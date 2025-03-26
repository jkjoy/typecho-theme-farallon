<?php 
/**
 * 全部分类
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
    <section class="category--list">
    <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
    <?php while($categories->next()): ?>
    <?php
    // 获取分类 ID
    $categoryId = $categories->mid;
    $themeUrl = $this->options->midimg;
    // 为每个分类生成图片地址
    $categoryImage = $themeUrl . $categoryId . '.jpg';
    ?>
    <div class="category--item">
    <img class="category--cover" src="<?php echo $categoryImage; ?>" loading="lazy" alt="<?php $categories->name(); ?>">
    <div class="category--content">
        <a class="category--card" href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?>
        <span>(<?php $categories->count(); ?>)</span></a>
        <div class="category--desc">   <?php $categories->description(); ?>
        </div>
        </div>
        </div>  
    <?php endwhile; ?>
    </section>
</div>
<?php $this->need('footer.php'); ?>