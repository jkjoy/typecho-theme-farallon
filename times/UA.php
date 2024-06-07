<?php
class UA{
    public $ua;
    public function __construct($ua = '')
    {
        $this->ua = $ua;
    }
    public function returnBrowser(){
        $ua = $this->ua;
        if(preg_match('/rv:(11.0)/i', $ua, $matches)){
            $title = 'Internet Explorer '. $matches[1];
            $icon = 'fa fa-internet-explorer';//ie11
        }elseif (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Internet Explorer '. $matches[1];

            if ( strpos($matches[1], '7') !== false || strpos($matches[1], '8') !== false)
                $icon = 'fa fa-internet-explorer';//ie8
            elseif ( strpos($matches[1], '9') !== false)
                $icon = 'fa fa-internet-explorer';//ie9
            elseif ( strpos($matches[1], '10') !== false)
                $icon = 'fa fa-internet-explorer';//ie10
        }elseif (preg_match('#Edge/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Edge '. $matches[1];
            $icon = 'fa fa-edge';
        }elseif (preg_match('#TheWorld ([a-zA-Z0-9.]+)#i', $ua, $matches)){
            $title = 'TheWorld(世界之窗) '. $matches[1];
            $icon = 'iconfont icon-theworld';
        }elseif (preg_match('#JuziBrowser#i', $ua, $matches)){
            $title = 'Juzi(桔子) '.$matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#KBrowser#i', $ua, $matches)){
            $title = 'KBrowser(超快) '.$matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#MyIE#i', $ua, $matches)){
            $title = 'MyIE(蚂蚁) '.$matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)){
            $title = 'Firefox '. $matches[1];
            $icon = 'fa fa-firefox';
        }elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)){
            $title = 'Chrome for iOS '. $matches[1];
            $icon = 'fa fa-chrome';
        } elseif (preg_match('#LBBROWSER#i', $ua, $matches)) {
            $title = '猎豹';
            $icon = 'iconfont icon-liebaoliulanqi';
        }elseif (preg_match('#Opera.(.*)Version[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Opera '. $matches[2];
            $icon = 'fa fa-opera';
            if (preg_match('#opera mini#i', $ua))
                $title = 'Opera Mini '. $matches[2];
        }elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua,$matches)) {
            $title = 'Maxthon(遨游) '. $matches[2];
            $icon = 'iconfont icon-liulanqi-aoyou';
        }elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '360 Browser '. $matches[1];
            $icon = 'iconfont icon-liulanqi-jisu';
        }elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'SouGou Browser 2 '.$matches[1];
            $icon = 'iconfont icon-liulanqi-sougou';
        }elseif (preg_match('#QQBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'QQBrowser '.$matches[1];
            $icon = 'iconfont icon-QQliulanqi';
            if (preg_match('#Mobile MQQBrowser/([a-zA-Z0-9.]+)#i', $ua,$matches)) {
                $title = 'Mobile MQQBrowser '. $matches[1];
                $icon = 'fa fa-qq';
            }elseif (preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua,$matches)) {
                $title = 'Wechat Browser '. $matches[1];
                $icon = 'weixin';
            }
        }elseif (preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'QQ '.$matches[1];
            $icon = 'fa fa-qq';
        }elseif (preg_match('#YYE/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'YYE '.$matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#115Browser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '115 '.$matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#37abc/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '37abc '.$matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#TheWorld ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '世界之窗 '.$matches[1];
            $icon = 'iconfont icon-theworld';
        }elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'UCWEB '. $matches[1];
            $icon = 'icon-win8 icon-ucliulanqi';
        }elseif (preg_match('#UBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'UBrowser '. $matches[1];
            $icon = 'iconfont icon-ucliulanqi';
        }elseif (preg_match('#Quark/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Quark '. $matches[1];
            $icon = 'iconfont icon-ucliulanqi';	//
        }elseif (preg_match('#2345Explorer/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '2345Explorer '. $matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('#XiaoMi/MiuiBrowser/([0-9.]+)#i', $ua, $matches)) {
            $title = '小米 '. $matches[1];
            $icon = 'iconfont icon-xiaomi';
        }elseif (preg_match('/WeiBo/i', $ua, $matches)) {
            $title = '微博 '. $matches[1];
            $icon = 'iconfont icon-weibo';
        }elseif (preg_match('/BIDU/i', $ua, $matches)) {
            $title = '百度 '. $matches[1];
            $icon = 'iconfont icon-setting';
        }elseif (preg_match('/mailapp/i', $ua, $matches)) {
            $title = 'EmailApp '. $matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('/Sleipnir/i', $ua, $matches)) {
            $title = '神马 '. $matches[1];
            $icon = 'iconfont icon-weibiaoti--';
        }elseif (preg_match('/MZBrowser/i', $ua, $matches)) {
            $title = '魅族 '. $matches[1];
            $icon = 'iconfont icon-meizu';
        }elseif (preg_match('/VivoBrowser/i', $ua, $matches)) {
            $title = 'Vivo '. $matches[1];
            $icon = 'iconfont icon-VIVO';
        }elseif (preg_match('/mixia/i', $ua, $matches)) {
            $title = '米侠 '. $matches[1];
            $icon = 'fa fa-globe';
        }elseif (preg_match('/CoolMarket/i', $ua, $matches)) {
            $title = '酷安 '. $matches[1];
            $icon = 'iconfont icon-coolapk';
        }elseif (preg_match('/YaBrowser/i', $ua, $matches)) {
            $title = 'Yandex '. $matches[1];
            $icon = 'iconfont icon-yandex';
        }elseif (preg_match('/Kraitnabo\/([^\s|;]+)/i', $ua, $matches)) {
            $title = '南博 '. $matches[1];
            $icon = 'anzhuo';
        }elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Google Chrome '. $matches[1];
            $icon = 'fa fa-chrome';
            if (preg_match('#OPR/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
                $title = 'Opera '. $matches[1];
                $icon = 'fa fa-opera';
            }
        }elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Safari '. $matches[1];
            $icon = 'fa fa-safari';
        }
        return array("title"=>$title,
            "icon"=>$icon);
    }
    public function returnOS(){
        $ua = $this->ua;
        $title = "未知浏览器";
        $icon = "";
        if (preg_match('/win/i', $ua)) {
            if (preg_match('/Windows NT 6.1/i', $ua)) {
                $title = "Windows 7";
                $icon = "iconfont icon-win";
            }elseif (preg_match('/Windows 98/i', $ua)) {
                $title = "Windows 98";
                $icon = "iconfont icon-win2";
            }elseif (preg_match('/Windows NT 5.0/i', $ua)) {
                $title = "Windows 2000";
                $icon = "iconfont icon-win2";
            }elseif (preg_match('/Windows NT 5.1/i', $ua)) {
                $title = "Windows XP";
                $icon = "iconfont icon-win";
            }elseif (preg_match('/Windows NT 5.2/i', $ua)) {
                if (preg_match('/Win64/i', $ua)) {
                    $title = "Windows XP 64 bit";
                } else {
                    $title = "Windows Server 2003";
                }
                $icon = 'iconfont icon-win';
            }elseif (preg_match('/Windows NT 6.0/i', $ua)) {
                $title = "Windows Vista";
                $icon = "fa fa-windows";
            }elseif (preg_match('/Windows NT 6.2/i', $ua)) {
                $title = "Windows 8";
                $icon = "iconfont icon-win8";
            }elseif (preg_match('/Windows NT 6.3/i', $ua)) {
                $title = "Windows 8.1";
                $icon = "iconfont icon-win8";
            }elseif (preg_match('/Windows NT 10.0/i', $ua)) {
                $title = "Windows 10";
                $icon = "iconfont icon-win3";
            }elseif (preg_match('/Windows Phone/i', $ua)) {
                $matches = explode(';',$ua);
                $title = $matches[2];
                $icon = "iconfont icon-winphone";
            }
        } elseif (preg_match('#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
            $title = "iPod ";//.$matches[1]
            $icon = "iconfont icon-ipod";
        } elseif (preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) {
            $title = "Iphone ";//.$matches[1]
            $icon = "iconfont icon-iphone";
        } elseif (preg_match('/iPad; CPU OS ([_0-9]+)/i', $ua, $matches)) {
            $title = "iPad ";//.$matches[1]
            $icon = "iconfont icon-ipad";
        } elseif (preg_match('/Mac OS X ([0-9_]+)/i', $ua, $matches)) {
            if(count(explode(7,$matches[1]))>1) $matches[1] = 'Lion '.$matches[1];
            elseif(count(explode(8,$matches[1]))>1) $matches[1] = 'Mountain Lion '.$matches[1];
            $title = "Mac OSX";
            $icon = "iconfont icon-macosdeicon";
        } elseif (preg_match('/Macintosh/i', $ua)) {
            $title = "Mac OS";
            $icon = "iconfont icon-iconmacos";
        } elseif (preg_match('/CrOS/i', $ua)){
            $title = "Google Chrome OS";
            $icon = "iconfont icon-iconchromeos";
        } elseif (preg_match('/Linux/i', $ua)) {
            $title = 'Linux';
            $icon = 'fa fa-linux';
            if (preg_match('/Ubuntu/i', $ua)) {
                $title = "Ubuntu Linux";
                $icon = "iconfont icon-ubuntu";
            }elseif(preg_match('#Debian#i', $ua)) {
                $title = "Debian GNU/Linux";
                $icon = "iconfont icon-debian";
            }elseif (preg_match('#Fedora#i', $ua)) {
                $title = "Fedora Linux";
                $icon = "iconfont icon-fedora";
            }elseif (preg_match('/Kraitnabo\/([^\s|;]+)/i', $ua, $matches)) {
            $title = '南博app '. $matches[1];
            $icon = 'anzhuo';
            }elseif (preg_match('/Android.([0-9. _]+)/i',$ua, $matches)) {
                $title= "Android";
                $icon = "iconfont icon-android";
            }
        } elseif (preg_match('/Android.([0-9. _]+)/i',$ua, $matches)) {
            $title= "Android";
            $icon = "iconfont icon-android";
        }
        return array("title"=>$title,
            "icon"=>$icon);
    }
    /**
     * 时光机页面ua，如果是手机设备，只显示设备类型，如果是电脑设备只显示电脑设备类型，如果是扩展发送，显示发送自「扩展」，如果是微信公众号，显示
     */
    public function returnTimeUa(){
        if ($this->ua == "weixin" || $this->ua == "weChat"){
            return array("title"=>("微信公众号"),
                "icon"=>"weixin");
        }elseif ($this->ua == "crx"){
            return array("title"=>("Chrome扩展"),
                "icon"=>"liulanqi");
        }elseif ($this->ua == "yearcross"){
            return array("title"=>("YearCross"),
                "icon"=>"QQ");
        }elseif ($this->ua == "Kraitnabo"){
            return array("title"=>("南博app"),
                "icon"=>"anzhuo");
        }elseif ($this->ua == "python"){
            return array("title"=>("python脚本"),
                "icon"=>"python");
        }else{
            $ua = $this->returnOS();
            $ua["icon"] = "anzhuo";
            return $ua;
        }
    }
}