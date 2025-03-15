<?php 
/**
 * 全部标签
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>   
        <h2 class="post--single__subtitle"><?php $this->content(); ?> </h2>
    </header>
    <div class="post-content">
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0')->to($tags); ?>
        <?php if($tags->have()): ?>
        <div class="archive--tagList">
            <?php while ($tags->next()): ?>
            <span class="archive--tagItem">
                <a role="listitem" target="<?php $this->options->sidebarLinkOpen(); ?>" data-toggle="tooltip" data-placement="top" href="<?php $tags->permalink(); ?>" rel="tag" title="<?php $tags->count(); ?> 篇文章">
                    <?php $tags->name(); ?> (<?php $tags->count(); ?>)
                </a>
            </span>
        <?php endwhile; ?>
        </div>
        <?php else: ?>
        <p class="text-center pb-2"><?php _e('没有任何标签'); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php $this->need('footer.php'); ?>