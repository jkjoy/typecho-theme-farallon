<?php 
/**
 * 友情链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
<header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="archive--title__year"> </h2>
</header>
<div class="graph u-marginBottom30">
<?php $this->content(); ?>
        </div>
    <div class="template--linksWrap">
        <ul class="link-items">
            <?php
            Links_Plugin::output('<li class="link-item"><a class="link-item-inner effect-apollo" href="{url}" target="_blank">      
            <span class="sitename"><strong>{name}</strong>{title}</span>     
            </a></li>');
        ?>
</ul>
    </div>
    <?php if ($this->allow('comment')): ?>
       <?php $this->need('comments.php'); ?>
   <?php endif; ?>
</section>
<?php $this->need('footer.php'); ?>
