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
    document.querySelectorAll('.text').forEach(link => {
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