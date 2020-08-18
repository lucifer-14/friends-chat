<?php
//delcare global error vairable
$error = '';


function validateRecovery($username, $default_url, $isAdmin)
{
    global $conn, $error;

    $isExist = true;
    if ($isAdmin) {
        $query = "select * from users where username='$username' and role='Admin'";
    }else{
    //make default query
        $query = "select * from users where (username='$username' or email='$username') and role='User'";
    }
    $resultQuery = mysqli_query($conn, $query);
    //check username is exist or not
    if (mysqli_num_rows($resultQuery) == 0) {
        $error = "This username or email does not exist.";
        $isExist = false;
    }

    //is user is exist
    if ($isExist) {
        
        //take authentication
        $auth = mysqli_query($conn, $query);
        if (mysqli_num_rows($auth) == 1) {

            $_SESSION['temp']=$username;

            //handle fall back url 
            header("location:$default_url");
        } else {
            $error = 'Invalid password.';
        }
    }
}



function validateUser($username, $password, $default_url, $isAdmin)
{
    global $conn, $error;

    $isExist = true;
    $passwordhash = md5($password);
    //make default query
    $query = "select * from users where password='$passwordhash' and (username='$username' or email='$username')";
    $resultQuery = mysqli_query($conn, $query);
    //check username is exist or not
    if (mysqli_num_rows($resultQuery) == 0) {
        $error = "This account does not exist.";
        $isExist = false;
    }

    //is user is exist
    if ($isExist) {

        //take authentication
        $auth = mysqli_query($conn, $query);
        if (mysqli_num_rows($auth) == 1) {
            $user = mysqli_fetch_assoc($auth);

            //store user's data in session
            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['photo'] = $user['photo'];

            //handle fall back url 
            $redirectUrl = $_POST['url'];

            header("location:$default_url");
        }
    }
}
