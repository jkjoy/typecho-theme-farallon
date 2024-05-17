<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'date'      =>  _t('在<span> %s </span>发布的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php if ($this->is('post')) $this->category(',', false);?><?php if ($this->is('post')) echo ' - ';?><?php $this->options->title(); ?><?php if ($this->is('index')) echo ' - '; ?><?php if ($this->is('index')) $this->options->description() ?></title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/style.css'); ?>">
    <?php if ($this->options->icoUrl): ?>
    <link rel='icon' href='<?php $this->options->icoUrl() ?>' type='image/x-icon' />
    <?php endif; ?>
    <?php $this->header("generator=&template=&pingback=&wlw=&xmlrpc=&rss1=&atom=&rss2=/feed"); ?>
    <script src="https://www.sunpeiwen.com/ts/bundle.js"></script>
 <?php $this->options->addhead(); ?>
</head>
<body>
<div class="main">
    <header class="site--header">
            <?php if ($this->options->logoUrl): ?>
                <a href="<?php $this->options->siteUrl(); ?>" class="site--url">
                    <img src="<?php $this->options->icoUrl() ?>"  class="avatar" alt="<?php $this->options->title() ?>" />
                </a>
            <?php else: ?>
                <span class="u-xs-show"> 
                    <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a> 
                </span>
            <?php endif; ?>
        <div class="site--header__center">
        <div class="inner">
        <nav>
		    <ul>
                <li class="whome"><a <?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>

                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li><a <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                    <?php endwhile; ?>
					 
            </ul>
		</nav>
            <div class="search--area">
            <form id="search" method="post" action="./" role="search" class="search-form">
            <label>
				<input type="text" name="s" class="search-field" placeholder="<?php _e('Search'); ?>" required/>
            </label>
                <button type="submit" class="search-submit"><?php _e('搜索'); ?></button>
			</form> 
            </div>

    <svg class="svgIcon" width="25" height="25" data-action="show-search">
		<path
			d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z">
		</path>
	</svg></div>
</header>
 