<?php
/**
 * 一款简洁优雅的单栏主题. 移植自HUGO主题 <a href="https://github.com/bigfa/Farallon">Farallon</a> 原作者 bigfa  
 * 适配Typecho 1.3.0
 * @package Farallon
 * @author  老孙 
 * @version 1.0.0
 * @link https://www.imsun.org
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

if (function_exists('farallon_is_json_request') && farallon_is_json_request()) {
    // 保持与正常列表一致的查询/分页行为（置顶逻辑在该文件内处理）
    $this->need('module/sticky.php');

    if (!defined('FARALLON_LOADMORE_JSON')) {
        define('FARALLON_LOADMORE_JSON', true);
    }

    ob_start();
    $this->need('module/postlist.php');
    $html = trim(ob_get_clean());

    $nextUrl = function_exists('farallon_get_next_page_url') ? farallon_get_next_page_url($this) : '';
    farallon_send_json([
        'success' => true,
        'html' => $html,
        'next' => $nextUrl,
        'hasMore' => (bool)$nextUrl
    ]);
}
?>
<?php $this->need('module/sticky.php'); ?>
<?php $this->need('header.php');?>
<main class="site--main">
    <div class="articleList">
    <?php $this->need('module/postlist.php'); ?>
    <?php $this->need('module/paging.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>