<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main class="site--main">
    <header class="archive--header"><?php if ($this->have()): ?>
        <h2 class="post--single__title"><?php $this->archiveTitle(array(
            'category'  =>  _t('  <span> %s </span> '),
            'search'    =>  _t('包含关键字<span> %s </span>的文章'),
            'date'      =>  _t('在 <span> %s </span>发布的文章'),
            'tag'       =>  _t('标签 <span> %s </span>下的文章'),
            'author'    =>  _t('作者 <span>%s </span>发布的文章')
        ), '', ''); ?></h2>
        <h3 class="post--single__subtitle"><?php $this->categorydescription(); ?></h3>
        <?php while($this->next()): ?>
    </header>
    <article class="post--item">   
    <div class="content">
        <h2 class="post--title">
			 <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
		</h2>
        <div class="description">
            <?php
              // 判断是否存在自定义字段summary并输出，否则输出自动生成的摘要
            if($this->fields->summary){echo $this->fields->summary;} else {$this->excerpt(180); }
             ?>
	    </div>  
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
            </svg><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 ', '1 ', '%d '); ?></a>
        </div>
    </div> 
    </article>  
    <?php endwhile; ?>     
</main>
    <?php
            $this->pagenav(
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z" fill="var(--main)"></path></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z" fill="var(--main)"></path></svg>',
                1,
                '...',
                array(
                    'wrapTag' => 'div',
                    'wrapClass' => 'pagination_page',
                    'itemTag' => '',
                    'textTag' => 'a',
                    'currentClass' => 'active',
                    'prevClass' => 'prev',
                    'nextClass' => 'next'
                )
            );
        ?>   
        <!-- 搜索结果 --> 
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
<style>
/* 分页 */
.pagination_page{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: var(--margin);
    gap: 0.5rem;
}
.pagination_page li.active a {
    background: var(--theme);
    color: #fff;
    font-weight: 500;
}
.pagination_page a{
    display: flex;
    padding: 0.5rem;
    font-size: 0.9rem;
    width: 1.75rem;
    height: 1.75rem;
    background: var(--background);
    border-radius: 50%;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    transition: 0.2s;
    -webkit-transition: 0.2s;
    justify-content: center;
    align-items: center;
    letter-spacing: 0;
}
.pagination_page span.next{
    cursor: pointer;
}
.pagination_page li.active a:hover{
    cursor: not-allowed;
}
/* 分页 */
</style>
<?php $this->need('footer.php'); ?>