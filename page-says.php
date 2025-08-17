<?php
/**
 * 说说页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?> </h2>
    </header>
    <article class="post--single">
<?php
class UA{
    public $ua;
    public function __construct($ua = '')
    {
        $this->ua = $ua;
    }
    public function returnOS(){
        $ua = $this->ua;
        $title = "未知浏览器";
        $icon = "";
        if (preg_match('/win/i', $ua)) {
            if (preg_match('/Windows NT 6.1/i', $ua)) {
                $title = "Windows 7";
            }elseif (preg_match('/Windows 98/i', $ua)) {
                $title = "Windows 98";
            }elseif (preg_match('/Windows NT 5.0/i', $ua)) {
                $title = "Windows 2000";
            }elseif (preg_match('/Windows NT 5.1/i', $ua)) {
                $title = "Windows XP";
            }elseif (preg_match('/Windows NT 5.2/i', $ua)) {
                if (preg_match('/Win64/i', $ua)) {
                    $title = "Windows XP 64 bit";
                } else {
                    $title = "Windows Server 2003";
                }
            }elseif (preg_match('/Windows NT 6.0/i', $ua)) {
                $title = "Windows Vista";
            }elseif (preg_match('/Windows NT 6.2/i', $ua)) {
                $title = "Windows 8";
            }elseif (preg_match('/Windows NT 6.3/i', $ua)) {
                $title = "Windows 8.1";
            }elseif (preg_match('/Windows NT 10.0/i', $ua)) {
                $title = "Windows 10";
            }elseif (preg_match('/Windows Phone/i', $ua)) {
                $matches = explode(';',$ua);
                $title = $matches[2];
            }
        } elseif (preg_match('#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
            $title = "iPod ";//.$matches[1]
        } elseif (preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) {
            $title = "Iphone ";//.$matches[1]
        } elseif (preg_match('/iPad; CPU OS ([_0-9]+)/i', $ua, $matches)) {
            $title = "iPad ";//.$matches[1]
        } elseif (preg_match('/Mac OS X ([0-9_]+)/i', $ua, $matches)) {
            if(count(explode(7,$matches[1]))>1) $matches[1] = 'Lion '.$matches[1];
            elseif(count(explode(8,$matches[1]))>1) $matches[1] = 'Mountain Lion '.$matches[1];
            $title = "Mac OSX";
        } elseif (preg_match('/Macintosh/i', $ua)) {
            $title = "Mac OS";
        } elseif (preg_match('/CrOS/i', $ua)){
            $title = "Google Chrome OS";
        } elseif (preg_match('/Linux/i', $ua)) {
            $title = 'Linux';
            if (preg_match('/Ubuntu/i', $ua)) {
                $title = "Ubuntu Linux";
            }elseif(preg_match('#Debian#i', $ua)) {
                $title = "Debian GNU/Linux";
            }elseif (preg_match('#Fedora#i', $ua)) {
                $title = "Fedora Linux";
            }elseif (preg_match('/Android.([0-9. _]+)/i',$ua, $matches)) {
                $title= "Android";
            }
        } elseif (preg_match('/Android.([0-9. _]+)/i',$ua, $matches)) {
            $title= "Android";
        }
        return array("title"=>$title);
    }
    /**
     * 时光机页面ua，如果是手机设备，只显示设备类型，如果是电脑设备只显示电脑设备类型，如果是扩展发送，显示发送自「扩展」，如果是微信公众号，显示
     */
    public function returnTimeUa(){
        if ($this->ua == "weixin" || $this->ua == "weChat"){
            return array("title" => "微信公众号");
        }elseif ($this->ua == "crx"){
            return array("title" => "Chrome扩展");
        }elseif ($this->ua == "yearcross"){
            return array("title" => "YearCross");
        }else{
            $ua = $this->returnOS();
            return $ua;
        }
    }
}

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
                <?php if ($comments->parent) {echo getPermalinkFromCoid($comments->parent);} $comments->content();?>
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
    </article> 
</section>
<?php $this->need('footer.php'); ?>