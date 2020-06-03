<?php

if (isset($_POST['id'])) {
    file_get_contents("php://input");
    error_reporting(0);//加上error_reporting(0);就不会弹出警告了
    //json头
    header("Content-type: application/json");
    //跨域
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: *");
    //CORS
    header("Access-Control-Request-Methods:GET, POST, PUT, DELETE, OPTIONS");
    header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid');
    //从登录页接受来的数据
    $id = $_POST['id'];
    //创建连接
    require_once('../comm/conn.php');
    mysqli_select_db($conn, "wish");
    $sql = "DELETE FROM wisher WHERE id='$id';";
    $result = mysqli_query($conn, $sql) or die('增加数据出错：' . mysqli_error($conn));
    if (!$result) {
        //      删除失败
        echo "{".'"code"'.":0,".'"status"'.":"."0"."}";
        die();
    } else {
        echo "{".'"code"'.":1,".'"status"'.":"."1"."}";
    }
    exit();
} else {
    echo "{".'"code"'.":0,".'"status"'.":"."0"."}";
}

?>
