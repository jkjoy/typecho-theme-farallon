<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('module/header.php'); ?>
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
        <?php $this->pageNav(
            ' ',
            ' ',
            1,
            '...',
            array(
                'wrapTag' => 'nav',
                'wrapClass' => 'nav-links nav-links__comment',
                'itemTag' => '',
                'textTag' => 'span',
                'itemClass'   => 'page-numbers', 
                'currentClass' => 'page-numbers current',
                'prevClass' => 'hidden',
                'nextClass' => 'hidden'
            )
        ); ?> 
    <?php else: ?>
        <!-- 无结果 -->
        <?php $this->need('module/notfound.php'); ?>
    <?php endif; ?>
</div>
<?php $this->need('module/footer.php'); ?>