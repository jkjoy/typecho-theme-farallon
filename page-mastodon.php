<?php 
/**
 * 说说页面 - Mastodon
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?> </h2>
    </header>
    <article class="post--single">
    <?php $tooot = $this->fields->tooot ? $this->fields->tooot : 'https://bbapi.ima.cm'; ?>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />    
    <div id="tooot"></div>
    <div class="nav-links" id="loadmore">
        <span class="loadmore">加载更多</span>
    </div>
    </article> 
<script>
window.onload = function() {
    let offset = 0; // 初始偏移量
    const limit = 20; // 每次加载的数量
    function formatHTML(toots) {
        let htmlString = '';      
        toots.forEach(toot => {
            const { content, account, url, created_at, media_attachments} = toot;
            let mediaHTML = ''; // 初始化资源相关HTML为空字符串
            // 处理媒体附件
            if (media_attachments.length > 0) {
                media_attachments.forEach(attachment => {
                    if (attachment.type === 'image') {
                        mediaHTML += `<a href="${attachment.url}" target="_blank"><img src="${attachment.preview_url}" data-fancybox="img" class="thumbnail-image img"></a>`;
                    }
                });
            }
            // 使用 marked 转换 markdown 内容为 HTML
            const htmlContent = marked.parse(content);
            // 创建 HTML 字符串
            htmlString += `
            <article class='post--item post--item__status'>
                <div class='content'>
                <header>
                <img src="${account.avatar}" class="avatar" width="48" height="48" />
                <a class="humane--time" href="${url}" target="_blank">${new Date(created_at).toLocaleString()}</a>
                </header>
                <div class="description" itemprop="about">
                ${htmlContent}
                <div class="resimg">${mediaHTML}</div>
                </div>
                </div>
                </article>`;
        });
        return htmlString;
    }
    function fetchToots() {
        return fetch('<?php echo $tooot; ?>')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching toots:', error);
                return [];
            });
    }
    function fetchAndDisplayToots() {
        fetchToots().then(data => {
            const memosContainer = document.getElementById('tooot');
            const tootsToShow = data.slice(offset, offset + limit); // 选择要显示的toots
            memosContainer.innerHTML += formatHTML(tootsToShow);
            offset += limit; // 更新偏移量
            // 如果没有更多的toots，隐藏“加载更多”按钮
            if (offset >= data.length) {
                document.getElementById('loadmore').style.display = 'none';
            }
        });
    }
    // 在页面加载完成后获取并展示 toots
    fetchAndDisplayToots();
    // 绑定“加载更多”按钮的点击事件
    document.getElementById('loadmore').addEventListener('click', fetchAndDisplayToots);
};
Fancybox.bind("[data-fancybox]", {
  // Your custom options
});
</script>         
<style>
div pre code {
  /* 迫使文字断行 */
  white-space: pre-wrap; /* CSS3 */
  word-wrap: break-word; /* 老版本的浏览器 */
  overflow-wrap: break-word;  
  /* 指定如何断行 */
  word-break: break-all;  
  word-break: break-word;  
}
div p a {
    word-break: break-all;  
  word-break: break-word;  
}
.thumbnail-image {
    width:100%;
    height: 200px;  
    align-items: center; 
    justify-content: center;
    overflow: hidden;
}
.resimg {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 10px; 
    row-gap: 10px; 
}
.thumbnail-image img {
    width:100%;
    height:170px;
    object-fit:cover;
    border-radius:4px;
    transition:transform .3s ease;
    cursor:zoom-in
}  
/* 当屏幕宽度小于732px时 */
@media (max-width: 732px) {
    .resimg {
        grid-template-columns: repeat(2, 1fr); /* 修改为两列 */
    }
}
/* 当屏幕宽度小于400px时 */
@media (max-width: 400px) {
    .resimg {
        grid-template-columns: 1fr; /* 修改为一列 */
    }
} 
.load-more-btn {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
  }
.load-more-btn:hover {
      background-color: #0056b3;
  } 
.nav-links .loadmore {
    border: 1px solid var(--farallon-border-color);
    cursor: pointer;
    position: relative;
    padding: 5px 30px;
    border-radius: 8px;
    font-size: 14px;
    color: var(--farallon-text-gray)
}

.nav-links .loadmore:hover {
    border-color: var(--farallon-hover-color);
    color: var(--farallon-hover-color)
}  
</style>  
</div>
<?php $this->need('footer.php'); ?>