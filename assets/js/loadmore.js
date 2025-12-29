(() => {
    let inFlightController = null;

    const toJsonUrl = (url) => {
        try {
            const u = new URL(url, window.location.href);
            u.searchParams.set('format', 'json');
            u.hash = '';
            return u.toString();
        } catch {
            // 兜底：尽量在原 URL 后追加 format=json
            const parts = String(url).split('#');
            const base = parts[0];
            const hash = parts[1] ? `#${parts[1]}` : '';
            if (base.includes('?')) return `${base}&format=json${hash}`;
            return `${base}?format=json${hash}`;
        }
    };

    const parsePostsFromHtml = (html) => {
        const tpl = document.createElement('template');
        tpl.innerHTML = html || '';
        return tpl.content.querySelectorAll('.loadpost');
    };

    const setLoadingState = (btn, loading, text) => {
        if (!btn.dataset.originalText) {
            btn.dataset.originalText = btn.textContent || '加载更多';
        }
        btn.classList.toggle('loading', loading);
        btn.setAttribute('aria-busy', loading ? 'true' : 'false');
        btn.setAttribute('aria-disabled', loading ? 'true' : 'false');
        if (loading) {
            btn.dataset.href = btn.getAttribute('href') || '';
            btn.removeAttribute('href');
        } else if (!btn.getAttribute('href') && btn.dataset.href) {
            btn.setAttribute('href', btn.dataset.href);
        }
        btn.textContent = text || (loading ? '加载中...' : btn.dataset.originalText);
    };

    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.loadmore a');
        if (!btn) return;

        e.preventDefault();

        if (btn.classList.contains('loading')) return;

        const nextPage = btn.getAttribute('href');
        if (!nextPage) return;

        const articleList =
            document.querySelector('#loadposts') ||
            document.querySelector('.posts-container');
        const navLinks = document.querySelector('.nav-links');
        if (!articleList) return;

        // 取消上一条未完成请求（防抖/避免并发插入）
        if (inFlightController && typeof inFlightController.abort === 'function') {
            inFlightController.abort();
        }
        inFlightController = typeof AbortController !== 'undefined' ? new AbortController() : null;

        setLoadingState(btn, true, '加载中...');

        try {
            const res = await fetch(toJsonUrl(nextPage), {
                signal: inFlightController ? inFlightController.signal : undefined,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const data = await res.json();
            if (!data || data.success !== true) {
                throw new Error('Invalid JSON response');
            }

            const newPosts = parsePostsFromHtml(data.html);

            if (newPosts && newPosts.length) {
                const fragment = document.createDocumentFragment();
                newPosts.forEach((post) => {
                    post.style.opacity = 0;
                    fragment.appendChild(post);
                });
                articleList.appendChild(fragment);

                // 淡入（尊重减少动画偏好）
                const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                if (!reduceMotion) {
                    requestAnimationFrame(() => {
                        newPosts.forEach((post) => {
                            post.style.transition = 'opacity 0.35s';
                            post.style.opacity = 1;
                        });
                    });
                } else {
                    newPosts.forEach((post) => (post.style.opacity = 1));
                }
            }

            if (data.next) {
                btn.setAttribute('href', data.next);
                setLoadingState(btn, false, btn.dataset.originalText);
            } else {
                if (navLinks) navLinks.remove();
            }
        } catch (err) {
            // Abort 不提示错误
            if (err && err.name === 'AbortError') return;
            console.error('Load more error:', err);
            setLoadingState(btn, false, '加载失败，点击重试');
        } finally {
            inFlightController = null;
        }
    });
})();
