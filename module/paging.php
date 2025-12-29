<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if ($this->options->loadmore): ?>    
    <?php
            $this->pageNav(
                ' ',
                ' ',
                1,
                '...',
                array(
                    'wrapTag' => 'nav',
                    'wrapClass' => 'nav-links',
                    'itemTag' => '',
                    'textTag' => 'span',
                    'itemClass'   => 'page-numbers', 
                    'currentClass' => 'page-numbers current',
                    'prevClass' => 'hidden',
                    'nextClass' => 'hidden'
                )
            );
    ?>
    <?php else:?>
    <?php
        $nextPage = $this->_currentPage + 1;
        $totalPages = ceil($this->getTotal() / $this->parameter->pageSize);
        if ($this->_currentPage < $totalPages): 
    ?>
    <div class="nav-links">
        <span class="loadmore"><?php $this->pageLink('加载更多', 'next'); ?></span>
    </div>
    <script src="<?php $this->options->themeUrl('assets/js/loadmore.js'); ?>"></script>  
    <?php endif; ?>
    <?php endif; ?>