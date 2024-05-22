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
        <h2 class="archive--title__year">共包含 <?php $quantity->publishedPostsNum(); ?> 篇文章</h2>
        <?php if ($this->options->showallwords): ?>
                <h3><?php echo allwords(); ?></h3>
<?php endif; ?>
</header>
<div class="page--archive">
    <?php
        $stat = Typecho_Widget::widget('Widget_Stat');
        Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
        $year = 0; $mon = 0;
        $output = '<div class="archives">';
        
        while ($archives->next()) {
            $year_tmp = date('Y', $archives->created);
            $mon_tmp = date('m', $archives->created);
            
            // 检查年份和月份是否变化
            if ($year != $year_tmp) {
                if ($year > 0) {
                    $output .= '</ul></div>'; // 结束上一个年份的ul和div
                }
                
                $year = $year_tmp; $mon = 0; // 更新年份和重置月份
                $output .= '<h2 class="archive--title__year">' . date('Y', $archives->created) . '</h2>'; // 输出新的年份
            }
            
            if ($mon != $mon_tmp) {
                if ($mon > 0) {
                    $output .= '</ul>'; // 结束上一个月份的ul
                }
                
                $mon = $mon_tmp; // 更新月份
                $output .= '<h3 class="archive--title__month">'. date('M', $archives->created) . '</h3><ul class="archive--list" aria-label="' . date('Y年m月', $archives->created) . '">'; // 输出新的月份和开始新的列表
            }
            
            // 输出文章项
            $output .= '<li class="archive--item"><div class="archive--title"><a href="' . $archives->permalink . '">' . $archives->title . '</a></div>';
            $output .= '<div class="archive--meta">' . date('m月d日', $archives->created) . '</div></li>'; 
        }
        
        if ($year > 0) {
            $output .= '</ul>'; // 确保结束最后一个月份列表和div
        }
        
        $output .= '</div>'; // 结束归档div
        echo $output;
    ?>
</div>
</section>
<?php $this->need('footer.php'); ?>
 