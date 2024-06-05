<?php
/**
 * 网站数据
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle"><?php $this->content(); ?> </h2>
    </header>
    <article class="post--single">
    <div class="graph u-marginBottom30">
        <div data-target="<?php $this->options->postLinkOpen(); ?>" class="post-content">
            <h2>分类占比</h2>
                <p>下面是个分类的文章占比：</p>
            <div id="category-chart" style="height: 390px;"></div>      
            <h2>文章更新</h2>
            <p>下面是 <?php echo date('Y年m月d日', time() - 20736000); ?> 到 <?php echo date('Y年m月d日', time()); ?> 的文章更新情况</p>
            <div id="post-chart" style="height: 250px;"></div> 
            <h2>评论动态</h2>
            <p>下面是 <?php echo date('Y年m月d日', time() - 20736000); ?> 到 <?php echo date('Y年m月d日', time()); ?> 的评论动态</p>
            <div id="comment-chart" style="height: 250px;"></div>     
            <h2>最多阅读的文章</h2>
            <?php $top5Post = top5post(); ?>
            <p>下面是阅读量排名前 <?php echo count($top5Post); ?> 的文章</p>
            <table class="pure-table pure-table-bordered">
                <thead>
                    <tr>
                        <th>排名</th>
                        <th>文章</th>
                        <th>阅读量</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $top = 1; ?>
                    <?php foreach ($top5Post as $post): ?>
                    <tr>
                        <td><?php echo $top; ?></td>
                        <td><a href="<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a></td>
                        <td><?php echo $post['views']; ?></td>
                    </tr>
                    <?php $top ++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2>最多评论的文章</h2>  
                        <?php $top5CommentPost = top5CommentPost(); ?>
                        <p>下面是评论数排名前 <?php echo count($top5CommentPost); ?> 的文章：</p>
            <table class="pure-table pure-table-bordered"> 
                            <thead>
                            <tr>
                                <th>排名</th>
                                <th>文章</th>
                                <th>评论数</th>
                            </tr>
                            </thead> 
                            <tbody> 
                            <?php $top = 1; ?>
                            <?php foreach ($top5CommentPost as $post): ?>
                                <tr>
                                    <td><?php echo $top; ?></td>
                                    <td><a href="<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a></td>
                                    <td><?php echo $post['commentsNum']; ?></td>
                                </tr>
                                <?php $top ++; ?>
                            <?php endforeach; ?>
                             </tbody>
            </table>
        </div>  
    </article>
</section>
    <script type="text/javascript">
      var data = {
        post: <?php echo json_encode(postCalendar(time() - 20736000, time())); ?>,
        comment: <?php echo json_encode(commentCalendar(time() - 20736000, time())); ?>,
        category: <?php echo json_encode(categoryPostCount()); ?>
      };
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/jkjoy/typecho-theme-farallon@0.5.0/dist/js/chart.js"></script>
    <script id="MathJax-script" async src="https://jsd.onmicrosoft.cn/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
            <script>
                // 配置 MathJax
                MathJax = {
                    tex: {
                        inlineMath: [['$', '$']],
                        displayMath: [['$$', '$$']],
                        processEscapes: true,
                        processEnvironments: true,
                    },
                    options: {
                        skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'],
                    },
                };
                // 刷新预时重新渲染
                document.addEventListener('pjax:complete', () => {
                    MathJax.typesetPromise();
                });
            </script>
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
}
 
td,th {
    padding: 0;
}
 
.pure-table {
    border-collapse: collapse;
    border-spacing: 0;
    empty-cells: show;
    border: 1px solid #cbcbcb;
}
 
.pure-table caption {
    color: #000;
    font: italic 85%/1 arial,sans-serif;
    padding: 1em 0;
    text-align: center;
}
 
.pure-table td,.pure-table th {
    border-left: 1px solid #cbcbcb;
    border-width: 0 0 0 1px;
    font-size: inherit;
    margin: 0;
    overflow: visible;
    padding: .5em 1em;
}
 
.pure-table thead {
    background-color: #e0e0e0;
    color: #000;
    text-align: left;
    vertical-align: bottom;
}
 
.pure-table td {
    background-color: transparent;
}
 
.pure-table-bordered td {
    border-bottom: 1px solid #cbcbcb;
}
 
.pure-table-bordered tbody>tr:last-child>td {
    border-bottom-width: 0;
}
</style>
<?php $this->need('footer.php'); ?>