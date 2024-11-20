<?php include './connection.php' ?>
<?php session_start() ?>
<?php

$user_id = $_SESSION['id'];
$rec_id = 0;
$name = $ing = $desc = $img  = $cat_id = '';
$flag = 0;
$name_err = $ing_err = $desc_err = $img_err = $cat_err = 0;

$recipe = 0;

try {
    
if (isset($_POST['submit']) && !isset($_POST['update'])) {

    ///////////img handeling
    // Check if file was uploaded
    if (!empty($_FILES['upload']['name'])) {
        $file_name = $_FILES['upload']['name'];
        $file_tmp = $_FILES['upload']['tmp_name'];
        $target_dir = "upload/recipes/" . $file_name;
        move_uploaded_file($file_tmp, $target_dir);
    } else {
        $img_err = 1;
    }
    //------ validate inputs
    (empty($_POST['name'])) ? $name_err = 1 : $name = $_POST['name'];
    (empty($_POST['ing'])) ? $ing_err = 1 : $ing = $_POST['ing'];
    (empty($_POST['desc'])) ? $desc_err = 1 : $desc = $_POST['desc'];
    (empty($_POST['cat'])) ? $cat_err = 1 : $cat_id = (int)$_POST['cat'];


    if (!$name_err && !$ing_err && !$desc_err && !$img_err) {
        $sql = "INSERT INTO recipes (name, ing, descr, img, cat_id, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
    
        $stmt->bind_param('ssssii', $name, $ing, $desc, $target_dir, $cat_id, $user_id);
    
        if ($stmt->execute()) {
            $successMessage = "Data submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

if (isset($_POST['update'])) {


    // // ------ validate inputs
    // if(!empty($_POST['rec-name']))   
    // if(!empty($_POST['rec-ing'])) $ing = $_POST['rec-ing'];
    // if(!empty($_POST['rec-des']))  $desc = $_POST['rec-des'];
    // if(!empty($_POST['img']))  $img = $_POST['img'];
    // if(!empty($_POST['rec-id'])) $rec_id = (int)$_POST['rec-id'];
    // if(!empty($_POST['rec-cat']))$cat_id = (int)$_POST['cat-id'];


    $rec_id = $_POST['rec-id'];

    $sql = "SELECT  *  FROM recipes
    WHERE id = " . $_POST['rec-id'] . "
    ORDER BY date DESC";

    $result = mysqli_query($conn, $sql);
    $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $recipe = $recipes[0];

    $name = $recipe['name'];
    $desc = $recipe['descr'];
    $img = $recipe['img'];
    $ing = $recipe['ing'];
    $cat_id = (int)$recipe['cat_id'];



    if (isset($_POST['submit'])) {

        ///////////img handeling
        // Check if file was uploaded
        if (!empty($_FILES['upload']['name'])) {
            $file_name = $_FILES['upload']['name'];
            $file_tmp = $_FILES['upload']['tmp_name'];
            $target_dir = "upload/recipes/" . $file_name;
            move_uploaded_file($file_tmp, $target_dir);
        } else {
            $target_dir = $img;
        }

        //------ validate inputs
        (empty($_POST['name'])) ? $name_err = 1 : $name = $_POST['name'];
        (empty($_POST['ing'])) ? $ing_err = 1 : $ing = $_POST['ing'];
        (empty($_POST['desc'])) ? $desc_err = 1 : $desc = $_POST['desc'];
        (empty($_POST['cat'])) ? $cat_err = 1 : $cat_id = (int)$_POST['cat'];



        if (!$name_err && !$ing_err && !$desc_err && !$img_err) {
           
            $sql = "UPDATE recipes 
             SET name = ?, 
            ing = ?, 
            descr = ?, 
            img = ?, 
            cat_id = ?
             WHERE id = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param('ssssii', $name, $ing, $desc, $target_dir, $cat_id, $rec_id);


            $name = $name;
            $ing = $ing;
            $desc = $desc;
            $target_dir = $target_dir;
            $cat_id = $cat_id;
            $rec_id = $rec_id;

           


            if ( $stmt->execute()) {

                $successMessage = "Data updated successfully!";
            } else {

                throw new Exception("Error: " . $stmt->error);
            }
        }
    }
}

    
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage();
}




?>


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
    <script src='./js/pic.js' defer></script>
</head>

<body>


    <!-- ////////////////nav//////////// -->
    <?php include './nav.php'; ?>




    <div id="form" class=" con container col-lg-6 col-10 p-4 border shadow d-flex flex-column align-items-center ">
        <h2 class="mb-4"> <?php if (isset($_POST['update'])) {
                                $flag = 1;
                                echo "Update";
                            } else echo "New" ?> Recipe</h2>
        <div class="add img rounded-2 col-11" id='imgContainer'>
            <?php if (isset($_POST['update'])) { ?>
                <img src=<?php echo $img; ?> alt="">
            <?php } else { ?>
                Add Picture

            <?php } ?>
        </div>

        <form id="registrationForm" class="needs-validation w-100 " novalidate method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <div>
                <input id="img" type="file" accept="image/*" name="upload" style="display:none" />
                <div class=" text-center">

                    <?php echo ($img_err) ? "please enter  image for this recipe{$img}"  : null;  ?>
                </div>

            </div>
            <div class="form-group has-validation ">
                <label for="fullName">Recipe Name</label>
                <input type="text" class="form-control <?php echo ($name_err) ? 'is-invalid' : null; ?> " id="fullName" name="name" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback">
                    Please enter recipe's name
                </div>
            </div>

            <div class="form-group">
                <label>Catigory</label>
                <select class="form-select" name='cat' aria-label="Default select example">
                    <?php
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);
                    $cats = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    foreach ($cats as $cat) {
                        $selected = ($cat['id'] == $cat_id) ? 'selected' : '';
                        echo "<option value='{$cat['id']}' {$selected}>{$cat['name']}</option>";
                    }

                    ?>
                </select>

            </div>

            <div class="form-group">
                <label class="mt-3" for="confirmPassword">Ingredients</label>
                <textarea class="form-control <?php echo ($ing_err) ? 'is-invalid' : null; ?>" placeholder="Enter the ingredients " name="ing" id="text" cols="30" rows="10" style="resize: none;"><?php echo $ing ?></textarea>
                <div class="invalid-feedback">
                    <?php echo ($ing_err) ? 'Please enter the ingredients' : null; ?>
                </div>
            </div>
            <div class="form-group">
                <label class="mt-3" for="confirmPassword">Cooking Guide</label>
                <textarea class="form-control <?php echo ($desc_err) ? 'is-invalid' : null; ?>" placeholder="how to do this recipe" name="desc" id="text" cols="30" rows="10" style="resize: none;"><?php echo $desc ?></textarea>
                <div class="invalid-feedback">
                    <?php echo ($desc_err) ? 'Please enter recipe directions' : null; ?>
                </div>
            </div>

            <input type="submit" name="submit" class="btn mt-4 " value="submit" style="color:#fff;background-color:#FF702A">


            <input type="hidden" name=<?PHP echo ($flag) ? 'update' : null;  ?> value=' '>
            <input type="hidden" name='img' value=<?php echo ($flag) ? $img : 0; ?>>
            <input type="hidden" name=<?PHP echo ($rec_id) ? 'rec-id' : null;  ?> value=<?PHP echo $rec_id  ?>>
        </form>
    </div>

    <?php if (isset($successMessage)) { ?>
        <script>
            // JavaScript to show an alert box with the success message
            alert("<?php echo $successMessage; ?>");
            window.location.href = "profile.php";
        </script>
    <?php } ?>



    <?php include 'footer.php' ?>
</body>

</html>