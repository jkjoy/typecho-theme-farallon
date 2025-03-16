
## 说明

移植自 `bigfa `大大的 `hugo-theme-farallon` 

## 更新日志 & 预览

https://www.imsun.org/archives/1640.html

## 功能

### 观影

- 更新豆瓣API获取方式

[Docker 自动同步豆瓣书影音记录](https://fatesinger.com/103483)

在新建页面选择`豆瓣`, 在自定义字段设置`douban`值为API地址. (默认为`https://db.imsun.org`)

- neodb 方式获取

参照[使用 NeoDB API 构建观影页面](https://www.imsun.org/archives/1688.html)

在新建页面选择`NEODB页面`, 在自定义字段设置`neodb`值为API地址. (默认为`https://neodb.imsun.org`)

### 友情链接

基于 `links` 插件实现

可使用 `寒泥` 大佬制作的版本或者其他版本

### 首页摘要

若使用AI摘要插件则显示AI摘要,不使用则显示默认字数摘要

### 说说 by Memos

使用自定义字段设置memos

在自定义字段中填入`memos`值为memos地址,结尾不带`/`

在自定义字段中填入`memosID`默认值为`1`,不为`1`时需要设置

在自定义字段中填入`memosnum`默认值为`20`,默认获取20条最近的memo

### 说说 by Mastodon

根据 [如何获得Access Tokens](https://www.imsun.org/archives/1643.html)
获得API地址

在自定义字段中填入`tooot`值为Mastodon API 地址

### 好物 by memos

~~在自定义字段中填入`memos`值为memos地址~~
~~在自定义字段中填入`memosID`默认值为`1`,不为`1`时才需要设置~~
~~在自定义字段中填入`memostag`默认值为`好物`,不为`好物`时才需要设置~~
~~memos的写法可以参照~~
在自定义页面选择`好物页面`
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