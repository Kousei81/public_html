<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>mission_1-27</title>
</head>
<body>
    <form action="#" method="post">
    <input type="text" name="number">
    <input type="submit" name="submit" value="送信">
    </form>
    <?php   
    $num = $_POST["number"];
    $filename = "mission_1-27.txt";
    $fp = fopen($filename, "a");
    fwrite($fp, $num.PHP_EOL);
    fclose($fp);
    echo "書き込み成功！<br>";
    if(file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line) {
            if($line % 3 === 0 && $line % 5 === 0) {
                echo "FizzBuzz<br>";
            } else if($line % 3 === 0) {
                echo "Fizz<br>";
            } else if($line % 5 === 0) {
                echo "Buzz<br>";
            } else {
                echo $line."<br>";
            }
        }
    }
    //PHP_EOLがないと改行されないので、file関数を使用したとき、1行ずつ行う数値の読み込みがおかしなことになってしまう。
    //FILE_SKIP_EMPTY_LINESを使いたいときは必ず、一緒にFILE_IGNORE_NEW_LINESを使う。
    //file関数を使うときは基本的にFILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINESは必要。
    ?>
</body>
</html>

