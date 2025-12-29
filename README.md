
## 说明

移植自`hugo-theme-farallon` 主题,并在此基础上进行了一些修改.
由于是自用,有很多主观上的修改,可能不适合所有人.


## 预览

![预览图](/screenshots.png)

[Demo](https://blog.imsun.org/)

可去我的博客反馈 <a href="https://www.imsun.org/archives/1640.html" target="_blank">https://www.imsun.org/archives/1640.html</a>

## 功能

### 封面

优先使用自定义字段`cover`的值作为封面,若没有则使用文章内的第一张图片作为封面
开启php拓展`gd`可自动裁剪封面图片,否则使用原图
需要`usr`文件夹的写权限

### 友情链接

本功能基于 `links` 插件实现,必须安装 `links` 插件才能使用.
否则报错`Class "Links_Plugin" not found`

*可使用 `寒泥` 大佬制作的版本或者其他版本*

### 好物页面

在自定义页面选择模板`好物页面`

在编辑器中使用表格的方式进行书写,以下为示例
```markdown
| 商品名称 | 类别 |  图片链接 | 产品介绍 |
|---------|---------|------|----------|
| 商品A | 电子产品 | https://cdn.wanne.cn/ali.png| 这是一个很好的产品 |
| 商品B | 家居用品 | https://cdn.wanne.cn/wx.png | 非常推荐购买 |
```


## 版权

使用本主题请保留原作者的版权信息 谢谢合作

## 感谢

[bigfa](https://github.com/bigfa/hugo-theme-farallon)