<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main class="site--main">
<header class="archive--header">
<h1 class="post--single__title"><?php $this->title() ?></h1>
</header>
    <article class="post--single">
			 
        <div class="graph u-marginBottom30">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>
</main>
<?php $this->need('footer.php'); ?>
 