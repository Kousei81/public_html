<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>mission_2-01</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment" value="コメント">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
    $str = $_POST["comment"];
    echo $str."を受け付けました";
    ?>
</body>
</html>