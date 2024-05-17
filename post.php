<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main class="site--main">
<article class="post--single">
    
    <ul class="meta"><div class="post--single__meta">
        <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                </path>
        </svg>
        <time class="humane--time"><?php $this->date('Y-m-d'); ?></time>
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
            </svg>
            <span class="article--views"><a><?php get_post_view($this) ?></a></span> 阅读 
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path
                        d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg> 
             <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 评论', '%d 评论'); ?></a> 
           
        </div>         
             <h2 class="post--single__title"><?php $this->title() ?></h2>
             <div class="post--single__content graph" >
                  <?php $this->content(); ?>
            </div>
            
            <div class="post--single__action">
 <!--打赏  -->
<script type="text/javascript" src="https://blogcdn.loliko.cn/donate/index_wx.js?121"></script>
<link rel="stylesheet" type="text/css" href="https://blogcdn.loliko.cn/donate/style_wx.css?121" />
<div class="donate-panel"> 
  <div id="donate-btn">赏</div> 
  <div id="qrcode-panel" style="display: none;"> 
    <div class="qrcode-body"> 
      <div class="donate-memo"> 
      <span id="donate-close">关闭</span> 
    </div> 
    <div class="donate-qrpay"> 
     <img id="wxqr" src="https://blogcdn.loliko.cn/donate/wx.png" /> 
    </div> 
     </div> 
   </div> 
</div> 
            </div>
<!-- TAG -->
        <div class="tag--list artile--tag"> 
            <?php $this->tags(' ', true, ' '); ?> 
        </div>     
<!-- 个人信息-->
<?php if ($this->options->showProfile): ?>
    <?php $this->need('profile.php'); ?>
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
    <!-- 判断如果禁止评论则不显示评论的div -->
    <?php if ($this->allow('comment')): ?>
       <?php $this->need('comments.php'); ?>
   <?php endif; ?>
<!-- 可以使用第三方评论-->
<?php $this->options->twikoo(); ?> 
</main>
<?php $this->need('footer.php'); ?>
