<?php
// 确保退出安全
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/** 文章置顶 */
$sticky = $this->options->sticky; // 置顶的文章id，多个用|隔开
$db = Typecho_Db::get();
$pageSize = $this->options->pageSize;

if ($sticky && !empty(trim($sticky))) {
    $sticky_cids = array_filter(explode('|', $sticky)); // 分割文本并过滤空值
    if (!empty($sticky_cids)) {
        $sticky_html = " <span class='sticky--post'> 置顶 </span> "; // 置顶标题的 html

        // 清空原有文章的队列
        $this->row = [];
        $this->stack = [];
        $this->length = 0;

        // 获取总数，并排除置顶文章数量
        if (isset($this->currentPage) && $this->currentPage == 1) {
            $totalOriginal = $this->getTotal();
            $stickyCount = count($sticky_cids);
            $this->setTotal(max($totalOriginal - $stickyCount, 0));

            // 构建置顶文章的查询
            $selectSticky = $this->select()->where('type = ?', 'post');
            foreach ($sticky_cids as $i => $cid) {
                if ($i == 0) 
                    $selectSticky->where('cid = ?', $cid);
                else 
                    $selectSticky->orWhere('cid = ?', $cid);
            }

            // 获取置顶文章
            $stickyPosts = $db->fetchAll($selectSticky);

            // 压入置顶文章到文章队列
            foreach ($stickyPosts as &$stickyPost) {
                $stickyPost['title'] .= $sticky_html;
                $this->push($stickyPost);
            }

            $standardPageSize = $pageSize - count($stickyPosts);
        } else {
            $standardPageSize = $pageSize;
        }

        // 构建正常文章查询，排除置顶文章
        $selectNormal = $this->select()
            ->where('type = ?', 'post')
            ->where('status = ?', 'publish')
            ->where('created < ?', time())
            ->order('created', Typecho_Db::SORT_DESC)
            ->page(isset($this->currentPage) ? $this->currentPage : 1, $standardPageSize);

        foreach ($sticky_cids as $cid) {
            $selectNormal->where('table.contents.cid != ?', $cid);
        }
    } else {
        // 如果sticky_cids为空，使用默认查询
        $selectNormal = $this->select()
            ->where('type = ?', 'post')
            ->where('status = ?', 'publish')
            ->where('created < ?', time())
            ->order('created', Typecho_Db::SORT_DESC)
            ->page(isset($this->currentPage) ? $this->currentPage : 1, $pageSize);
    }
} else {
    // 如果没有置顶文章，使用默认查询
    $selectNormal = $this->select()
        ->where('type = ?', 'post')
        ->where('status = ?', 'publish')
        ->where('created < ?', time())
        ->order('created', Typecho_Db::SORT_DESC)
        ->page(isset($this->currentPage) ? $this->currentPage : 1, $pageSize);
}

// 登录用户显示私密文章
if ($this->user->hasLogin()) {
    $uid = $this->user->uid;
    if ($uid) {
        $selectNormal->orWhere('authorId = ? AND status = ?', $uid, 'private');
    }
}

$normalPosts = $db->fetchAll($selectNormal);

// 如果之前没有清空队列（没有置顶文章的情况），现在清空
if (empty($sticky) || empty(trim($sticky)) || empty($sticky_cids)) {
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
}

// 压入正常文章到文章队列
foreach ($normalPosts as $normalPost) {
    $this->push($normalPost);
}
?>
<?php while($this->next()): ?>
	<article class="post--item">
    <div class="content">
        <h2 class="post--title">
			 <a href="<?php $this->permalink() ?>">
             <?php $this->title() ?>
                <?php if((time() - $this->created) < 60*60*24*3): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    class="icon--sticky" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="w-4 h-4 text-red-400">
                    <path
                        d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z">
                    </path>
                </svg> 
                <?php endif; ?>
            </a>
		</h2>
        <div class="description">
        <?php
        if($this->fields->summary){
        echo $this->fields->summary;
         } else {
        $this->excerpt(180);
        }?>
         </div>
	    <div class="meta">
			<svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                </path>
            </svg><time><?php $this->date('Y-m-d'); ?></time> 
 
				<svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path
                    d="M408.551619 97.52381a73.142857 73.142857 0 0 1 51.736381 21.430857L539.306667 197.973333A73.142857 73.142857 0 0 0 591.067429 219.428571H804.571429a73.142857 73.142857 0 0 1 73.142857 73.142858v560.761904a73.142857 73.142857 0 0 1-73.142857 73.142857H219.428571a73.142857 73.142857 0 0 1-73.142857-73.142857V170.666667a73.142857 73.142857 0 0 1 73.142857-73.142857h189.123048z m0 73.142857H219.428571v682.666666h585.142858V292.571429h-213.504a146.285714 146.285714 0 0 1-98.499048-38.13181L487.619048 249.734095 408.551619 170.666667zM365.714286 633.904762v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z m-365.714285-195.047619v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z">
                </path>
            </svg><?php $this->category(','); ?>
            <svg class="icon" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9ZM11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12Z" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M21.83 11.2807C19.542 7.15186 15.8122 5 12 5C8.18777 5 4.45796 7.15186 2.17003 11.2807C1.94637 11.6844 1.94361 12.1821 2.16029 12.5876C4.41183 16.8013 8.1628 19 12 19C15.8372 19 19.5882 16.8013 21.8397 12.5876C22.0564 12.1821 22.0536 11.6844 21.83 11.2807ZM12 17C9.06097 17 6.04052 15.3724 4.09173 11.9487C6.06862 8.59614 9.07319 7 12 7C14.9268 7 17.9314 8.59614 19.9083 11.9487C17.9595 15.3724 14.939 17 12 17Z" />
            </svg>
            <span class="article--views"><?php get_post_view($this) ?></span>
            <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
                <g>
                    <path
                        d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                    </path>
                </g>
            </svg>
				 <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 ', '1 ', '%d '); ?></a>
	    </div>
    </div>    
    <?php
       $firstImage = img_postthumb($this->cid);
       $cover = $this->fields->cover;
       $imageToDisplay = !empty($cover) ? $cover : $firstImage;
       if($imageToDisplay): 
    ?>
       <a href="<?php $this->permalink() ?>" class="cover--link">
        <img src="<?php echo $imageToDisplay; ?>" alt="<?php $this->title() ?>" class="cover" itemprop="image"/>
       </a>
    <?php endif; ?>  
    </article>
	<?php endwhile; ?>
    <?php
            $this->pageNav(
                ' ',
                ' ',
                1,
                '...',
                array(
                    'wrapTag' => 'nav',
                    'wrapClass' => 'nav-links nav-links__comment',
                    'itemTag' => '',
                    'textTag' => 'span',
                    'itemClass'   => 'page-numbers', 
                    'currentClass' => 'page-numbers current',
                    'prevClass' => 'hidden',
                    'nextClass' => 'hidden'
                )
            );
        ?>