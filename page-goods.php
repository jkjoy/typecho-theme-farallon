<?php
/**
 * 好物页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="site--main site--main__gears">
    <header class="archive--header">
        <h1 class="post--single__title"><?php $this->title() ?></h1>
    </header>
    <div id="goods" class="good--list">
        <?php
        $content = $this->content;
        try {
            $goods = parseGoodsTable($content);
            if (empty($content) || empty($goods)) {
                echo '<div class="no-goods">暂无数据，请按照格式书写。</div>';
            } else {
            foreach ($goods as $item): ?>
                <div class="good--item">
                    <div class="img-spacer">
                        <a href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" class="img40" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </a>
                    </div>
                    <div class="good--name">
                        <div class="brand">
                            <?php echo htmlspecialchars($item['name']); ?>·<?php echo htmlspecialchars($item['price']); ?>
                        </div>
                    <?php echo htmlspecialchars($item['description']); ?>  
                    </div>
                </div>
            <?php endforeach;
        }
        } catch (Exception $e) {
            echo '<div class="no-goods">解析内容时出现错误，请检查格式是否正确。</div>';
        }
        ?>
    </div>
    <?php if ($this->allow('comment')): ?>
       <?php $this->need('./module/comments.php'); ?>
    <?php endif; ?>
</div>
<style>.img40{height:137px;width:auto;object-fit:cover;}.img-spacer{width:100%;aspect-ratio:1;overflow:hidden;}.brand{font-weight:500;margin-bottom:5px;}.no-goods{grid-column:1 / -1;text-align:center;padding:20px;background:#f5f5f5;border-radius:8px;}</style>
<?php $this->need('footer.php'); ?>