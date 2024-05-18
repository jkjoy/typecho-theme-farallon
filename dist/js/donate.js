setTimeout(function(){
    initDonate()
}, 1000);
function initDonate(){
    var donateBtn = document.getElementById('donate-btn');
    var donatePopup = document.getElementById('qrcode-panel');
    if(!donateBtn && !donatePopup){
        return
    }
    var l = donateBtn.offsetLeft-125;
    var t = donateBtn.offsetTop-330;
    donatePopup.style.left=l+'px'
    donatePopup.style.top=t+'px'

    donateBtn.addEventListener('click',function(){
        donatePopup.style.display='';
        event.stopPropagation()
    })
    document.getElementById('donate-close').addEventListener('click',function(){
        donatePopup.style.display='none';
        event.stopPropagation()
    })
    document.querySelector('body').addEventListener('click',function() {
        donatePopup.style.display='none';
        event.stopPropagation()
    });
    donatePopup.addEventListener('click',function() {
        event.stopPropagation()
    });
}