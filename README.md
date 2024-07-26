## 说明

移植自 `bigfa `大大的 `hugo-theme-farallon` 原汁原味,可以直接使用 原主题的CSS 
精简部分 JS.

- 2024.7.24
增加短代码`[article url="https://your-site.com/your-article-url"]`或者`[article id="123"]`的方式获取文章
增加置顶文章的功能,样式来自于wordpress版本


- 2024.7.4
把分类图片以`mid`.jpg 的形式在主题`/dist/img`目录下,自动匹配

- 2024.6.12

更新豆瓣API获取方式
[Docker 自动同步豆瓣书影音记录](https://fatesinger.com/103483)
主题设置处填入API

- ~~2024.6.7~~

~~用自带评论做的说说页面,来自~~
https://github.com/gogobody/typecho-whisper
~~删减部分内容只能发表文字~~

- 2024.6.5 v0.5.3

新增了好物的页面 还是通过memos来获取

- 2024.6.4 v0.5.1

更改了设置memos的方式
新增了Mastodon 的 说说 页面

- 2024.6.3 v0.5.0

还是抄了原版的豆瓣获取方式

- 2024.5.26 v0.4.1

抄了个网站统计页面

- 2024.5.24

新增了说说页面,基于memos 0.19 以下的版本
在后台设置memos的地址和memoID即可
默认获取最近20条公开的memo


## 原项目地址
https://github.com/bigfa/hugo-theme-farallon


## 功能

### 豆瓣观影

  更新 获取方式

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
## 预览地址

https://www.imsun.org

## 感谢

[bigfa](https://github.com/bigfa/hugo-theme-farallon)