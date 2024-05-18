<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'));
    $form->addInput($logoUrl);
    $icoUrl = new Typecho_Widget_Helper_Form_Element_Text('icoUrl', NULL, NULL, _t('站点 Favicon 地址'));
    $form->addInput($icoUrl);
    $jzyear = new Typecho_Widget_Helper_Form_Element_Text('jzyear', NULL, NULL, _t('建站年份 eg. 2006'));
    $form->addInput($jzyear);
    $instagramurl = new Typecho_Widget_Helper_Form_Element_Text('instagramurl', NULL, NULL, _t('ins'));
    $form->addInput($instagramurl);
    $telegramurl = new Typecho_Widget_Helper_Form_Element_Text('telegramurl', NULL, NULL, _t('电报'));
    $form->addInput($telegramurl);
    $githuburl = new Typecho_Widget_Helper_Form_Element_Text('githuburl', NULL, NULL, _t('github'));
    $form->addInput($githuburl);
    $twitterurl = new Typecho_Widget_Helper_Form_Element_Text('twitterurl', NULL, NULL, _t('twitter'));
    $form->addInput($twitterurl);
    $mastodonurl = new Typecho_Widget_Helper_Form_Element_Text('mastodonurl', NULL, NULL, _t('mastodon'));
    $form->addInput($mastodonurl);
    $sitemapurl = new Typecho_Widget_Helper_Form_Element_Text('sitemapurl', NULL, NULL, _t('sitemap'));
    $form->addInput($sitemapurl);
    $cnavatar = new Typecho_Widget_Helper_Form_Element_Text('cnavatar', NULL, 'https://cravatar.cn/avatar/', _t('自定义Gravatar镜像服务器,默认https://cravatar.cn/avatar/'));
    $form->addInput($cnavatar);
    $donate = new Typecho_Widget_Helper_Form_Element_Text('donate', NULL, 'https://blogcdn.loliko.cn/donate/wx.png', _t('赞赏二维码'));
    $form->addInput($donate);


    $twikoo = new Typecho_Widget_Helper_Form_Element_Textarea('twikoo', NULL, NULL, _t('引用第三方评论'));
    $form->addInput($twikoo);

    $addhead = new Typecho_Widget_Helper_Form_Element_Textarea('addhead', NULL, NULL, _t('添加head'));
    $form->addInput($addhead);
    $tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji', NULL, NULL, _t('统计代码'));
    $form->addInput($tongji);
    $showProfile = new Typecho_Widget_Helper_Form_Element_Radio('showProfile',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否在文章页面显示显示作者信息'), _t('选择“是”将在文章页面包含显示作者信息。'));
    $form->addInput($showProfile);
    $showallwords = new Typecho_Widget_Helper_Form_Element_Radio('showallwords',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示归档字数统计'), _t('选择“是”将在归档页面显示全站总字数。'));
    $form->addInput($showallwords);
    $showrelated = new Typecho_Widget_Helper_Form_Element_Radio('showrelated',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示相关文章'), _t('选择“是”将在文章页面显示相关文章。'));
    $form->addInput($showrelated);
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
function show_first_image($content) {
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    // 检查是否找到了图片
    if(isset($matches[1][0])){
        return $matches[1][0];
    }
    return false; // 没有找到图片，返回 false
}