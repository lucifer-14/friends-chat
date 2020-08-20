<?php
include "utilities/config.php";
include "utilities/helper.php";
include "utilities/registercommon.php";

if (isset($_POST["register"])) {
    $result = register('User');
    if ($result) {

        $_SESSION['userId'] = mysqli_insert_id($conn);;
        $_SESSION['role'] = 'User';
        header("location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register | Friends-Chat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/friends_chat_logo.jpg" sizes="128x128" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="logincomponent/css/util.css">
    <link rel="stylesheet" type="text/css" href="logincomponent/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="components/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(logincomponent/images/animescover1.jpg);">
                    <span class="login100-form-title-1" style="letter-spacing: 4px;">
                        Register
                    </span>
                </div>

                <form class="login100-form validate-form" action="register.php" method="POST">
                    <div class='text-danger'>
                        <?php
                        if ($error) : ?>
                            <div class='text-danger'>
                                <?php print_r($error) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Enter username" value="<?php echo $username ?? '' ?>" autocomplete="off" required>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Phone No</span>
                        <input class="input100" type="text" name="phone" placeholder="Enter phone number" value="<?php echo $phone ?? '' ?>" autocomplete="off" required>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Enter email" value="<?php echo $email ?? '' ?>" autocomplete="off" required>
                    </div>
                    <div class="wrap-input100-no-broder m-b-26">
                        <span class="label-input100">Gender</span>
                        <select name="gender" id="" class="form-control select2">
                            <option value="none" <?php echo getSelectedText($gender, "none") ?>>-Select Gender-</option>
                            <option value="Male" <?php echo getSelectedText($gender, "Male") ?>>Male</option>
                            <option value="Female" <?php echo getSelectedText($gender, "Female") ?>>Female</option>
                            <option value="Other" <?php echo getSelectedText($gender, "Other") ?>>Other</option>
                        </select>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password" autocomplete="off" required>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Confirm Password</span>
                        <input class="input100" type="password" name="confirmpassword" placeholder="Enter confirm password" autocomplete="off" required>
                    </div>

                    <div class="row" style=" width:100%">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <a href="login.php?url=<?php echo str_replace("url=","",$_SERVER["QUERY_STRING"])?>" class="login100-form-btn bg-danger">
                                    Cancel
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <button class="login100-form-btn" type="submit" name="register">
                                    Register
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php?>
</body>

</html>
