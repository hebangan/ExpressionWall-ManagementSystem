<?php

if (isset($_POST['feeders'])) {
    //从登录页接受来的数据
    $feeders = $_POST['feeders'];
    $content = $_POST['content'];
    //创建连接
    require_once('../comm/conn.php');
    mysqli_select_db($conn, "wish");
    $sql="INSERT INTO feedback(feeders,content) VALUES ('$feeders','$content')";
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
