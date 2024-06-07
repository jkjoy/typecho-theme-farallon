<?php
/**
 * 说说页面 - 时光机
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?> </h2>
    </header>
    <article class="post--single">
            <?php $this->need('times/dycomment.php'); ?>
    </article> 
</section>
<?php $this->need('footer.php'); ?>