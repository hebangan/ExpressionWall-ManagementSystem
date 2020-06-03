<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>登录</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
        @font-face {
            font-family: digit;
            src: url("digital-7_mono.ttf"
                    /*tpa=./digital-7_mono.ttf*/
                ) format("truetype");
        }
    </style>
    <link rel="icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <link rel="apple-touch-icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <link href="css/login.css" tppabs="css/login.css" type="text/css" rel="stylesheet">
    <link href="css/tc.css" tppabs="css/tc.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js" tppabs="./js/jquery.min.js"></script>
    <script type="text/javascript" src="js/garden.js" tppabs="./js/garden.js"></script>
    <script type="text/javascript" src="js/functions.js" tppabs="./js/functions.js"></script>
    <script type="text/javascript" src="js/login.js" tppabs="./js/login.js"></script>

<body>

    <script language="JavaScript">
        $(function () {
            $('form').find('input[type=checkbox]').bind('click', function () {
                $('form').find('input[type=checkbox]').not(this).attr("checked", false);
            });
        });
        function login() {
             num = document.getElementById("num").value;
             pwd = document.getElementById("pwd").value;
            if ($('.check').is(':checked')) {
                var role='';
                //获取登入的身份的value值 0普 1管理
                $.each($('#dl > form > table > tbody > tr:nth-child(4) > td>input:checkbox'),function(){
                    if(this.checked){
                        role=$(this).val();
                    }
                });
                // alert(role);
                if (num == '' || pwd == '') {
                    alert("请输入账号、密码!");
                } else {
                    data={
                        zh:num,
                        pwd:pwd,
                        role:role
                    };
                    //普通用户登录
                    if(role==0){
                        $.ajax({
                            url: "api/isLogin.php",
                            type:'POST',
                            data:data,
                            success: function(data){
                                var datas = eval('(' + data + ')');
                                status=datas.status;
                                if (status==1){
                                    begin('普通用户登录成功!');
                                    location.href="index.php"
                                }else {
                                    begin('普通用户登录失败!')
                                }
                            },
                            error: function(data){
                                // console.log(data);
                                begin('普通用户登录失败!')
                            }
                        });
                    }
                    // 管理员登入
                    if(role==1){
                        $.ajax({
                            url: "api/isLogin.php",
                            type:'POST',
                            data:data,
                            success: function(data){
                                var datas = eval('(' + data + ')');
                                status=datas.status;
                                if (status==1){
                                    begin('管理员登录成功!');
                                    location.href="admin.php"
                                }else {
                                    begin('管理员登录失败!')
                                }
                            },
                            error: function(data){
                                // console.log(data);
                                begin('管理员登录失败!')
                            }
                        });
                    }
                }
            } else {
                alert('请勾选登入身份!');
            }
        }

        function reg() {
             zc_num = document.getElementById("num_zc").value;
             zc_pwd = document.getElementById("pwd_zc").value;
            if ($('.check').is(':checked')) {
                var role='';
                $.each($('.zc > form > table > tbody > tr:nth-child(4) > td>input:checkbox'),function(){
                    if(this.checked){
                        role=$(this).val();
                    }
                });
                if (zc_num == '' || zc_pwd == '') {
                    alert("请输入账号、密码!");
                } else {
                    //    发送post注册
                    zc_data={
                        zh:zc_num,
                        pwd:zc_pwd,
                        role:role
                    };
                    $.ajax({
                        url: "api/isReg.php",
                        type:'POST',
                        data:zc_data,
                        success: function(data){
                            var datas = eval('(' + data + ')');
                            console.log(datas);
                            status=datas.status;
                            if (status==1){
                                begin('注册成功!')
                            }else {
                                begin('注册失败!')
                            }
                        },
                        error: function(data){
                            // console.log(data);
                            begin('注册失败!')
                        }
                    });
                }
            } else {
                alert('请勾选登入身份!');
            }
        }
    </script>

    <div id="mainDiv">
        <div id="content">
            <div id="code">
                <span class="comments">嗨,朋友<img src="img/2402.gif">:</span><br />
                <span class="space"><span class="comments">你好呀~</span></span><br />
                <span class="space" /><span class="comments">缘分让我们相遇是意外~嘿嘿,快来注册登入吧~</span>
            </div>
            <div id="loveHeart">
                <canvas id="garden"></canvas>
                <div id="words" style="display:none">
                    <!-- 登录 -->
                    <div class="bd" id="dl" style="display: ">
                        <form>
                            <table class="gridtable">
                                <tr>
                                    <th colspan="3">欢迎登录</th>
                                </tr>
                                <tr>
                                    <td>账号</td>
                                    <td><input type="text" id="num"></td>
                                </tr>
                                <tr>
                                    <td>密码</td>
                                    <td><input type="password" id="pwd"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" class="check" name="role" checked
                                            value="0">普通</input>
                                        <input type="checkbox" class="check" name="role" value="1">管理员</input>
                                    </td>
                                </tr>
                            </table>
                            <input type="button" class="btn" value="登录" onclick="login()">
                            <span>没有账号?<a href="#" id="zc">点击注册</a></span>
                        </form>
                    </div>

                    <!-- 注册 -->
                    <div class="zc" style="display:none ;">
                        <form>
                            <table class="gridtable">
                                <tr>
                                    <th colspan="3">欢迎注册</th>
                                </tr>
                                <tr>
                                    <td>账号</td>
                                    <td><input type="text" id="num_zc"></td>
                                </tr>
                                <tr>
                                    <td>密码</td>
                                    <td><input type="password" id="pwd_zc"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" class="check" name="role" checked
                                            value="0">普通</input>
                                        <input type="checkbox" class="check" name="role" value="1">管理员</input>
                                    </td>
                                </tr>
                            </table>
                            <input type="button" class="btn" value="注册" onclick="reg()">
                            <span>已有有账号?<a href="#" id="backdl">返回登入</a></span>
                        </form>
                    </div>
                    <!--弹窗-->
                    <div class="tc">
                        <button onclick="begin()" style="display: none" ></button>
                        <div id="box_action_translateY" style="display: none;"></div>
                    </div>

                </div>

            </div>
        </div>

        <script>
            $('#zc').click(function () {
                $('#dl').fadeOut(2000, function () {
                    //在显示注册内容
                    $('.zc').fadeIn(1000)
                });
            })

            $('#backdl').click(function () {
                $('.zc').fadeOut(2000, function () {
                    //在显示d登入内容
                    $('.bd').fadeIn(1000)
                });
            })
        </script>

        <script type="text/javascript">
            var offsetX = $("#loveHeart").width() / 2;
            var offsetY = $("#loveHeart").height() / 2 - 55;

            if (!document.createElement('canvas').getContext) {
                var msg = document.createElement("div");
                msg.id = "errorMsg";
                msg.innerHTML = "提醒您：您的浏览器版本过旧^_^<br/>";
                document.body.appendChild(msg);
                $("#code").css("display", "none")
                document.execCommand("stop");
            } else {
                setTimeout(function () {
                    adjustWordsPosition();
                    startHeartAnimation();
                }, 5000);
                adjustCodePosition();
                $("#code").typewriter();
            }
        </script>
        <!-- <audio id="bgmMusic" src="http://qzone.haoduoge.com/music/C2C3F0LSXH4D771253124A26CF9C71C939B2A.mp3" preload="auto" type="audio/mp3" autoplay loop></audio> -->

<!--        弹窗-->
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
</body>

</html>
