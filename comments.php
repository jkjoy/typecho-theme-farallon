<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="post--ingle__comments">
<div id="comments" class="responsesWrapper">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
        <?php if ($this->is('attachment')) : ?>
        <?php _e(''); ?>
        <?php else: ?>
    <div id="<?php $this->respondId(); ?>" class="respond comment-respond">
        <div class="cancel-comment-reply cancel-comment-reply-link">
        <?php $comments->cancelReply(); ?>
    </div>

    	<h3 class="comments--title">
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path
                        d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg><?php $this->commentsNum(_t('暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论')); ?>
        </h3>
        <?php if ($comments->have()): ?>
        <?php $comments->listComments(); ?>
        <?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
        <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>">
        <div class="comment-author">
            <?php $comments->gravatar('40', ''); ?>
            <cite class="fn"><?php $comments->author(); ?></cite>
        </div>
        <div class="comment-meta">
            <a href="<?php $comments->permalink(); ?>"><?php $comments->date('Y-m-d H:i'); ?></a>
            <span class="comment-reply"><?php $comments->reply(); ?></span>
        </div>
        <?php $comments->content(); ?>
		<?php $singleCommentOptions->commentStatus(); ?>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>
 
    <?php
            $comments->pageNav(
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z" fill="var(--main)"></path></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z" fill="var(--main)"></path></svg>',
                1,
                '...',
                array(
                    'wrapTag' => 'div',
                    'wrapClass' => 'cat_pagination_page',
                    'itemTag' => '',
                    'textTag' => 'a',
                    'currentClass' => 'active',
                    'prevClass' => 'prev',
                    'nextClass' => 'next'
                )
            );
        ?>
    <?php endif; ?>

    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="comment-form">
            <?php if($this->user->hasLogin()): ?>
    		<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
    		<p class="comment-form-author">
    			<input placeholder="称呼 *" type="text" name="author" id="author" class="text" value="" required />
    		</p>
    		<p class="comment-notes">
    			<input placeholder="邮箱<?php if ($this->options->commentsRequireMail): ?> *<?php endif; ?>" type="email" name="mail" id="mail" class="text" value=""<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
    		</p>
    		<p class="comment-form-url">
    			<input type="url" name="url" id="url" class="text" placeholder="http(s)://<?php if ($this->options->commentsRequireURL): ?> *<?php endif; ?>" value=""<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
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
    <?php _e(''); ?>
    <?php endif; ?>   
</div>
</div>