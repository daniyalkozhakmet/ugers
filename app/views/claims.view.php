<?php include('components/header.view.php'); ?>
<section class="d-flex justify-content-between align-items-center flex-column my-4">
    <h1>Claims </h1>
    <?php
    if (isset($error)) {
    ?>
        <?php include('components/alert.view.php'); ?>
    <?php
    }
    ?>
    <?php include('components/claims.tb.view.php'); ?>
</section>


<?php include('components/footer.view.php'); ?>