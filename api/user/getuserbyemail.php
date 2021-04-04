<?php

include_once "../Database.php";
include_once "../User.php";

header('Content-Type: application/json');

$result = array();

if (!isset($_POST['email']) || empty($_POST['email'])){
    $result['message'] = 'ERROR: email is not set or empty.';
    http_response_code(400);
} else {
    $email = $_POST['email'];

    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $user = new User();

    if ($user->getuserbyemail($db_con, $email)){
        $result['message'] = 'SUCCESS.';
        $result['user'] = array(
            'uid' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
            'profile_img' => $user->profile_img,
            'created_on' => $user->created_on,
            'admin' => $user->admin,
            'enabled' => $user->enabled
        );
        http_response_code(200);
    } else {
        http_response_code(404);
        $result['message'] = 'ERROR: No user with the specified email found.';
    }
}

print_r(json_encode($result));

?>