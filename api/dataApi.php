<?php
    //设置json格式头部,并防止出现跨域问题
    header('Access-Control-Allow-Origin:*');
    header('Content-type: application/json');
    require_once ('../comm/conn.php');
    mysqli_select_db($conn,"wish");
    $sql="select * from wisher";
    $result=mysqli_query($conn,$sql) or die('查询数据失败:'.mysqli_errno($conn));
    $json = '';
    $data = array();
    class Note
    {
        public $id;
        public $content;
        public $sender;
        public $likeCount;
        public $time;
    }
    if($result){
        while ($row = mysqli_fetch_array($result,MYSQLI_BOTH))
        {
            $note = new Note();
            $note->id = $row["id"];
            $note->content = $row["content"];
            $note->sender = $row["sender"];
            $note->likeCount = $row["likeCount"];
            $note->time = $row["time"];
            $data[]=$note;
        }
        $json = json_encode($data);//把数据转换为JSON数据.
        echo "{".'"code"'.":1,".'"note"'.":".$json."}";
        mysqli_close($conn);
    }else{
        echo "{".'"code"'.":0,"."}";
    }
?>
