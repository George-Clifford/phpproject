<?php
//indeXed arrays
// $counties = array("Nairobi", "Mombasa", "Kisumu");

// var_dump($counties)
// echo $counties[2];

//indeXed loops
// foreach ($counties as $county) {
//     echo $county;
// };

//associative array
$user_input = array ("username" => "John", "email" => "john@gmail.com", "password" => "1234");
//var_dump($user_input);
echo $user_input['username']
foreach ($user_input as $key => $value) {
    echo $value . ", " .;
};
?>