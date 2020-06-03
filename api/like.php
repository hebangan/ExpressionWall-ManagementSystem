<?php

if (isset($_POST['id'])) {
    //从登录页接受来的数据
    $id = $_POST['id'];
    $likeCount = $_POST['like'];
    //创建连接
    require_once('../comm/conn.php');
    mysqli_select_db($conn, "wish");
    $sql="UPDATE wisher SET likeCount = '$likeCount' WHERE id = '$id';";
    $result = mysqli_query($conn, $sql) or die('增加数据出错：' . mysqli_error($conn));
    if (!$result) {
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
