<?php
require_once 'UA.php';
require_once 'Content.php';
if ($this->user->hasLogin()){
    $GLOBALS['isLogin'] = true;
}else{
    $GLOBALS['isLogin'] = false;
}
function threadedComments($comments, $options)
{
    $db = Typecho_Db::get();
?>
    <article class='post--item post--item__status'>
        <div class='content'>
            <header>
            <?php $ua = new UA($comments->agent); ?>
            <div class="comment--avatar"><?php echo $comments->gravatar('48', ''); ?></div>
                 <?php $comments->author(); ?> 
                <span class="dot"></span>
                <p class="humane--time"><?php $comments->date('Y年m月d日 H:i'); ?></p>
                <span class="dot"></span>
                <?php echo "发自" . $ua->returnTimeUa()['title'];?>
            </header>
                <div class="description" itemprop="about">
                <?php echo Content::postCommentContent(Content::timeMachineCommentContent($comments->text),$GLOBALS['isLogin'] ,"","","",true); ?>
                </div>
                </div>
    </article>
<?php } ?>
<?php $this->comments()->to($comments); ?>
    <input type="hidden" class="j-comment-url" value="<?php $this->commentUrl() ?>">
    <?php if ($this->user->hasLogin()) : ?>
        <div class="respond" id="comments">
            <div class="comments--title">有什么新鲜事想告诉大家？</div>
            <form method="post" id="textarea"  class="comment-form" action="<?php $this->commentUrl() ?>">
            <p class="comment-form-comment">
            <textarea name="text" id="j-dynamic-form-text" class="textarea" autocomplete="off" rows="3" placeholder="发表您的新鲜事儿..."></textarea>
                <input type="hidden" value="<?php $this->user->screenName(); ?>" name="author" />
                <input type="hidden" value="<?php $this->user->mail(); ?>" name="mail" />
                <input type="hidden" value="<?php $this->options->siteUrl(); ?>" name="url" />
                <input type="hidden" name="_" value="<?php Typecho_Widget::widget('Widget_Security')->to($security);
                echo $security->getToken($this->request->getRequestUrl()); ?>">
            </p>
                <p class="form-submit">
                    <button type="submit" class="submit"><?php _e('发表（Ctrl+Enter）'); ?></button>
                </p>
            </form>
        </div>
    <?php endif; ?>
    <?php $comments->listComments(['commentUrl'=>$this->commentUrl,'class'=>$this]); ?>
    <?php
            $comments->pageNav(
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