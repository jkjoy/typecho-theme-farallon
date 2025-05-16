<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//主题设置
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'));
    $form->addInput($logoUrl);
    $icoUrl = new Typecho_Widget_Helper_Form_Element_Text('icoUrl', NULL, NULL, _t('站点 Favicon 地址'));
    $form->addInput($icoUrl);
    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('置顶文章cid'), _t('多篇文章以`|`符号隔开'), _t('会在首页展示置顶文章。'));
    $form->addInput($sticky);
    $travel = new Typecho_Widget_Helper_Form_Element_Text('travel', NULL, NULL, _t('travel分类 Mid'), _t('填写分类的mid'), _t('指定分类ID，用于足迹分类展示'));
    $form->addInput($travel);
    $memos = new Typecho_Widget_Helper_Form_Element_Text('memos', NULL, NULL, _t('说说分类 Mid'), _t('填写分类的mid'), _t('指定分类ID，用于说说分类展示'));
    $form->addInput($memos);    
    $instagramurl = new Typecho_Widget_Helper_Form_Element_Text('instagramurl', NULL, NULL, _t('Instagram'), _t('会在个人信息显示'));
    $form->addInput($instagramurl);
    $telegramurl = new Typecho_Widget_Helper_Form_Element_Text('telegramurl', NULL, 'https://t.me/', _t('电报'), _t('会在个人信息显示'));
    $form->addInput($telegramurl);
    $githuburl = new Typecho_Widget_Helper_Form_Element_Text('githuburl', NULL, 'https://github.com/', _t('github'), _t('会在个人信息显示'));
    $form->addInput($githuburl);
    $twitterurl = new Typecho_Widget_Helper_Form_Element_Text('twitterurl', NULL, NULL, _t('twitter'), _t('会在个人信息显示'));
    $form->addInput($twitterurl);
    $mastodonurl = new Typecho_Widget_Helper_Form_Element_Text('mastodonurl', NULL, NULL, _t('mastodon'), _t('会在个人信息显示'));
    $form->addInput($mastodonurl);
    $showProfile = new Typecho_Widget_Helper_Form_Element_Radio('showProfile',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否在文章页面显示作者信息'), _t('选择"是"将在文章页面包含显示作者信息。'));
    $form->addInput($showProfile);
    $showcate = new Typecho_Widget_Helper_Form_Element_Radio('showcate',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否在文章页面显示文章分类'), _t('选择"是"将在文章页面显示文章的分类信息。'));
    $form->addInput($showcate);
    $showrelated = new Typecho_Widget_Helper_Form_Element_Radio('showrelated',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示相关文章'), _t('选择"是"将在文章页面显示相关文章。'));
    $form->addInput($showrelated);
    $showshare = new Typecho_Widget_Helper_Form_Element_Radio('showshare',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示复制链接'), _t('选择"是"将在文章页面显示复制链接。'));
    $form->addInput($showshare);
    $showtime = new Typecho_Widget_Helper_Form_Element_Radio('showtime',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('是否显示页面加载时间'), _t('选择"是"将在页脚显示加载时间。'));
    $form->addInput($showtime);
    $loadmore = new Typecho_Widget_Helper_Form_Element_Radio('loadmore',
    array('0'=> _t('加载更多'), '1'=> _t('页码模式')),
    '0', _t('加载文章列表方式'), _t('加载更多将在文章列表底部显示加载更多按钮'));
    $form->addInput($loadmore);
    $sitemapurl = new Typecho_Widget_Helper_Form_Element_Text('sitemapurl', NULL, NULL, _t('sitemap'), _t('网站地图链接'));
    $form->addInput($sitemapurl);
    $cnavatar = new Typecho_Widget_Helper_Form_Element_Text('cnavatar', NULL, NULL , _t('Gravatar镜像'), _t('默认https://cravatar.cn/avatar/'));
    $form->addInput($cnavatar);
    $midimg = new Typecho_Widget_Helper_Form_Element_Text('midimg', NULL, '/img/', _t('填写分类图片路径,以"/"结尾'), _t('默认使用网站根目录下的img文件夹,也可以填写绝对或者CDN地址,自动匹配目录下以分类ID为文件名的mid.jpg格式的图片'));
    $form->addInput($midimg);
    $wxpay = new Typecho_Widget_Helper_Form_Element_Text('wxpay', NULL, 'https://blog.loliko.cn/images/wechatpay.png', _t('微信收款码'), _t('赞赏二维码'));
    $form->addInput($wxpay);
    $alipay= new Typecho_Widget_Helper_Form_Element_Text('alipay', NULL, 'https://blog.loliko.cn/images/alipay.png', _t('支付宝收款码'), _t('赞赏二维码'));
    $form->addInput($alipay);
    $addhead = new Typecho_Widget_Helper_Form_Element_Textarea('addhead', NULL, NULL, _t('Head内代码用于网站验证等'), _t('支持HTML'));
    $form->addInput($addhead);
    $tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji', NULL, NULL, _t('统计代码'), _t('支持HTML'));
    $form->addInput($tongji);
}

function saveThemeConfig($config) {
    // 可以在这里添加额外的验证或处理逻辑
    return $config;
}

// 自定义字段
function themeFields($layout) {
    $summary= new Typecho_Widget_Helper_Form_Element_Textarea('summary', NULL, NULL, _t('文章摘要'), _t('自定义摘要'));
    $layout->addItem($summary);
    $cover= new Typecho_Widget_Helper_Form_Element_Text('cover', NULL, NULL, _t('文章封面'), _t('自定义文章封面'));
    $layout->addItem($cover);
}

/*
* 文章浏览数统计
*/
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

/** 头像镜像     */
$options = Typecho_Widget::widget('Widget_Options');
$gravatarPrefix = empty($options->cnavatar) ? 'https://cravatar.cn/avatar/' : $options->cnavatar;
define('__TYPECHO_GRAVATAR_PREFIX__', $gravatarPrefix);

// 初始化主题
function init_theme() {
    // 检查并创建封面图片目录
    $coversDir = dirname(__FILE__) . '/assets/images/covers';
    if (!is_dir($coversDir)) {
        @mkdir($coversDir, 0755, true);
    }
}
// 在主题加载时执行初始化
init_theme();

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

/**
* 获取文章第一张图片
*/    
function img_postthumb($cid) {
    $db = Typecho_Db::get();
    
    // 首先检查是否设置了自定义封面
    $cover = $db->fetchRow($db->select('str_value')
        ->from('table.fields')
        ->where('cid = ?', $cid)
        ->where('name = ?', 'cover'));
    
    // 如果找到自定义封面，直接返回
    if ($cover && !empty($cover['str_value'])) {
        return $cover['str_value'];
    }
    
    // 否则尝试从文章内容中获取第一张图片
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

/**
 * 图片灯箱
 */
class ImageStructureProcessor {
    public static function processContent($content, $widget, $lastResult = null) {
        // 首先应用之前的过滤器结果
        $content = empty($lastResult) ? $content : $lastResult;
        
        // 检查内容是否为空
        if (empty($content) || !is_string($content)) {
            return $content;
        }
        if ($widget instanceof Widget_Archive) {
            try {
                // 使用 DOM 操作确保结构完整性
                $dom = new DOMDocument('1.0', 'UTF-8');
                // 添加错误处理
                libxml_use_internal_errors(true);
                // 添加基础 HTML 结构以确保正确解析
                $content = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body><div>' . $content . '</div></body></html>';
                // 直接加载内容到 DOM
                $dom->loadHTML($content, 
                    LIBXML_HTML_NOIMPLIED | 
                    LIBXML_HTML_NODEFDTD | 
                    LIBXML_NOERROR | 
                    LIBXML_NOWARNING
                );
                $xpath = new DOMXPath($dom);
                // 查找所有没有父 figure 的图片，排除 SVG
                $images = $xpath->query("//img[not(ancestor::figure) and not(contains(@src, '.svg'))]");
                if ($images->length > 0) {
                    foreach ($images as $img) {
                        // 获取必要的属性
                        $src = $img->getAttribute('src');
                        $alt = $img->getAttribute('alt');
                        // 跳过没有 src 的图片或 SVG 格式的图片
                        if (empty($src) || stripos($src, '.svg') !== false) {
                            continue;
                        }
                        // 创建容器元素
                        $figure = $dom->createElement('figure');
                        $figure->setAttribute('class', 'grap--figure');
                        // 创建链接元素用于 lightbox
                        $link = $dom->createElement('a');
                        $link->setAttribute('href', $src);
                        $link->setAttribute('data-lightbox', 'image-set');
                        $link->setAttribute('data-title', $alt);
                        $link->setAttribute('class', 'no-style-link');
                        // 只有在有 alt 属性时才创建 figcaption
                        if (!empty($alt)) {
                            $caption = $dom->createElement('figcaption', $alt);
                            $caption->setAttribute('class', 'imageCaption');
                        }
                        // 重组 DOM 结构
                        if ($img->parentNode) {
                            $img->parentNode->replaceChild($figure, $img);
                            $link->appendChild($img);
                            $figure->appendChild($link);
                            if (isset($caption)) {
                                $figure->appendChild($caption);
                            }
                        }
                    }
                }
                // 获取处理后的内容
                $content = $dom->saveHTML();
                // 提取 body 部分的内容
                $content = preg_replace('/^.*<body>(.*)<\/body>.*$/is', '$1', $content);
                // 清理临时添加的 div 标签
                $content = preg_replace('/^<div>|<\/div>$/i', '', $content);
                // 清理 libxml 错误
                libxml_clear_errors();
            } catch (Exception $e) {
                // 记录错误但返回原始内容
                error_log('Image processing error: ' . $e->getMessage());
                // 如果发生错误，返回上一个过滤器结果或原始内容
                return empty($lastResult) ? $content : $lastResult;
            }
        }
        return $content;
    }
}
// u6ce8u91cau6389u8fd9u884cuff0cu9632u6b62u8986u76d6u8fd9u4e2au94a9u5b50u7684u5176u4ed6u6ce8u518c
// Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = function($content, $widget) {
//     return ImageStructureProcessor::processContent($content, $widget);
// };

/**
 * 处理图片为封面图（裁剪为5:3，最大宽度500px，转换为webp）
 * 
 * @param string $imageUrl 原始图片URL
 * @return string 处理后的图片URL
 */
function process_cover_image($imageUrl) {
    // 检查GD库是否可用
    if (!function_exists('imagecreatetruecolor')) {
        return $imageUrl; // 如果GD库不可用，返回原图
    }
    
    // 分析URL
    $parsed = parse_url($imageUrl);
    
    // 如果图片是外部链接，需要下载
    $isExternalUrl = !empty($parsed['host']) && $parsed['host'] !== $_SERVER['HTTP_HOST'];
    
    // 生成唯一的文件名（使用MD5哈希）
    $filename = md5($imageUrl) . '.webp';
    
    // 处理后图片的保存路径
    $themeDir = dirname(__FILE__);
    $savePath = $themeDir . '/assets/images/covers/' . $filename;
    $webPath = Helper::options()->themeUrl . '/assets/images/covers/' . $filename;
    
    // 如果缓存文件已存在，直接返回
    if (file_exists($savePath)) {
        return $webPath;
    }
    
    // 获取原始图片内容
    if ($isExternalUrl) {
        // 外部图片，需要下载
        $imageContent = @file_get_contents($imageUrl);
        if (!$imageContent) {
            return $imageUrl; // 无法下载，返回原图
        }
    } else {
        // 本地图片
        $localPath = $_SERVER['DOCUMENT_ROOT'] . $parsed['path'];
        if (!file_exists($localPath)) {
            return $imageUrl; // 无法找到本地文件，返回原图
        }
        $imageContent = @file_get_contents($localPath);
    }
    
    // 创建图像资源
    $originalImage = @imagecreatefromstring($imageContent);
    if (!$originalImage) {
        return $imageUrl; // 无法创建图像资源，返回原图
    }
    
    // 获取原始图片尺寸
    $originalWidth = imagesx($originalImage);
    $originalHeight = imagesy($originalImage);
    
    // 计算目标尺寸（5:3比例，最大宽度500px）
    $targetWidth = min(500, $originalWidth);
    $targetHeight = intval($targetWidth * 3 / 5);
    
    // 计算裁剪坐标（居中裁剪）
    $cropX = 0;
    $cropY = 0;
    $cropWidth = $originalWidth;
    $cropHeight = $originalHeight;
    
    // 计算比例
    $originalRatio = $originalWidth / $originalHeight;
    $targetRatio = 5 / 3;
    
    if ($originalRatio > $targetRatio) {
        // 原图过宽，需要裁剪宽度
        $cropWidth = intval($originalHeight * $targetRatio);
        $cropX = intval(($originalWidth - $cropWidth) / 2);
    } else {
        // 原图过高，需要裁剪高度
        $cropHeight = intval($originalWidth / $targetRatio);
        $cropY = intval(($originalHeight - $cropHeight) / 2);
    }
    
    // 创建目标图像
    $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);
    
    // 裁剪并调整大小
    imagecopyresampled(
        $targetImage, 
        $originalImage, 
        0, 0, 
        $cropX, $cropY, 
        $targetWidth, $targetHeight, 
        $cropWidth, $cropHeight
    );
    
    // 保存为webp格式
    if (!function_exists('imagewebp')) {
        // 如果不支持webp，保存为png
        $filename = md5($imageUrl) . '.png';
        $savePath = $themeDir . '/assets/images/covers/' . $filename;
        $webPath = Helper::options()->themeUrl . '/assets/images/covers/' . $filename;
        imagepng($targetImage, $savePath, 9); // 9是最高压缩质量
    } else {
        // 保存为webp
        imagewebp($targetImage, $savePath, 80); // 80是质量参数
    }
    
    // 释放资源
    imagedestroy($originalImage);
    imagedestroy($targetImage);
    
    return $webPath;
}

/**
 * *获取文章卡片
 * **
 * 
*/
function get_article_summary($post) {
    // 首先尝试从自定义字段获取摘要
    $db = Typecho_Db::get();
    // 查询自定义字段表
    $row = $db->fetchRow($db->select()
        ->from('table.fields')
        ->where('cid = ?', $post['cid'])
        ->where('name = ?', 'summary')); 
    // 如果找到自定义摘要字段
    if ($row && !empty($row['str_value'])) {
        return $row['str_value'];
    } 
    // 如果没有自定义摘要，截取文章内容
    // 去除HTML标签
    $text = strip_tags($post['text']);
    
    // 截取指定长度的摘要
    return Typecho_Common::subStr($text, 0, 100, '...');
}
// 在原函数中使用
function get_article_info($atts) {
    $default_atts = array(
        'id' => '',
    );
    $atts = array_merge($default_atts, $atts);
    $db = Typecho_Db::get();
    // 根据 ID获取文章
    if (!empty($atts['id'])) {
        $post = $db->fetchRow($db->select()->from('table.contents')
            ->where('cid = ?', $atts['id'])
            ->limit(1));
    } else {
        return '请提供文章ID';
    }
    if (!$post) {
        return '未找到文章';
    }
    // 将文章数据推送到抽象内容小部件中
    $post = Typecho_Widget::widget('Widget_Abstract_Contents')->push($post);
    // 获取摘要
    $summary = get_article_summary($post);
    // 获取缩略图
    $default_thumbnail = Helper::options()->themeUrl . '/assets/images/nopic.svg';
    $imageToDisplay = img_postthumb($post['cid']);
    if (empty($imageToDisplay)) {
        $imageToDisplay = $default_thumbnail;
    } else {
        // 处理封面图片
        $imageToDisplay = process_cover_image($imageToDisplay);
    }
    // 构建输出
    $output = '<div class="graph--mixtapeEmbed">';
    $output .= '<a class="mixtapeContent" href="' . $post['permalink'] . '" target="_blank">';
    $output .= '<span class="markup--strong markup--mixtapeEmbed-strong">' . htmlspecialchars($post['title']) . '</span>';
    $output .= '<em class="markup--em markup--mixtapeEmbed-em">' . htmlspecialchars($summary) . '</em>';
    $output .= '</a>';
    $output .= '<a class="mixtapeImage" href="' . $post['permalink'] . '" target="_blank" style="background-image:url(' . htmlspecialchars($imageToDisplay) . ')"></a>';
    $output .= '</div>';
    return $output;
}
// 创建一个新的类来处理内容过滤
class ContentFilter
{
    public static function filterContent($content, $widget, $lastResult)
    {
        // 首先运行之前的过滤器结果
        $content = empty($lastResult) ? $content : $lastResult;
        
        // 处理图片灯箱
        $content = ImageStructureProcessor::processContent($content, $widget, $content);
        
        // 然后处理我们的文章短代码
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
// 注册钩子
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('ContentFilter', 'filterContent');
// 编辑器按钮类
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
// 注册编辑器按钮钩子
// 避免重复注册，在最后执行
if (!Typecho_Plugin::exists('Widget_Abstract_Contents', 'editor')) {
    Typecho_Plugin::factory('admin/write-post.php')->bottom = array('EditorButton', 'render');
    Typecho_Plugin::factory('admin/write-page.php')->bottom = array('EditorButton', 'render');
}

/**    
 * 评论者认证等级 + 身份    
 *    
 * @author Chrison    
 * @access public    
 * @param str $email 评论者邮址    
 * @return result     
 */     
function commentApprove($widget, $email = NULL)      
{   
    $result = array(
        "state" => -1,//状态
        "isAuthor" => 0,//是否是博主
        "userLevel" => '',//用户身份或等级名称
        "userDesc" => '',//用户title描述
        "bgColor" => '',//用户身份或等级背景色
        "commentNum" => 0//评论数量
    );
    if (empty($email)) return $result;      
    $result['state'] = 1;     
    if ($widget->authorId == $widget->ownerId) {      
        $result['isAuthor'] = 1;
        $result['userLevel'] = '作者';
        $result['userDesc'] = '博主';
        $result['bgColor'] = '#FFD700';
        $result['commentNum'] = 999;
    } else {
        $db = Typecho_Db::get();
        $commentNumSql = $db->fetchAll($db->select(array('COUNT(cid)'=>'commentNum'))
            ->from('table.comments')
            ->where('mail = ?', $email));
        $commentNum = $commentNumSql[0]['commentNum'];
        //$linkSql = $db->fetchAll($db->select()->from('table.links')
        //    ->where('user = ?',$email));
        if($commentNum==1){
            $result['userLevel'] = '初识';
            $result['bgColor'] = '#999999';
            $userDesc = '初来乍到的新朋友';
        } else {
            if ($commentNum<3 && $commentNum>1) {
                $result['userLevel'] = '初识';
                $result['bgColor'] = '#999999';
            }elseif ($commentNum<9 && $commentNum>=3) {
                $result['userLevel'] = '朋友';
                $result['bgColor'] = '#A0DAD0';
            }elseif ($commentNum<27 && $commentNum>=9) {
                $result['userLevel'] = '好友';
                $result['bgColor'] = '#FF8C00';
            }elseif ($commentNum<81 && $commentNum>=27) {
                $result['userLevel'] = '挚友';
                $result['bgColor'] = '#FF0000';
            }elseif ($commentNum<100 && $commentNum>=81) {
                $result['userLevel'] = '兄弟';
                $result['bgColor'] = '#006400';
            }elseif ($commentNum>=100) {
                $result['userLevel'] = '老铁';
                $result['bgColor'] = '#A0DAD0';
            }
             $userDesc = '已有'.$commentNum.'条评论'; 
        }
       // if($linkSql){
        //    $result['userLevel'] = '博友';
        //    $result['bgColor'] = '#21b9bb';
        //    $userDesc = '🔗'.$linkSql[0]['description'].'&#10;✌️'.$userDesc;
       // }       
        $result['userDesc'] = $userDesc;
        $result['commentNum'] = $commentNum;
    } 
    return $result;
}

/**
 * 修改附件插入功能
 */
// 添加批量插入按钮的JavaScript
// 避免重复注册，使用条件判断
if (!Typecho_Plugin::exists('admin/write-post.php', 'bottom')) {
    Typecho_Plugin::factory('admin/write-post.php')->bottom = array('MyHelper', 'addBatchInsertButton');
    Typecho_Plugin::factory('admin/write-page.php')->bottom = array('MyHelper', 'addBatchInsertButton');
}

class MyHelper {
    public static function addBatchInsertButton() {
        ?>
        <script>
        $(document).ready(function() {
            // 添加批量插入按钮
            var batchButton = $('<button type="button" class="btn primary" id="batch-insert">批量插入所有附件</button>');
            $('#file-list').before(batchButton);
            
            // 修改单个附件的插入格式
            Typecho.insertFileToEditor = function(title, url, isImage) {
                var textarea = $('#text'), sel = textarea.getSelection(),
                    insertContent = isImage ? '![' + title + '](' + url + ')' : 
                                            '[' + title + '](' + url + ')';
                
                textarea.replaceSelection(insertContent);
                textarea.focus();
            };
            
            // 批量插入功能
            $('#batch-insert').click(function() {
                var content = '';
                $('#file-list li').each(function() {
                    var $this = $(this),
                        title = $this.find('.insert').text(),
                        url = $this.data('url'),
                        isImage = $this.data('image') == 1;
                        
                    content += isImage ? '![' + title + '](' + url + ')\n' : 
                                       '[' + title + '](' + url + ')\n';
                });
                
                var textarea = $('#text');
                var pos = textarea.getSelection();
                var newContent = textarea.val();
                if (pos.start === pos.end) {
                    newContent = newContent.substring(0, pos.start) + content + newContent.substring(pos.start);
                } else {
                    newContent = newContent.substring(0, pos.start) + content + newContent.substring(pos.end);
                }
                textarea.val(newContent);
                textarea.focus();
            });
        });
        </script>
        <?php
    }
}