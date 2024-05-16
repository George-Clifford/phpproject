<?php
//Function to add two numbers
// function addNumbers($num1, $num2) {
//     $sum = $num1 + $num2;
//     return $sum;
// }

// // Define the numbers
// $number1 = 5;
// $number2 = 10;

// // Call the function to add the numbers
// $result = addNumbers($number1, $number2);

// echo "The sum of $number1 and $number2 is: $result";

//VARIABLES EAMPLE
// $deposit = 40000;
// $withdrawal = 5000;
// $balance = $deposit - $withdrawal;
// echo $balance;

//functions 
// function compute_balance($deposit,$withdrawal) {
//     return $deposit-$withdrawal;;
// }
// //calling the function
// echo compute_balance(40000,5000)

//var-dump function

//isset function
// $username = "John";
// if(isset($username)) {
//     echo "Username is set";
// }else{
//     echo "Username is not set";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <!-- Signup form -->
    <div class="container">
        <div class="form-header">
            <h1>Signup</h1>
        </div>
        <form action="process_signup.php" method="post">
            <div class="form-input">
                <input type="text" name="username" placeholder="Enter username">
            </div>
            <div class="form-input">
                <input type="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-input">
                <input type="password" name="password" placeholder="Enter password">
            </div>
            <div class="form-input">
                <input type="submit" name="signup" value="Signup">
            </div>
        </form>
    </div>
</body>
</html>