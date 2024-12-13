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
    <?php
       // 获取自定义字段 douban 的值，如果不存在则使用默认值
        $douban = $this->fields->douban ? $this->fields->douban : 'https://db.imsun.org/';
       // 确保URL末尾只有一个斜杠
        $douban = rtrim($douban, '/') . '/';
    ?>
<script>
new Douban({
    baseAPI: <?php echo json_encode($douban); ?>,
    container: ".db--container",
});
</script>
</div>
</section>
<?php $this->need('footer.php'); ?>