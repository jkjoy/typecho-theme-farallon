<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="related--content">
    <h3 class="related--posts__title">相关文章</h3>
    <div class="post--single__related">
    <?php $this->related(6)->to($relatedPosts); ?>   
    <?php while ($relatedPosts->next()): ?>     
        <div class="post--single__related__item">
            <a href="<?php $relatedPosts->permalink(); ?>">
                <div class="post--single__related__item__img">
                </div>
                <div class="post--single__related__item__title">
                <?php $relatedPosts->title(25); ?>
                </div>
                <div class="meta">
                <time class="humane--time"><?php $relatedPosts->date('Y-m-d'); ?></time>
                </div>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
</div>