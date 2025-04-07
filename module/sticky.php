<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php  
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