<?php
/**
 * 一款单栏主题. 移植自HUGO主题 Farallon 原作者 bigfa  
 * @package Farallon
 * @author  老孙 
 * @version 0.6.3
 * @link https://www.imsun.org
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="site--main">
<div class="articleList">
<?php $this->need('postlist.php'); ?>
</div>
</main>
<?php $this->need('footer.php'); ?>