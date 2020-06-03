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
    <script type="text/javascript" src="js/vue.js"></script>
    <script type="text/javascript" src="js/axios.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/default.css">
    <link type="text/css" rel="stylesheet" href="css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="css/tc.css">
    <link type="text/css" rel="stylesheet" href="css/about.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <title>表白墙</title>
</head>
<body>

<div class="all">

    <!-- 关于我弹框部分 -->
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

    <!--    导航条-->
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

    <div class="d1" style="width:800px;margin-left:380px">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#bb" data-toggle="tab">表白</a>
            </li>
            <li><a href="#fk" data-toggle="tab">反馈</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="bb">
                <!--    表白内容-->
                <div id="app">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">表白集合</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body form-inline">
                                <label>
                                    表白内容搜索:
                                    <input type="text" class="form-control" v-model="keywords" id="search">
                                </label>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>表白者</th>
                            <th>表白内容</th>
                            <th>时间</th>
                            <th>点赞数</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in search(keywords)" ::key="item.id">
                            <td>{{item.id}}</td>
                            <td>{{item.sender}}</td>
                            <td>{{item.content}}</td>
                            <td>{{item.time}}</td>
                            <td>{{item.likeCount}}</td>
                            <td><a href="#" @click.prevent="del(item.id)">删除</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="fk">
                <!--    反馈内容-->
                <div id="app2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">反馈集合</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body form-inline">
                                <label>
                                    反馈内容搜索:
                                    <input type="text" class="form-control" v-model="keywords" id="search">
                                </label>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>反馈者</th>
                            <th>反馈内容</th>
                            <th>反馈时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in search(keywords)" ::key="item.id">
                            <td>{{item.feeders}}</td>
                            <td>{{item.content}}</td>
                            <td>{{item.Time}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--  表白内容的js-->
    <script>
        Vue.prototype.$ajax = axios;
        var vm = new Vue({
            el: '#app',
            data: {
                id: '',
                sender: '',
                content: '',
                time: '',
                likeCount: '',
                keywords: '',
                list: []
            },
            created() {
                // 调用接口
                this.getApi()
            },
            methods: {
                getApi() {
                    axios({
                        method: 'get',
                        url: 'api/dataApi.php',
                    }).then(result => {
                        var note = result.data.note;
                        var count = note.length;
                        for (i = 0; i < count; i++) {
                            id = note[i]['id'];
                            content = note[i]['content'];
                            sender = note[i]['sender'];
                            time = note[i]['time'];
                            likeCount = note[i]['likeCount'];
                            this.list.push({
                                id: id,
                                sender: sender,
                                content: content,
                                time: time,
                                likeCount: likeCount,
                            })
                        }
                    }).catch(err => {
                        console.log(err);
                        begin('数据获取失败 ●ω●')
                    })
                },
                del(id) {
                    // 删除数据库一行
                    var param = new URLSearchParams();
                    param.append('id', id);
                    this.$ajax({
                        method: 'post',
                        url: 'api/delData.php',
                        data:param
                    }).then(rs=>{
                        if(rs.status==200&&rs.data.code==1){
                            //重新刷新列表
                            this.list=[];
                            //重新获取数据库信息，刷新商品列表。
                            this.getApi();
                            begin('删除成功 ≧◉◡◉≦')
                        }else {
                            begin('删除失败 ●＾●')
                        }
                    }).catch(err=>{
                        console.log(err);
                    });
                },
                search(keywords) {
                    return this.list.filter(item => {
                        if (item.content.includes(keywords)) {
                            begin('查询成功 ●ω●')
                            return item;
                        }else{
                            begin('未查询到该条记录 ●ω●')
                        }

                    })

                }
            }
        })
    </script>

    <!--  反馈内容的js-->
    <script>
        Vue.prototype.$ajax = axios;
        var vm = new Vue({
            el: '#app2',
            data: {
                feeders: '',
                content: '',
                Time: '',
                keywords: '',
                list: []
            },
            created() {
                // 调用接口
                this.getFeedApi()
            },
            methods: {
                getFeedApi() {
                    axios({
                        method: 'get',
                        url: 'api/isFeedback.php',
                    }).then(result => {
                        var feeds = result.data.feeds;
                        var count = feeds.length;
                        for (i = 0; i < count; i++) {
                            feeders = feeds[i]['feeders'];
                            content = feeds[i]['content'];
                            Time = feeds[i]['Time'];
                            this.list.push({
                                feeders: feeders,
                                content: content,
                                Time: Time,
                            })
                        }
                    }).catch(err => {
                        console.log(err);
                        begin('数据获取失败 ●ω●')
                    })
                },
                search(keywords) {
                    return this.list.filter(item => {
                        if (item.content.includes(keywords)) {
                            begin('查询成功 ●ω●')
                            return item;
                        }else{
                            begin('未查询到该条记录 ●ω●')
                        }

                    })

                }
            }
        })
    </script>
</div>

<!--首页跳转-->
<script>
    $('.logo_sp').click(function () {
        window.location.href="index.php"
    })
</script>

<!--音乐播放-->
<!--<audio style="display:none; height: 0" id="bg-music" preload="auto" src="http://alihba.fun/love/music.mp3" loop="loop"></audio>-->

<!--关于我-->
<script type="text/javascript" src="js/about.js"></script>


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

