<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
<header class="archive--header">
<h1 class="post--single__title"><?php $this->title() ?></h1>
</header>
    <article class="post--single">
        <div class="graph u-marginBottom30">
            <?php $this->content(); ?>
        </div>
    <!-- 判断如果禁止评论则不显示评论的div -->
    <?php if ($this->allow('comment')): ?>
       <?php $this->need('comments.php'); ?>
   <?php endif; ?>
   <!-- 可以使用第三方评论-->
<?php $this->options->twikoo(); ?> 
</article>
</section>
<?php $this->need('footer.php'); ?>
 