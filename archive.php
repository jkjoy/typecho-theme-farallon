<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

if (function_exists('farallon_is_json_request') && farallon_is_json_request()) {
    // 获取分类ID配置（保持与页面模板一致）
    $travelId = Helper::options()->travel;
    $memosId = Helper::options()->memos;
    $currentCategory = isset($this->categories[0]['mid']) ? intval($this->categories[0]['mid']) : null;
    $travelId = is_numeric($travelId) ? intval($travelId) : null;
    $memosId = is_numeric($memosId) ? intval($memosId) : null;

    if (!defined('FARALLON_LOADMORE_JSON')) {
        define('FARALLON_LOADMORE_JSON', true);
    }

    ob_start();
    if ($this->have()) {
        if ($currentCategory === $travelId) {
            $this->need('module/travel.php');
        } elseif ($currentCategory === $memosId) {
            $this->need('module/memos.php');
        } else {
            $this->need('module/postlist.php');
        }
    }
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
<?php $this->need('header.php'); ?>
<header class="archive--header">
    <h2 class="post--single__title">
        <?php $this->archiveTitle(array(
            'category'  =>  _t('  <span> %s </span> '),
            'search'    =>  _t('包含关键字<span> %s </span>的文章'),
            'date'      =>  _t('在 <span> %s </span>发布的文章'),
            'tag'       =>  _t('标签 <span> %s </span>下的文章'),
            'author'    =>  _t('作者 <span>%s </span>发布的文章')
        ), '', ''); ?>
    </h2>
    <div class="taxonomy--description">
        <?php echo $this->getDescription(); ?>
    </div>
</header>
<div class="site--main">
<?php
// 获取分类ID配置
$travelId = Helper::options()->travel;
$memosId = Helper::options()->memos;
// 安全地获取当前分类 mid
$currentCategory = isset($this->categories[0]['mid']) ? intval($this->categories[0]['mid']) : null;
// 转换为整型（如果需要）
$travelId = is_numeric($travelId) ? intval($travelId) : null;
$memosId = is_numeric($memosId) ? intval($memosId) : null;
?>
    <?php if ($this->have()): ?>
        <?php if ($currentCategory === $travelId): ?>
            <!-- 旅行分类模板 -->
            <?php $this->need('module/travel.php'); ?>
        <?php elseif ($currentCategory === $memosId): ?>
            <!-- 说说分类模板 -->
            <?php $this->need('module/memos.php'); ?>
        <?php else: ?>
            <!-- 默认文章列表 -->
            <?php $this->need('module/postlist.php'); ?>
        <?php endif; ?>
        <!-- 分页导航 -->
        <?php $this->need('module/paging.php'); ?>
    <?php else: ?>
        <!-- 无结果 -->
        <?php $this->need('module/notfound.php'); ?>
    <?php endif; ?>
</div>
<?php $this->need('footer.php'); ?>