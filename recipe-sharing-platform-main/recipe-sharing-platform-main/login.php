<?php include './connection.php' ?>
<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Cokina</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/registeration.css">
    <link rel="stylesheet" href="./css/media.css">
    <script src="https://kit.fontawesome.com/a74f5560d6.js" crossorigin="anonymous"></script>
    <script src="bootstrap/bootstrap.bundle.min.js" defer></script>
    <script src="js/nav.js" defer></script>



</head>



<body>


    <!-- ////////////////nav//////////// -->
    <?php include './nav.php' ?>

    <!-- ////////////validation ///////////////////////-->
    <?php

$email = $password = '';
$password_err = $email_err = 0;

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "select * from users where Email = '$email' ";
    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!empty($user)) {
        if ($user[0]['Password'] == $password) {

            $_SESSION['name'] = $user[0]['Username'];
            $_SESSION['id'] = $user[0]['id'];
            $_SESSION['email'] = $user[0]['Email'];
            $_SESSION['img'] = $user[0]['User_img'];

            header("Location: main.php");
            exit();
        } else $password_err = 1;
    } else {
        $email_err = 1;
    }

    if ($email == '' && $password == '') {
        $email_err = 1;
        $password_err = 1;
    }
}

?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->
<section ></section>
    <section id="login" class="con d-flex justify-content-center align-items-center" style="height: 86.3vh;"    >

        <form id="form" class="border p-3 shadow has-validation container col-lg-6 col-11 rounded-4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <h3 class="text-center">login</h3>
            <div>
                <label class="form-label" for="email">Email</label>
                <input class="form-control <?php echo ($email_err) ? 'is-invalid' : null; ?>" type="email" name="email" id="email" value="<?php echo $email  ?>">
                <div class="invalid-feedback">
                    please enter valid email
                </div>
            </div>
            <div class=" mt-3">

                <label class="form-label" for="password">Password</label>
                <input class="form-control <?php echo ($password_err) ? 'is-invalid' : null; ?>" type="password" name="password" id="password">
                <div class="invalid-feedback">
                    please enter valid password
                </div>
            </div>

            <a href="./register.php" class=" d-inline-block my-3">I don't have an account </a>

            <div class="d-flex justify-content-end ">
                <input class="d-block btn mt-3" type="submit" name='submit' value="Login">
            </div>


        </form>

    </section>
    <?php include 'footer.php'?>
</body>

</html>