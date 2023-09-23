<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>mission_2-04</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment" value="コメント">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
    $filename = "mission_2-4.txt";
    if(!empty($_POST["comment"])) {
        $str = $_POST["comment"];
        echo $str."を受け付けました<br>";
        $fp = fopen($filename, "a");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
    }
    
    if(file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach($lines as $line) {
                if($line === "完成！") {
                    echo "おめでとう！<br>";
                } else {
                    echo $line."<br>";
                }
            }    
    }
    //??は式の結果がNullの場合は右辺、そうでない場合は左辺を返す演算子です。
    //if文でnullのとき、""を返すとかでもいいと思う。
    ?>
</body>
</html>