<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>mission_3-01</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" value="名前">
        <input type="text" name="comment" value="コメント">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
    if(!empty($_POST["name"]) && !empty($_POST["comment"])) {
        $filename = "mission_3-1.txt";
        if (file_exists($filename)) {
            $num = count(file($filename))+1;
        } else {
            $num = 1;
        }
        $name = $_POST["name"];
        $str = $_POST["comment"];
        $time = date("Y/m/d H:i:s");
        $post = $num."<>".$name."<>".$str."<>".$time;
        $fp = fopen($filename, "a");
        fwrite($fp, $post.PHP_EOL);
        fclose($fp);
    }
    ?>
</body>
</html>