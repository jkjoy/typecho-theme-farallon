<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('module/header.php'); ?>
<?php 
// 获取特殊高亮的分类ID
$highlightCategoryId = Helper::options()->highlight_category;
?>
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
    <?php if ($this->is('category') && $this->categoryDescription()): ?>
    <div class="taxonomy--description">
        <?php $this->categorydescription(); ?>
    </div>
    <?php endif; ?>
</header>  
<div class="site--main">
    <div class="post--cards">
    <?php if ($this->have()): ?>
        <?php while($this->next()): ?>
            <?php 
            // 获取文章的所有分类
            $currentCategories = $this->categories;
            // 检查是否为高亮分类
            $isHighlightCategory = false;
            foreach ($currentCategories as $category) {
                if ($category['mid'] == $highlightCategoryId) {
                    $isHighlightCategory = true;
                    break;
                }
            }
            // 获取文章图片
            $default_thumbnail = Helper::options()->themeUrl . '/assets/images/nopic.svg';
            $firstImage = img_postthumb($this->cid);
            if (empty($firstImage)) {
                $firstImage = $default_thumbnail;
            }
            $cover = $this->fields->cover;
            $imageToDisplay = $cover;
            if (empty($imageToDisplay)) {
                $imageToDisplay = $firstImage;
            }
            ?>
                <article class="post--card">
                    <img src="<?php echo $imageToDisplay; ?>" alt="<?php $this->title() ?>" class="cover" itemprop="image"/>
                    <div class="content">
                        <h2 class="post--title">
                            <a href="<?php $this->permalink() ?>">  
                            <?php $this->title() ?>
                            </a>
                        </h2>
                        <div class="description">
                            <?php $this->excerpt(20, '...'); ?>
                        </div>
                        <div class="meta">
                            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                                <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
                            </svg>
                            <time datetime='<?php $this->date('Y-m-d'); ?>' class="humane--time">
                                <?php $this->date('Y-m-d'); ?>
                            </time>
                        </div>
                    </div>
                </article>  
        <?php endwhile; ?>
        </div>
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
        <main class="site--main">              
            <header class="archive-header archive-header__search">
                <div class="pagination">
                    <h2>Sorry</h2>
                    <p>很遗憾,未找到您期待的内容</p>
                </div> 
            </header> 
        </main>        
    <?php endif; ?>   
</div>
<?php $this->need('module/footer.php'); ?>