  
 <div class="author--card">
            <img src="<?php $this->options->logoUrl() ?>" class="avatar" height="64" width="64" decoding="async">
            <div class="author--name">
                <?php $this->options->author() ?>
            </div>
            <div class="author--description">
                <?php $this->options->description() ?>
            </div>
            <div class="author--sns">
                <?php $this->need('sns.php'); ?>      
            </div>
</div>
 