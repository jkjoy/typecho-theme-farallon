<?php 
/**
 * 文章归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main class="site--main">
<header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <?php Typecho_Widget::widget('Widget_Stat')->to($quantity); ?>
        <h2 class="archive--title__year">共包含 <?php $quantity->publishedPostsNum(); ?> 篇文章</h2>
</header>
  
    <div data-target="<?php $this->options->postLinkOpen(); ?>" class="page--archive"  >

<?php
    $stat = Typecho_Widget::widget('Widget_Stat');
            Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
            $year = 0;
            $mon = 0;
            $i = 0;
            $j = 0;
$output = '<div class="archives">';
    while ($archives->next()) {
            $year_tmp = date('Y', $archives->created);
            $mon_tmp = date('m', $archives->created);
            $y = $year;
            $m = $mon;
        if ($year > $year_tmp || $mon > $mon_tmp) {
$output .= '</ul></div>';
        }
    if ($year != $year_tmp || $mon != $mon_tmp) {
        $year = $year_tmp;
        $mon = $mon_tmp;
$output .= '<h2 class="archive--title__year">' . date('Y年', $archives->created) . '</h2>
          <h3 class="archive--title__month">'. date('m月', $archives->created) .'</h3><ul class="archive--list" aria-label="' . date('Y年m月', $archives->created) . '">
          '; //输出年份
        }
$output .= '<li class="archive--item"><div class="archive--title"><a href="' . $archives->permalink . '">' . $archives->title . '</a></div> 
          <div class="archive--meta">' . date('m月d日', $archives->created) . '</div> </li>'; //输出文章
        }
$output .= ' </ul></div></div>';
          echo $output;?>
   </div>


</main>
<?php $this->need('footer.php'); ?>
 