<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?> 
 <div class="author--card">
            <img src="<?php $this->options->logoUrl() ?>" class="avatar" height="64" width="64" decoding="async">
            <div class="author--name">
                <?php $this->author(); ?>
            </div>
            <div class="author--description">
                <?php $this->options->description() ?>
            </div>
            <div class="author--sns">
                <?php $this->need('sns.php'); ?>      
            </div>
</div>