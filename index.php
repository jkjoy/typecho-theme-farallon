<?php
/**
 * 一款单栏主题. 
 * 移植自HUGO主题 <a href="https://github.com/bigfa/Farallon">Farallon</a>
 * 原作者 bigfa  
 * * 适配Typecho 1.3.0
 * @package Farallon
 * @author  老孙 
 * @version 0.8.2
 * @link https://www.imsun.org
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('module/sticky.php'); ?>
<?php $this->need('header.php');?>
<main class="site--main">
    <div class="articleList">
    <?php $this->need('module/postlist.php'); ?>
    <?php $this->need('module/paging.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>