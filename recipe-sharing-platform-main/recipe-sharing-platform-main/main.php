<?php include './connection.php' ?>
<?php session_start() ?>
<?php

$name = $email = $message = '';
$name_err = $email_err = $message_err = '';
$succ = 0;
if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $name_err = 1;
        $succ = 0;
    } else $name = $_POST['name'];
    if (empty($_POST['message'])) {
        $message_err = 1;
        $succ = 0;
    } else $message = $_POST['message'];
    if (empty($_POST['email'])) {
        $email_err = 1;
        $succ = 0;
    } else $email = $_POST['email'];

    if (!$name_err && !$message_err && !$email_err) {


        $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $name, $email, $message);

        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        if ($stmt->execute()) {
            $succ = 1;
            header("Location: main.php#contact");
        } else {
            echo "Error: " . $stmt->error;
        }


        $stmt->close();
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title >Cokina</title>
    <link rel="icon" type="image/x-icon" href="./imges/ricesolid.svg">
    <!-- <i class="fa-solid fa-bowl-rice fs-5"></i> -->
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" href="./css/nav.css">
    <script src="https://kit.fontawesome.com/a74f5560d6.js" crossorigin="anonymous"></script>
    <script src="bootstrap/bootstrap.bundle.min.js" defer></script>
    <script src="js/nav.js" defer></script>
    <script src="js/clickCat.js" defer></script>


</head>

<body>
    <!-- ////////////////nav//////////// -->
    <?php include './nav.php' ?>



    <section class="home " id="home">
        <div class="container ">
            <img src="imges/young-pretty-woman-eating-pizza-pizza-bar.jpg">
            <div class="content">
                <div class=" col-lg-6">
                    <h2>Choose from a handreds of recipes </h2>
                    <p> Join us on a flavorful journey, where each recipe is a celebration of creativity,
                        culture, and the joy of sharing delicious moments around the table.</p>

                </div>

            </div>
        </div>

    </section>

    <section class="about" id="about">
        <div class="container d-flex flex-column align-items-center">
            <div class="up">
                <h2>what is <span class=" fw-normal" style="color:#FF702A"> Cokina </span>?</h2>
                <p class="col-lg-9">
                    " Cokina is your go-to destination for a world of flavors,
                    bringing together a diverse array of recipes to inspire your kitchen adventures.
                    From tantalizing appetizers to decadent desserts, our recipe website is a treasure trove of culinary inspiration,
                    catering to every taste and skill level. Whether you're a seasoned chef seeking new challenges or a kitchen novice exploring the joys of cooking,
                    our platform offers a rich tapestry of recipes, tips, and techniques to elevate your dining experience. Join us on a flavorful journey,
                    where each recipe is a celebration of creativity, culture,
                    and the joy of sharing delicious moments around the table. "

                </p>

            </div>
            
            
                        
                  

            <form action="recipes.php" class="col-12" method="post">      
            <h3 class="hdown">Our Catigory</h3>
            <div class="down col-12 d-flex flex-column align-items-center">
                <div class=" d-flex flex-column justify-content-center align-items-center col-12 flex-lg-row flex-md-row ">
                    <div class="card one mx-5">
                        <i class="fa-solid fa-bowl-food"></i>
                        <input class="nav-link" type="submit" name="Breakfast" value="Breakfast" hidden>
                        <h3>Breakfast</h3>
                    </div>
                    <div class=" card two  mx-5">
                        <i class="fa-solid fa-burger"></i>
                        <input class="nav-link" type="submit" name="Dinner" value="Dinner" hidden>
                        <h3>Dinner</h3>
                    </div>
                </div>

                <div class=" d-flex flex-column justify-content-center align-items-center col-12 flex-lg-row flex-md-row ">
                    <div class="card three  mx-5 ">
                        <i class="fa-solid fa-pizza-slice"></i>
                        <input class="nav-link" type="submit" name="Lunch" value="Lunch" hidden>
                        <h3>Lunch</h3>
                    </div>
                    <div class="card four  mx-5 ">
                        <i class="fa-solid fa-ice-cream"></i>
                        <input class="nav-link" type="submit" name="Dessert" value="Dessert" hidden>
                        <h3>Dessert</h3>
                    </div>
                </div>

            </div>
        </div>

        </form>
    </section>

    <section id='contact'>

        <div class="container">
            <h3>Contact Us</h3>
            <form class="has-validation" action='./main.php#contact' method="post">
                <div class="form-group">
                    <input class="bg-transparent text-white form-control <?php echo ($name_err) ? 'is-invalid' : null; ?>" type="text" placeholder="Enter your name" id="name" name='name' value="<?php echo $name ?>">
                    <div class="invalid-feedback">
                        <?php echo ($name_err) ? 'Please enter your name' : null; ?>
                    </div>
                </div>
                <div class='form-group'>
                    <input class="bg-transparent text-white form-control <?php echo ($email_err) ? 'is-invalid' : null; ?>" type="email" placeholder="Enter your email" id="email" name='email' value="<?php echo $email  ?>">
                    <div class="invalid-feedback">
                        <?php echo ($email_err) ? 'Please enter a valid email' : null; ?>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control text-white <?php echo ($message_err) ? 'is-invalid' : null; ?>" placeholder="Enter your message" name="message" id="text" cols="30" rows="10" style="resize: none;" value="<?php echo $message  ?>"></textarea>
                    <div class="invalid-feedback">
                        <?php echo ($message_err) ? 'Please enter your message' : null; ?>
                    </div>
                </div>



                <input type="submit" name="submit">

            </form>

        </div>
    </section>


    <?php include 'footer.php' ?>


</body>

</html>