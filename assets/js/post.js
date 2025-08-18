document.addEventListener('DOMContentLoaded', function() {
    const tooltip = document.getElementById('copyTooltip');
    let timeoutId = null;
    // 确保初始状态下提示框是隐藏的
    //tooltip.style.display = 'none';
    // 复制函数
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // 显示提示
            tooltip.style.display = 'block';
            tooltip.style.opacity = '1';           
            // 清除之前的定时器（如果存在）
            if (timeoutId) clearTimeout(timeoutId);           
            // 设置新的定时器
            timeoutId = setTimeout(() => {
                tooltip.style.opacity = '0';
                setTimeout(() => {
                    tooltip.style.display = 'none';
                }, 300); // 等待淡出动画完成后再隐藏
            }, 1500);
        }).catch(err => {
            tooltip.textContent = '复制失败，请重试';
            tooltip.style.display = 'block';
            tooltip.style.opacity = '1';
            
            if (timeoutId) clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                tooltip.style.opacity = '0';
                setTimeout(() => {
                    tooltip.style.display = 'none';
                    tooltip.textContent = '复制成功！'; // 重置文本
                }, 300);
            }, 1500);
            console.error('复制失败:', err);
        });
    }
    // 给所有复制链接添加点击事件
    document.querySelectorAll('.copy').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const textToCopy = this.getAttribute('data-copy') || this.textContent;
            copyToClipboard(textToCopy);
        });
    });
});
    
document.addEventListener('DOMContentLoaded', (event) => {
    const targetClassElement = document.querySelector('.post--single__title');
    const postContent = document.querySelector('.post--single__content');
    if (!postContent) return;
    let found = false;
    for (let i = 1; i <= 6 &&!found; i++) {
        if (postContent.querySelector(`h${i}`)) {
            found = true;
        }
    }
    if (!found) return;
    const heads = postContent.querySelectorAll('h1, h2, h3, h4, h5, h6');
    const toc = document.createElement('div');
    toc.id = 'toc';
    toc.innerHTML = '<details class="toc" open><summary class="toc-title">目录</summary><nav id="TableOfContents"><ul></ul></nav></details>';
    // 插入到指定 class 元素之后
    if (targetClassElement) {
        targetClassElement.parentNode.insertBefore(toc, targetClassElement.nextSibling);
    }
    let currentLevel = 0;
    let currentList = toc.querySelector('ul');
    let levelCounts = [0];
    heads.forEach((head, index) => {
        const level = parseInt(head.tagName.substring(1));
        if (levelCounts[level] === undefined) {
            levelCounts[level] = 1;
        } else {
            levelCounts[level]++;
        }
        // 重置下级标题的计数器
        levelCounts = levelCounts.slice(0, level + 1);
        if (currentLevel === 0) {
            currentLevel = level;
        }
        while (level > currentLevel) {
            let newList = document.createElement('ul');
            if (!currentList.lastElementChild) {
                currentList.appendChild(newList);
            } else {
                currentList.lastElementChild.appendChild(newList);
            }
            currentList = newList;
            currentLevel++;
            levelCounts[currentLevel] = 1;
        }
        while (level < currentLevel) {
            currentList = currentList.parentElement;
            if (currentList.tagName.toLowerCase() === 'li') {
                currentList = currentList.parentElement;
            }
            currentLevel--;
        }
        const anchor = head.textContent.trim().replace(/\s+/g, '-');
        head.id = anchor;
        const item = document.createElement('li');
        const link = document.createElement('a');
        link.href = `#${anchor}`;
        link.textContent = `${head.textContent}`;
        link.style.textDecoration = 'none';
        item.appendChild(link);
        currentList.appendChild(item);
    });
});

function fetchWithRetry(url, retries = 3) {
    return fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();  // 首先获取文本响应
        })
        .then(text => {
            try {
                return JSON.parse(text);  // 尝试解析 JSON
            } catch (e) {
                console.error('Invalid JSON:', text);
                throw new Error('Invalid JSON response');
            }
        })
        .catch(error => {
            if (retries > 0) {
                console.log(`Retrying... (${retries} attempts left)`);
                return new Promise(resolve => setTimeout(resolve, 1000))  // 等待1秒
                    .then(() => fetchWithRetry(url, retries - 1));
            }
            throw error;
        });
}
document.addEventListener('DOMContentLoaded', function() {
    const doubanLinks = document.querySelectorAll('a[href^="https://movie.douban.com/subject/"]');
    doubanLinks.forEach(link => {
        const url = link.href;
        const movieId = url.match(/subject\/(\d+)/)[1];
        link.innerHTML += ' <span class="loading">(加载中...)</span>';
        fetchWithRetry(`https://api.loliko.cn/movies/${movieId}`)
            .then(data => {
                const movieInfo = createMovieInfoHTML(data, url);
                const wrapper = document.createElement('div');
                wrapper.innerHTML = movieInfo;
                link.parentNode.replaceChild(wrapper, link);
            })
            .catch(error => {
                console.error('Error fetching movie data:', error);
                // 显示错误消息给用户
                link.innerHTML = `<span style="color: red;">加载失败</span> <a href="${url}" target="_blank">查看豆瓣电影详情</a>`;
            })
            .finally(() => {
                const loadingSpan = link.querySelector('.loading');
                if (loadingSpan) {
                    loadingSpan.remove();
                }
            });
    });
});
function createMovieInfoHTML(data, originalUrl) {
    if (!data || data.error || Object.keys(data).length === 0) {
        return `<a href="${originalUrl}" target="_blank">查看豆瓣电影详情</a>`;
    }
    return `
    <div class=doulist-item>
    <div class=doulist-subject>
        <div class=doulist-post>
           <img decoding=async referrerpolicy=no-referrer src=${data.img}>
        </div>
        <div class=doulist-content>
            <div class=doulist-title>
               <a href="${originalUrl}" class=cute target="_blank" rel="external nofollow"> ${data.name} </a>
            </div>
            <div class=rating>
                <span class=rating_nums>豆瓣评分 : ${data.rating}</span>
            </div>
            <div class=abstract>
               ${data.year}年 · ${data.country} · ${data.genre}  · 导演: ${data.director} · 演员 : ${data.actor} 
            </div>
        </div> 
    </div>     
    </div>
    `;
}

class LikeHandler {
    constructor() {
        this.likeButtons = document.querySelectorAll('.like-btn');
        this.lastSendTime = 0;
        this.throttleTimeMs = 3000; // 3秒节流
        this.init();
    }

    getCookie(name) {
        if (document.cookie.length > 0) {
            let start = document.cookie.indexOf(name + '=');
            if (start !== -1) {
                start = start + name.length + 1;
                let end = document.cookie.indexOf(';', start);
                if (end === -1) end = document.cookie.length;
                return document.cookie.substring(start, end);
            }
        }
        return '';
    }

    setCookie(name, value, days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        let expires = '; expires=' + date.toUTCString();
        document.cookie = name + '=' + value + expires + '; path=/';
    }

    showNotice(message, type = 'success') {
        let notice = `<div class="notice--wrapper ${type}">${message}</div>`;
        document.querySelector('body').insertAdjacentHTML('beforeend', notice);
        let wrapper = document.querySelector('.notice--wrapper');
        wrapper.classList.add('is-active');
        setTimeout(() => {
            wrapper.remove();
        }, 3000);
    }

    replaceSvg(button) {
        const svg = button.querySelector('.icon--default');
        // 添加动画类
        svg.classList.add('animate-like');
        // 立即更新SVG确保可见
        svg.innerHTML = `<svg class="icon--default" viewBox="0 0 1024 1024" width="12" height="12" style="fill: currentColor !important;"><path d="M780.8 204.8c-83.2-44.8-179.2-19.2-243.2 44.8L512 275.2 486.4 249.6c-64-64-166.4-83.2-243.2-44.8C108.8 275.2 89.6 441.6 185.6 537.6l32 32 153.6 153.6 102.4 102.4c25.6 25.6 57.6 25.6 83.2 0l102.4-102.4 153.6-153.6 32-32C934.4 441.6 915.2 275.2 780.8 204.8z"></path></svg>`;
        // 动画结束后移除类
        setTimeout(() => {
            svg.classList.remove('animate-like');
        }, 600);
    }

    init() {
        this.likeButtons.forEach(button => {
            let cid = button.getAttribute('data-cid');
            // 同时检查cookie和localStorage
            if (this.getCookie('extend_contents_likes_' + cid) ||
                localStorage.getItem('extend_contents_likes_' + cid)) {
                button.classList.add('is-active');
                button.disabled = true;
                this.replaceSvg(button);
            }
            button.addEventListener('click', () => this.handleLike(button, cid));
        });
    }

    handleLike(button, cid) {
        const currentTime = new Date().getTime();
        if (currentTime - this.lastSendTime < this.throttleTimeMs) {
            this.showNotice('操作过于频繁', 'error');
            return;
        }
        this.lastSendTime = currentTime;

        if (this.getCookie('extend_contents_likes_' + cid) ||
            localStorage.getItem('extend_contents_likes_' + cid)) {
            this.showNotice('您已经点过赞了', 'error');
            return;
        }

        fetch('/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'likeup=1&cid=' + cid
        })
        .then(response => {
            if (!response.ok) throw new Error('网络响应错误');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                button.querySelector('.count').textContent = data.likes;
                button.classList.add('is-active');
                button.disabled = true;
                this.replaceSvg(button);
                this.setCookie('extend_contents_likes_' + cid, '1', 30);
                localStorage.setItem('extend_contents_likes_' + cid, '1');
                this.showNotice('感谢您的点赞！');
            } else {
                this.showNotice(data.msg || '点赞失败', 'error');
            }
        })
        .catch(error => {
            console.error('错误:', error);
            this.showNotice('点赞异常', 'error');
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new LikeHandler();
});