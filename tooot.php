<?php 
/**
 * 说说页面1 - Mastodon
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
 
    <?php
    require 'Parsedown.php'; 

    use Parsedown;
// 获取 API 地址
$tooot = $this->fields->tooot ? $this->fields->tooot : 'https://bbapi.ima.cm';

// 获取当前页码，默认为第一页
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 每页显示的数量
$limit = 20;

// 计算偏移量
$offset = ($page - 1) * $limit;

// 使用 file_get_contents 获取数据
$data = file_get_contents($tooot);
$toots = json_decode($data, true);

// 只获取当前页的数据
$tootsToShow = array_slice($toots, $offset, $limit);

// 初始化 Parsedown
$parsedown = new Parsedown();
?>

    <script src="<?php $this->options->themeUrl('/dist/js/marked.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/dist/js/view-image.min.js'); ?>"></script>
 
    <div id="tooot">
        <?php foreach ($tootsToShow as $toot): ?>
            <article class='post--item post--item__status'>
                <div class='content'>
                    <header>
                        <img src="<?php echo $toot['account']['avatar']; ?>" class="avatar" width="48" height="48" no-view />
                        <a class="humane--time" href="<?php echo $toot['url']; ?>" target="_blank"><?php echo date('Y-m-d H:i:s', strtotime($toot['created_at'])); ?></a>
                    </header>
                    <div class="description" itemprop="about">
                    <?php echo $parsedown->text($toot['content']); ?>
                        <div class="resimg">
                            <?php foreach ($toot['media_attachments'] as $attachment): ?>
                                <?php if ($attachment['type'] === 'image'): ?>
                                    <a href="<?php echo $attachment['url']; ?>" target="_blank"><img src="<?php echo $attachment['preview_url']; ?>" class="thumbnail-image img"></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="nav-links" id="loadmore">
        <?php if ($offset + $limit < count($toots)): ?>
            <a href="?page=<?php echo $page + 1; ?>" class="loadmore">加载更多</a>
        <?php endif; ?>
    </div>
    <script>
        window.ViewImage && ViewImage.init('.content img');
    </script>
 
 </article>  
<style>
div pre code {
  /* 迫使文字断行 */
  white-space: pre-wrap; /* CSS3 */
  word-wrap: break-word; /* 老版本的浏览器 */
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