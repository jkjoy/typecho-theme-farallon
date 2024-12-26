<?php 
/**
 * Neodb 页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('/dist/css/neodb.css'); ?>">
<script src="<?php $this->options->themeUrl('/dist/js/neodb.js'); ?>"></script>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?></h2>
    </header>
    <div class="site--main">
    <div class="neodb-container"></div>
    <?php $neodb = $this->fields->neodb ? $this->fields->neodb : 'https://neodb.imsun.org'; ?>
<script>
const neodb = new NeoDB({
    container: ".neodb-container",
    baseAPI: "<?php echo $neodb; ?>/api",
    types: ["book", "movie", "tv", "music", "game"],
});    
</script>
</div>
</section>
<?php $this->need('footer.php'); ?>