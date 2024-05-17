<?php
/**
 * 移植自HUGO主题`farallon`原作者`bigfa` 
 * @package farallon
 * @author  老孙 
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