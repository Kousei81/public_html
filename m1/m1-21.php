<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>mission_1-20</title>
</head>
<body>
    <form action="#" method="post">
    <input type="text" name="number">
    <input type="submit" name="submit" value="送信">
    </form>
    <?php
        $number = $_POST["number"];
        if($number % 3 === 0 && $number % 5 === 0) {
            echo "FizzBuzz";
        } else if($number % 3 === 0) {
            echo "Fizz";
        } else if($number % 5 === 0) {
            echo "Buzz";
        } else {
            echo $number;
        }
    ?>
</body>
</html>