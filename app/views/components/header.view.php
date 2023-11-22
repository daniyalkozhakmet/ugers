<!DOCTYPE html>
<html lang="ru">
<meta charset="utf-8">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>UGERS</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../public/assets/css/bootstrap.min.css">
    <script src="<?= ROOT . "/assets/js/bootstrap.min.js"; ?>"></script>
    <script src="<?= ROOT . "/assets/js/bootstrap.js"; ?>"></script>
    <script src="<?= ROOT . "/assets/js/bootstrap.bundle.js"; ?>"></script>
    <script src="<?= ROOT . "/assets/js/bootstrap.bundle.min.js"; ?>"></script> -->
    <link rel="stylesheet" href="<?= ROOT . "/assets/css/bootstrap.min.css"; ?>">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href=" <?= ROOT . '/claim/get_my_claims' ?>" class="pb-2 my-sm-0"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav w-100 d-flex justify-content-end align-items-sm-center align-items-end gap-2">

                    <?php
                    if (!empty($_SESSION['USER'])) {
                    ?>
                        <li class="nav-item " role="button">
                            Привет, <span class="text-primary text-uppercase"><?= $_SESSION['USER']->username ?></span>
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
                            <a class="nav-link" class="navbar-brand " href=" <?= ROOT . '/logout' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg></a>
                        </li>


                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" class="navbar-brand" href=" <?= ROOT . '/login' ?>">Логин</a>
                        </li>


                    <?php } ?>
                </ul>
            </div>
        </div>

    </nav>
    <?php if (!empty($_SESSION['USER']) && $_SESSION['USER']->role == 'admin') include('admin.tab.view.php'); ?>
    <?php if (!empty($_SESSION['USER']) && $_SESSION['USER']->role == 'user') include('user.tab.view.php'); ?>

    <section class="container">