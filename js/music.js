//音乐自动播放
$(document).ready(function(){
    autoPlayMusic();
    audioAutoPlay();
});

function openmusic(){
    autoPlayMusic();
    audioAutoPlay();
    $(".close_music_div").css({"display":"block"});
    $(".open_music_div").css({"display":"none"});
}

function pauseAuto(){
    var audio = document.getElementById('bg-music');
    audio.pause();
    $(".close_music_div").css({"display":"none"});
    $(".open_music_div").css({"display":"block"});
}

function audioAutoPlay() {
    var audio = document.getElementById('bg-music');
    audio.play();
    document.addEventListener("WeixinJSBridgeReady", function () {
        audio.play();
    }, false);
}
// 音乐播放
function autoPlayMusic() {
    // 自动播放音乐效果，解决浏览器或者APP自动播放问题
    function musicInBrowserHandler() {
        musicPlay(true);
        document.body.removeEventListener('touchstart', musicInBrowserHandler);
    }
    document.body.addEventListener('touchstart', musicInBrowserHandler);
    // 自动播放音乐效果，解决微信自动播放问题
    function musicInWeixinHandler() {
        musicPlay(true);
        document.addEventListener("WeixinJSBridgeReady", function () {
            musicPlay(true);
        }, false);
        document.removeEventListener('DOMContentLoaded', musicInWeixinHandler);
    }
    document.addEventListener('DOMContentLoaded', musicInWeixinHandler);
}
function musicPlay(isPlay) {
    var media = document.querySelector('#bg-music');
    if (isPlay && media.paused) {
        media.play();
    }
    if (!isPlay && !media.paused) {
        media.pause();
    }
}