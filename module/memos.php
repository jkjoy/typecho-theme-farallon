<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="loadposts">
<?php while($this->next()): ?>
    <article id="loadpost" class="post--item post--item__status" itemtype="http://schema.org/Article" itemscope="itemscope">
    <div class="content">
        <header>
            <img src="<?php $this->options->logoUrl() ?>" class="avatar" width="48" height="48" />
            <a datetime='<?php $this->date('Y-m-d'); ?>' class="humane--time" href="<?php $this->permalink() ?>"
                itemprop="datePublished">
                <?php $options = Helper::options();if ($options->friendlyTime == '1') {echo time_ago($this->created);} else {$this->date('Y-m-d H:i'); }?>
            </a>
        </header>
        <div class="description" itemprop="about">
         <?php $this->excerpt(200, '...'); ?>
        </div>
    </div>
</article>   
<?php endwhile; ?>
</div>