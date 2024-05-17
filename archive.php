<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main id="main">
<div class="site--main">
        <?php if ($this->have()): ?>
<header class="archive--header">
        <h2 class="post--single__title"><?php $this->archiveTitle(array(
            'category'  =>  _t('  <span> %s </span> '),
            'search'    =>  _t('包含关键字<span> %s </span>的文章'),
            'date'      =>  _t('在 <span> %s </span>发布的文章'),
            'tag'       =>  _t('标签 <span> %s </span>下的文章'),
            'author'    =>  _t('作者 <span>%s </span>发布的文章')
        ), '', ''); ?></h2>
        <h3 class="post--single__subtitle"><?php $this->categorydescription(); ?></h3>
    </header>
        <?php while($this->next()): ?>

<article class="post--item" itemtype="http://schema.org/Article" itemscope="itemscope" >
    <div class="content">
        <h2 class="post--title" itemprop="headline">
			 <a href="<?php $this->permalink() ?>"><?php $this->title() ?>
			 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    class="icon--sticky" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="w-4 h-4 text-red-400">
                    <path
                        d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z">
                    </path>
                </svg></a>
		</h2>
		<div class="meta">
			<svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                </path>
            </svg><time><?php $this->date('Y-m-d'); ?></time> 
 
				<svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M408.551619 97.52381a73.142857 73.142857 0 0 1 51.736381 21.430857L539.306667 197.973333A73.142857 73.142857 0 0 0 591.067429 219.428571H804.571429a73.142857 73.142857 0 0 1 73.142857 73.142858v560.761904a73.142857 73.142857 0 0 1-73.142857 73.142857H219.428571a73.142857 73.142857 0 0 1-73.142857-73.142857V170.666667a73.142857 73.142857 0 0 1 73.142857-73.142857h189.123048z m0 73.142857H219.428571v682.666666h585.142858V292.571429h-213.504a146.285714 146.285714 0 0 1-98.499048-38.13181L487.619048 249.734095 408.551619 170.666667zM365.714286 633.904762v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z m-365.714285-195.047619v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z">
                </path>
            </svg><?php $this->category(','); ?>
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path
                        d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg>
				 <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 评论', '%d 评论'); ?></a>
		</div>
            <div class="description">
    			<?php $this->excerpt(180); ?>
	</div>
           
</article>
        <?php endwhile; ?>
        <?php else: ?>
        <div class="page404">
        <h2>404 - 页面没找到</h2>
        <p>你想查看的页面已被转移或删除了</p>
        </div>
        <?php endif; ?>
    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</main>
</div>
<?php $this->need('footer.php'); ?>