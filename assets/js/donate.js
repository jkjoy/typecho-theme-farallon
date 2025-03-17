document.addEventListener('DOMContentLoaded', function() {
    const donateBtn = document.getElementById('donate-btn');
    const qrcodePanel = document.getElementById('qrcode-panel');
    const donateClose = document.getElementById('donate-close');
    const methodBtns = document.querySelectorAll('.donate-method-btn');
    const qrImages = document.querySelectorAll('.qr-image');
    let isVisible = false;

    // 切换支付方式
    function switchPayMethod(method) {
        // 更新按钮状态
        methodBtns.forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.method === method) {
                btn.classList.add('active');
            }
        });

        // 更新二维码显示
        qrImages.forEach(img => {
            img.classList.remove('active');
            if (img.dataset.method === method) {
                img.classList.add('active');
            }
        });
    }

    // 点击打赏按钮切换二维码显示状态
    function toggleQRCode(event) {
        event.stopPropagation();
        isVisible = !isVisible;
        qrcodePanel.style.display = isVisible ? 'block' : 'none';
    }

    // 点击关闭按钮隐藏二维码
    function hideQRCode(event) {
        event.stopPropagation();
        isVisible = false;
        qrcodePanel.style.display = 'none';
    }

    // 点击二维码面板之外的地方隐藏二维码
    function handleDocumentClick(event) {
        if (isVisible && !qrcodePanel.contains(event.target) && !donateBtn.contains(event.target)) {
            isVisible = false;
            qrcodePanel.style.display = 'none';
        }
    }

    // 绑定事件监听器
    donateBtn.addEventListener('click', toggleQRCode);
    donateClose.addEventListener('click', hideQRCode);
    document.addEventListener('click', handleDocumentClick);

    // 绑定支付方式切换按钮事件
    methodBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const method = e.target.dataset.method;
            switchPayMethod(method);
        });
    });

    // 初始化显示第一个支付方式
    switchPayMethod('wechat');
});