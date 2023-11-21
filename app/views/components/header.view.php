<!DOCTYPE html>
<html lang="ru">
<meta charset="utf-8">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>UGERS</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href=" <?= ROOT . '/claim/get_my_claims' ?>" class="pb-2 my-sm-0"><i class="bi bi-house text-primary fs-2"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav w-100 d-flex justify-content-end align-items-sm-center align-items-end gap-2">

                    <?php
                    if (!empty($_SESSION['USER'])) {
                    ?>
                        <li class="nav-item " role="button">
                            Привет,  <span class="text-primary text-uppercase"><?= $_SESSION['USER']->username ?></span>
                        </li>
                        <?php
                        if ($_SESSION['USER']->role == 'admin') {
                        ?>
                            <li class="nav-item " role="button">
                                <a class="nav-link" class="navbar-brand " href=" <?= ROOT . '/admin' ?>"><i style="font-size: 25px;" class="bi bi-gear"></i></a>
                            </li>
                        <?php
                        }
                        if ($_SESSION['USER']->role == 'user') {
                        ?>
                            <li class="nav-item " role="button">
                                <a class="nav-link" class="navbar-brand " href=" <?= ROOT . '/claim/create' ?>"><i style="font-size: 25px;" class="bi bi-plus-circle-fill"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item d-flex justify-content-end align-items-center">
                            <a class="nav-link" class="navbar-brand " href=" <?= ROOT . '/logout' ?>"><i style="font-size: 25px;" class="bi bi-box-arrow-right font-weight-bold"></i></a>
                        </li>


                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" class="navbar-brand" href=" <?= ROOT . '/login' ?>">Log in</a>
                        </li>


                    <?php } ?>
                </ul>
            </div>
        </div>

    </nav>
    <?php if (!empty($_SESSION['USER']) && $_SESSION['USER']->role == 'admin') include('admin.tab.view.php'); ?>
    <?php if (!empty($_SESSION['USER']) && $_SESSION['USER']->role == 'user') include('user.tab.view.php'); ?>

    <section class="container">