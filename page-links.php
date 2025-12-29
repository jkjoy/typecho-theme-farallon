<?php 
/**
 * 友情链接
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
    <div class="template--linksWrap">
        <?php
        $linksPluginReady = class_exists('Links_Plugin');
        $linksTableReady = false;
        $linksListHtml = '';

        if ($linksPluginReady) {
            try {
                $db = Typecho_Db::get();
                $db->fetchRow($db->select()->from('table.links')->limit(1));
                $linksTableReady = true;
            } catch (Exception $e) {
                $linksTableReady = false;
            }
        }

        if ($linksPluginReady && $linksTableReady) {
            try {
                ob_start();
                Links_Plugin::output('<li class="link-item"><a class="link-item-inner effect-apollo" href="{url}" target="_blank" rel="nofollow noopener noreferrer"><span class="sitename"><strong>{name}</strong><span class="description">{title}</span></span></a></li>');
                $linksListHtml = trim(ob_get_clean());
            } catch (Exception $e) {
                if (ob_get_level() > 0) {
                    @ob_end_clean();
                }
                $linksListHtml = '';
            }
        }
        ?>

        <?php if (!$linksPluginReady || !$linksTableReady): ?>
            <article class="post--error" itemtype="http://schema.org/Article" itemscope="itemscope">
                <div class="content">
                    <h2 class="post--title" itemprop="headline">友情链接功能未启用</h2>
                    <div class="meta">检测到未安装/未启用 Links 插件，请先安装并启用 Links 插件。</div>
                </div>
            </article>
        <?php else: ?>
            <?php if ($linksListHtml === ''): ?>
                <article class="post--error" itemtype="http://schema.org/Article" itemscope="itemscope">
                    <div class="content">
                        <h2 class="post--title" itemprop="headline">暂无友情链接</h2>
                        <div class="meta">在 Links 插件后台添加链接后显示。</div>
                    </div>
                </article>
            <?php else: ?>
                <ul class="link-items">
                    <?php echo $linksListHtml; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <article class="post--single">
        <?php if ($this->allow('comment')): ?>
        <?php $this->need('module/comments.php'); ?>
        <?php endif; ?>
    </article>
</section>
<?php $this->need('footer.php'); ?>