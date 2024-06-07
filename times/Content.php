<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Content
{
    public static function postCommentContent($content, $isLogin, $rememberEmail, $currentEmail, $parentEmail, $isTime = false)
    {
        //解析私密评论
        $flag = true;
        if (strpos($content, '[secret]') !== false) {//提高效率，避免每篇文章都要解析
            $pattern = self::get_shortcode_regex(array('secret'));
            $content = preg_replace_callback("/$pattern/", array('Content', 'secretContentParseCallback'), $content);
            if ($isLogin || ($currentEmail == $rememberEmail && $currentEmail != "") || ($parentEmail == $rememberEmail && $rememberEmail != "")) {
                $flag = true;
            } else {
                $flag = false;
            }
        }
        if ($flag) {
            $content = Content::parseContentPublic($content);
            return $content;
        } else {
            if ($isTime) {
                return '<div class="hideContent">此条为私密说说，仅发布者可见</div>';
            } else {
                return '<div class="hideContent">该评论仅登录用户及评论双方可见</div>';
            }
        }
    }
    /**
     * 解析时光机页面的评论内容
     * @param $content
     * @return string
     */
    public static function timeMachineCommentContent($content)
    {
        return Content::parseContentPublic($content);
    }
    /**
     * 一些公用的解析，文章、评论、时光机公用的，与用户状态无关
     * @param $content
     * @return null|string|string[]
     */
    public static function parseContentPublic($content)
    {
        $options = Helper::options();
        //倒计时
        if (strpos($content, '[countdown') !== false) {
            $pattern = self::get_shortcode_regex(array('countdown'));
            $content = preg_replace_callback("/$pattern/", array('Content', 'countdownParseCallback'),
                $content);
        }
        return $content;
    }
}