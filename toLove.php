<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <link rel="apple-touch-icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/tolove.js"></script>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/default.css">
    <link type="text/css" rel="stylesheet" href="css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="css/tc.css">
    <link type="text/css" rel="stylesheet" href="css/about.css">
    <link type="text/css" rel="stylesheet" href="css/tolove.css">
    <title>表白</title>
</head>
<body>
<!-- 弹框部分 -->
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

<!-- 导航条 -->
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

 
<div class="yuAll">

<div class="row">
     <div class="con_img1">
        <div class="item-img">
            <div class="feeders">隔壁老王</div>
            <div class="title">这里可以预览噢~~</div>
        </div>
     </div>
</div>


<div class="tol" id="tl" style="display: ">
    <form>
        <table class="table">
            <tr>
                <th colspan="3">表白留言</th>
            </tr>
            <tr>
                <td>表白人:</td>
                <td><input type="text" id="feeder"></td>
            </tr>
            <tr>
                <td>表白内容</td>
                <td><textarea name="" id="contet" cols="" rows="" style="vertical-align:top;outline:none;"></textarea></td>
            </tr>

        </table>
        <input type="button" class="btn" value="发表" onclick="toLove()">
    </form>
</div>

</div>

<!--弹窗-->
<div class="tc">
    <button onclick="begin()" style="display: none" ></button>
    <div id="box_action_translateY" style="display: none;"></div>
</div>
<script>
    $('.logo_sp').click(function () {
        window.location.href="index.php"
    })
</script>
<!--关于我-->
<script type="text/javascript" src="js/about.js"></script>
<!--弹窗-->
<script>
    var boo = 0;
    var canUse = document.getElementsByTagName("body")[0].style;
    if (typeof canUse.animation != "undefined" || typeof canUse.WebkitAnimation != "undefined") {
        boo = 1;/*支持动画*/
    } else {
        boo = 0;/*不支持动画*/
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


<script>
    function toLove() {
        var s = $('input').val();
        var tex = $('textarea').val();
        if (s!=''&&tex!=''){
            data={
                sender:s,
                content:tex,
            };
            $.ajax({
                url: "api/tolove.php",
                type:'post',
                data:data,
                success: function(data){
                    var datas = eval('(' + data + ')');
                    req_status=datas.code;
                    if (req_status==1){
                        begin('表白成功~')
                    }else {
                        begin('表白失败~')
                    }
                },
                error: function(){
                    console.log(data);
                    begin('表白失败~')
                }
            });
        }else{
            begin('表白内容不为空噢~')
        }
    }

</script>
</body>
</html>
