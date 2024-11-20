<?php include './connection.php' ?>
<?php session_start() ?>

<?php



// header('Content-Type: application/json');
// echo json_encode($recipes);
// exit();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Cokina</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" href="./css/nav.css">
    <script src="https://kit.fontawesome.com/a74f5560d6.js" crossorigin="anonymous"></script>
    <script src="bootstrap/bootstrap.bundle.min.js" defer></script>
    <script src="./js/search.js" defer></script>
    <script src="js/nav.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

</head>

<body>
    <?php include './nav.php'; ?>

    <section class="h-100 mt-5 d-flex" id="recipe">

        <!-- <div class="col-2 container mt-5 bg-danger">

            </div> -->


        <div class=" container py-5 h-100 mt-5  d-flex justify-content-center align-items-center h-100 ">


            <div class="card rounded-3overflow-hidden w-100 ps-lg-4 " style="min-height: 26em;">


                <section id="recipes" class="card-body p-4 text-black">

                    <?php if (!isset($_POST['Breakfast']) && !isset($_POST['Lunch']) && !isset($_POST['Dinner']) && !isset($_POST['Dessert']) ) { ?>
                        <div class="d-flex justify-content-center align-items-center mt-5">
                            <p class="lead fw-normal fs-3 fw-bold mb-3"><?php echo (isset($_POST['search']))?"Search Results":"Recipes"?> </p>
                        </div>

                        <div class="row justify-content-center justify-content-lg-start ps-lg-3 m-auto ">

                            <?php


                            if (isset($_POST['search'])) {
                                $searchQuery = $_POST['searchItems'];
                                $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
                            FROM recipes
                            JOIN categories ON recipes.cat_id = categories.id
                            JOIN users ON recipes.user_id = users.id
                            WHERE recipes.name LIKE '%" . $searchQuery . "%'
                            ORDER BY recipes.date DESC";

                                $result = mysqli_query($conn, $sql);
                                $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            } else {

                                $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
                            FROM recipes
                            JOIN categories ON recipes.cat_id = categories.id
                            JOIN users ON recipes.user_id = users.id
                            ORDER BY recipes.date DESC";

                                $result = mysqli_query($conn, $sql);
                                $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            }
                            foreach ($recipes as $recipe) {

                                echo '
                                <div class="mb-3 mx-2 card p-0" style="width: 17rem;" id="' . $recipe['id'] . '">
                                    <div style="height: 12rem;">
                                        <img src="' . $recipe['img'] . '" alt="' . $recipe['name'] . '" class="w-100 rounded-2">
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="card-title">' . $recipe['name'] . '</h4>
                                        <h6 class="">' . $recipe['category_name'] . '</h6>
                                        <p class="" style = "margin-top: 0em"> by ' . $recipe['user_name'] . '</p>

                                        <form class="d-flex justify-content-center" method="post" enctype="multipart/form-data" method="post">
                                            <input type="number" name="rec-id"  hidden value=' . $recipe['id'] . '>
                                            <input type="submit" formaction="details.php" class="btn " style="background-color:#FF702A ; color : white ;"  value="details" name="details">
                                        </form>
                                        
                                    </div>
                                </div>

                                ';
                            }

                            ?>


                        </div>

                </section>
            <?php } ?>

            <?php if (isset($_POST['Breakfast'])) { ?>
                <section id="breakfast" class="card-body p-4 text-black">

                    <div class="d-flex justify-content-center align-items-center mt-5">
                        <p class="lead fw-normal fs-3 fw-bold mb-3">Breakfast Recipes</p>
                    </div>

                    <div class="row justify-content-center justify-content-lg-start ps-lg-3 m-auto ">

                        <?php

                        $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
                        FROM recipes
                        JOIN categories ON recipes.cat_id = categories.id
                        JOIN users ON recipes.user_id = users.id
                        WHERE  recipes.cat_id = 1
                        ORDER BY recipes.date DESC";

                        $result = mysqli_query($conn, $sql);
                        $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // }
                        foreach ($recipes as $recipe) {

                            echo '
            <div class="mb-3 mx-2 card p-0" style="width: 17rem;" id="' . $recipe['id'] . '">
                <div style="height: 12rem;">
                    <img src="' . $recipe['img'] . '" alt="' . $recipe['name'] . '" class="w-100 rounded-2">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">' . $recipe['name'] . '</h4>
                    <h6 class="">' . $recipe['category_name'] . '</h6>
                    <p class="" style = "margin-top: 0em"> by ' . $recipe['user_name'] . '</p>

                    <form class="d-flex justify-content-center" method="post" enctype="multipart/form-data" method="post">
                        <input type="number" name="rec-id"  hidden value=' . $recipe['id'] . '>
                        <input type="submit" formaction="details.php" class="btn " style="background-color:#FF702A ; color : white ;"  value="details" name="details">
                    </form>
                    
                </div>
            </div>

            ';
                        }

                        ?>




                    </div>

                </section>

            <?php } ?>

            <?php if (isset($_POST['Lunch'])) { ?>

                <section id="lunch" class="card-body p-4 text-black">

                    <div class="d-flex justify-content-center align-items-center mt-5">
                        <p class="lead fw-normal fs-3 fw-bold mb-3">Lunch Recipes</p>
                    </div>

                    <div class="row justify-content-center justify-content-lg-start ps-lg-3 m-auto ">

                        <?php



                        $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
        FROM recipes
        JOIN categories ON recipes.cat_id = categories.id
        JOIN users ON recipes.user_id = users.id
        WHERE  recipes.cat_id = 2
        ORDER BY recipes.date DESC";

                        $result = mysqli_query($conn, $sql);
                        $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // }
                        foreach ($recipes as $recipe) {

                            echo '
            <div class="mb-3 mx-2 card p-0" style="width: 17rem;" id="' . $recipe['id'] . '">
                <div style="height: 12rem;">
                    <img src="' . $recipe['img'] . '" alt="' . $recipe['name'] . '" class="w-100 rounded-2">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">' . $recipe['name'] . '</h4>
                    <h6 class="">' . $recipe['category_name'] . '</h6>
                    <p class="" style = "margin-top: 0em"> by ' . $recipe['user_name'] . '</p>

                    <form class="d-flex justify-content-center" method="post" enctype="multipart/form-data" method="post">
                        <input type="number" name="rec-id"  hidden value=' . $recipe['id'] . '>
                        <input type="submit" formaction="details.php" class="btn " style="background-color:#FF702A ; color : white ;"  value="details" name="details">
                    </form>
                    
                </div>
            </div>

            ';
                        }

                        ?>


                    </div>

                </section>
            <?php } ?>

            <?php if (isset($_POST['Dinner'])) { ?>

                <section id="dinner" class="card-body p-4 text-black">

                    <div class="d-flex justify-content-center align-items-center mt-5">
                        <p class="lead fw-normal fs-3 fw-bold mb-3">Dinner Recipes</p>
                    </div>

                    <div class="row justify-content-center justify-content-lg-start ps-lg-3 m-auto ">

                        <?php




                        $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
                        FROM recipes
                        JOIN categories ON recipes.cat_id = categories.id
                        JOIN users ON recipes.user_id = users.id
                        WHERE  recipes.cat_id = 3
                        ORDER BY recipes.date DESC";

                        $result = mysqli_query($conn, $sql);
                        $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // }
                        foreach ($recipes as $recipe) {

                            echo '
            <div class="mb-3 mx-2 card p-0" style="width: 17rem;" id="' . $recipe['id'] . '">
                <div style="height: 12rem;">
                    <img src="' . $recipe['img'] . '" alt="' . $recipe['name'] . '" class="w-100 rounded-2">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">' . $recipe['name'] . '</h4>
                    <h6 class="">' . $recipe['category_name'] . '</h6>
                    <p class="" style = "margin-top: 0em"> by ' . $recipe['user_name'] . '</p>

                    <form class="d-flex justify-content-center" method="post" enctype="multipart/form-data" method="post">
                        <input type="number" name="rec-id"  hidden value=' . $recipe['id'] . '>
                        <input type="submit" formaction="details.php" class="btn " style="background-color:#FF702A ; color : white ;"  value="details" name="details">
                    </form>
                    
                </div>
            </div>

            ';
                        }

                        ?>



                    </div>

                </section>
            <?php } ?>


            <?php if (isset($_POST['Dessert'])) { ?>

                <section id="dessert" class="card-body p-4 text-black">

                    <div class="d-flex justify-content-center align-items-center mt-5">
                        <p class="lead fw-normal fs-3 fw-bold mb-3">Dessert Recipes</p>
                    </div>

                    <div class="row justify-content-center justify-content-lg-start ps-lg-3 m-auto ">

                        <?php



                        $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
                        FROM recipes
                        JOIN categories ON recipes.cat_id = categories.id
                        JOIN users ON recipes.user_id = users.id
                        WHERE  recipes.cat_id = 4
                        ORDER BY recipes.date DESC";

                        $result = mysqli_query($conn, $sql);
                        $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // }
                        foreach ($recipes as $recipe) {

                            echo '
            <div class="mb-3 mx-2 card p-0" style="width: 17rem;" id="' . $recipe['id'] . '">
                <div style="height: 12rem;">
                    <img src="' . $recipe['img'] . '" alt="' . $recipe['name'] . '" class="w-100 rounded-2">
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title">' . $recipe['name'] . '</h4>
                    <h6 class="">' . $recipe['category_name'] . '</h6>
                    <p class="" style = "margin-top: 0em"> by ' . $recipe['user_name'] . '</p>

                    <form class="d-flex justify-content-center" method="post" enctype="multipart/form-data" method="post">
                        <input type="number" name="rec-id"  hidden value=' . $recipe['id'] . '>
                        <input type="submit" formaction="details.php" class="btn " style="background-color:#FF702A ; color : white ;"  value="details" name="details">
                    </form>
                    
                </div>
            </div>

            ';
                        }

                        ?>


                    </div>

                </section>
            <?php } ?>
            </div>

        </div>

    </section>

    <?php include 'footer.php' ?>



</body>

</html>