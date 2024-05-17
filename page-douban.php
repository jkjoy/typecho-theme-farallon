<?php 
/**
 * 豆瓣页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle">观影数据来源于豆瓣</h2>
    </header>
    <div class="db--container">
    <div data-status="watched" class="douban-movie-list doubanboard-list"></div>
    </div>  
</section>
<?php $this->need('footer.php'); ?>