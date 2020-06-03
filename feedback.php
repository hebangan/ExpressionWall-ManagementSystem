<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>反馈</title>
    <link rel="icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <link rel="apple-touch-icon" type="image/png" sizes="60x50" href="./img/logo.png"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/tc.css">
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/axios.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/default.css">
    <link type="text/css" rel="stylesheet" href="css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="css/about.css">
</head>
<body>
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

<div class="time_bar"></div>

<div id="app">
    <div class="tc">
        <button onclick="begin()" style="display: none" ></button>
        <div id="box_action_translateY" style="display: none;"></div>
    </div>
    <div class="form_group">
        <label>反馈者: </label>
        <input type="text" class="form-control" v-model="feeders">
    </div>

    <div class="form_group">
        <label>反馈内容: </label>
        <textarea class="form-control" v-model="content"></textarea>
    </div>

    <div class="form_group">
        <input type="button" value="发表" class="btn btn-primary" @click="add">
    </div>


    <div class="feeds"  style="white-space:pre-line;overflow:auto;">
        <ul class="list-group">
            <li class="list-group-item" v-for="item in list" :key="item.id">
                <span class="badge">反馈时间:{{item.time}}</span>
                <span class="badge">反馈者:{{item.feeders}}</span>
                {{item.content}}

            </li>
        </ul>
    </div>


</div>
<script>
    $('.logo_sp').click(function () {
        window.location.href="index.php"
    })
</script>

<script type="text/javascript" src="js/about.js"></script>

<script>
    Vue.prototype.$ajax = axios;
    var vm = new Vue({
        el: '#app',
        data: {
            feeders:'',
            content:'',
            time:'',
            list: []
        },
        created() {
            this.getApi()
        },
        methods: {
            getApi(){
                this.$ajax({
                    method: 'get',
                    url: 'api/isFeedback.php',
                }).then(result => {
                    // console.log(result)
                    var feeds = result.data.feeds;
                    var count = feeds.length;
                    for (i = 0; i < count; i++) {
                        console.log(feeds[i])
                        feeders = feeds[i]['feeders']
                        content = feeds[i]['content']
                        time = feeds[i]['Time']
                        this.list.unshift({
                            feeders: feeders,
                            content: content,
                            time: time,
                        })
                    }
                }).catch(err => {
                    console.log(err)
                    alert('获取反馈数据失败！')
                })
            },
            add() {
                if (this.feeders != '' && this.content != '' ) {
                    //往数据库添加
                    var params = new URLSearchParams();
                    params.append('feeders',  this.feeders);
                    params.append('content', this.content);
                    this.$ajax({
                        method: 'post',
                        url: 'api/addFeed.php',
                        data:params
                    }).then(rs=>{
                        //后端返回来的
                        // rs.request.response
                        if(rs.status==200){
                            this.list=[];
                            //重新获取数据库信息，刷新商品列表。
                            this.getApi();
                            begin('已收到反馈~')
                            // alert('物品添加成功！');
                        }else {
                            begin('反馈出错!')
                        }
                    }).catch(err=>{
                        console.log(err);
                    });

                    this.list.unshift({
                        feeders: this.feeders,
                        content: this.content,
                    });
                    this.feeders = this.content = '';
                } else {
                    begin('反馈内容不为空~')
                }
            }
        }
    });
</script>

<!--Vue-->
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


<!--弹窗-->
<script>
    var boo = 0;
    var canUse = document.getElementsByTagName("body")[0].style;
    if (typeof canUse.animation != "undefined" || typeof canUse.WebkitAnimation != "undefined") {
        boo = 1;/*支持动画*/
    } else {
        boo = 0;/*不支持动画*/
    }

    // $('#action_translateY').click(function () {
    //     actionIn("#box_action_translateY", 'action_translateY', 1, "");
    // })


    /*obj,actionName,speed都是 string,time(秒)是int类型*/
    function actionIn(obj, actionName, time, speed) {
        $(obj).show();
        if (boo == 1) $(obj).css({ "animation": actionName + " " + time + "s" + " " + speed, "animation-fill-mode": "forwards" });
    }
    /*---淡出----*/

    // $('#action_translateYOut').click(function () {
    //     actionOut("#box_action_translateYOut", 'action_translateYOut', 1, "");
    // })


    /*obj,actionName,speed都是 string,time(秒)是int类型*/
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