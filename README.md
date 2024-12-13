
## 说明

移植自 `bigfa `大大的 `hugo-theme-farallon` 

## 更新日志 & 预览

https://www.imsun.org/archives/1640.html

## 功能

### 豆瓣观影

更新豆瓣API获取方式

[Docker 自动同步豆瓣书影音记录](https://fatesinger.com/103483)

在新建页面选择`豆瓣`, 在自定义字段设置`douban`值为API地址. (默认为`https://db.imsun.org`)

### 友情链接

基于 `links` 插件实现

可使用 `寒泥` 大佬制作的版本或者其他版本

### 首页摘要

若使用AI摘要插件则显示AI摘要,不使用则显示默认字数摘要

### 说说 by Memos

使用自定义字段设置memos

在自定义字段中填入`memos`值为memos地址,不带`/`

在自定义字段中填入`memosID`默认值为`1`,不为`1`时才需要设置

在自定义字段中填入`memosnum`默认值为`20`,默认获取20条最近的memo

### 说说 by Mastodon

根据 https://www.imsun.org/archives/1643.html
获得API地址

在自定义字段中填入`tooot`值为Mastodon API 地址

### 好物 by memos

在自定义字段中填入`memos`值为memos地址
在自定义字段中填入`memosID`默认值为`1`,不为`1`时才需要设置
在自定义字段中填入`memostag`默认值为`好物`,不为`好物`时才需要设置

memos的写法可以参照

## 版权

使用本主题请保留原作者的版权信息 谢谢合作

## 感谢

[bigfa](https://github.com/bigfa/hugo-theme-farallon)