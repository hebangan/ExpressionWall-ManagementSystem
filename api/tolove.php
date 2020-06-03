<?php
if (isset($_POST['sender'])) {
    //从登录页接受来的数据
    $sender = $_POST['sender'];
    $content = $_POST['content'];
    //创建连接
    require_once('../comm/conn.php');
    mysqli_select_db($conn, "wish");
    $sql="INSERT INTO wisher(sender,content,likeCount) VALUES ('$sender','$content','0')";
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

