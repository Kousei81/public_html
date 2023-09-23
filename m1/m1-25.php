<?php
$str = "Hello World";
$filename = "misson_1-25.txt";
$fp = fopen($filename, "a");
fwrite($fp, $str.PHP_EOL);
fclose($fp);
echo "書き込み完了！";
//wは既存の内容を上書きする。aは既存の内容に追記する。
//fopenで作ったファイルは自分が書いているプログラムのファイルと同じ層に作られる。
//ファイルがない場合、aは新規作成して、wはエラーが起こる。
?>