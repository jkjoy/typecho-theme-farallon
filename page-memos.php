<?php 
/**
 * 说说页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />    
    <div id="talk"></div>
<style>
div pre code {
  /* 迫使文字断行 */
  white-space: pre-wrap; /* CSS3 */
  
  /* 当文字超出容器宽度时会断行 */
  word-wrap: break-word; /* 老版本的浏览器 */
  overflow-wrap: break-word; /* CSS3, 推荐使用 */
  
  /* 指定如何断行 */
  word-break: break-all;     /* 对于非中文字母（如拉丁字母或半角符号等）也同样断行 */
  word-break: break-word;    /* 保留对于英文单词的完整，为个别单词断行 */
}
</style>
<script>
if (99) {
    let url = '<?php $this->options->memos() ?>';
    fetch(url + '/api/v1/memo?creatorId=<?php $this->options->memosID() ?>&rowStatus=NORMAL&limit=20')
    .then(res => res.json())
    .then(data => { 
        let html = '';
        data.forEach(item => {
            // 假设这里的 Format 函数能正确地格式化每个 item，并确保它返回有 `date` 和 `tag` 的对象
            let data = Format(item); 
            let memoURL = url + '/m/' + item.id;
            let mdContent = marked.parse(data.content);
            html += `
            <article class='post--item post--item__status'>
                <div class='content'>
                <header>
                <img src="<?php $this->options->logoUrl() ?>" class="avatar" width="48" height="48" />
                <a class="humane--time" href="${memoURL}" target="_blank">${data.date}</a>
                </header>
                <div class="description mdContent" itemprop="about">
                <span class="talk_tag"># ${data.tag}</span><br>
                ${mdContent}
                </div>
                </div>
                </article>
            `;
        });
        
        document.getElementById('talk').innerHTML = html;
    })
    .catch(error => {
        console.error('Error:', error);
        // 这里可以添加一些用户提示错误发生的 HTML 更新
    });
 
    // 页面内容格式化
    function Format(item) {
        let date = getTime(new Date(item.createdTs * 1000).toString()),
            content = item.content,
            tag = item.content.match(/#([^\s#]+?) /g),
            imgs = content.match(/!\[.*\]\(.*?\)/g), 
            text = ''
        if (imgs) imgs = imgs.map(item => { return item.replace(/!\[.*\]\((.*?)\)/, '$1') })
        if (item.resourceList.length) {
            if (!imgs) imgs = []
            item.resourceList.forEach(t => {
                if (t.externalLink) imgs.push(t.externalLink)
                else imgs.push(`${url}/o/r/${t.id}/${t.publicId}/${t.filename}`)
            })
        }
        text = content.replace(/#(.*?)\s/g, '').replace(/\!?\[(.*?)\]\((.*?)\)/g, '').replace(/\{(.*?)\}/g, '')
        content = text.replace(/\[(.*?)\]\((.*?)\)/g, `<a href="$2" target="_blank">$1</a>`);
        if (imgs) {
            content += `<div class="resimg">`
            imgs.forEach(e => content += `<a href="${e}" data-fancybox="gallery" class="fancybox img" data-thumb="${e}"><img class="no-lazyload thumbnail-image" src="${e}"></a>`
            )
            content += '</div>'
        }
        return {
            content: content,
            tag: tag ? tag[0].replace(/#([^\s#]+?) /,'$1') : '日常',
            date: date,
            text: text.replace(/\[(.*?)\]\((.*?)\)/g, '[链接]' + `${imgs?'[图片]':''}`)
        }
    }
    // 页面时间格式化
    function getTime(time) {
        let d = new Date(time),
            ls = [d.getFullYear(), d.getMonth() + 1, d.getDate(), d.getHours(), d.getMinutes(), d.getSeconds()];
        for (let i = 0; i < ls.length; i++) {
            ls[i] = ls[i] <= 9 ? '0' + ls[i] : ls[i] + ''
        }
        if (new Date().getFullYear() == ls[0]) return ls[1] + '月' + ls[2] + '日 ' + ls[3] +':'+ ls[4]
        else return ls[0] + '年' + ls[1] + '月' + ls[2] + '日 ' + ls[3] +':'+ ls[4]
    }
}
Fancybox.bind("[data-fancybox]", {
  // Your custom options
});
</script>
<style>
.thumbnail-image {
    width:100%;
    height: 200px;  
    align-items: center; 
    justify-content: center;
    overflow: hidden;
}
.resimg {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 10px; 
    row-gap: 10px; 
}
.thumbnail-image img {
    width:100%;
    height:170px;
    object-fit:cover;
    border-radius:4px;
    transition:transform .3s ease;
    cursor:zoom-in
}  
/* 当屏幕宽度小于732px时 */
@media (max-width: 732px) {
    .resimg {
        grid-template-columns: repeat(2, 1fr); /* 修改为两列 */
    }
}

/* 当屏幕宽度小于400px时 */
@media (max-width: 400px) {
    .resimg {
        grid-template-columns: 1fr; /* 修改为一列 */
    }
}  
</style>  
</div>
<?php $this->need('footer.php'); ?>