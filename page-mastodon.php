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
    <script src="<?php $this->options->themeUrl('/dist/js/marked.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/dist/css/lightbox.min.css'); ?>">
    <script src="<?php $this->options->themeUrl('/dist/js/lightbox-plus-jquery.min.js'); ?>"></script>
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
            // 判断是否存在 reblog
            const isReblog = toot.reblog && toot.reblog.content;
            const content = isReblog ? toot.reblog.content : toot.content;
            const url = isReblog ? toot.reblog.url : toot.url;
            const account = isReblog ? toot.reblog.account : toot.account;
            const created_at = isReblog ? toot.reblog.created_at : toot.created_at;
            const media_attachments = isReblog ? toot.reblog.media_attachments : toot.media_attachments;

            let mediaHTML = ''; // 初始化资源相关HTML为空字符串
            // 处理媒体附件
            if (media_attachments.length > 0) {
                media_attachments.forEach(attachment => {
                    if (attachment.type === 'image') {
                        mediaHTML += `<a href="${attachment.url}" target="_blank" data-lightbox="image-set"><img src="${attachment.preview_url}" class="thumbnail-image img" ></a>`;
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
                <img src="${account.avatar}" class="avatar" width="48" height="48" no-view />
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
</script>         
<style>
div pre code {
  white-space: pre-wrap;  
  word-wrap: break-word; 
  overflow-wrap: break-word;  
  word-break: break-all;  
  word-break: break-word;  
}
div p a {
    word-break: break-all;  
  word-break: break-word;  
}
.resimg {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 10px; 
    row-gap: 10px; 
}
/* 单个缩略图的样式 */
.thumbnail-image {
    width: 100%; /* 确保其宽度填满父容器 */
    height: 200px; /* 固定高度 */
    display: flex; /* 使用 flexbox 居中 */
    align-items: center; /* 垂直居中 */
    justify-content: center; /* 水平居中 */
    overflow: hidden; /* 确保容器内的多余内容不会显示出来 */
    border-radius: 4px; /* 圆角 */
    transition: transform .3s ease; /* 鼠标悬停时的过渡效果 */
    cursor: zoom-in; /* 鼠标指针变为放大镜 */
}
img {
    object-fit: cover; /* 保持图片的纵横比，但会将图片裁剪以填充容器 */
    object-position: center; /* 保证中央部分 */
}
/* 缩略图内的图片样式 */
.thumbnail-image img {
    width: 100%;
    min-height: 200px;
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
    .thumbnail-image img {
       width: 100%;
       height: 480px;
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
