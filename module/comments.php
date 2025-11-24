<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="post--ingle__comments">
    <?php $this->comments()->to($comments); ?>
    <?php 
    // 获取之前评论者的信息
    $previousAuthor = isset($_COOKIE['__typecho_remember_author']) ? htmlspecialchars($_COOKIE['__typecho_remember_author']) : '';
    $previousEmail = isset($_COOKIE['__typecho_remember_mail']) ? htmlspecialchars($_COOKIE['__typecho_remember_mail']) : '';
    $previousUrl = isset($_COOKIE['__typecho_remember_url']) ? htmlspecialchars($_COOKIE['__typecho_remember_url']) : '';
    
    $language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
    if($this->allow('comment') && stripos($language, 'zh') > -1): ?>
        <?php if ($this->is('attachment')) : ?>
        <?php else: ?>
        <h3 class="comments--title" id="comments">
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg>
            <?php $this->commentsNum(_t('0'), _t('1'), _t('%d')); ?>
        </h3> 
        <ol class="commentlist sulliComment--list"></ol>   
        <div id="<?php $this->respondId(); ?>" class="comment-respond">
            <h3 id=reply-title class=comment-reply-title>发表评论
                <small></small>
            </h3>
            <form method=post id=commentform class=comment-form novalidate>
                <p class=comment-notes>
                    <span id=email-notes>您的电子邮箱地址不会被公开。</span> 
                    <span class=required-field-message>必填项已用
                        <span class=required>*</span>标注
                    </span>
                </p>
            </form>
            <div class="cancel-comment-reply cancel-comment-reply-link"><?php $comments->cancelReply(); ?></div>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="comment-form">
                <?php if($this->user->hasLogin()): ?>
                <p class=comment-notes><?php _e('登录身份: '); ?>
                <a href="<?php $this->options->profileUrl(); ?>">
                <?php $this->user->screenName(); ?></a>. 
                <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                <?php else: ?>
                <p class="comment-form-author">
                    <input placeholder="称呼 *" type="text" name="author" id="author" class="text" value="<?php echo $previousAuthor; ?>" required />
                </p>
                <p class="comment-notes">
                    <input placeholder="邮箱<?php if ($this->options->commentsRequireMail): ?> *<?php endif; ?>" type="email" name="mail" id="mail" class="text" value="<?php echo $previousEmail; ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                </p>
                <p class="comment-form-url">
                    <input type="url" name="url" id="url" class="text" placeholder="http(s)://<?php if ($this->options->commentsRequireURL): ?> <?php endif; ?>" value="<?php echo $previousUrl; ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                </p>
                <?php endif; ?>
                <p class="comment-form-comment">
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false};" placeholder="<?php _e('评论审核后显示，请勿重复提交...'); ?>" required ><?php $this->remember('text'); ?></textarea>
                </p>
                <p class="form-submit">
                <button type="submit" class="submit" id="misubmit"><?php _e('提交评论（Ctrl+Enter）'); ?></button>
                </p>
            </form>
        </div>
        <?php endif; ?>
    <?php else: ?>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav(
            ' ',
            ' ',
            1,
            '...',
            array(
                'wrapTag' => 'nav',
                'wrapClass' => 'nav-links nav-links__comment',
                'itemTag' => '',
                'textTag' => 'span',
                'itemClass'   => 'page-numbers', 
                'currentClass' => 'page-numbers current',
                'prevClass' => 'hidden',
                'nextClass' => 'hidden'
            )
        );
    ?>
    <?php else: ?>   
        <center><h3></h3></center>
    <?php endif; ?>
    <?php $this->options->twikoo(); ?>
</div>
<!-- 添加JavaScript代码 -->
<script>
document.getElementById('comment-form').addEventListener('submit', function() {
    // 获取表单数据
    var author = document.getElementById('author');
    var mail = document.getElementById('mail');
    var url = document.getElementById('url');
    
    // 如果不是登录用户才保存cookie
    if (author && mail && url) {
        // 设置cookie，有效期30天
        setCookie('__typecho_remember_author', author.value, 30);
        setCookie('__typecho_remember_mail', mail.value, 30);
        setCookie('__typecho_remember_url', url.value, 30);
    }
});
// Cookie设置函数
function setCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + encodeURIComponent(value) + expires + '; path=/';
}
</script>
<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $depth = $comments->levels + 1;
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="<?php 
        if ($comments->levels == 0) {
            echo 'comment parent';
        } else {
            echo 'comment child';
        }
        echo $commentClass; 
    ?>">
    <?php $commentApprove = commentApprove($comments, $comments->mail); ?>
        <div class="comment-body" id="<?php $comments->theId(); ?>">
            <div class="comment-meta">
                <div class="comment--avatar">
                <?php if ($comments->url): ?>
                    <a href="<?php echo $comments->url ?>" target="_blank" rel="external nofollow" title=" <?php echo $commentApprove['userDesc']; ?> ">
                        <?php echo $comments->gravatar('40', ''); ?> 
                    </a>
                <?php else: ?>
                    <?php echo $comments->gravatar('40', ''); ?> 
                <?php endif; ?>
                </div>
                <div class="comment--meta">
                    <div class="comment--author">
                        <span style="color: <?php echo $commentApprove['bgColor']; ?>;">
                            <p class="tooltip" data-tooltip=" <?php echo $commentApprove['userLevel']; ?> ">
                                <?php echo $comments->author; ?> 
                            </p>
                        </span>
                        <span class="dot"></span>
                        <div class="comment--time"><?php $comments->date('Y-m-d H:i'); ?></div>
                        
                        <span class="comment-reply-link u-cursorPointer">
                            <?php $comments->reply('<svg viewBox="0 0 24 24" width="14" height="14"  aria-hidden="true" class="" ><g><path d="M12 3.786c-4.556 0-8.25 3.694-8.25 8.25s3.694 8.25 8.25 8.25c1.595 0 3.081-.451 4.341-1.233l1.054 1.7c-1.568.972-3.418 1.534-5.395 1.534-5.661 0-10.25-4.589-10.25-10.25S6.339 1.786 12 1.786s10.25 4.589 10.25 10.25c0 .901-.21 1.77-.452 2.477-.592 1.731-2.343 2.477-3.917 2.334-1.242-.113-2.307-.74-3.013-1.647-.961 1.253-2.45 2.011-4.092 1.78-2.581-.363-4.127-2.971-3.76-5.578.366-2.606 2.571-4.688 5.152-4.325 1.019.143 1.877.637 2.519 1.342l1.803.258-.507 3.549c-.187 1.31.761 2.509 2.079 2.629.915.083 1.627-.356 1.843-.99.2-.585.345-1.224.345-1.83 0-4.556-3.694-8.25-8.25-8.25zm-.111 5.274c-1.247-.175-2.645.854-2.893 2.623-.249 1.769.811 3.143 2.058 3.319 1.247.175 2.645-.854 2.893-2.623.249-1.769-.811-3.144-2.058-3.319z"></path></g></svg>'); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="comment-content">
                <?php if ($comments->parent) {echo getPermalinkFromCoid($comments->parent);} $comments->content();?>
            </div>
        </div>
        <?php if ($comments->children) { ?>
            <ol class="children">
                <?php $comments->threadedComments($options); ?>
            </ol>
        <?php } ?>
    </li>
<?php } ?>