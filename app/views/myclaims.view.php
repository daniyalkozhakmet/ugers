<?php include('components/header.view.php');

// Manually set parameter in the URL
$userParam = isset($_GET['id']) ? $_GET['id'] : '';
?>
<section>
    <?php if (!is_bool(message())) { ?>
        <p class="alert alert-success w-100 text-center">
            <?= message() ?>
        </p>
    <?php } ?>
    <form class="form-inline my-4" method="GET" action="<?= isset($is_deleted) ? ROOT  . ($is_deleted ? '/admin/get_my_deleted_claims' : '/claim/get_my_claims') : ROOT . '/admin/' . 'claim_view_by_user'  ?>">
        <div class="input-group ">
            <input type="hidden" name="id" value="<?= htmlspecialchars($userParam) ?>">
            <input type="text" class="form-control" name='invent' placeholder="Поиск по инвентарному номеру" aria-label="Search by invent num" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Поиск</button>
            </div>
        </div>
    </form>
</section>
<?php
!is_null($error) ? include('components/alert.view.php') : include('components/claims.tb.view.php')
?>

<?php include('components/footer.view.php'); ?>