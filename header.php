<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'date'      =>  _t('在<span> %s </span>发布的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php if ($this->is('post')) $this->category(',', false);?><?php if ($this->is('post')) echo ' - ';?><?php $this->options->title(); ?><?php if ($this->is('index')) echo ' - '; ?><?php if ($this->is('index')) $this->options->description() ?></title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/dist/css/style.min.css'); ?>">
    <?php if ($this->options->icoUrl): ?>
    <link rel='icon' href='<?php $this->options->icoUrl() ?>' type='image/x-icon' />
    <?php endif; ?>
    <?php $this->header("generator=&template=&pingback=&wlw=&xmlrpc=&rss1=&atom=&rss2=/feed"); ?>
    <?php $this->options->addhead(); ?>
</head>
<body>
    <script>
        window.DEFAULT_THEME = "light";
        if (localStorage.getItem("theme") == null) {
            localStorage.setItem("theme", window.DEFAULT_THEME);
        }
        if (localStorage.getItem("theme") == "dark") {
            document.querySelector("body").classList.add("dark");
        }
        if (localStorage.getItem("theme") == "auto") {
            document.querySelector("body").classList.add("auto");
        }
    </script>
<div class="main">
    <header class="site--header">
            <?php if ($this->options->logoUrl): ?>
                <a href="<?php $this->options->siteUrl(); ?>" class="site--url">
                    <img src="<?php $this->options->logoUrl() ?>"  class="avatar" alt="<?php $this->options->title() ?>" />
                </a>
            <span class="u-xs-show"> 
                    <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a> 
            </span>
            <?php else: ?>
                <span class="u-xs-show"> 
                    <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a> 
                </span>
            <?php endif; ?>
    <div class="site--header__center">
        <div class="inner">
        <nav>
		    <ul>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li><a <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                    <?php endwhile; ?>		 
            </ul>
		</nav>
                    <!-- 这年头谁会用站内的搜索啊      --> 
            <div class="search--area">
                <form id="search" method="post" action="./" role="search" class="search-form">
                    <label>
				        <input type="text" name="s" class="search-field text" placeholder="Search" required/>
                    </label>
                    <button type="submit" class="search-submit submit">搜索</button>
			    </form>                 
            </div>
        </div> 
    </div>
     <svg class="svgIcon" width="25" height="25" data-action="show-search">
		<path
			d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z">
		</path>
	</svg>   
</header>
