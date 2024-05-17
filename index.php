<?php
/**
 * @package zizhi
 * @author zizhi
 * @version 1.0
 * @link https://minirizhi.com
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