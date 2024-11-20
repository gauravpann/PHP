<?php include './connection.php' ?>
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Cokina</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/media.css">
    
    <script src="https://kit.fontawesome.com/a74f5560d6.js" crossorigin="anonymous"></script>
    <!-- <script src="bootstrap/bootstrap.bundle.min.js" defer></script> -->
    <script src="./js/delete.js" defer></script>

</head>

<body>
    <?php include './nav.php'; ?>
    <?php if (isset($_SESSION['id'])) { ?>
        <section class="h-100 mt-5 ">

            <div class="  container py-5 h-100 mt-5  d-flex justify-content-center align-items-center h-100 ">

                <div class="card rounded-3overflow-hidden w-100 ">

                    <div class="text-white d-flex flex-row align-items-center " style="background-color: #28243a;">
                        <div class="ms-4 my-3 d-flex rounded-4 rounded-pill justify-content-center align-items-center fs-1 overflow-hidden" style="width:5em;height:5em;">

                            <?php if ($_SESSION['img']) { ?>
                                <img src=<?php echo $_SESSION['img']; ?> alt="image">
                            <?php } else { ?>
                                <i class="fa-solid fa-user"></i>
                                <!-- <img src="./imges/user-solid.svg" alt=""/> -->
                            <?php } ?>

                        </div>
                        <div class="ms-3">
                            <h5> <?php echo $_SESSION['name']; ?></h5>
                            <p>Email: <?php echo $_SESSION['email']; ?> </p>
                            <a href="./addrecipe.php" class="btn" style="z-index: 1;color:#fff;background-color:#FF702A">
                                Add recipe
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4 my-5 text-black">

                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <p class="lead fw-normal fs-3 fw-bold mb-3">Recipes</p>
                        </div>

                        <div class="row justify-content-center justify-content-lg-start ps-lg-3 m-auto mt-2">

                            <?php

                            $user_id = $_SESSION['id'];
                            $sql = "SELECT recipes.*, categories.name AS category_name
                            FROM recipes
                            JOIN categories ON recipes.cat_id = categories.id
                            WHERE recipes.user_id = '$user_id'
                            ORDER BY recipes.date DESC";

                            $result = mysqli_query($conn, $sql);
                            $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);


                            foreach ($recipes as $recipe) {

                                echo '
                                <div class="mb-3 mx-2 card p-0" style="width: 18rem;" id="' . $recipe['id'] . '">
                                    <div style="height: 12rem;">
                                    <button onclick="confirmDelete(' . $recipe['id'] . ')" class="border-0 position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-regular fa-trash-can fs-4 text-white" style="z-index:2 ; position: absolute; top:.5em ; right:.5em "></i>
                                    </button>
                                        <img src="' . $recipe['img'] . '" alt="' . $recipe['name'] . '" class="w-100 rounded-2">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">' . $recipe['name'] . '</h5>
                                        <p class="card-text">' . $recipe['category_name'] . '</p>
                                        <form class="d-flex justify-content-center" enctype="multipart/form-data" method="post">
                                        
                                            <input type="number" name="rec-id"  hidden value=' . $recipe['id'] . '>
                                            
                                            <input type="submit" formaction="details.php" class="btn  me-3" style="background-color:#FF702A ; color : white ;"  value="details" name="details">
                                            <input type="submit" formaction="addrecipe.php" class="btn" style="border:1px solid #FF702A ; color :  #FF702A ;" value="update" name="update">
                                        </form>
                                        
                                    </div>
                                </div>

                                ';
                            }

                            ?>

            

                        </div>

                    </div>
                </div>

            </div>

        </section>

    <?php } else { ?>



        <section class="page_404">
            <div class="container">


                <div class="col-sm-10 text-center m-auto">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>


                    </div>

                    <div class="contant_box_404">
                        <h3 class="h2">
                            Look like you're lost
                        </h3>

                        <p>the page you are looking for not avaible!</p>

                        <a href="./main.php" class="btn" style="background-color: #FF702A; color :white" >Go to Home</a>
                    </div>

                </div>

            </div>
        </section>
    <?php } ?>
    <?php include 'footer.php'?>
</body>

</html>

