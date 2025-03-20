    // 加载更多文章
    $(document).on('click', '.post-read-more a', function(e){
        e.preventDefault();
        var $btn = $(this);
        var nextPage = $btn.attr('href');
        
        if($btn.hasClass('loading')) return false;
        
        $btn.addClass('loading').text('加载中...');
        
        $.ajax({
            url: nextPage,
            type: 'GET',
            dataType: 'html',
            success: function(data){
                // 创建一个临时的DOM元素来解析返回的HTML
                var $html = $('<div></div>').html(data);
                
                // 找到新的文章
                var $newPosts = $html.find('.post_loop');
                
                // 找到新的"加载更多"按钮
                var $newBtn = $html.find('.post-read-more a');
                
                // 将新文章添加到页面
                if ($newPosts.length > 0) {
                    $('.post_box').append($newPosts);
                    // 新文章淡入效果
                    $newPosts.hide().fadeIn(500);
                }
                
                // 更新"加载更多"按钮或移除它
                if($newBtn.length > 0){
                    $btn.attr('href', $newBtn.attr('href'))
                       .removeClass('loading')
                       .text('加载更多');
                } else {
                    $('.post-read-more').remove();
                }
            },
            error: function(xhr, status, error){
                console.error("AJAX Error:", status, error);
                $btn.removeClass('loading').text('加载失败，点击重试');
            }
        });
        
        return false;
    });
