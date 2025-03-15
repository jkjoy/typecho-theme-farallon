<?php 
/**
 * 说说页面 - memos
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?> </h2>
    </header>
    <?php
        // 检查是否存在自定义字段 'memos' 和 'memosID'
        $memos = $this->fields->memos ? $this->fields->memos : 'https://memos.imsun.org';
        $memosID = $this->fields->memosID ? $this->fields->memosID : '1';
        $memosnum = $this->fields->memosnum ? $this->fields->memosnum : '20';
        ?>
    <article class="post--single">
    <script src="<?php $this->options->themeUrl('/dist/js/marked.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/dist/css/lightbox.min.css'); ?>">
    <script src="<?php $this->options->themeUrl('/dist/js/lightbox-plus-jquery.min.js'); ?>"></script>
    <div id="talk"></div>
    <div class="nav-links" id="loadmore">
        <span class="loadmore">加载更多</span>
    </div>
    </article> 
<script>
let currentPage = 1; // 当前页码
const limit = 10; // 每页条数
let url = '<?php echo $memos; ?>';
let memosID = '<?php echo $memosID; ?>';
let memosnum = '<?php echo $memosnum; ?>';

function loadMemos(page) {
    fetch(`${url}/api/v1/memo?creatorId=${memosID}&rowStatus=NORMAL&limit=${limit}&offset=${(page - 1) * limit}`)
    .then(res => res.json())
    .then(data => { 
        let html = '';
        data.forEach(item => {
            let data = Format(item); 
            let memoURL = url + '/m/' + item.id;
            let mdContent = marked.parse(data.content);
            html += `
            <article class='post--item post--item__status'>
                <div class='content'>
                <header>
                <img src="<?php $this->options->logoUrl() ?>" class="avatar" width="48" height="48" no-view />
                <a class="humane--time" href="${memoURL}" target="_blank">${data.date}</a>
                </header>
                <div class="description" itemprop="about">
                ${mdContent}
                <span class="tag--list"><a>${data.tag}</a></span>
                </div>
                </div>
                </article>
            `;
        });
        document.getElementById('talk').innerHTML += html;
    })
    .catch(error => {
        console.error('Error:', error);
        // 这里可以添加一些用户提示错误发生的 HTML 更新
    });
}

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
        imgs.forEach(e => content += `<a href="${e}"  class="img" data-thumb="${e}" data-lightbox="images"><img class="no-lazyload thumbnail-image" src="${e}"></a>`
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

// 初始加载第一页
loadMemos(currentPage);

// 点击“加载更多”按钮时加载下一页
document.getElementById('loadmore').addEventListener('click', function() {
    currentPage++;
    loadMemos(currentPage);
});

</script>
<style> 
div pre code {
  /* 迫使文字断行 */
  white-space: pre-wrap; /* CSS3 */
  word-wrap: break-word; /* 老版本的浏览器 */
  overflow-wrap: break-word;  
  /* 指定如何断行 */
  word-break: break-all;  
  word-break: break-word;  
}
div p a {
  word-break: break-all;  
  word-break: break-word;  
}
.thumbnail-image {
    width:100%;
    height: 200px;  
    align-items: center; 
    justify-content: center;
    overflow: hidden;
    border-radius:4px;
    transition:transform .3s ease;
    cursor:zoom-in;
}
.resimg {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 10px; 
    row-gap: 10px; 
}
.thumbnail-image img {
    width:100%;
    min-height: 200px;
    object-fit:cover;
} 
img {
    object-fit: cover; /* 保持图片的纵横比，但会将图片裁剪以填充容器 */
    object-position: center; /* 保证中央部分 */
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
.load-more-btn {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
  }
.load-more-btn:hover {
      background-color: #0056b3;
  } 
.nav-links .loadmore {
    border: 1px solid var(--farallon-border-color);
    cursor: pointer;
    position: relative;
    padding: 5px 30px;
    border-radius: 8px;
    font-size: 14px;
    color: var(--farallon-text-gray)
}

.nav-links .loadmore:hover {
    border-color: var(--farallon-hover-color);
    color: var(--farallon-hover-color)
}   
</style>  
</div>
<?php $this->need('footer.php'); ?>
