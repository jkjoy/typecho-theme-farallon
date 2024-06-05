<?php 
/**
 * 全部分类
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
    <section class="category--list">
      <?php $this->widget('Widget_Metas_Category_List')->parse('
      <div class="category--item">
      <img src="https://static.fatesinger.com/2021/12/vhp6eou5x2wqh2zy.jpg" class="category--cover"/>
      <div class="category--content">
       <a href="{permalink}" class="category--card">{name}
       <span>({count})</span>
       </a> 
         <div class="category--desc">{description}</div>
      </div>
      </div>    
    '); ?>
    </section>
</div>
<?php $this->need('footer.php'); ?>