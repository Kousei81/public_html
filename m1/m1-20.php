<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>mission_1-20</title>
</head>
<body>
    <form action="#" method="post">
    <input type="text" name="comment">
    <input type="submit" name="submit" value="送信">
    </form>
    <?php
        $comment = $_POST["comment"];
        echo $comment;
    ?>
</body>
</html>