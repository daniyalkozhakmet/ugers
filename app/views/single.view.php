<?php include('components/header.view.php'); ?>

<section>
    <?php if ($error != '') :
        include('components/alert.view.php')
    ?>
    <?php else : ?>
        <div>
            <h2>Cliam <?= $data->invent_num ?></h2>
            <div class="my-3 border-bottom ">
                <h6>Invent number: </h6>
                <p class="fw-normal mx-2"><?= $data->invent_num ?></p>
                <!-- <h5>Res: <span class="fw-normal mx-2"><?= $data->res ?></span></h5> -->
            </div>

            <div class="my-3 border-bottom">
                <h6>Neighborhood: </h6>
                <p class="fw-normal mx-2"><?= $data->neighborhood ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Address: </h6>
                <p class="fw-normal mx-2"><?= $data->address ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Direction: </h6>
                <p class="fw-normal mx-2"><?= $data->direction ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Date of excavation: </h6>
                <p class="fw-normal mx-2"><?= $data->date_of_excavation ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Open square: </h6>
                <p class="fw-normal mx-2"><?= $data->open_square ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Date of recovery ABP: </h6>
                <p class="fw-normal mx-2"><?= $data->date_recovery_ABP ?></p>
            </div>

            <div class="my-3 border-bottom">
                <h6>Square restored area: </h6>
                <p class="fw-normal mx-2"><?= $data->square_restored_area ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Street type: </h6>
                <p class="fw-normal mx-2"><?= $data->street_type ?></p>
            </div>
            <div class="my-3 border-bottom">
                <h6>Work type: </h6>
                <p class="fw-normal mx-2"><?= $data->type_of_work ?></p>
            </div>

        </div>
    <?php endif ?>



</section>
<?php include('components/footer.view.php'); ?>