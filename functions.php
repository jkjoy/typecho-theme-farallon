<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'));
    $form->addInput($logoUrl);
    $icoUrl = new Typecho_Widget_Helper_Form_Element_Text('icoUrl', NULL, NULL, _t('站点 Favicon 地址'));
    $form->addInput($icoUrl);
    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('置顶文章cid'), _t('多篇文章以`|`符号隔开'), _t('会在首页展示置顶文章。'));
    $form->addInput($sticky);
    $showProfile = new Typecho_Widget_Helper_Form_Element_Radio('showProfile',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否在文章页面显示显示作者信息'), _t('选择“是”将在文章页面包含显示作者信息。'));
    $form->addInput($showProfile);
    $instagramurl = new Typecho_Widget_Helper_Form_Element_Text('instagramurl', NULL, 'https://Instagram.com/', _t('Instagram'), _t('会在个人信息显示'));
    $form->addInput($instagramurl);
    $telegramurl = new Typecho_Widget_Helper_Form_Element_Text('telegramurl', NULL, 'https://t.me/', _t('电报'), _t('会在个人信息显示'));
    $form->addInput($telegramurl);
    $githuburl = new Typecho_Widget_Helper_Form_Element_Text('githuburl', NULL, 'https://github.com/', _t('github'), _t('会在个人信息显示'));
    $form->addInput($githuburl);
    $twitterurl = new Typecho_Widget_Helper_Form_Element_Text('twitterurl', NULL, 'https://x.com/', _t('twitter'), _t('会在个人信息显示'));
    $form->addInput($twitterurl);
    $mastodonurl = new Typecho_Widget_Helper_Form_Element_Text('mastodonurl', NULL,'https://jiong.us/', _t('mastodon'), _t('会在个人信息显示'));
    $form->addInput($mastodonurl);
    $sitemapurl = new Typecho_Widget_Helper_Form_Element_Text('sitemapurl', NULL, NULL, _t('sitemap'), _t('会在页脚显示'));
    $form->addInput($sitemapurl);
    $cnavatar = new Typecho_Widget_Helper_Form_Element_Text('cnavatar', NULL, 'https://cravatar.cn/avatar/', _t('Gravatar镜像'), _t('默认https://cravatar.cn/avatar/,建议保持默认'));
    $form->addInput($cnavatar);
    $midimg = new Typecho_Widget_Helper_Form_Element_Text('midimg', NULL, './img/', _t('填写分类图片路径,以"/"结尾'), _t('可以使用本地目录或者CDN地址,自动匹配路径下以mid.jpg格式的图片,使用分类页面时需要设置'));
    $form->addInput($midimg);
    $donate = new Typecho_Widget_Helper_Form_Element_Text('donate', NULL, 'https://blogcdn.loliko.cn/donate/wx.png', _t('赞赏二维码'), _t('不填写则不显示'));
    $form->addInput($donate);
    $doubanID = new Typecho_Widget_Helper_Form_Element_Text('doubanID', NULL, 'https://db.imsun.org/', _t('豆瓣页面必需API,包含"/"'), _t('使用豆瓣页面时需要设置'));
    $form->addInput($doubanID);
    $twikoo = new Typecho_Widget_Helper_Form_Element_Textarea('twikoo', NULL, NULL, _t('引用第三方评论'), _t('不填写则不显示'));
    $form->addInput($twikoo);
    $addhead = new Typecho_Widget_Helper_Form_Element_Textarea('addhead', NULL, NULL, _t('添加head'), _t('支持HTML'));
    $form->addInput($addhead);
    $tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji', NULL, NULL, _t('统计代码'), _t('支持HTML'));
    $form->addInput($tongji);
    $showallwords = new Typecho_Widget_Helper_Form_Element_Radio('showallwords',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示归档字数统计'), _t('选择“是”将在归档页面显示全站总字数。'));
    $form->addInput($showallwords);
    $showrelated = new Typecho_Widget_Helper_Form_Element_Radio('showrelated',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示相关文章'), _t('选择“是”将在文章页面显示相关文章。'));
    $form->addInput($showrelated);
    $showshare = new Typecho_Widget_Helper_Form_Element_Radio('showshare',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示复制链接'), _t('选择“是”将在文章页面显示复制链接。'));
    $form->addInput($showshare);
    $showtime = new Typecho_Widget_Helper_Form_Element_Radio('showtime',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示页面加载时间'), _t('选择“是”将在页脚显示加载时间。'));
    $form->addInput($showtime);
    $qqboturl = new Typecho_Widget_Helper_Form_Element_Text('qqboturl', NULL, 'https://bot.asbid.cn', _t('QQ机器人API,保持默认则需添加 2280858259 为好友'), _t('基于cqhttp,有评论时QQ通知'));
    $form->addInput($qqboturl);
    $qqnum = new Typecho_Widget_Helper_Form_Element_Text('qqnum', NULL, '80116747', _t('QQ号码'), _t('用于接收QQ通知的号码'));
    $form->addInput($qqnum);
} 
function get_post_view($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            
        }
    }
    echo $row['views'];
}
// 获取Typecho的选项
$options = Typecho_Widget::widget('Widget_Options');
// 检查cnavatar是否已设置，如果未设置或为空，则使用默认的Gravatar前缀
$gravatarPrefix = empty($options->cnavatar) ? 'https://cravatar.cn/avatar/' : $options->cnavatar;
// 定义全局常量__TYPECHO_GRAVATAR_PREFIX__，用于存储Gravatar前缀
define('__TYPECHO_GRAVATAR_PREFIX__', $gravatarPrefix);
/**
* 页面加载时间
*/
function timer_start() {
    global $timestart;
    $mtime = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
    }
    timer_start();
    function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime = explode( ' ', microtime() );
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display ) {
    echo $r;
    }
    return $r;
    }

/*
 * 全站字数
 */
function allwords() {
    $chars = 0;
    $db = Typecho_Db::get();
    $select = $db ->select('text')->from('table.contents');//如果只要统计文章总字数不要统计单页的话可在后面加入->where('type = ?','post')
    $rows = $db->fetchAll($select);
    foreach ($rows as $row) { $chars += mb_strlen(trim($row['text']), 'UTF-8'); }
    if($chars<50000){
    echo '全站共 '.$chars.' 字,还在努力更新中,加油！加油啦！';}
    elseif ($chars<70000 && $chars>50000){
    echo '全站共 '.$chars.' 字，写完一本埃克苏佩里的《小王子》了！';}
    elseif ($chars<90000 && $chars>70000){
    echo '全站共 '.$chars.' 字，写完一本鲁迅的《呐喊》了！';}
    elseif ($chars<100000 && $chars>90000){
    echo '全站共 '.$chars.' 字，写完一本林海音的《城南旧事》了！';}
    elseif ($chars<110000 && $chars>100000){
    echo '全站共 '.$chars.' 字，写完一本马克·吐温的《王子与乞丐》了！';}
    elseif ($chars<120000 && $chars>110000){
    echo '全站共 '.$chars.' 字，写完一本鲁迅的《彷徨》了！';}
    elseif ($chars<130000 && $chars>120000){
    echo '全站共 '.$chars.' 字，写完一本余华的《活着》了！';}
    elseif ($chars<140000 && $chars>130000){
    echo '全站共 '.$chars.' 字，写完一本曹禺的《雷雨》了！';}
    elseif ($chars<150000 && $chars>140000){
    echo '全站共 '.$chars.' 字，写完一本史铁生的《宿命的写作》了！';}
    elseif ($chars<160000 && $chars>150000){
    echo '全站共 '.$chars.' 字，写完一本伯内特的《秘密花园》了！';}
    elseif ($chars<170000 && $chars>160000){
    echo '全站共 '.$chars.' 字，写完一本曹禺的《日出》了！';}
    elseif ($chars<180000 && $chars>170000){
    echo '全站共 '.$chars.' 字，写完一本马克·吐温的《汤姆·索亚历险记》了！';}
    elseif ($chars<190000 && $chars>180000){
    echo '全站共 '.$chars.' 字，写完一本沈从文的《边城》了！';}
    elseif ($chars<200000 && $chars>190000){
    echo '全站共 '.$chars.' 字，写完一本亚米契斯的《爱的教育》了！';}
    elseif ($chars<210000 && $chars>200000){
    echo '全站共 '.$chars.' 字，写完一本巴金的《寒夜》了！';}
    elseif ($chars<220000 && $chars>210000){
    echo '全站共 '.$chars.' 字，写完一本东野圭吾的《解忧杂货店》了！';}
    elseif ($chars<230000 && $chars>220000){
    echo '全站共 '.$chars.' 字，写完一本莫泊桑的《一生》了！';}
    elseif ($chars<250000 && $chars>230000){
    echo '全站共 '.$chars.' 字，写完一本简·奥斯汀的《傲慢与偏见》了！';}
    elseif ($chars<280000 && $chars>250000){
    echo '全站共 '.$chars.' 字，写完一本钱钟书的《围城》了！';}
    elseif ($chars<300000 && $chars>280000){
    echo '全站共 '.$chars.' 字，写完一本张炜的《古船》了！';}
    elseif ($chars<310000 && $chars>300000){
    echo '全站共 '.$chars.' 字，写完一本茅盾的《子夜》了！';}
    elseif ($chars<320000 && $chars>310000){
    echo '全站共 '.$chars.' 字，写完一本阿来的《尘埃落定》了！';}
    elseif ($chars<340000 && $chars>320000){
    echo '全站共 '.$chars.' 字，写完一本艾米莉·勃朗特的《呼啸山庄》了！';}
    elseif ($chars<350000 && $chars>340000){
    echo '全站共 '.$chars.' 字，写完一本雨果的《巴黎圣母院》了！';}
    elseif ($chars<400000 && $chars>350000){
    echo '全站共 '.$chars.' 字，写完一本东野圭吾的《白夜行》了！';}
    elseif ($chars<1000000 && $chars>400000){
    echo '全站共 '.$chars.' 字，写完一本我国著名的四大名著了！';}
    elseif ($chars>1000000){
    echo '全站共 '.$chars.' 字，已写一本列夫·托尔斯泰的《战争与和平》了！';}
} 
function img_postthumb($cid) {
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')
        ->from('table.contents')
        ->where('table.contents.cid=?', $cid)
        ->order('table.contents.cid', Typecho_Db::SORT_ASC)
        ->limit(1));
    // 检查是否获取到结果
    if (!$rs) {
        return "";
    }
    preg_match_all("/https?:\/\/[^\s]*.(png|jpeg|jpg|gif|bmp|webp)/", $rs['text'], $thumbUrl);  //通过正则式获取图片地址
    // 检查是否匹配到图片URL
    if (count($thumbUrl[0]) > 0) {
        return $thumbUrl[0][0];  // 返回第一张图片的URL
    } else {
        return "";  // 没有匹配到图片URL，返回空字符串
    }
}
//回复加上@
function getPermalinkFromCoid($coid) {
	$db = Typecho_Db::get();
	$row = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
	if (empty($row)) return '';
	return '<a href="#comment-'.$coid.'" style="text-decoration: none;">@'.$row['author'].'</a>';
}
// 评论提交通知函数
function notifyQQBot($comment) {
    $options = Helper::options();
    // 检查评论是否已经审核通过
    if ($comment->status != "approved") {
        error_log('Comment is not approved.');
        return;
    } 
    // 获取配置中的QQ机器人API地址
    $cq_url = $options->qqboturl;
    // 检查API地址是否为空
    if (empty($cq_url)) {
        error_log('QQ Bot URL is empty. Using default URL.');
        $cq_url = 'https://bot.asbid.cn';
    }
    // 获取QQ号码
    $qqnum = $options->qqnum;
    // 检查QQ号码是否为空
    if (empty($qqnum)) {
        error_log('QQ number is empty.');
        return;
    }
    // 如果是管理员自己发的评论则不发送通知
    if ($comment->authorId === $comment->ownerId) {
        error_log('This comment is by the post owner.');
        return;
    }
    // 构建消息内容
    $msg = '「' . $comment->author . '」在文章《' . $comment->title . '》中发表了评论！';
    $msg .= "\n评论内容:\n{$comment->text}\n永久链接地址：{$comment->permalink}";
    // 准备发送消息的数据
    $_message_data_ = [
        'user_id' => (int) trim($qqnum),
        'message' => str_replace(["\r\n", "\r", "\n"], "\r\n", htmlspecialchars_decode(strip_tags($msg)))
    ];
    // 输出调试信息
    error_log('Sending message to QQ Bot: ' . print_r($_message_data_, true));
    // 初始化Curl请求
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "{$cq_url}/send_msg?" . http_build_query($_message_data_, '', '&'),
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log('Curl error: ' . curl_error($ch));
    } else {
        error_log('Response: ' . $response);
    }
    curl_close($ch);
}
Typecho_Plugin::factory('Widget_Feedback')->finishComment = 'notifyQQBot';
//开始增加某些奇怪的东西
// 获取月份
function getMonth() {
    $path = $_SERVER['PHP_SELF'];  // 获取路劲
    preg_match('/\d{4}\/\d{2}\/\d{2}|\d{4}\/\d{2}/', $path, $date);  // 匹配路劲中的日期
    if (is_array($date) && count($date)) {
        $date = explode('/', $date[0]);  // 如果匹配到就分割日期
    }else {
        $date = date('Y/m/d', time());  // 如果没有匹配到就获取当前月
        $date = explode('/', $date);  // 分割日期
    }
    return $date;
}
// 获取指定月份的文章
function getMonthPost() {
    $date = getMonth();  // 获取要查询文章的月份

    $start = $date[0] . '-' . $date[1] . '-01 00:00:00';  // 月的第一天
    $end = date('Y-m-t', strtotime($date[0] . '-' . $date[1] . '-' . '1 23:59:59'));  // 月最后一天
    $start = strtotime($start);  // 把月的第一天转换为时间戳
    $end = strtotime($end . ' 23:59:59');  // 把月的最后一天转换为时间戳
    $db = Typecho_Db::get();
    // 按照提供的月份查询出文件的时间
    $post = $db->fetchAll($db->select('table.contents.created')->from('table.contents')->where('created >= ?', $start)->where('created <= ?', $end)->where('type = ?', 'post')->where('status = ?', 'publish'));
    // 按照提供的月份查询前一个月的文章
    $previous = $db->fetchAll($db->select('table.contents.created')->from('table.contents')->where('created < ?', $start)->where('type = ?', 'post')->where('status = ?', 'publish')->offset(0)->limit(1)->order('created', Typecho_Db::SORT_DESC));
    // 按照提供的月份查询后一个月的文章
    $next = $db->fetchAll($db->select('table.contents.created')->from('table.contents')->where('created > ?', $end)->where('type = ?', 'post')->where('status = ?', 'publish')->offset(0)->limit(1)->order('created', Typecho_Db::SORT_ASC));

    if (count($next)) {
        $next = date('Y/m/', $next[0]['created']);  // 格式化前一个月的文章时间
    }

    if (count($previous)) {
        $previous = date('Y/m/', $previous[0]['created']);  // 格式化后一个月的文章时间
    }

    $day = array();
    foreach ($post as $val) {
        array_push($day, date('j', $val['created']));  // 把查询出的文章日加入数组
    }
    return array(
        'post'=> $day,
        'previous' => $previous,
        'next' => $next
    );
}
// 生成日历
function calendar($month, $url, $rewrite) {
    $monthArr = getMonth();  // 获取月份
    $post = getMonthPost();  // 获取文章日期

    // 判断是否启用了地址重写功能
    if ($rewrite) {
        $monthUrl = $url . $monthArr[0] . '/' . $monthArr[1] . '/';  // 生成日期链接前缀
        $previousUrl = is_array($post['previous'])?'':$url . $post['previous'];  // 生成前一个月的跳转链接地址
        $nextUrl = is_array($post['next'])?'':$url . $post['next'];  // 生成后一个月的跳转链接地址
    }else {
        $monthUrl = $url . 'index.php/' . $monthArr[0] . '/' . $monthArr[1] . '/';  // 生成日期链接前缀
        $previousUrl = is_array($post['previous'])?'':$url . 'index.php/' . $post['previous'];  // 生成前一个月的跳转链接地址
        $nextUrl = is_array($post['next'])?'':$url . 'index.php/' . $post['next'];  // 生成后一个月的跳转链接地址
    }

    $postCount = array_count_values($post['post']);  // 统计每天的文章数量

    $calendar = '';  // 初始化
    $week_arr = ['日', '一', '二', '三', '四', '五', '六'];  // 表头
    $this_month_days = (int)date('t', strtotime($month));  // 本月共多少天
    $this_month_one_n = (int)date('w', strtotime($month));  // 本月1号星期几
    $calendar .= '<table aria-label="' . $monthArr[0] . '年' . $monthArr[1] . '月日历" class="table table-bordered table-sm m-0"><thead><tr>';  // 表头

    foreach ($week_arr as $k => $v){
        if($k == 0){
            $class = ' class="sunday"';
        }elseif ($k == 6){
            $class = ' class="saturday"';
        }else{
            $class = '';
        }
        $calendar .= '<th class="text-center py-2">' . $v . '</th>';
    }
    $calendar .= '</tr></thead><tbody>';
    // 表身
    // 计算本月共几行数据
    $total_rows = ceil(($this_month_days - (7 - $this_month_one_n)) / 7) + 1;
    $number = 1;
    $flag = 0;
    for ($row = 1;$row <= $total_rows;$row++){
        $calendar .= '<tr>';
        for ($week = 0;$week <= 6;$week ++){
            if($number < 10){
                $numbera = '0' . $number;
            }else{
                $numbera = $number;
            }

            if($number <= $this_month_days){
                if ($number < 10) {
                    $zero = '0';
                }else {
                    $zero = '';
                }

                if($row == 1){
                    if($week >= $this_month_one_n){
                        if (in_array($number, $post['post'])) {
                            $calendar .= '<td class="active text-center py-2">' . '<a rel="archives" href="' . $monthUrl . $zero . $number . '/' . '" class="p-0" title="' . $postCount[$number] . '篇文章" data-toggle="tooltip" data-placement="top"><b>' . $number . '</b></a>' . '</td>';
                        }else {
                            $calendar .= '<td class="text-center py-2">' . $number . '</td>';
                        }
                        $flag = 1;
                    }else{
                        $calendar .= '<td></td>';
                    }
                }else{
                    if (in_array($number, $post['post'])) {
                        $calendar .= '<td class="active text-center py-2">' . '<a rel="archives" href="' . $monthUrl . $zero . $number . '/' . '" class="p-0" title="' . $postCount[$number] . '篇文章" data-toggle="tooltip" data-placement="top"><b>' . $number . '</b></a>' . '</td>';
                    }else {
                        $calendar .= '<td class="text-center py-2">' . $number . '</td>';
                    }
                }
                if($flag){
                    $number ++;
                }
            }else{
                $calendar .= '<td></td>';
            }
        }
        $calendar .= '</tr>';
    }

    $calendar .= '</tbody></table>';

    return array(
        'calendar' => $calendar,
        'previous' => is_array($post['previous'])?false:$post['previous'],
        'next' => is_array($post['next'])?false:$post['next'],
        'previousUrl' => $previousUrl,
        'nextUrl' => $nextUrl
    );
}
// 获取分类数量
function categoryCount() {
    $db = Typecho_Db::get();
    $count = $db->fetchRow($db->select('COUNT(*)')->from('table.metas')->where('type = ?', 'category'));
    return $count['COUNT(*)'];
}

// 获取标签数量
function tagCount() {
    $db = Typecho_Db::get();
    $count = $db->fetchRow($db->select('COUNT(*)')->from('table.metas')->where('type = ?', 'tag'));
    return $count['COUNT(*)'];
}

// 获取总阅读量
function viewsCount() {
    $db = Typecho_Db::get();
    $count = $db->fetchRow($db->select('SUM(views) AS viewsCount')->from('table.contents'));
    return $count['viewsCount'];
}

// 获取阅读量排名前 5 的 5 篇文章的信息
function top5post() {
    $db = Typecho_Db::get();
    $top5Post = $db->fetchAll($db->select()->from('table.contents')->where('type = ?', 'post')->where('status = ?', 'publish')->order('views', Typecho_Db::SORT_DESC)->offset(0)->limit(5));
    $postList =array();
    foreach ($top5Post as $post) {
        $post = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($post);
        array_push($postList, array(
            'title' => $post['title'],
            'link' => $post['permalink'],
            'views' => $post['views']
        ));
    }
    return $postList;
}

// 获取评论数排名前 5 的 5 篇文章的信息
function top5CommentPost() {
    $db = Typecho_Db::get();
    $top5Post = $db->fetchAll($db->select()->from('table.contents')->where('type = ?', 'post')->where('status = ?', 'publish')->order('commentsNum', Typecho_Db::SORT_DESC)->offset(0)->limit(5));
    $postList = array();
    foreach ($top5Post as $post) {
        $post = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($post);
        array_push($postList, array(
            'title' => $post['title'],
            'link' => $post['permalink'],
            'commentsNum' => $post['commentsNum']
        ));
    }
    return $postList;
}
// 获取 ECharts 格式要求的文章更新日历
function postCalendar($start, $end) {
    $db = Typecho_Db::get();
    $dateList = $db->fetchAll($db->select('created')->from('table.contents')->where('created > ?', $start)->where('created < ?', $end));
    if (count($dateList) < 1) {
        return array();
    }
    $dateList2 = array();
    foreach ($dateList as $val) {
        array_push($dateList2, date('Y-m-d', $val['created']));
    }
    $dateList2 = array_count_values($dateList2);
    $key = array_keys($dateList2);
    $dateList = array();

    for ($i = 0;$i < count($dateList2);$i ++) {
        array_push($dateList, array(
            $key[$i],
            $dateList2[$key[$i]]
        ));
    }

    return $dateList;
}

// 获取 ECharts 格式要求的评论更新日历
function commentCalendar($start, $end) {
    $db = Typecho_Db::get();
    $dateList = $db->fetchAll($db->select('created')->from('table.comments')->where('created > ?', $start)->where('created < ?', $end));
    if (count($dateList) < 1) {
        return array();
    }
    $dateList2 = array();
    foreach ($dateList as $val) {
        array_push($dateList2, date('Y-m-d', $val['created']));
    }
    $dateList2 = array_count_values($dateList2);
    $key = array_keys($dateList2);
    $dateList = array();

    for ($i = 0;$i < count($dateList2);$i ++) {
        array_push($dateList, array(
            $key[$i],
            $dateList2[$key[$i]]
        ));
    }

    return $dateList;
}
// 获取个分类的文章数量
function categoryPostCount() {
    $db = Typecho_Db::get();
    $count = $db->fetchAll($db->select('name', 'count AS value')->from('table.metas')->where('type = ?', 'category'));
    if (count($count) < 1) {
        return array();
    }
    return $count;
}

// 获取父分类的名称
function getParentCategory($categoryId) {
    $db = Typecho_Db::get();
    $category = $db->fetchRow($db->select()->from('table.metas')->where('mid = ?', $categoryId));
    return $category['name'];
}

// 计算两个时间之间相差的天数
function getDays($time1, $time2) {
    return floor(($time2 - $time1) / 86400);
}

//获取文章卡片
function get_article_info($atts) {
    $default_atts = array(
        'id' => '',
        'url' => ''
    );
    $atts = array_merge($default_atts, $atts);
    $db = Typecho_Db::get();
    if (!empty($atts['id'])) {
        $post = $db->fetchRow($db->select()->from('table.contents')
            ->where('cid = ?', $atts['id'])
            ->limit(1));
    } elseif (!empty($atts['url'])) {
        $post = $db->fetchRow($db->select()->from('table.contents')
            ->where('permalink = ?', $atts['url'])
            ->limit(1));
    } else {
        return '请提供文章ID或URL';
    }
    if (!$post) {
        return '未找到文章';
    }
    $post = Typecho_Widget::widget('Widget_Abstract_Contents')->push($post);

    // 获取缩略图
    $imageToDisplay = img_postthumb($post['cid']);
    if (empty($imageToDisplay)) {
        $imageToDisplay = '//pic.0tz.top/api'; // 设置一个默认图片路径
    }

    $output = '<div class="graph--mixtapeEmbed">';
    $output .= '<a class="mixtapeContent" href="' . $post['permalink'] . '" target="_blank">';
    $output .= '<span class="markup--strong markup--mixtapeEmbed-strong">' . $post['title'] . '</span>';
    $output .= '<em class="markup--em markup--mixtapeEmbed-em">' . Typecho_Common::subStr(strip_tags($post['text']), 0, 100, '...') . '</em>';
    $output .= '</a>';
    $output .= '<a class="mixtapeImage" href="' . $post['permalink'] . '" target="_blank" style="background-image:url(' . $imageToDisplay . ')"></a>';
    $output .= '</div>';
    return $output;
}


// 注册短代码
function register_shortcodes() {
    Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('ContentProcessor', 'process');
}

class ContentProcessor {
    public static function process($content, $widget, $lastResult) {
        $content = preg_replace_callback('/\[article\s+([^\]]+)\]/', function($matches) {
            $atts = self::parse_atts($matches[1]);
            return get_article_info($atts);
        }, $content);

        return $content;
    }

    // 解析短代码属性
    private static function parse_atts($text) {
        $atts = array();
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
        if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
            foreach ($match as $m) {
                if (!empty($m[1]))
                    $atts[strtolower($m[1])] = stripcslashes($m[2]);
                elseif (!empty($m[3]))
                    $atts[strtolower($m[3])] = stripcslashes($m[4]);
                elseif (!empty($m[5]))
                    $atts[strtolower($m[5])] = stripcslashes($m[6]);
                elseif (isset($m[7]) && strlen($m[7]))
                    $atts[] = stripcslashes($m[7]);
                elseif (isset($m[8]))
                    $atts[] = stripcslashes($m[8]);
            }
        }
        return $atts;
    }
}

register_shortcodes();
 
//在编辑器中添加插入文章引用的按钮
class EditorButton {
    public static function render()
    {
        echo <<<EOF
<script>
$(document).ready(function() {
    $('#wmd-button-row').append('<li class="wmd-button" id="wmd-article-button" title="插入文章引用"><span style="background: none;"><svg t="1687164718203" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4158" width="20" height="20"><path d="M810.666667 213.333333H213.333333c-46.933333 0-85.333333 38.4-85.333333 85.333334v426.666666c0 46.933333 38.4 85.333333 85.333333 85.333334h597.333334c46.933333 0 85.333333-38.4 85.333333-85.333334V298.666667c0-46.933333-38.4-85.333333-85.333333-85.333334z m0 512H213.333333V298.666667h597.333334v426.666666z" p-id="4159"></path><path d="M298.666667 384h426.666666v85.333333H298.666667zM298.666667 554.666667h426.666666v85.333333H298.666667z" p-id="4160"></path></svg></span></li>');

    $('#wmd-article-button').click(function() {
        var articleId = prompt("请输入要引用的文章ID：");
        if (articleId) {
            var text = "[article id=\"" + articleId + "\"]";
            var textarea = $('#text')[0];
            var start = textarea.selectionStart;
            var end = textarea.selectionEnd;
            var value = textarea.value;

            textarea.value = value.substring(0, start) + text + value.substring(end);

            // 将光标移动到插入的文本之后
            textarea.setSelectionRange(start + text.length, start + text.length);
            textarea.focus();

            // 触发change事件，确保编辑器更新
            $('#text').trigger('change');
        }
    });
});
</script>
EOF;
    }
}

// 注册钩子
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('EditorButton', 'render');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('EditorButton', 'render');
