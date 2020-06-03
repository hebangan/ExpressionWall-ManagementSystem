<?php

if (isset($_POST['zh'])) {
        //从登录页接受来的数据
        $name = $_POST['zh'];
        $pwd = $_POST['pwd'];
        $role = $_POST['role'];
        //创建连接
        require_once('../comm/conn.php');
        mysqli_select_db($conn, "wish");
        if ($role==0){
//            普通用户登入
            $sql = "select zh,pwd from ordinary  where  zh='{$name}'  AND pwd='{$pwd}' ;";
            $result = mysqli_query($conn, $sql) or die('查询数据出错：' . mysqli_error($conn));
            $row = mysqli_num_rows($result);
            if (!$row) {
                echo "{".'"code"'.":0,".'"status"'.":"."0"."}";
                die();
            } else {
                echo "{".'"code"'.":1,".'"status"'.":"."1"."}";
            }
            exit();
        }else{
//            VIP用户登入
            $sql = "select zh,pwd from vip  where  zh='{$name}'  AND pwd='{$pwd}' ;";
            $result = mysqli_query($conn, $sql) or die('查询数据出错：' . mysqli_error($conn));
            $row = mysqli_num_rows($result);
            if (!$row) {
                echo "{".'"code"'.":0,".'"status"'.":"."0"."}";
                die();
            } else {
                echo "{".'"code"'.":1,".'"status"'.":"."1"."}";
            }
            exit();
        }

} else {
    echo "{".'"code"'.":0,".'"status"'.":"."0"."}";
}

?>
