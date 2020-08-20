<?php
//global variables
$id = '';
$username;
$email;
$phone;
$gender;
$role;
$password;
$confirmPassword;
$error = '';
$isDeactive;
$photo = '';
$editState = false;

function register($role): bool
{
    //delare variables as global
    global
        $username, $email, $phone, $gender, $password;
    //get post data
    getPostRequest();

    //check validation
    if (isValidFields()) {
        //hash password with md5
        $passwordhash = md5($password);
        $query = "insert into users
        (
            username,
            email,
            phone,
            gender,
            password,
            active,
            registeredDate,
            photo,
            isDeactive
            )
        values(
            '$username',
            '$email',
            '$phone',
            '$gender',
            '$passwordhash',
            1,
            now(),
            'user_img/default_profile.jpg',
            '$isDeactive'
            )";

        //insert to db
        //$_SESSION['userId'] = $user;
        $_SESSION['username'] = $username;
        $_SESSION['photo'] = 'user_img/default_profile.jpg';
        $takeIdQuery=mysqli_query($conn, "select * from users where username=$username and email=$email and phone=$phone and $gender=$gender and password=$passwordhash");
        $user = mysqli_fetch_object($takeIdQuery);
        $_SESSION['userId'] = $user->id;
        return post_db($query);
    }
    return false;
}

function getPostRequest()
{
    //delare variables as global
    global
        $username, $email, $phone, $gender,
        $password, $confirmPassword, $role, $id, $isDeactivated;

    //set global parameters with post values
    $id = $_POST["id"] ?? "";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];
    $isDeactivated = $_POST["isDeactivated"] ?? "no";
}

//common method for validating input fields
function isValidFields()
{
    global $password, $confirmPassword, $error, $editState;
    if (!$editState && $password == '') {
        $error = 'Password cannot be empty.';
        return false;
    }
    if (isUserNameDuplicate()) {
        $error = 'Username is already taken. ';
    }
    if (isEmailDuplicate()) {
        $error .= 'Email is already taken. ';
    }
    if (genderValid()){
        $error .= 'Invalid gender. ';
    }
    if ($password != '' && $password != $confirmPassword) {
        $error .= 'Password and confirm password did not match.';
    }
    if(($password != '' && $password != $confirmPassword) || isUserNameDuplicate() || isEmailDuplicate() || genderValid())
    {
        return false;
    }else{
        return true;
    }
}

function genderValid(){
    global $gender;
    if($gender=="none")
        return true;
    else
        return false;
}
//user name checker method
function isUserNameDuplicate()
{
    global $username, $editState, $id, $conn;
    $query = "select * from users where username='$username'";
    if ($editState) {
        $query .= " and id<>'$id'";
    }
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

//user name checker method
function isEmailDuplicate()
{
    global $email, $editState, $id, $conn;
    $query = "select * from users where email='$email'";
    if ($editState) {
        $query .= " and id<>'$id'";
    }
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function post_db($query): bool
{
    global $conn, $error;
    $result = mysqli_query($conn, $query);
    if ($result) {
        return true;
    } else {
        $error = mysqli_error($conn);
        return false;
    }
}
