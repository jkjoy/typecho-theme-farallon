<?php 
/**
 * 豆瓣
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<section class="site--main">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
        <h2 class="post--single__subtitle">数据来源于豆瓣</h2>
    </header>
    <div class="db--container" data-token="322dba2a3a27524b97c06d941d9631d153fc">
        <nav class="db--nav">
            <div class="db--navItem JiEun current" data-type="movie">Movie</div>
            <div class="db--navItem JiEun" data-type="book">Book</div>
            <div class="db--navItem JiEun" data-type="game">Game</div>
            <div class="db--navItem JiEun" data-type="music">Music</div>
            <div class="db--navItem JiEun" data-type="drama">Drama</div>
        </nav>
        <div class="db--genres">
        </div>
        <div class="db--list db--list__card">
        </div>
        <div class="block-more block-more__centered">
            <div class="lds-ripple">
            </div>
        </div>
    </div>
     
</section>
<?php $this->need('footer.php'); ?>