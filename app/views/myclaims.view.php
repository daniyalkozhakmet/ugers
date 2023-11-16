<?php include('components/header.view.php'); ?>
<section>
    <form class="form-inline my-4" method="GET" action="<?= ROOT . '/claim/get_my_claims' ?>">
        <div class="input-group ">
            <input type="text" class="form-control" name='invent' placeholder="Search by invent num" aria-label="Search by invent num" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</section>
<?php
!is_null($error) ? include('components/alert.view.php') : include('components/claims.tb.view.php')
?>

<?php include('components/footer.view.php'); ?>