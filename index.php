<?php
/**
 * @package farallon
 * @author 原作者 bigfa 老孙移植
 * @version 0.4.1
 * @link https://imsun.org
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