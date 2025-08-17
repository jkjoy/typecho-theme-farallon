<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<main id="site--main">
    <section class="template--404">
        <div class="error--text">404</div>
        <div class="error--posts">
            <article class="post--error" itemtype="http://schema.org/Article" itemscope="itemscope">
                <div class="content">
                    <h2 class="post--title" itemprop="headline">
                        <a href="<?php $this->options->siteUrl(); ?>">
                        <?php $this->options->title(); ?>
                        </a>
                    </h2>
                    <div class="meta">
                        <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                            <path
                                d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                            </path>
                        </svg>
                    </div>
                </div>
            </article>  
        </div>
    </section>
</main>
<?php $this->need('footer.php'); ?>
