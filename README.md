
## 说明

移植自 `bigfa `大大的 `hugo-theme-farallon` 主题,并在此基础上进行了一些修改.
由于是自用,有很多主观上的修改,可能不适合所有人.


## 更新日志 & 预览

### 0.7.1

- 调整了赞赏的样式,同时填写支付宝和微信收款码的图片地址即可显示
- 调整文章列表的加载方式
- 调整了文件的结构

### 0.7.0

根据原版更新,修复了一些问题,并添加了一些功能

- 增加了文章列表的加载方式选择
- 增加了足迹分类的显示
- 增加了说说页面的显示
- 增加了编辑页面的自定义字段的说明

- 调整了文件夹的结构
- 调整了一些样式

- 移除了评论功能对links插件的关联,避免出现错误
- 移除了一些不必要的文件
- 移除了评论QQ通知的功能


 后续会继续更新


- 可能会删除Memos说说的功能,因为memos的API不稳定
- 逐渐移除依靠API实现的功能



[预览](https://www.imsun.org/)

https://www.imsun.org/archives/1640.html

## 功能

### 封面

优先使用自定义字段`cover`的值作为封面,若没有则使用文章内的第一张图片作为封面

### 摘要

优先使用自定义字段`summary`的值作为摘要,若没有则显示默认字数摘要

### 观影

- 更新豆瓣API获取方式

[Docker 自动同步豆瓣书影音记录](https://fatesinger.com/103483)

在新建页面选择模板`豆瓣页面`, 在自定义字段设置`douban`值为API地址. (默认为`https://db.imsun.org`)

- neodb 方式获取

参照[使用 NeoDB API 构建观影页面](https://www.imsun.org/archives/1688.html)

在新建页面选择模板`NEODB页面`, 在自定义字段设置`neodb`值为API地址. (默认为`https://neodb.imsun.org`)

### 友情链接

本功能基于 `links` 插件实现,必须安装 `links` 插件才能使用.
否则报错`Class "Links_Plugin" not found`

*可使用 `寒泥` 大佬制作的版本或者其他版本*

### 说说 by Memos

基于`memos`的API获取,注意该功能要求`memos`的版本为 v0.18.0

自定义页面使用模板`说说页面 by memos`在自定义字段设置 

- `memos`值为memos地址,结尾不带`/`

- `memosID`默认值为`1`,不为`1`时需要设置

- `memosnum`默认值为`20`,默认获取20条最近的memo

### 说说 by Mastodon

兼容`Mastodon`,`Pleroma`,`GotoSocial`的API.

根据 [如何获得Access Tokens](https://www.imsun.org/archives/1643.html)
获得API地址

在自定义字段中填入`tooot`值为 Mastodon API 地址

### 好物页面

~~在自定义字段中填入`memos`值为memos地址~~
~~在自定义字段中填入`memosID`默认值为`1`,不为`1`时才需要设置~~
~~在自定义字段中填入`memostag`默认值为`好物`,不为`好物`时才需要设置~~
~~memos的写法可以参照~~

在自定义页面选择模板`好物页面`

在编辑器中使用表格的方式进行书写,以下为示例
```markdown
| 图片链接 | 商品名称 | 价格 | 商品链接 | 推荐理由 |
|---------|---------|------|----------|----------|
| https://example.com/image1.jpg | 商品A | ¥99 | https://example.com/product1 | 这是一个很好的产品 |
| https://example.com/image2.jpg | 商品B | ¥199 | https://example.com/product2 | 非常推荐购买 |
```


## 版权

使用本主题请保留原作者的版权信息 谢谢合作

## 感谢

[bigfa](https://github.com/bigfa/hugo-theme-farallon)