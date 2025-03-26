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
        <div style="display: grid; place-items: center;">
            <p style="padding-bottom: 2px;"><?php _e('暂无标签'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $this->need('footer.php'); ?>