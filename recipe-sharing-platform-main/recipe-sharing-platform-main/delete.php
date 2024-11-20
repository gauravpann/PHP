<?php


include './connection.php';

if (isset($_POST['delete_recipe_id'])) {
    $recipe_id = $_POST['delete_recipe_id'];
    $delete_query = "DELETE FROM recipes WHERE id = $recipe_id ";   
    if (mysqli_query($conn, $delete_query)) {
        mysqli_close($conn);
    }
    
}

?> 