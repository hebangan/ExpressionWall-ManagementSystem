<?php
//设置json格式头部,并防止出现跨域问题
header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');
require_once ('../comm/conn.php');
mysqli_select_db($conn,"wish");
$sql="select * from feedback";
$result=mysqli_query($conn,$sql) or die('查询数据失败:'.mysqli_errno($conn));
$json = '';
$data = array();
class FB
{
    public $feeders;
    public $content;
    public $Time;
}
if($result){
    while ($row = mysqli_fetch_array($result,MYSQLI_BOTH))
    {
        $fb = new FB();
        $fb->feeders = $row["feeders"];
        $fb->content = $row["content"];
        $fb->Time = $row["Time"];
        $data[]=$fb;
    }
    $json = json_encode($data);//把数据转换为JSON数据.
    echo "{".'"code"'.":1,".'"feeds"'.":".$json."}";
    mysqli_close($conn);
}else{
    echo "{".'"code"'.":0,"."}";
}
?>
