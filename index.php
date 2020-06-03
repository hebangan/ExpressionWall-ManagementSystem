<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <link rel="apple-touch-icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/default.css">
    <link type="text/css" rel="stylesheet" href="css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="css/tc.css">
    <link type="text/css" rel="stylesheet" href="css/about.css">
    <title>表白墙</title>
</head>
<body>

<!--进入首页-->
<div  class="start">
    <img id="loveImg" src="img/love.png" style="width: 200px;height: 200px;cursor: pointer"  title="点击开启表白之旅~">
    <div style="font-size: 18px;font-weight: bold">点击开启表白之旅吧~ &nbsp&nbsp<img src="img/2412.gif"></div>
</div>

<div class="all">

    <!-- 关于我弹框 -->
    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="closeBtn">&times;</span>
                <h2>About me</h2>
            </div>
            <div class="modal-body">
                <p>表白墙正式完工~</p>
                <p>期末作品,完成于时间 2020-06-02</p>
            </div>
            <div class="modal-footer">
                <h3>开心 ╮(╯▽╰)╭ </h3>
            </div>
        </div>
    </div>

<!--导航条-->
    <div class="top">
        <div class="logo_sp">
            <img  src="img/logo.png" class="logo" alt="" />
            <span class="logo_name">表白墙</span>
        </div>
        <ul id="nav">
            <li><a href="index.php">首页</a></li>
            <li><a href="login.php">登录</a></li>
            <li><a href="feedback.php">反馈</a></li>
            <li><a href="#" id="modalBtn">关于我</a></li>
        </ul>
    </div>
    <div class="time_bar"></div>
    <!--弹窗-->
    <div class="tc">
        <button onclick="begin()" style="display: none" ></button>
        <div id="box_action_translateY" style="display: none;"></div>
    </div>
<!--    切换皮肤按钮-->
    <div class="btnAll">
        <button type="button" id="btn1">随机皮肤</button>
        <button type="button" id="btn">我要表白</button>
    </div>

<!--开始动画效果-->
    <script>
        (function () {
            $('.all').css("display","none");
            $('#loveImg').click(function () {
                //先隐藏爱心
                $('.start').fadeOut(1300,function(){
                    //在显示全部内容
                    $('.all').fadeIn(1000)
                });
            })
        })();
    </script>

<!--切换皮肤-->
    <script>
        $('#btn1').click(function () {
            count1=$(".row1").children().length;
            count2=$(".row2").children().length;
            for (i=1;i<=count1;i++){
                var num =Math.floor(Math.random()*12)+1;
                node='body > div > div.container > div.row1 > div:nth-child('+i+') > div';
                $(node).css("background-image","url('./img/"+num+".jpg')")
                console.log(num)
            }

            for (i=1;i<=count2;i++){
                var num =Math.floor(Math.random()*12)+1;
                node='body > div > div.container > div.row2 > div:nth-child('+i+') > div';
                $(node).css("background-image","url('./img/"+num+".jpg')")
                console.log(num)
            }
            begin('嘿嘿~ =͟͟͞͞( •̀д•́)')
        })
    </script>

<!-- 表白-->
    <script>
        $('#btn').click(function () {
            window.location.href='toLove.php'
            begin('表白成功~ ❤')
        })
    </script>

<!--    展示表白内容卡片-->
    <div class="container" style="overflow:auto;">
        <div class="row1">
        </div>
        <div class="row2">
        </div>

    </div>
</div>
<script>
    $('.logo_sp').click(function () {
            window.location.href="index.php"
        })
</script>


<!--播放音乐-->
<audio style="display:none; height: 0" id="bg-music" autoplay="autoplay" loop="loop"  >
    <source src="music.mp3" type="audio/mpeg">
</audio>

<!--关于我-->
<script type="text/javascript" src="js/about.js"></script>

<!--ajax刷新数据-->
<script type="text/javascript">
    //    获取后端的数据
    $.ajax({
        url: "api/dataApi.php",
        type:'GET',
        success: function(data){
            // var datas = eval('(' + data + ')');
            req_status=data.code;
            if (req_status==1){
                counts=data.note.length;
                for (i=0;i<counts;i++){
                    sender=data.note[i].sender;
                    contens=data.note[i].content;
                    likeCount=data.note[i].likeCount;
                    id=data.note[i].id;
                    time=data.note[i].time;
                    if((i+1)%2!=0){
                        //奇数
                        var newMsgChild = $(
                            "<div class='con_img'><div class='item-img1'><div class='feeders'>"+
                            sender +"</div>"+
                            "<div class='title'>"+contens+"</div><img   class='like' src='img/like.png' style='width: 30px;height: 30px;cursor: pointer' id='"+id+"' >"
                            +"<div class='likeCount' id='"+id+"' >"+likeCount+"</div><div class='dateTime'>"
                            +time+"</div>"
                        );

                        $('.row1').append(newMsgChild);
                    }else{
                        //偶数
                        var newMsgChild = $(
                            "<div class='con_img'><div class='item-img2'><div class='feeders'>"+
                            sender +"</div>"+
                            "<div class='title'>"+contens+"</div><img   class='like' src='img/like.png' style='width: 30px;height: 30px;cursor: pointer' id='"+id+"'  >"
                            +"<div class='likeCount' id='"+id+"' >"+likeCount+"</div><div class='dateTime'>"
                            +time+"</div>"
                        );
                        $('.row2').append(newMsgChild);
                    }
                }
            }else {
                begin('获取数据资源失败~  ●ω●')
            }
        },
        error: function(){
            console.log(data);
            begin('获取数据资源失败~  ●ω●')
        }
    });

</script>

<!--点赞-->
<script>
    window.onload=function () {

        var item_Count1=$(".row1").children().length;
        var item_Count2=$(".row2").children().length;
        // alert('row1有'+item_Count1+'个');
        // alert('row2有'+item_Count2+'个');
        var oDiv = document.getElementsByClassName("like");
        for (var i = 0; i < oDiv.length; i++) {
            (function(i) {
                oDiv[i].onclick = function() {
                    if (i<item_Count1){
                        //说明是row1的节点
                        c=i+1;
                        node='body > div > div.container > div.row1 > div:nth-child('+c+') > div>img'
                        likeNode='body > div > div.container > div.row1 > div:nth-child('+c+') > div>div.likeCount'
                        $(node).click(function () {
                            // alert('点击row1第'+c+'张');
                            $(node).attr('src',"img/pic_love.png")
                            id=$(likeNode).attr('id');
                            like_count=$(likeNode).html();
                            allLike=Number(like_count)+Number(1);
                            $(likeNode).html(allLike);
                            like(id,allLike);
                            // begin('点赞成功~')
                        })
                    }else{
                        temp=item_Count1-1;
                        c=i-temp;
                        node='body > div > div.container > div.row2 > div:nth-child('+c+') > div>img'
                        likeNode='body > div > div.container > div.row2> div:nth-child('+c+') > div>div.likeCount'
                        $(node).click(function () {
                            // alert('点击row2第'+c+'张');
                            $(node).attr('src',"img/pic_love.png")
                            id=$(likeNode).attr('id');
                            like_count=$(likeNode).html();
                            allLike=Number(like_count)+Number(1);
                            $(likeNode).html(allLike);
                            like(id,allLike);
                            // alert(Number(like_count)+1)
                            // begin('点赞成功~')
                        })
                    }
                }
            })(i)
        }
    }

    function like(id,likeCount) {
        data={
            id:id,
            like:likeCount,
        };
        console.log(data)
        $.ajax({
            url: "api/like.php",
            type:'post',
            data:data,
            success: function(data){
                var datas = eval('(' + data + ')');
                req_status=datas.code;
                if (req_status==1){
                    begin('点赞成功 ∩０∩')
                }else {
                    begin('点赞失败 o(╯□╰)o')
                }
            },
            error: function(){
                console.log(data);
                begin('点赞失败 o(╯□╰)o')
            }
        });
    }
</script>

<!--弹窗-->
<script>
    var boo = 0;
    var canUse = document.getElementsByTagName("body")[0].style;
    if (typeof canUse.animation != "undefined" || typeof canUse.WebkitAnimation != "undefined") {
        boo = 1;
    } else {
        boo = 0;
    }

    function actionIn(obj, actionName, time, speed) {
        $(obj).show();
        if (boo == 1) $(obj).css({ "animation": actionName + " " + time + "s" + " " + speed, "animation-fill-mode": "forwards" });
    }

    function actionOut(obj, actionName, time, speed) {
        if (boo == 1) {
            $(obj).css({ "animation": actionName + " " + time + "s" + " " + speed });
            var setInt_obj = setInterval(function () {
                $(obj).hide();
                clearInterval(setInt_obj);
            }, time * 1000);
        } else $(obj).hide();
    }
    function begin(s) {
        $('#box_action_translateY').html(s);
        actionIn("#box_action_translateY", 'action_translateY', 1, "");
        actionOut("#box_action_translateY", 'action_translateYOut', 2, "");
    }
</script>

<!--时间-->
<script>
    function writeCurrentDate() {
        var now = new Date();
        var year = now.getFullYear(); //得到年份
        var month = now.getMonth(); //得到月份
        var date = now.getDate(); //得到日期
        var day = now.getDay(); //得到周几
        var hour = now.getHours(); //得到小时
        var minu = now.getMinutes(); //得到分钟
        var sec = now.getSeconds(); //得到秒
        var MS = now.getMilliseconds(); //获取毫秒
        var week;
        month = month + 1;
        if (month < 10) month = '0' + month;
        if (date < 10) date = '0' + date;
        if (hour < 10) hour = '0' + hour;
        if (minu < 10) minu = '0' + minu;
        if (sec < 10) sec = '0' + sec;
        if (MS < 100) MS = '0' + MS;
        var arr_week = new Array(
            '星期日',
            '星期一',
            '星期二',
            '星期三',
            '星期四',
            '星期五',
            '星期六'
        );
        week = arr_week[day];
        var time = '';
        time =
            year +
            '年' +
            month +
            '月' +
            date +
            '日' +
            ' ' +
            hour +
            ':' +
            minu +
            ':' +
            sec +
            ' ' +
            week;
        $('.time_bar').html(time);
        //设置得到当前日期的函数的执行间隔时间，每1000毫秒刷新一次。
        var timer = setTimeout('writeCurrentDate()', 1000);
    }
    writeCurrentDate();
</script>
</body>
</html>
