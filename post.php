<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<style>#toc{font-size:14px;padding:10px 15px;background-color:var(--farallon-background-gray);border-radius:10px;margin-bottom:20px}#toc  summary{cursor:pointer}#toc toc-title{font-weight:600}#toc  ul{padding-left:10px;margin-bottom:10px}#toc  ul li::before{content:"·";margin-right:5px}#toc  ul li>ul{margin-left:10px;font-size:12px}</style>
<main class="site--main">
<article class="post--single">
    <ul class="meta">
        <div class="post--single__meta">
             <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                </path>
            </svg><time class="humane--time"><?php $options = Helper::options();if ($options->friendlyTime == '1') {echo time_ago($this->created);} else {$this->date('Y-m-d H:i'); }?></time>
            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M408.551619 97.52381a73.142857 73.142857 0 0 1 51.736381 21.430857L539.306667 197.973333A73.142857 73.142857 0 0 0 591.067429 219.428571H804.571429a73.142857 73.142857 0 0 1 73.142857 73.142858v560.761904a73.142857 73.142857 0 0 1-73.142857 73.142857H219.428571a73.142857 73.142857 0 0 1-73.142857-73.142857V170.666667a73.142857 73.142857 0 0 1 73.142857-73.142857h189.123048z m0 73.142857H219.428571v682.666666h585.142858V292.571429h-213.504a146.285714 146.285714 0 0 1-98.499048-38.13181L487.619048 249.734095 408.551619 170.666667zM365.714286 633.904762v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z m-365.714285-195.047619v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z">
                </path>
            </svg><?php $this->category(','); ?> 
            <svg class="icon" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9ZM11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12Z" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M21.83 11.2807C19.542 7.15186 15.8122 5 12 5C8.18777 5 4.45796 7.15186 2.17003 11.2807C1.94637 11.6844 1.94361 12.1821 2.16029 12.5876C4.41183 16.8013 8.1628 19 12 19C15.8372 19 19.5882 16.8013 21.8397 12.5876C22.0564 12.1821 22.0536 11.6844 21.83 11.2807ZM12 17C9.06097 17 6.04052 15.3724 4.09173 11.9487C6.06862 8.59614 9.07319 7 12 7C14.9268 7 17.9314 8.59614 19.9083 11.9487C17.9595 15.3724 14.939 17 12 17Z" />
            </svg><span class="article--views"><a><?php get_post_view($this) ?></a></span>  
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path
                        d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg> <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 ', '1 ', '%d '); ?></a> 
            <?php if($this->user->hasLogin() && $this->user->pass('editor', true)): ?>    
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                    <path d="M16.7574 2.99677L14.7574 4.99677H5V18.9968H19V9.23941L21 7.23941V19.9968C21 20.5491 20.5523 20.9968 20 20.9968H4C3.44772 20.9968 3 20.5491 3 19.9968V3.99677C3 3.44448 3.44772 2.99677 4 2.99677H16.7574ZM20.4853 2.09727L21.8995 3.51149L12.7071 12.7039L11.2954 12.7063L11.2929 11.2897L20.4853 2.09727Z">
                    </path>
                </svg>
                <a href="<?php $this->options->adminUrl('write-post.php?cid=' . $this->cid); ?>" target="_blank" title="编辑文章">Edit</a>
                <?php endif; ?>
        </div>         
            <h2 class="post--single__title"><?php $this->title() ?></h2>
            <div class="post--single__content graph" ><?php $this->content(); ?></div>
        <?php if($this->options->wxpay): ?> 
            <!--打赏  -->
        <div class="post--single__action">   
            <button class="button--like" onclick="openModal()">
                <svg class="icon--default" viewBox="0 0 1024 1024" width="32" height="32"><path d="M332.8 249.6c38.4 0 83.2 19.2 108.8 44.8L467.2 320 512 364.8 556.8 320l25.6-25.6c32-32 70.4-44.8 108.8-44.8 19.2 0 38.4 6.4 57.6 12.8 44.8 25.6 70.4 57.6 76.8 108.8 6.4 44.8-6.4 89.6-38.4 121.6L512 774.4 236.8 492.8C204.8 460.8 185.6 416 192 371.2c6.4-44.8 38.4-83.2 76.8-108.8C288 256 313.6 249.6 332.8 249.6L332.8 249.6M332.8 185.6C300.8 185.6 268.8 192 243.2 204.8 108.8 275.2 89.6 441.6 185.6 537.6l281.6 281.6C480 832 499.2 838.4 512 838.4s32-6.4 38.4-19.2l281.6-281.6c96-96 76.8-262.4-57.6-332.8-25.6-12.8-57.6-19.2-89.6-19.2-57.6 0-115.2 25.6-153.6 64L512 275.2 486.4 249.6C448 211.2 390.4 185.6 332.8 185.6L332.8 185.6z"></path></svg>
            </button>           
        </div>
        <!-- 弹窗 -->
        <div class="modal" id="modal" onclick="closeModal()">
            <div class="modal-content" onclick="event.stopPropagation()">
            <span class="close-btn" onclick="closeModal()">&times;</span>
                <p>如果觉得文章对你有帮助，可以请作者喝杯咖啡 ☕️</p>
                <img src="<?php $this->options->wxpay() ?>" alt="微信二维码">
                <img src="<?php $this->options->alipay() ?>" alt="支付宝二维码">
            </div>
        </div>
        <script>function openModal(){document.getElementById('modal').style.display='flex'}function closeModal(){document.getElementById('modal').style.display='none'}</script>
        <style>.button--like{background:none;border:none;padding:0;cursor:pointer;transition:transform 0.3s ease;}.button--like:hover{transform:scale(1.1);}.icon--default{fill:#666;transition:fill 0.3s ease;}.button--like:hover .icon--default{fill:#ff4081;}.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.1);justify-content:center;align-items:center;z-index:1000;}.modal-content{background-color:white;padding:20px;border-radius:10px;text-align:center;position:relative;}.modal-content img{width:200px;height:200px;margin-top:10px;}.close-btn{position:absolute;top:10px;right:10px;cursor:pointer;font-size:20px;color:#888;}</style>
        <?php endif; ?>
        <!-- 复制链接 -->
        <?php if($this->options->showshare): ?>
        <div class="post--share">
            <svg viewBox="0 0 24 24" aria-hidden="true"><g><path d="M18.36 5.64c-1.95-1.96-5.11-1.96-7.07 0L9.88 7.05 8.46 5.64l1.42-1.42c2.73-2.73 7.16-2.73 9.9 0 2.73 2.74 2.73 7.17 0 9.9l-1.42 1.42-1.41-1.42 1.41-1.41c1.96-1.96 1.96-5.12 0-7.07zm-2.12 3.53l-7.07 7.07-1.41-1.41 7.07-7.07 1.41 1.41zm-12.02.71l1.42-1.42 1.41 1.42-1.41 1.41c-1.96 1.96-1.96 5.12 0 7.07 1.95 1.96 5.11 1.96 7.07 0l1.41-1.41 1.42 1.41-1.42 1.42c-2.73 2.73-7.16 2.73-9.9 0-2.73-2.74-2.73-7.17 0-9.9z"></path></g></svg>
            <span class="text" data-copy="<?php $this->permalink(); ?>">复制链接</span><span class="link text"><?php $this->permalink(); ?></span><div class="notice--wrapper" id="copyTooltip" style="display: none;">复制成功！</div>
        </div>
        <?php endif; ?>   
        <!-- TAG -->
        <div class="tag--list artile--tag"> 
            <?php $this->tags(' ', true, ' '); ?> 
        </div>     
        <!-- 个人信息-->
        <?php if ($this->options->showProfile): ?>
           <?php $this->need('module/profile.php'); ?>
        <?php endif; ?>
        <!-- 分类-->
        <?php if ($this->options->showcate): ?>
    <?php
    // 初始化分类图片地址为空
    $categoryImage = '';
    // 检查文章是否有分类
    if ($this->categories) {
        // 获取第一个分类的信息
        $category = $this->categories[0];
        $categoryId = $category['mid'];
        $categoryName = $category['name'];
        $categoryDescription = $category['description'];  // 如果分类有说明（描述）
        // 获取主题选项中的分类图片基本 URL
        $themeUrl = $this->options->midimg;
        // 生成分类图片地址
        $categoryImage = $themeUrl . $categoryId . '.jpg';
    }
    ?>
    <!-- 显示分类信息 -->
    <?php if ($category): ?>
        <div class="category--card__list">
            <a href="<?php echo $category['permalink']; ?>" class="category--card">
                <div class="category--card__image">
                    <img src="<?php echo htmlspecialchars($categoryImage); ?>" alt="<?php echo htmlspecialchars($categoryName); ?>">
                </div>
                <div class="category--card__content">
                    <div class="category--card__title"><?php echo htmlspecialchars($categoryName); ?></div>
                    <div class="category--card__description"><?php echo htmlspecialchars($categoryDescription); ?></div>
                </div>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<!-- 相关文章-->
<?php if ($this->options->showrelated): ?>
    <?php $this->need('module/related.php'); ?>
<?php endif; ?>
<?php if ($this->allow('comment')): ?>
    <?php $this->need('module/comments.php'); ?>
<?php endif; ?>
<!--翻页-->
    <nav class="navigation post-navigation is-active">
        <div class="nav-links">
            <div class="nav-previous">
            <span class="meta-nav">  上一篇:  <?php $this->thePrev('%s','没有了'); ?></span>
            </div>
            <div class="nav-next">
            <span class="meta-nav"> 下一篇:  <?php $this->theNext('%s','没有了'); ?></span>
            </div>
        </div>   
    </nav> 
</ul>    
</article>
</main>
<script src="<?php $this->options->themeUrl('assets/js/post.js'); ?>"></script>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/lightbox.min.css'); ?>">
<script src="<?php $this->options->themeUrl('assets/js/lightbox-plus-jquery.min.js'); ?>"></script>
<?php $this->need('footer.php'); ?>