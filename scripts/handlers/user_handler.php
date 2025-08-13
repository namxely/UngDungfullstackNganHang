<?php
    require "../models/users.php";
    require "../connect.php";

    $user = new Users();

    $user_action = isset($_GET['user_action']) ? $_GET['user_action'] : '';

    $user->account_id = isset($_POST[$user::ACCOUNT_ID]) ? $_POST[$user::ACCOUNT_ID] : '';
    $user->first_name = isset($_POST[$user::FIRST_NAME]) ? $_POST[$user::FIRST_NAME] : '';
    $user->last_name = isset($_POST[$user::LAST_NAME]) ? $_POST[$user::LAST_NAME] : '';
    $user->password = isset($_POST[$user::PASSWORD]) ? $_POST[$user::PASSWORD] : '';
    $user->address = isset($_POST[$user::ADDRESS]) ? $_POST[$user::ADDRESS] : '';
    $user->pesel = isset($_POST[$user::PESEL]) ? $_POST[$user::PESEL] : '';
    $user->email = isset($_POST[$user::EMAIL]) ? $_POST[$user::EMAIL] : '';
    $user->balance = isset($_POST[$user::BALANCE]) ? $_POST[$user::BALANCE] : '';
    $user->role_id = isset($_POST[$user::ROLE_ID]) ? $_POST[$user::ROLE_ID] : '';
    $user->account_number = isset($_POST[$user::ACCOUNT_NUMBER]) ? $_POST[$user::ACCOUNT_NUMBER] : '';
    $user->phone_number = isset($_POST[$user::PHONE_NUMBER]) ? $_POST[$user::PHONE_NUMBER] : '';

    switch($user_action) 
    {
        case 'l':
            user_login_handle($conn, $user);
            break;

        case 'r':
            user_register_handle($conn, $user);
            break;
    }

    function user_login_handle($conn, $user)
    {
        $user->login($conn);
    }

    function user_register_handle($conn, $user)
    {   
        $user->register($conn);
    }
?>