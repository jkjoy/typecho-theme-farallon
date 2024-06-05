<?php 
/**
 * 好物页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="site--main site--main__gears">
<header class="archive--header">
    <h1 class="post--single__title"><?php $this->title() ?></h1>
    <h2 class="post--single__subtitle"><?php $this->content(); ?></h2>
</header>
<div id=goods class="good--list"></div>
</div>
<style>
.img40 {
  height: 137px;
  width: auto;
}    
</style>
<?php
        // 检查是否存在自定义字段 'memos' 和 'memosID'
        $memos = $this->fields->memos ? $this->fields->memos : 'https://memos.imsun.org';
        $memosID = $this->fields->memosID ? $this->fields->memosID : '1';
        $memostag = $this->fields->memostag ? $this->fields->memostag : '好物';
        ?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    memoGoods();
});
function memoGoods(e) {
    let t = e || 12;
    var n = "<?php echo $memos; ?>",
        s = n + "/api/v1/memo?creatorId=<?php echo $memosID; ?>&limit=" + t + "&tag=<?php echo $memostag; ?>";
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
            '" class="img40"></a></div><div class="good--name"><div class="brand">' 
            + d + '·' + m +'</div>' 
            + u + 
            '</div></div>';
        }
        let f = document.querySelector("#goods");
        f.innerHTML = c;
    });
}
</script>
<?php $this->need('footer.php'); ?>