(() => {
    const onReady = (fn) => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn, { once: true });
        } else {
            fn();
        }
    };

    const showNotice = (() => {
        let el = null;
        let timer = null;

        const ensure = () => {
            if (el) return el;
            el = document.getElementById('farallonNotice');
            if (!el) {
                el = document.createElement('div');
                el.id = 'farallonNotice';
                el.className = 'notice--wrapper';
                el.setAttribute('role', 'status');
                el.setAttribute('aria-live', 'polite');
                el.style.display = 'block';
                el.style.opacity = '0';
                el.style.pointerEvents = 'none';
                el.style.transition = 'opacity 0.3s ease-in-out';
                document.body.appendChild(el);
            }
            return el;
        };

        return (message, type = 'success') => {
            const node = ensure();
            node.classList.remove('success', 'error');
            node.classList.add(type);
            node.textContent = String(message || '');
            node.style.opacity = '1';
            if (timer) clearTimeout(timer);
            timer = setTimeout(() => {
                node.style.opacity = '0';
            }, 1500);
        };
    })();

    const copyToClipboard = async (text) => {
        const value = (text ?? '').toString().trim();
        if (!value) {
            showNotice('没有可复制的内容', 'error');
            return;
        }

        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(value);
                showNotice('复制成功！', 'success');
                return;
            }
        } catch (err) {
            console.error('Clipboard API failed:', err);
        }

        const textarea = document.createElement('textarea');
        textarea.value = value;
        textarea.setAttribute('readonly', '');
        textarea.style.position = 'fixed';
        textarea.style.left = '-9999px';
        textarea.style.top = '0';
        document.body.appendChild(textarea);
        textarea.focus();
        textarea.select();
        textarea.setSelectionRange(0, textarea.value.length);

        try {
            const ok = document.execCommand('copy');
            showNotice(ok ? '复制成功！' : '复制失败，请手动复制', ok ? 'success' : 'error');
        } catch (err) {
            console.error('execCommand copy failed:', err);
            showNotice('复制失败，请手动复制', 'error');
        } finally {
            textarea.remove();
        }
    };

    const initCopy = () => {
        document.addEventListener('click', (e) => {
            const target = e.target.closest('[data-copy], .copy, .cpoy');
            if (!target) return;
            if (target.tagName && target.tagName.toLowerCase() === 'a') {
                e.preventDefault();
            }
            const text = target.getAttribute('data-copy') || target.textContent;
            copyToClipboard(text);
        });
    };

    const initToc = () => {
        const postContent = document.querySelector('.post--single__content');
        if (!postContent) return;
        if (document.getElementById('toc')) return;

        const headings = Array.from(postContent.querySelectorAll('h1, h2, h3, h4, h5, h6')).filter(
            (h) => (h.textContent || '').trim().length > 0
        );
        if (!headings.length) return;

        const toc = document.createElement('div');
        toc.id = 'toc';
        toc.innerHTML =
            '<details class="toc" open><summary class="toc-title">目录</summary><nav id="TableOfContents"><ul></ul></nav></details>';

        const titleEl = document.querySelector('.post--single__title');
        if (titleEl && titleEl.parentNode) {
            titleEl.parentNode.insertBefore(toc, titleEl.nextSibling);
        } else if (postContent.parentNode) {
            postContent.parentNode.insertBefore(toc, postContent);
        }

        const rootUl = toc.querySelector('#TableOfContents > ul');
        if (!rootUl) return;

        const usedIds = new Set();
        const ensureId = (h, idx) => {
            if (h.id) {
                h.id = h.id.replace(/\s+/g, '-');
                usedIds.add(h.id);
                return h.id;
            }
            const base =
                (h.textContent || 'heading')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[#?&%]/g, '') || `heading-${idx + 1}`;
            let id = base;
            let n = 1;
            while (usedIds.has(id) || document.getElementById(id)) {
                id = `${base}-${n++}`;
            }
            h.id = id;
            usedIds.add(id);
            return id;
        };

        const firstLevel = parseInt(headings[0].tagName.substring(1), 10) || 1;
        let currentLevel = firstLevel;
        const stack = [rootUl];

        headings.forEach((h, idx) => {
            const level = parseInt(h.tagName.substring(1), 10) || currentLevel;
            const id = ensureId(h, idx);

            while (level > currentLevel) {
                const parent = stack[stack.length - 1];
                const lastLi = parent.lastElementChild;
                const ul = document.createElement('ul');
                (lastLi || parent).appendChild(ul);
                stack.push(ul);
                currentLevel++;
            }
            while (level < currentLevel && stack.length > 1) {
                stack.pop();
                currentLevel--;
            }

            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = `#${id}`;
            a.textContent = (h.textContent || '').trim();
            a.style.textDecoration = 'none';
            li.appendChild(a);
            stack[stack.length - 1].appendChild(li);
        });
    };

    const initDouban = () => {
        const links = Array.from(document.querySelectorAll('a[href^="https://movie.douban.com/subject/"]'));
        if (!links.length) return;

        const memoryCache = new Map();
        const inFlight = new Map();
        const cacheKey = (id) => `farallon_douban_${id}`;

        const readCache = (id) => {
            if (memoryCache.has(id)) return memoryCache.get(id);
            try {
                const raw = sessionStorage.getItem(cacheKey(id));
                if (!raw) return null;
                const data = JSON.parse(raw);
                memoryCache.set(id, data);
                return data;
            } catch {
                return null;
            }
        };

        const writeCache = (id, data) => {
            memoryCache.set(id, data);
            try {
                sessionStorage.setItem(cacheKey(id), JSON.stringify(data));
            } catch {
                // ignore
            }
        };

        const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

        const fetchJsonWithRetry = async (url, { retries = 2, timeoutMs = 8000 } = {}) => {
            let lastErr = null;
            for (let i = 0; i <= retries; i++) {
                const controller = typeof AbortController !== 'undefined' ? new AbortController() : null;
                const tid = controller ? setTimeout(() => controller.abort(), timeoutMs) : null;
                try {
                    const res = await fetch(url, {
                        signal: controller ? controller.signal : undefined,
                        headers: { Accept: 'application/json' }
                    });
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    try {
                        return await res.json();
                    } catch {
                        const text = await res.text();
                        return JSON.parse(text);
                    }
                } catch (err) {
                    lastErr = err;
                    if (i < retries) await sleep(800 * Math.pow(2, i));
                } finally {
                    if (tid) clearTimeout(tid);
                }
            }
            throw lastErr || new Error('Fetch failed');
        };

        const createMovieNode = (data, originalUrl) => {
            if (!data || data.error || Object.keys(data).length === 0) {
                const a = document.createElement('a');
                a.href = originalUrl;
                a.target = '_blank';
                a.rel = 'noopener noreferrer external nofollow';
                a.textContent = '查看豆瓣电影详情';
                return a;
            }

            const wrap = document.createElement('div');
            wrap.className = 'doulist-item';
            const subject = document.createElement('div');
            subject.className = 'doulist-subject';

            const poster = document.createElement('div');
            poster.className = 'doulist-post';
            const img = document.createElement('img');
            img.decoding = 'async';
            img.referrerPolicy = 'no-referrer';
            img.src = data.img || '';
            img.alt = (data.name || '').toString();
            poster.appendChild(img);

            const content = document.createElement('div');
            content.className = 'doulist-content';
            const title = document.createElement('div');
            title.className = 'doulist-title';
            const a = document.createElement('a');
            a.href = originalUrl;
            a.className = 'cute';
            a.target = '_blank';
            a.rel = 'noopener noreferrer external nofollow';
            a.textContent = (data.name || '').toString();
            title.appendChild(a);

            const rating = document.createElement('div');
            rating.className = 'rating';
            const ratingSpan = document.createElement('span');
            ratingSpan.className = 'rating_nums';
            ratingSpan.textContent = `豆瓣评分 : ${(data.rating ?? '').toString()}`;
            rating.appendChild(ratingSpan);

            const abstract = document.createElement('div');
            abstract.className = 'abstract';
            abstract.textContent = `${(data.year ?? '').toString()}年 · ${(data.country ?? '').toString()} · ${(data.genre ?? '').toString()} · 导演: ${(data.director ?? '').toString()} · 演员 : ${(data.actor ?? '').toString()}`;

            content.appendChild(title);
            content.appendChild(rating);
            content.appendChild(abstract);

            subject.appendChild(poster);
            subject.appendChild(content);
            wrap.appendChild(subject);
            return wrap;
        };

        const replaceWithError = (link) => {
            const url = link.href;
            const wrap = document.createElement('span');
            const err = document.createElement('span');
            err.style.color = 'red';
            err.textContent = '加载失败 ';
            const a = document.createElement('a');
            a.href = url;
            a.target = '_blank';
            a.rel = 'noopener noreferrer external nofollow';
            a.textContent = '查看豆瓣电影详情';
            wrap.appendChild(err);
            wrap.appendChild(a);
            link.replaceWith(wrap);
        };

        const MAX_CONCURRENT = 3;
        let active = 0;
        const queue = [];
        const runNext = () => {
            while (active < MAX_CONCURRENT && queue.length) {
                const job = queue.shift();
                active++;
                job()
                    .catch(() => {})
                    .finally(() => {
                        active--;
                        runNext();
                    });
            }
        };
        const enqueue = (job) => {
            queue.push(job);
            runNext();
        };

        const loadOne = (link) => {
            if (link.dataset.doubanLoaded === '1') return;
            link.dataset.doubanLoaded = '1';

            const url = link.href;
            const match = url.match(/subject\/(\d+)/);
            const movieId = match ? match[1] : null;
            if (!movieId) return;

            const loading = document.createElement('span');
            loading.className = 'loading';
            loading.textContent = '(加载中...)';
            link.appendChild(document.createTextNode(' '));
            link.appendChild(loading);

            const cached = readCache(movieId);
            if (cached) {
                link.replaceWith(createMovieNode(cached, url));
                return;
            }

            if (inFlight.has(movieId)) {
                inFlight.get(movieId)
                    .then((data) => link.replaceWith(createMovieNode(data, url)))
                    .catch(() => replaceWithError(link));
                return;
            }

            enqueue(async () => {
                try {
                    const apiUrl = `https://api.loliko.cn/movies/${movieId}`;
                    const p = fetchJsonWithRetry(apiUrl);
                    inFlight.set(movieId, p);
                    const data = await p;
                    writeCache(movieId, data);
                    link.replaceWith(createMovieNode(data, url));
                } catch (err) {
                    console.error('Douban fetch failed:', err);
                    replaceWithError(link);
                } finally {
                    inFlight.delete(movieId);
                }
            });
        };

        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            io.unobserve(entry.target);
                            loadOne(entry.target);
                        }
                    });
                },
                { rootMargin: '200px 0px' }
            );
            links.forEach((link) => io.observe(link));
        } else {
            links.forEach((link) => loadOne(link));
        }
    };

    const initLike = () => {
        const buttons = Array.from(document.querySelectorAll('.like-btn'));
        if (!buttons.length) return;

        const getCookie = (name) => {
            if (!document.cookie) return '';
            const parts = document.cookie.split(';').map((p) => p.trim());
            const kv = parts.find((p) => p.startsWith(`${name}=`));
            if (!kv) return '';
            return kv.substring(name.length + 1);
        };

        const setCookie = (name, value, days) => {
            const date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
        };

        const hasLiked = (cid) => {
            const key = `extend_contents_likes_${cid}`;
            return getCookie(key) || localStorage.getItem(key);
        };

        const markLiked = (cid) => {
            const key = `extend_contents_likes_${cid}`;
            setCookie(key, '1', 30);
            localStorage.setItem(key, '1');
        };

        const setActive = (button) => {
            button.classList.add('is-active');
            button.setAttribute('aria-pressed', 'true');
            const svg = button.querySelector('svg');
            if (svg) {
                svg.style.color = '#ff4d4f';
                svg.style.fill = '#ff4d4f';
            }
        };

        buttons.forEach((button) => {
            const cid = button.getAttribute('data-cid');
            if (!cid) return;

            if (hasLiked(cid)) setActive(button);

            button.addEventListener('click', async () => {
                if (hasLiked(cid)) {
                    showNotice('您已经点过喜欢了，请不要重复点击～', 'error');
                    return;
                }
                if (button.dataset.loading === '1') return;
                button.dataset.loading = '1';

                try {
                    const body = new URLSearchParams({ likeup: '1', cid: String(cid) });
                    const res = await fetch('/', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            Accept: 'application/json'
                        },
                        body: body.toString(),
                        credentials: 'same-origin'
                    });
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);

                    const data = await res.json();
                    if (data && data.success) {
                        const countEl = button.querySelector('.count');
                        if (countEl) countEl.textContent = data.likes;
                        setActive(button);
                        markLiked(cid);
                        showNotice('点赞成功！感谢你的喜爱～', 'success');
                    } else {
                        showNotice((data && data.msg) || '点赞失败', 'error');
                    }
                } catch (err) {
                    console.error('Like error:', err);
                    showNotice('点赞异常', 'error');
                } finally {
                    button.dataset.loading = '0';
                }
            });
        });
    };

    onReady(() => {
        initCopy();
        initToc();
        initDouban();
        initLike();
    });
})();
