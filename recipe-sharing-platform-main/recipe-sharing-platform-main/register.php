<?php include './connection.php' ?>
<?php session_start() ?>
<?php

$name = $email = $password = $target_dir = '';
$name_err = $email_err = $password_err = $confirm_password_err = 0;
if (isset($_POST['submit'])) {

    ///////////img handeling
    // Check if file was uploaded
    if (!empty($_FILES['upload']['name'])) {
        $file_name = $_FILES['upload']['name'];
        $file_tmp = $_FILES['upload']['tmp_name'];
        $target_dir = "upload/users/" . $file_name;
        move_uploaded_file($file_tmp, $target_dir);
    }
    //------ validate inputs
    (empty($_POST['name'])) ? $name_err = 1 : $name = $_POST['name'];
    (empty($_POST['password'])) ? $password_err = 1 : $password = $_POST['password'];
    (empty($_POST['email'])) ? $email_err = 1 : $email = $_POST['email'];
    (empty($_POST['confirmPassword']) || $_POST['confirmPassword'] != $_POST['password']) ? $confirm_password_err = 1 : $confirm_password = $_POST['confirmPassword'];

    //------ ensure email is unique
    $sql = "select * from users where Email = '$email' ";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!empty($user)) $email_err = 2;

    if (empty($user) && !$name_err && !$password_err && !$email_err &&  !$confirm_password_err) {

        $sql = "insert into users(Username, Email, Password, User_img) values ('$name', '$email', '$password','$target_dir')";

        if ($conn->query($sql) === TRUE) {

            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}




// $result = mysqli_query($conn , $sql);

// $users=mysqli_fetch_all($result, MYSQLI_ASSOC );

// var_dump($users);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Cokina</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/registeration.css">
    <link rel="stylesheet" href="./css/nav.css">
    <script src="https://kit.fontawesome.com/a74f5560d6.js" crossorigin="anonymous"></script>
    <script src="bootstrap/bootstrap.bundle.min.js" defer></script>
    <script src='./js/pic.js' defer></script>
</head>

<body>


    <!-- ////////////////nav//////////// -->
    <?php include './nav.php' ?>



    <div id="form" class=" container con col-lg-4 col-10 p-4 border shadow d-flex flex-column align-items-center ">
        <h2 class="mb-4">Registration Form</h2>
        <div class="img rounded-circle reg" id='imgContainer'>
            Add Picture
        </div>

        <form id="registrationForm" class="needs-validation w-100 " novalidate method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input id="imginput" type="file" accept="image/*" name="upload" style="display:none" />
            <div class="form-group has-validation ">
                <label for="fullName">User Name</label>
                <input type="text" class="form-control <?php echo ($name_err) ? 'is-invalid' : null; ?> " id="fullName" name="name" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback">
                    please enter fullName
                </div>
            </div>
            <div class="form-group">
                <label class="mt-3" for="email">Email</label>
                <input type="email" class="form-control <?php echo ($email_err == 1 || $email_err == 2) ? 'is-invalid' : null; ?>" id="email" name="email" value="<?php echo $email; ?>" required>
                <div class="invalid-feedback">
                    <?php if ($email_err == 1) echo "please enter valid email";
                    else if ($email_err == 2) echo 'This email already exist';
                    else echo null; ?>
                </div>
            </div>
            <div class="form-group">
                <label class="mt-3" for="password">Password</label>
                <input type="password" class="form-control <?php echo ($password_err) ? 'is-invalid' : null; ?>" id="password" name="password" required>
                <div class="invalid-feedback">
                    please enter valid password
                </div>
            </div>
            <div class="form-group">
                <label class="mt-3" for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control <?php echo ($confirm_password_err) ? 'is-invalid' : null; ?>" id="confirmPassword" name="confirmPassword" required>
                <div class="invalid-feedback confirming">
                    Please confirm the password
                </div>
            </div>


            <input type="submit" name="submit" class="btn mt-4 " value="Register">
        </form>
    </div>
    <?php include 'footer.php'?>



</body>

</html>