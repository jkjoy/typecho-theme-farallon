<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php // 获取文章图片
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
<div class="post--cards">
<?php while($this->next()): ?>
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