<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top p-3">
    <div class="container-fluid">
        <!-- <a class="navbar-brand text-white p-2 rounded-pill "  href="#">
            <i class="fa-solid fa-bowl-rice"></i>
            C O K I N A
        </a> -->
        <a class="navbar-brand text-white py-0 px-3 fs-2 rounded-pill " style="font-family:'Monotype corsiva';" href="./main.php">
            <i class="fa-solid fa-bowl-rice fs-5"></i>
            Cokina
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mb-1">

                <li class="nav-item">
                    <a class="nav-link" href="./main.php#home" data-href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./main.php#about" data-href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./main.php#contact" data-href="#contact">Contact</a>
                </li>
                <li class="nav-item">

                    <form action="recipes.php" method="post">
                        <a class="nav-link dropdown-toggle " role="button" href="./recipes.php" data-href="#recipe">Recipes</a>
                        <ul class="dropdown">
                            <li><input class="nav-link" type="submit" name="Breakfast" value="Breakfast"></li>
                            <li><input class="nav-link" type="submit" name="Dinner" value="Dinner"></li>
                            <li><input class="nav-link" type="submit" name="Lunch" value="Lunch"></li>
                            <li><input class="nav-link" type="submit" name="Dessert" value="Dessert"></li>
                        </ul>

                    </form>



                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-5 "> <a class=" text-decoration-none">

                        <form class="d-flex mt-1" action="recipes.php" method="POST" role="search">
                            <input class="form-control me-2 search" type="search" name="searchItems" placeholder="Search" aria-label="Search" style="width: 15em ;">
                            <input class="btn d-inline-block" style="border: 1px solid #FF702A; color:#FF702A" type="submit" value="Search" name="search">
                        </form>
                    </a>

                </li>

                <?php if (isset($_SESSION['id'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./profile.php">
                            <div class="imgcontaier">
                                <?php if ($_SESSION['img']) { ?>
                                    <img src=<?php echo $_SESSION['img']; ?> alt="">
                                <?php } else { ?>
                                    <i class="fa-solid fa-user"></i>
                                    <!-- <img src="./imges/user-solid.svg" alt=""/> -->
                                <?php } ?>
                            </div>
                        </a>
                        <!-- <i class="fa-solid fa-gear"></i> -->
                    </li>
                    <li class="nav-item d-flex">
                        <a class="nav-link me-1" onclick="loggingOut()">Logout</i></a>
                        <i class="fa-solid fa-right-from-bracket" style="margin-top:.9em ;"></i>
                    </li>

                <?php } else { ?>
                    <li class="nav-item d-flex">
                        <a class="nav-link ri" href="./login.php#login" data-href="#login">Login</a>
                        <i class="fa-solid fa-right-to-bracket" style="margin:.9em;"></i>
                    </li>

                <?php } ?>



            </ul>
        </div>
    </div>
</nav>

<script src="./js/logout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- href="logout.php" -->