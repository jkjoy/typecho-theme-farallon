<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
 
<footer class="site--footer">
    <div class="site--footer__content">
        <div class=site--footer__sns>
           <?php $this->need('sns.php'); ?>
        </div>

            <?php if($this->options->sitemapurl): ?>
            <a href="<?php $this->options->sitemapurl() ?>" target="_blank">💗</a>
            <?php endif; ?>
            <a href="https://www.typecho.org">Typecho</a>驱动  &nbsp;  <a href="https://www.imsun.org">Made with 老孙</a>💗 加载耗时
                <?php echo timer_stop();?> 💗
         <div class="copyright">
         <a href="<?php $this->options->siteUrl(); ?>">
               <?php $this->options->title(); ?>
            </a>   &nbsp; © 
            <?php $this->options->jzyear() ?>-<?php echo date('Y'); ?> 
            <svg class="icon icon--copryrights" viewBox="0 0 1040 1024" width="16" height="16">
                <path
                    d="M717.056236 383.936299l-51.226708 0c-28.2893 0-51.226708 22.936385-51.226708 51.225685l0 128.062678c0 28.2893 22.937408 51.225685 51.226708 51.225685l51.226708 0c28.2893 0 51.225685-22.936385 51.225685-51.225685L768.281921 435.161984C768.281921 406.872684 745.345536 383.936299 717.056236 383.936299zM717.056236 537.611308c0 14.158465-11.480472 25.612331-25.613354 25.612331-14.132882 0-25.612331-11.453866-25.612331-25.612331l0-76.835969c0-14.158465 11.480472-25.613354 25.612331-25.613354 14.133905 0 25.613354 11.453866 25.613354 25.613354L717.056236 537.611308zM1013.977739 426.580538 859.776751 165.30079c-8.888438-15.063067-22.294772-25.975605-37.57171-32.080649-32.708959-34.856879-79.187527-56.638975-130.762159-56.638975L332.862064 76.581166c-51.575656 0-98.0532 21.782096-130.761136 56.639998-15.276938 6.105045-28.683273 17.017582-37.572734 32.079626L10.327206 426.580538c-21.26021 36.069497-8.655124 82.217537 28.239158 103.028515l115.00836 64.967664 0 199.163015c0 99.024318 80.264045 153.678078 179.287339 153.678078l358.580818 0c99.024318 0 179.290409-80.266092 179.290409-179.290409L870.733291 594.575694l115.00836-64.966641C1022.63184 508.798075 1035.238972 462.650035 1013.977739 426.580538zM153.574724 536.518417l-67.058278-37.875632c-24.589025-13.907755-33.019021-44.647873-18.809391-68.684312l85.86767-145.555074L153.574724 536.518417zM646.620024 127.807874c0 56.5786-60.205197 102.45137-134.467551 102.45137-74.261331 0-134.466528-45.873794-134.466528-102.45137L646.620024 127.807874zM819.507606 742.515071c0 84.893482-68.810179 153.677055-153.678078 153.677055L358.475418 896.192126c-84.8679 0-153.675008-68.783573-153.675008-153.677055l0-461.030142c0-76.150354 55.402821-139.361001 128.093377-151.545508 1.332345 83.883479 81.06734 151.545508 179.258687 151.545508 98.19237 0 177.926342-67.662029 179.25971-151.545508 72.690556 12.183484 128.096447 75.394131 128.096447 151.545508L819.508629 742.515071zM937.791569 498.642784l-67.058278 37.875632 0-252.111948 85.86767 145.552004C970.807521 453.995935 962.377524 484.736053 937.791569 498.642784z"
                    p-id="4007"></path>
            </svg>
        </div>
    
    </div>

    <?php $this->options->tongji(); ?>
    
</footer>
 
<div class="backToTop">
    <svg xmlns="http://www.w3.org/2000/svg" class="svgIcon" viewBox="0 0 14 14" fill="currentColor" aria-hidden="true">
        <path
            d="M7.50015 0.425011C7.42998 0.354396 7.34632 0.298622 7.25415 0.261011C7.07101 0.187003 6.86629 0.187003 6.68315 0.261011C6.59128 0.298643 6.50795 0.354423 6.43815 0.425011L0.728147 6.13201C0.595667 6.27419 0.523544 6.46223 0.526972 6.65653C0.530401 6.85084 0.609113 7.03622 0.746526 7.17363C0.883939 7.31105 1.06932 7.38976 1.26362 7.39319C1.45793 7.39661 1.64597 7.32449 1.78815 7.19201L6.21615 2.76501V13.024C6.21615 13.2229 6.29517 13.4137 6.43582 13.5543C6.57647 13.695 6.76724 13.774 6.96615 13.774C7.16506 13.774 7.35583 13.695 7.49648 13.5543C7.63713 13.4137 7.71615 13.2229 7.71615 13.024V2.76501L12.1441 7.19201C12.2868 7.32867 12.4766 7.40497 12.6741 7.40497C12.8717 7.40497 13.0615 7.32867 13.2041 7.19201C13.3444 7.05126 13.4231 6.86068 13.4231 6.66201C13.4231 6.46334 13.3444 6.27277 13.2041 6.13201L7.50015 0.425011Z">
        </path>
    </svg>
</div>

<script src="<?php $this->options->themeUrl('/dist/js/bundle.js'); ?>"></script>
<?php $this->footer(); ?>
</div>
</body>
</html>