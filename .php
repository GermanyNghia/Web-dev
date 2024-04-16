<?php
session_start();
header("Location: welcome");
include("html/footer.html");
echo "<br>";
$name = "nghia";
$age = 20;

$strenght = 23.33;
$date = date("l");

echo "Today is $date <br>";
echo "Hello {$name} <br>";
echo "Your are {$age} <br>";
echo "Your power is: {$strenght} <br>";

echo "I like pizza and pasta <br> ";
echo "What do u like? <br>";
$arr = array($date, $name, $age);

foreach ($arr as $chain) {
    echo $chain . ", ";
}
echo "<br>";
//This is a comment
/*This
is
a 
multiline
comment
*/

//Arithmethic operators

$a = 3;
$b = 6;

echo $a + $b;
echo $a - $b;
echo $a * $b;
echo $a / $b;
echo $a ** $b; //pow
echo $a % $b;

printf("\nHello\n");
//Increment/Decrement operators

$a++;
echo $a;
$b--;
echo $b;
$a += 2;
echo "{$a} <br>";

// array
$fruit = array(1 => "apple", 2 => "pearl", 3 => "orange", 5 => "pineaplle");

// echo $fruit[2];

// foreach ($fruit as $num => $value) {
//     echo "$num = $value <br>";
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <h1>Đăng Nhập</h1>

    <form action="index.php" method="post">
        <label>username:</label> <br>
        <input type="text" name="username"> <br>
        <label>password:</label> <br>
        <input type="password" name="password"> <br>
        <input type="submit" value="Log in" name="login"> <br>
    </form> -->
    <!-- <form action="index.php" method="post">
        <label>x:</label> <br>
        <input type="number" name="x"> <br>
        <label>y:</label> <br>
        <input type="number" name="y"> <br> 
        <input type="submit" value="total"> <br>
    </form>  -->
    <!-- <form action="index.php" method="post">
        <label>n:</label> <br>
        <input type="number" name="n"> <br>
        <input type="submit" value="total"> <br>
    </form> -->
    <!-- <form action="index.php" method="post">
        <label>Enter a fruit:</label> <br>
        <input type="text" name="fruit"> <br>
        <input type="submit" value="total"> <br>
    </form> -->
    <!-- <form action="index.php" method="post">
        <input type="radio" name="student" value="K18">
        K18 <br>
        <input type="radio" name="student" value="K17">
        K17 <br>
        <input type="radio" name="student" value="K16">
        K16 <br>
        <input type="radio" name="student" value="K15">
        K15 <br>
        <input type="submit" name="confirm" value="confirm">
        <br>
    </form> -->
    <!-- <form action="index.php" method="post">
        <input type="checkbox" name="foods[]" value="Pizza">
        Pizza <br>
        <input type="checkbox" name="foods[]" value="Hamburger">
        Hamburger <br>
        <input type="checkbox" name="foods[]" value="Pasta">
        Pasta" <br>
        <input type="checkbox" name="foods[]" value="KFC">
        KFC <br>
        <input type="submit" name="submit" value="submit">
        <br>
    </form> -->

    <script>src = "index.js" </script>
</body>

</html>

<?php


// if (isset($_POST["login"])) {

//     $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
//     $password =filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

//     if (empty($username)|| empty($password)) {
//         echo '<span style="color:red;">Username or password is empty</span>';
//     } else
//         echo "Welcome {$username}";
// } else {
//     echo "Please enter your username and password";
// }



// if ($_POST["x"] == null)
// return false;
// else
// $x = $_POST["x"];

// if ($_POST["y"] == null)
// return false;
// else
// $y = $_POST["y"];


// $total = null;

// $total = abs($x + $y);

// echo $total;

// $n = $_POST["n"];
// $total = 0;

// for ($i = 1; $i <= $n; $i++) {

//     $total += $i;
// }
// echo "<br>";
// echo $total;

// $fruit2 = array_flip($fruit);

// $number = $fruit2[$_POST["fruit"]];


// echo "There are {$fruit2[$_POST["fruit"]]} of {$_POST["fruit"]}";

// if (isset($_POST["confirm"])){

//     $student = null;
//     if (isset($_POST["student"])) {
//         $student = $_POST["student"];
//     }
//     switch ($student) {
//         case "K18":
//             echo "You are $student";
//             break;
//         case "K17":
//             echo "You are $student";
//             break;
//         case "K16":
//             echo "You are $student";
//             break;
//         case "K15":
//             echo "You are $student";
//             break;
//         default:
//         echo "Plese select an option";
//     }
// }

// if (isset($_POST["submit"])) {
//     if (isset($_POST["foods"])) {
//         $foods = $_POST["foods"];
//         foreach ($foods as $food) {
//             echo $food . "<br>";
//         }
//     }
// }

// $phonenumber = "123-456-789";
// $name = "II.Mastet Bait";
// $names = array("Alex", "Bob", "Cindy");
// $name0 = implode($names);
// $fullname = explode(".", $name);
// echo str_replace("-", " ", $phonenumber). "<br>";
// echo strrev($name). "<br>";
// echo str_shuffle($name). "<br>";
// echo strcmp($name, "Mastet Bait") . "<br>";
// foreach ($fullname as $name1){
//     echo $name1 . " ";
// }
// echo $name0;

// $int = 0;

// try{
//     if($int == 0){
//         throw new Exception("Error");
//     }else
//     echo "ok";

// }catch (Exception $e){
// echo $e -> getMessage();
// }
foreach($_SERVER as $key => $value){
    echo "$key = $value". "<br>";
}
?>