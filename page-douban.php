<?php 
/**
 * 豆瓣页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<script src="<?php $this->options->themeUrl('/dist/js/db.js'); ?>"></script>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?></h2>
    </header>
    <div class="site--main">
    <div class="db--container"></div>
    <script>
     new Douban({
     baseAPI: '<?php $this->options->doubanID() ?>', // api
     container: ".db--container", // 容器名
    });
    </script>
</div>
</section>
<?php $this->need('footer.php'); ?>