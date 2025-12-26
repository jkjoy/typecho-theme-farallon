<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//主题设置
function themeConfig($form) {
    echo '<style>.typecho-page-title h2 {font-weight: 600;color: #737373;}.typecho-page-title h2:before {content: "#";margin-right: 6px;color: #ff6d6d; font-size: 20px;font-weight: 600;}.themeConfig h3 {color: #737373;font-size: 20px;}.themeConfig h3:before {content: "[";margin-right: 5px;color: #ff6d6d;font-size: 25px;}.themeConfig h3:after {content: "]";margin-left: 5px;color: #ff6d6d;font-size: 25px;}.info{border: 1px solid #ffadad;padding: 20px;margin: -15px 10px 25px 0;background: #ffffff;border-radius: 5px;color: #ff6d6d;}</style>';
    // 直接在主题设置页面调用更新检查
    themeAutoUpgradeNotice();
    echo '<span class="themeConfig"><h3>博客设置</h3></span>';
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('说说列表显示头像'));
    $form->addInput($logoUrl);
    $icoUrl = new Typecho_Widget_Helper_Form_Element_Text('icoUrl', NULL, NULL, _t('站点 Favicon 地址'), _t('请填写站点Favicon的URL地址'));
    $form->addInput($icoUrl);
    $midimg = new Typecho_Widget_Helper_Form_Element_Text('midimg', NULL, '/img/', _t('填写分类图片路径,以"/"结尾'), _t('默认使用网站根目录下的img文件夹,也可以填写绝对或者CDN地址,自动匹配目录下以分类ID为文件名的mid.jpg格式的图片'));
    $form->addInput($midimg);
    $addhead = new Typecho_Widget_Helper_Form_Element_Textarea('addhead', NULL, NULL, _t('Head内代码用于网站验证等'), _t('支持HTML'));
    $form->addInput($addhead);
    $tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji', NULL, NULL, _t('统计代码'), _t('支持HTML'));
    $form->addInput($tongji);
    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('<br><span class="themeConfig"><h3>文章置顶</h3></span><div class="info">文章的CID类型为数字</div>置顶文章的cid'), _t('多篇文章以`|`符号隔开'), _t('会在首页列表中置顶文章。'));
    $form->addInput($sticky);  
    $instagramurl = new Typecho_Widget_Helper_Form_Element_Text('instagramurl', NULL, NULL, _t('<br><span class="themeConfig"><h3>个人信息</h3></span><div class="info">不填写相关信息时可以隐藏该信息和图标</div>Instagram'), _t('会在个人信息显示'));
    $form->addInput($instagramurl);
    $telegramurl = new Typecho_Widget_Helper_Form_Element_Text('telegramurl', NULL, 'https://t.me/', _t('电报'), _t('会在个人信息显示'));
    $form->addInput($telegramurl);
    $githuburl = new Typecho_Widget_Helper_Form_Element_Text('githuburl', NULL, 'https://github.com/', _t('GitHub'), _t('会在个人信息显示'));
    $form->addInput($githuburl);
    $twitterurl = new Typecho_Widget_Helper_Form_Element_Text('twitterurl', NULL, NULL, _t('Twitter'), _t('会在个人信息显示'));
    $form->addInput($twitterurl);
    $mastodonurl = new Typecho_Widget_Helper_Form_Element_Text('mastodonurl', NULL, NULL, _t('Mastodon'), _t('会在个人信息显示'));
    $form->addInput($mastodonurl);
    $travel = new Typecho_Widget_Helper_Form_Element_Text('travel', NULL, NULL, _t('<br><span class="themeConfig"><h3>个性化设置</h3></span><div class="info">根据自己的需求进行设置</div>图文分类 Mid'), _t('填写分类的mid'), _t('指定分类ID，用于大图文章列表展示'));
    $form->addInput($travel);
    $memos = new Typecho_Widget_Helper_Form_Element_Text('memos', NULL, NULL, _t('说说分类 Mid'), _t('填写分类的mid'), _t('指定分类ID，用于说说分类展示'));
    $form->addInput($memos);  
    $friendlyTime = new Typecho_Widget_Helper_Form_Element_Radio('friendlyTime', 
        array('0' => _t('否'),
              '1' => _t('是')),
        '0', _t('是否显示友好时间'), _t('默认不显示友好时间，显示标准时间格式'));
    $form->addInput($friendlyTime);
    $loadmore = new Typecho_Widget_Helper_Form_Element_Radio('loadmore',
    array('0'=> _t('加载更多'), '1'=> _t('页码模式')),
    '0', _t('加载文章列表方式'), _t('加载更多将在文章列表底部显示加载更多按钮'));
    $form->addInput($loadmore);
    $showProfile = new Typecho_Widget_Helper_Form_Element_Radio('showProfile',
    array('0'=> _t('否'), '1'=> _t('是')),
    '0', _t('<br><span class="themeConfig"><h3>文章页设置</h3></span><div class="info">文章页面设置</div>是否在文章页面显示作者信息'), _t('选择"是"将在文章页面包含显示作者信息。'));
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
    $cnavatar = new Typecho_Widget_Helper_Form_Element_Text('cnavatar', NULL, NULL , _t('<br><span class="themeConfig"><h3>头像加速设置</h3></span><div class="info">默认https://cravatar.cn/avatar/</div>Gravatar镜像'), _t('默认https://cravatar.cn/avatar/'));
    $form->addInput($cnavatar);

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

 
/**
 * 文章点赞数
 */
function get_post_like($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();

    if (!array_key_exists('likes', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `likes` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }

    $row = $db->fetchRow($db->select('likes')->from('table.contents')->where('cid = ?', $cid));
    echo $row['likes'] ?? 0;
}

// AJAX 处理函数
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['likeup']) && isset($_POST['cid'])) {
    $cid = intval($_POST['cid']);
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();

    // 检查是否已点赞
    if (isset($_COOKIE['extend_contents_likes_' . $cid])) {
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => false,
            'msg' => '您已经点过赞了',
            'likes' => 0
        ));
        exit;
    }

    // 更新点赞数
    $row = $db->fetchRow($db->select('likes')->from('table.contents')->where('cid = ?', $cid));
    $newLikes = ($row['likes'] ?? 0) + 1;
    
    $db->query($db->update('table.contents')
        ->rows(array('likes' => $newLikes))
        ->where('cid = ?', $cid));

    // 设置cookie防止重复点赞(30天有效期)
    setcookie('extend_contents_likes_' . $cid, '1', time() + 2592000, '/');

    // 返回结果
    header('Content-Type: application/json');
    echo json_encode(array(
        'success' => true,
        'msg' => '点赞成功',
        'likes' => $newLikes
    ));
    exit;
}

/** 
 * Gravatar镜像     
 * @package custom
*/
$options = Typecho_Widget::widget('Widget_Options');
$gravatarPrefix = empty($options->cnavatar) ? 'https://cn.cravatar.com/avatar/' : $options->cnavatar;
if (!defined('TYPECHO_GRAVATAR_PREFIX')) {
	define('__TYPECHO_GRAVATAR_PREFIX__', $gravatarPrefix);
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

/**
 * 回复加上@
 * @param int $coid 评论ID
 * @return string
 */
function getPermalinkFromCoid($coid) {
	$db = Typecho_Db::get();
	$row = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
	if (empty($row)) return '';
	return '<a href="#comment-'.$coid.'" style="text-decoration: none;">@'.$row['author'].'</a>';
}

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
    $savePath = __TYPECHO_ROOT_DIR__ . '/usr/cache/covers/' . $filename;
    $webPath = Helper::options()->siteUrl . '/usr/cache/covers/' . $filename;

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
    
    // 计算目标尺寸（5:3比例，最大宽度200px）
    $targetWidth = min(200, $originalWidth);
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
        $savePath = __TYPECHO_ROOT_DIR__ . '/usr/cache/covers/' . $filename;
        $webPath = Helper::options()->siteUrl . '/usr/cache/covers/' . $filename;
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
 * 解析好物表格内容
 * @param string $content
 * @return array|null
 */
function parseGoodsTable($content) {
    if (empty($content)) {
        return null;
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    
    // 添加一个简单的HTML包装，以确保正确解析UTF-8内容
    $wrapped_content = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $content . '</body></html>';
    
    if (!$dom->loadHTML($wrapped_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR)) {
        libxml_clear_errors();
        return null;
    }
    
    $xpath = new DOMXPath($dom);
    $tables = $xpath->query('//table');
    
    if ($tables->length === 0) {
        return null;
    }
    
    $goods = array();
    
    foreach ($tables as $table) {
        $rows = $xpath->query('.//tr', $table);
        
        foreach ($rows as $row) {
            $cells = $xpath->query('.//td', $row);
            
            if ($cells->length >= 4) {
                $item = array(
                    'name' => trim($cells->item(0)->textContent),
                    'price' => trim($cells->item(1)->textContent),
                    'image' => trim($cells->item(2)->textContent),
                    'description' => trim($cells->item(3)->textContent)
                );
                
                // 确保所有必需的字段都不为空
                if (!empty($item['name']) && !empty($item['description']) && 
                    !empty($item['price']) && !empty($item['image'])) {
                    $goods[] = $item;
                }
            }
        }
    }
    
    libxml_clear_errors();
    return !empty($goods) ? $goods : null;
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
 * Typecho后台附件增强：图片预览、批量插入、保留官方删除按钮与逻辑
 * @author 老孙博客
 * @date 2025-04-25
 */
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('AttachmentHelper', 'addEnhancedFeatures');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('AttachmentHelper', 'addEnhancedFeatures');

class AttachmentHelper {
    public static function addEnhancedFeatures() {
        ?>
        <style>
        #file-list{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:15px;padding:15px;list-style:none;margin:0;}
        #file-list li{position:relative;border:1px solid #e0e0e0;border-radius:4px;padding:10px;background:#fff;transition:all 0.3s ease;list-style:none;margin:0;}
        #file-list li:hover{box-shadow:0 2px 8px rgba(0,0,0,0.1);}
        #file-list li.loading{opacity:0.7;pointer-events:none;}
        .att-enhanced-thumb{position:relative;width:100%;height:150px;margin-bottom:8px;background:#f5f5f5;overflow:hidden;border-radius:3px;display:flex;align-items:center;justify-content:center;}
        .att-enhanced-thumb img{width:100%;height:100%;object-fit:contain;display:block;}
        .att-enhanced-thumb .file-icon{display:flex;align-items:center;justify-content:center;width:100%;height:100%;font-size:40px;color:#999;}
        .att-enhanced-finfo{padding:5px 0;}
        .att-enhanced-fname{font-size:13px;margin-bottom:5px;word-break:break-all;color:#333;}
        .att-enhanced-fsize{font-size:12px;color:#999;}
        .att-enhanced-factions{display:flex;justify-content:space-between;align-items:center;margin-top:8px;gap:8px;}
        .att-enhanced-factions button{flex:1;padding:4px 8px;border:none;border-radius:3px;background:#e0e0e0;color:#333;cursor:pointer;font-size:12px;transition:all 0.2s ease;}
        .att-enhanced-factions button:hover{background:#d0d0d0;}
        .att-enhanced-factions .btn-insert{background:#467B96;color:white;}
        .att-enhanced-factions .btn-insert:hover{background:#3c6a81;}
        .att-enhanced-checkbox{position:absolute;top:5px;right:5px;z-index:2;width:18px;height:18px;cursor:pointer;}
        .batch-actions{margin:15px;display:flex;gap:10px;align-items:center;}
        .btn-batch{padding:8px 15px;border-radius:4px;border:none;cursor:pointer;transition:all 0.3s ease;font-size:10px;display:inline-flex;align-items:center;justify-content:center;}
        .btn-batch.primary{background:#467B96;color:white;}
        .btn-batch.primary:hover{background:#3c6a81;}
        .btn-batch.secondary{background:#e0e0e0;color:#333;}
        .btn-batch.secondary:hover{background:#d0d0d0;}
        .upload-progress{position:absolute;bottom:0;left:0;width:100%;height:2px;background:#467B96;transition:width 0.3s ease;}
        </style>
        <script>
        $(document).ready(function() {
            // 批量操作UI按钮
            var $batchActions = $('<div class="batch-actions"></div>')
                .append('<button type="button" class="btn-batch primary" id="batch-insert">批量插入</button>')
                .append('<button type="button" class="btn-batch secondary" id="select-all">全选</button>')
                .append('<button type="button" class="btn-batch secondary" id="unselect-all">取消全选</button>');
            $('#file-list').before($batchActions);

            // 插入格式
            Typecho.insertFileToEditor = function(title, url, isImage) {
                var textarea = $('#text'), 
                    sel = textarea.getSelection(),
                    insertContent = isImage ? '![' + title + '](' + url + ')' : 
                                            '[' + title + '](' + url + ')';
                textarea.replaceSelection(insertContent + '\n');
                textarea.focus();
            };

            // 批量插入
            $('#batch-insert').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var content = '';
                $('#file-list li').each(function() {
                    if ($(this).find('.att-enhanced-checkbox').is(':checked')) {
                        var $li = $(this);
                        var title = $li.find('.att-enhanced-fname').text();
                        var url = $li.data('url');
                        var isImage = $li.data('image') == 1;
                        content += isImage ? '![' + title + '](' + url + ')\n' : '[' + title + '](' + url + ')\n';
                    }
                });
                if (content) {
                    var textarea = $('#text');
                    var pos = textarea.getSelection();
                    var newContent = textarea.val();
                    newContent = newContent.substring(0, pos.start) + content + newContent.substring(pos.end);
                    textarea.val(newContent);
                    textarea.focus();
                }
            });

            $('#select-all').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#file-list .att-enhanced-checkbox').prop('checked', true);
                return false;
            });
            $('#unselect-all').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#file-list .att-enhanced-checkbox').prop('checked', false);
                return false;
            });

            // 防止复选框冒泡
            $(document).on('click', '.att-enhanced-checkbox', function(e) {e.stopPropagation();});

            // 增强文件列表样式，但不破坏li原结构和官方按钮
            function enhanceFileList() {
                $('#file-list li').each(function() {
                    var $li = $(this);
                    if ($li.hasClass('att-enhanced')) return;
                    $li.addClass('att-enhanced');
                    // 只增强，不清空li
                    // 增加批量选择框
                    if ($li.find('.att-enhanced-checkbox').length === 0) {
                        $li.prepend('<input type="checkbox" class="att-enhanced-checkbox" />');
                    }
                    // 增加图片预览（如已有则不重复加）
                    if ($li.find('.att-enhanced-thumb').length === 0) {
                        var url = $li.data('url');
                        var isImage = $li.data('image') == 1;
                        var fileName = $li.find('.insert').text();
                        var $thumbContainer = $('<div class="att-enhanced-thumb"></div>');
                        if (isImage) {
                            var $img = $('<img src="' + url + '" alt="' + fileName + '" />');
                            $img.on('error', function() {
                                $(this).replaceWith('<div class="file-icon">🖼️</div>');
                            });
                            $thumbContainer.append($img);
                        } else {
                            $thumbContainer.append('<div class="file-icon">📄</div>');
                        }
                        // 插到插入按钮之前
                        $li.find('.insert').before($thumbContainer);
                    }

                });
            }

            // 插入按钮事件
            $(document).on('click', '.btn-insert', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $li = $(this).closest('li');
                var title = $li.find('.att-enhanced-fname').text();
                Typecho.insertFileToEditor(title, $li.data('url'), $li.data('image') == 1);
            });

            // 上传完成后增强新项
            var originalUploadComplete = Typecho.uploadComplete;
            Typecho.uploadComplete = function(attachment) {
                setTimeout(function() {
                    enhanceFileList();
                }, 200);
                if (typeof originalUploadComplete === 'function') {
                    originalUploadComplete(attachment);
                }
            };

            // 首次增强
            enhanceFileList();
        });
        </script>
        <?php
    }
}

/**
 * 友好时间显示函数
 * @param int $time 时间戳
 * @param int $threshold 阈值（秒），超过此值则显示标准日期格式（Y-m-d）
 * @return string
 */
function time_ago($time, $threshold = 31536000) { // 31536000秒 = 1年
    $now = time();
    $difference = $now - $time;
    
    // 如果时间差超过阈值（默认1年），则返回标准日期格式（不带时间）
    if ($difference >= $threshold) {
        return date('Y-m-d', $time);
    }
    
    // 1年以内的时间，返回友好格式（如 "3天前"）
    $periods = array("秒", "分钟", "小时", "天", "周", "个月", "年");
    $lengths = array("60", "60", "24", "7", "4.35", "12");
    
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths); $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    return $difference . $periods[$j] . "前";
}

/***
 * 获取站点统计信息（带缓存）
 */
function getSiteStatsWithCache() {
    $cacheFile = __TYPECHO_ROOT_DIR__ . '/usr/cache/site_stats.cache';
    $cacheTime = 3600; // 1小时缓存
    $currentVersion = '1.1'; // 当前版本号

    // 检查缓存
    if (file_exists($cacheFile)) {
        $cacheData = json_decode(file_get_contents($cacheFile), true);
        if ($cacheData && 
            isset($cacheData['cache_time']) && 
            time() - $cacheData['cache_time'] < $cacheTime && 
            isset($cacheData['cache_version']) && 
            $cacheData['cache_version'] === $currentVersion) {
            return $cacheData;
        }
    }

    $db = Typecho_Db::get();
    $stats = [];

    // 1. 总分类数
    $stats['totalCategories'] = $db->fetchObject($db->select('COUNT(*) AS cnt')
        ->from('table.metas')
        ->where('type = ?', 'category'))->cnt;

    // 2. 总标签数
    $stats['totalTags'] = $db->fetchObject($db->select('COUNT(*) AS cnt')
        ->from('table.metas')
        ->where('type = ?', 'tag'))->cnt;

    // 3. 总文章数
    $stats['totalPosts'] = $db->fetchObject($db->select('COUNT(*) AS cnt')
        ->from('table.contents')
        ->where('type = ?', 'post')
        ->where('status = ?', 'publish'))->cnt;

    // 4. 总文章字数
    $stats['totalWords'] = $db->fetchObject($db->select('SUM(LENGTH(text)) AS total')
        ->from('table.contents')
        ->where('type = ?', 'post')
        ->where('status = ?', 'publish'))->total ?: 0;

    // 5. 建站时间
    $oldestPost = $db->fetchObject($db->select('MIN(created) AS created')
        ->from('table.contents')
        ->where('type = ?', 'post')
        ->where('status = ?', 'publish'));

    if ($oldestPost && !empty($oldestPost->created)) {
        $stats['siteCreationDate'] = date('Y-m-d', $oldestPost->created);
        $stats['siteCreateYear'] = date('Y', $oldestPost->created);
        $stats['siteDays'] = ceil((time() - $oldestPost->created) / 86400);
    } else {
        $stats['siteCreationDate'] = 'N/A';
        $stats['siteCreateYear'] = 'N/A';
        $stats['siteDays'] = 0;
    }

    // 6. 友情链接数量
    $stats['totalLinks'] = 0;
    if (class_exists('Links_Plugin')) {
        $stats['totalLinks'] = $db->fetchObject($db->select('COUNT(*) AS cnt')
            ->from('table.links'))->cnt ?: 0;
    }

    // 7. 总留言数量
    $stats['totalComments'] = $db->fetchObject($db->select('COUNT(*) AS cnt')
        ->from('table.comments')
        ->where('status != ?', 'spam'))->cnt;

    // 保存缓存
    $stats['cache_time'] = time();
    $stats['cache_version'] = $currentVersion; // 设置版本号
    if (!is_dir(dirname($cacheFile))) {
        mkdir(dirname($cacheFile), 0755, true);
    }
    if (!file_put_contents($cacheFile, json_encode($stats))) {
        error_log('Failed to write site stats cache to ' . $cacheFile);
    }

    return $stats;
}
/**
 * 自动检查主题更新
 */
function themeAutoUpgradeNotice()
{
    // 1. 定义当前主题版本 (从主题的 info.txt 或 functions.php 中读取)
    // 为了演示，我们直接定义
    $current_version = '0.8.1';

    // 2. 定义 GitHub API 地址
    $api_url = 'https://api.github.com/repos/jkjoy/typecho-theme-farallon/releases/latest';

    // 3. 设置缓存，避免每次请求都调用 API，减轻服务器压力
    // 使用主题目录下的缓存文件，确保有写入权限
    $cache_dir = __TYPECHO_ROOT_DIR__ . '/usr/cache';
    $cache_file = $cache_dir . '/version.json';
    $cache_time = 12 * 3600; // 缓存12小时

    // 确保缓存目录存在
    if (!file_exists($cache_dir)) {
        @mkdir($cache_dir, 0755, true);
    }

    $latest_version = null;
    
    // 检查缓存文件是否存在且未过期
    if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_time) {
        $cache_data = json_decode(file_get_contents($cache_file), true);
        if ($cache_data && isset($cache_data['tag_name'])) {
            $latest_version = $cache_data['tag_name'];
        }
    } else {
        // 缓存过期或不存在，重新请求 API
        $ctx = stream_context_create([
            'http' => [
                'header' => 'User-Agent: Typecho-Theme-Updater', // GitHub API 要求有 User-Agent
                'timeout' => 10 // 设置超时时间
            ]
        ]);
        
        $response = @file_get_contents($api_url, false, $ctx);

        if ($response) {
            $release_data = json_decode($response, true);
            if (isset($release_data['tag_name'])) {
                $latest_version = $release_data['tag_name'];
                // 更新缓存文件
                $result = file_put_contents($cache_file, json_encode(['tag_name' => $latest_version, 'time' => time()]));
                // 如果缓存写入失败，记录错误但不影响显示
                if (!$result) {
                    error_log('Failed to write upgrade cache to ' . $cache_file);
                }
            }
        } else {
            // API请求失败，记录错误
            error_log('Failed to fetch release data from ' . $api_url);
            // 如果有旧缓存，使用旧缓存数据
            if (file_exists($cache_file)) {
                $cache_data = json_decode(file_get_contents($cache_file), true);
                if ($cache_data && isset($cache_data['tag_name'])) {
                    $latest_version = $cache_data['tag_name'];
                }
            }
        }
    }
    // 4. 如果获取到了最新版本，则进行比较
    if ($latest_version && version_compare($current_version, $latest_version, '<')) {
        
        $notice_html = '
        <span class="themeConfig"><h3>主题更新</h3>
            <div class="info">发现新版本 ' . $latest_version . '，您当前使用的是 ' . $current_version . '。建议立即更新以获得最新功能和安全性修复。
                <a href="https://github.com/jkjoy/typecho-theme-farallon/releases/latest" target="_blank">查看更新</a>
                <a href="https://github.com/jkjoy/typecho-theme-farallon/releases" target="_blank">立即下载</a>
            </div>';
        echo $notice_html;
    }
}

/**
 * 将提示函数挂载到后台页面的底部钩子
 */
// 只有在Typecho环境中才注册钩子
if (class_exists('Typecho_Plugin')) {
    // 在主题列表页面显示更新提示
    Typecho_Plugin::factory('admin/themes.php')->bottom = function() {
        try {
            themeAutoUpgradeNotice();
        } catch (Exception $e) {
            error_log('Theme update check error: ' . $e->getMessage());
        }
    };
    
    // 在主题设置页面也显示
    Typecho_Plugin::factory('admin/footer.php')->execute = function() {
        try {
            // 检查是否在主题设置页面
            $request = Typecho_Request::getInstance();
            $screen = $request->getScreen();
            
            if ($screen && (strpos($screen, 'theme') !== false || strpos($screen, 'options-theme') !== false)) {
                themeAutoUpgradeNotice();
            }
        } catch (Exception $e) {
            error_log('Theme update check error: ' . $e->getMessage());
        }
    };
}
