<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main class="site--main">
<article class="post--single">
    <ul class="meta">
        <div class="post--single__meta">
             <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                </path>
            </svg><time class="humane--time"><?php $this->date('Y-m-d'); ?></time>
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
            </svg><span class="article--views"><a><?php get_post_view($this) ?></a></span> 阅读 
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path
                        d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg> <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 评论', '%d 评论'); ?></a> 
            <?php if($this->user->hasLogin() && $this->user->pass('editor', true)): ?>
              <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16">
                <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path 
                d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
              </svg>
               <a href="<?php $this->options->adminUrl('write-post.php?cid=' . $this->cid); ?>" target="_blank" title="编辑文章">编辑文章</a>
                  <?php endif; ?>
        </div>         
            <h2 class="post--single__title"><?php $this->title() ?></h2>
            <div class="post--single__content graph" ><?php $this->content(); ?></div>
<!--打赏  -->
        <?php if($this->options->donate): ?> 
        <div class="post--single__action">   
        <link rel="stylesheet" href="<?php $this->options->themeUrl('/dist/css/donate.css'); ?>">
        <script type="text/javascript" src="<?php $this->options->themeUrl('/dist/js/donate.js'); ?>"></script>
            <div class="donate-panel"> 
            <div id="donate-btn">
                <button class="button--like">
                <svg class="icon--default" viewBox="0 0 1024 1024" width="32" height="32">
                    <path
                        d="M332.8 249.6c38.4 0 83.2 19.2 108.8 44.8L467.2 320 512 364.8 556.8 320l25.6-25.6c32-32 70.4-44.8 108.8-44.8 19.2 0 38.4 6.4 57.6 12.8 44.8 25.6 70.4 57.6 76.8 108.8 6.4 44.8-6.4 89.6-38.4 121.6L512 774.4 236.8 492.8C204.8 460.8 185.6 416 192 371.2c6.4-44.8 38.4-83.2 76.8-108.8C288 256 313.6 249.6 332.8 249.6L332.8 249.6M332.8 185.6C300.8 185.6 268.8 192 243.2 204.8 108.8 275.2 89.6 441.6 185.6 537.6l281.6 281.6C480 832 499.2 838.4 512 838.4s32-6.4 38.4-19.2l281.6-281.6c96-96 76.8-262.4-57.6-332.8-25.6-12.8-57.6-19.2-89.6-19.2-57.6 0-115.2 25.6-153.6 64L512 275.2 486.4 249.6C448 211.2 390.4 185.6 332.8 185.6L332.8 185.6z">
                    </path>
                </svg>
                </button>
                </div> 
                <div id="qrcode-panel" style="display: none;"> 
                    <div class="qrcode-body"> 
                        <div class="donate-memo"> 
                            <span id="donate-close">关闭</span> 
                        </div> 
                        <div class="donate-qrpay"> 
                           <img id="wxqr" src="<?php $this->options->donate() ?>" /> 
                        </div> 
                    </div> 
                </div> 
            </div>                 
        </div>
        <?php endif; ?>
        <!-- 复制链接 -->
        <?php if($this->options->showshare): ?>
        <div class="post--share">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <g>
                            <path d="M18.36 5.64c-1.95-1.96-5.11-1.96-7.07 0L9.88 7.05 8.46 5.64l1.42-1.42c2.73-2.73 7.16-2.73 9.9 0 2.73 2.74 2.73 7.17 0 9.9l-1.42 1.42-1.41-1.42 1.41-1.41c1.96-1.96 1.96-5.12 0-7.07zm-2.12 3.53l-7.07 7.07-1.41-1.41 7.07-7.07 1.41 1.41zm-12.02.71l1.42-1.42 1.41 1.42-1.41 1.41c-1.96 1.96-1.96 5.12 0 7.07 1.95 1.96 5.11 1.96 7.07 0l1.41-1.41 1.42 1.41-1.42 1.42c-2.73 2.73-7.16 2.73-9.9 0-2.73-2.74-2.73-7.17 0-9.9z"></path>
                        </g>
                    </svg>
                    <span class="text">复制链接</span>
                    <span class="link" @click="copy" data-link="<?php $this->permalink(); ?>"><?php $this->permalink(); ?></span>
                    <script src="<?php $this->options->themeUrl('/dist/js/vue.min.js'); ?>"></script>
                    <script src="<?php $this->options->themeUrl('/dist/js/clipboard.min.js'); ?>"></script> 
<script>
        var app = new Vue({
        el: '.post--share',  
        data() {
            return {
               msg: "<?php $this->permalink(); ?>",    
            };
        },
        methods: {
             //复制方法
            copy: function () {
            var that = this;
            //注意vue umd版本ClipboardJS，而ES包请使用Clipboard
            var clipboard = new ClipboardJS(".link",{
                text: function (trigger) {
                //返回字符串
                return that.msg;
                }});
            clipboard.on("success", (e) => {
                //复制成功，显示提示
                this.showCopySuccessToast();
                clipboard.destroy();
            });
            clipboard.on("error", (e) => {
                //复制失败
                clipboard.destroy();
            });
            },
            showCopySuccessToast: function() {
                const toast = document.createElement("div");
                toast.textContent = "复制成功！";
                toast.className = "notice--wrapper";
                document.body.appendChild(toast);

                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 3000);
            }
        }
    });
    </script>
</div>
<?php endif; ?>
<!-- TAG -->
        <div class="tag--list artile--tag"> 
            <?php $this->tags(' ', true, ' '); ?> 
        </div>     
<!-- 个人信息-->
<?php if ($this->options->showProfile): ?>
    <?php $this->need('profile.php'); ?>
<?php endif; ?>
<!-- 相关文章-->
<?php if ($this->options->showrelated): ?>
    <?php $this->need('related.php'); ?>
<?php endif; ?>
    <!-- 判断如果禁止评论则不显示评论的div -->
    <?php if ($this->allow('comment')): ?>
       <?php $this->need('comments.php'); ?>
   <?php endif; ?>
<!-- 可以使用第三方评论-->
<?php $this->options->twikoo(); ?> 
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
<?php if($this->options->showtoc): ?>
<!--TOC 在宽度大于1400px时才会显示-->
<script>
document.addEventListener('DOMContentLoaded', (event) => {
  const postContent = document.querySelector('.post--single__content');
  if (!postContent) return;

  let found = false;
  for (let i = 1; i <= 6 && !found; i++) {
    if (postContent.querySelector(`h${i}`)) {
      found = true;
    }
  }
  if (!found) return;

  const heads = postContent.querySelectorAll('h1, h2, h3, h4, h5, h6');
  const toc = document.createElement('div');
  toc.id = 'toc';
  toc.innerHTML = '<strong>目录</strong><ul></ul>';
  document.body.appendChild(toc);
  let currentLevel = 0;
  let currentList = toc.querySelector('ul');
  let levelCounts = [0]; // 初始化层级计数器

  heads.forEach((head, index) => {
    const level = parseInt(head.tagName.substring(1));
    if (levelCounts[level] === undefined) {
      levelCounts[level] = 1; // 初始化该层级计数
    } else {
      levelCounts[level]++;
    }
    
    // 重置下级标题的计数器
    levelCounts = levelCounts.slice(0, level + 1);

    if (currentLevel === 0) {
      currentLevel = level;
    }
    while (level > currentLevel) {
      let newList = document.createElement('ul');
      if(!currentList.lastElementChild) {
        currentList.appendChild(newList);
      } else {
        currentList.lastElementChild.appendChild(newList);
      }
      currentList = newList;
      currentLevel++;
      levelCounts[currentLevel] = 1; // 初始化下一层级的计数器
    }
    while (level < currentLevel) {
      currentList = currentList.parentElement;
      if(currentList.tagName.toLowerCase() === 'li') {
        currentList = currentList.parentElement;
      }
      currentLevel--;
    }
    const numbers = levelCounts.slice(1, level + 1).join(' ') ; 
    const item = document.createElement('li');
    item.classList.add('toc-item'); // 添加基本类
    item.classList.add(`level-${level}`); // 根据级别添加类
    const anchor = `toc${index}`;
    head.id = anchor;
    const link = document.createElement('a');
    link.href = `#${anchor}`;
    link.textContent = `${numbers}. ${head.textContent}`; // 序号+标题文本
    item.appendChild(link);
    currentList.appendChild(item);
  });
});
</script>
<style>
#toc {
  position: fixed;
  top: 100px;
  right: 50px;
  max-width: 200px;
  background-color: var(--farallon-background-gray);
  padding: 10px;
  border-radius: 5px;
  /* 其他样式... */
}
@media screen and (max-width: 1400px) {
  #toc {
    display: none;
  }
}
</style>
<?php endif; ?>
</main>
<?php $this->need('footer.php'); ?>
