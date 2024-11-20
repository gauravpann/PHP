<?php include './connection.php' ?>
<?php session_start() ?>

<?php
$rec_id = 0;
$recipe = 0;


    if (isset($_POST['details'])){
    
        $sql = "SELECT recipes.* , categories.name AS category_name , users.Username AS user_name
        FROM recipes
        JOIN categories ON recipes.cat_id = categories.id
        JOIN users ON recipes.user_id = users.id
        WHERE recipes.id = ".$_POST['rec-id']."
        ORDER BY recipes.date DESC";

        $result = mysqli_query($conn, $sql);
        $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $recipe = $recipes[0];
        
    }

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
    <script src='./js/pic.js' defer></script>
    <script src="./js/delete.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<body>
    <?php include './nav.php'; ?>

    <section class="h-100 mt-5 ">

        <div class="  container py-5 h-100 mt-5  d-flex justify-content-center align-items-center h-100 ">

            <div class="card rounded-3overflow-hidden w-100 py-4">

                <div class=" d-flex flex-column align-items-center">
                    <h1 class="fw-bold"> <?php  echo $recipe['name']; ?></h1>
                    <div class=" my-4 d-flex rounded-4 col-11 col-lg-8 fs-1 overflow-hidden" style="height:11em;">
                        <img src=<?php  echo $recipe['img']; ?> alt="image 1" class="w-100">
                    </div>
                    <div class=" text-center ">

                        <h5><?php  echo $recipe['category_name']; ?></h5>
                        <h6>by <?php  echo $recipe['user_name']; ?></h6>
                        <p><?php $date = date_create($recipe['date']); echo date_format($date ,"Y-m-d h:i A"); ?></p>
                        


                    </div>
                </div>

                <div class="card-body col-lg-5 p-4 text-black mt-5">




                    <div class="row justify-content-center justify-content-lg-start m-auto ">
                        <h2 class="lead fw-bold mt-3">Ingredients </h2>
                        <p><?php  echo $recipe['ing']; ?>
                        </p>
                    </div>
                    <div class="row justify-content-center justify-content-lg-start m-auto ">
                        <h2 class="lead fw-bold mt-3">Cooking Guide </h2>
                        <p><?php  echo $recipe['descr']; ?>
                        </p>
                    </div>



                </div>
            </div>

        </div>

    </section>

    <?php include 'footer.php' ?>
</body>

</html>