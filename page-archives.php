<?php
/**
 * 文章归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <?php Typecho_Widget::widget('Widget_Stat')->to($quantity); ?>
        <h2 class="post--single__subtitle">共包含 <?php $quantity->publishedPostsNum(); ?> 篇文章</h2>
    </header>
    <div class="page--archive">
    <?php
        $stat = Typecho_Widget::widget('Widget_Stat');
        Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
        $year = 0; $mon = 0;
        $output = '<div class="archives">'; // Start archives container      
        while ($archives->next()) {
            $year_tmp = date('Y', $archives->created);
            $mon_tmp = date('m', $archives->created);  
            
            // 检查是否需要新的年份标题
            if ($year != $year_tmp) {
                if ($year > 0) {
                    $output .= '</ul></div>'; // 结束上一个年份的月份列表和包裹的div
                }
                $year = $year_tmp; 
                $mon = 0; // 重置月份
                $output .= '<div class="archive-year"><h2 class="archive--title__year">' . $year . '年</h2>'; // 开始新的年份div
            }       
            // 检查是否需要新的月份标题
            if ($mon != $mon_tmp) {
                if ($mon > 0) {
                    $output .= '</ul>'; // 结束上一个月份的列表
                }
                $mon = $mon_tmp; 
                $output .= '<h3 class="archive--title__month">' . $mon . '月</h3>'; 
                $output .= '<ul class="archive--list">'; // 开始新的月份列表
            }
            // 输出文章项
            $output .= '<li class="archive--item">';
            $output .= '<div class="archive--title"><a href="' . $archives->permalink . '">' . $archives->title . '</a></div>';
            $output .= '<div class="archive--meta">' . date('m月d日', $archives->created) . '</div></li>';
        }
        // 循环后，确保所有标签都已经关闭
        if ($mon > 0) {
            $output .= '</ul>'; // 结束最后一个月份的列表
        }
        if ($year > 0) {
            $output .= '</div>'; // 结束最后一个年份的div
        }
        $output .= '</div>'; // End archives container
        echo $output;
    ?>
    </div>
</section>
<?php $this->need('footer.php'); ?>