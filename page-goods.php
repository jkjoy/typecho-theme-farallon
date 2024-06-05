<?php 
/**
 * 好物页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="site--main site--main__gears">
    <h1 class="post--single__title"><?php $this->title() ?></h1>
    <h2 class="post--single__subtitle"><?php $this->content(); ?></h2>
<div class="good--list">
<div id=goods></div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    memoGoods();
});
function memoGoods(e) {
    let t = e || 12;
    var n = "https://memos.imsun.org",
        s = n + "/api/v1/memo?creatorId=1&limit=" + t + "&tag=好物";
    let i = 1;
    const o = /\n/;
    fetch(s).then(e => e.json()).then(e => {
        let c = "";
        for (var t, s, i, a, d, u, h, m, r = 0; r < e.length; r++) {
            a = e[r].content.replace(`#好物 \n`, ""),
            t = a.split(o),
            i = t[0].replace(/!\[.*?\]\((.*?)\)/g, "$1"), // 图片链接
            s = t[0].replace(/!\[(.*?)\]\(.*?\)/g, "$1"), 
            d = s.split(",")[0], // 商品名称
            u = s.split(",")[1], // 价格
            h = t[1].replace(/\[.*?\]\((.*?)\)/g, "$1"), // 商品链接
            m = t[1].replace(/\[(.*?)\]\(.*?\)/g, "$1"), // 推荐理由
            c += 
            '<div class="good--item"><div class="img-spacer"><a href="'
            + h + 
            '" target="_blank"><img src="' 
            + i + 
            '"></a></div><div class="good--name"><div class="brand">' 
            + d + '<br>' + u + 
            '</div>' 
            + m + 
            '</div></div>';
        }
        let f = document.querySelector("#goods");
        f.innerHTML = c;
    });
}
</script>
<?php $this->need('footer.php'); ?>
 
