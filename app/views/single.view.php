<?php include('components/header.view.php'); ?>

<section>
    <?php if ($error != '') :
        include('components/alert.view.php')
    ?>
    <?php else : ?>
        <div>
            <h2>Cliam <?= $data->invent_num ?></h2>
            <div class="row">
                <div class="col">
                    <div class="my-3 border-bottom ">
                        <h6>Invent number: </h6>
                        <p class="fw-normal mx-2"><?= $data->invent_num ?></p>
                        <!-- <h5>Res: <span class="fw-normal mx-2"><?= $data->res ?></span></h5> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Neighborhood: </h6>
                        <p class="fw-normal mx-2"><?= $data->neighborhood ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Address: </h6>
                        <p class="fw-normal mx-2"><?= $data->address ?></p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Date of excavation: </h6>
                        <p class="fw-normal mx-2"><?= $data->date_of_excavation ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Date of recovery ABP: </h6>
                        <p class="fw-normal mx-2"><?= $data->date_recovery_ABP ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Open square: </h6>
                        <p class="fw-normal mx-2"><?= $data->open_square ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Square restored area: </h6>
                        <p class="fw-normal mx-2"><?= $data->square_restored_area ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">

                    <div class="my-3 border-bottom">
                        <h6>Street type: </h6>
                        <p class="fw-normal mx-2"><?= $data->street_type ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="my-3 border-bottom">
                        <h6>Work type: </h6>
                        <p class="fw-normal mx-2"><?= $data->type_of_work ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="my-3 border-bottom">
                        <h6>Direction: </h6>
                        <p class="fw-normal mx-2"><?= $data->direction ?></p>
                    </div>
                </div>
            </div>
            <div class="row my-1 border-bottom">
                <div class="col">
                    <div class="">
                        <h6>Image 1 : </h6>
                    </div>
                    <div class="modal fade" id="imageModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Image 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex jusify-content-center">
                                    <!-- Image goes here -->
                                    <img src="<?= $data->image1 != '' ? $data->image1 : get_image()  ?>" class="img-fluid" alt="image1" srcset="" style="width:100%;object-fit:cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col py-2">
                    <button type="button" data-toggle="modal" data-target="#imageModal1" style="border: none;outline:none">
                        <img src="<?= $data->image1 != '' ? $data->image1 : get_image()  ?>" alt="" srcset="" id="clickableImage1" style="object-fit:cover" width="200px">
                    </button>
                </div>
            </div>
            <div class="row my-1 border-bottom">
                <div class="col">
                    <div class="">
                        <h6>Image 2 : </h6>
                    </div>
                    <div class="modal fade" id="imageModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Image 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Image goes here -->
                                    <img src="<?= $data->image2 != '' ? $data->image2 : get_image()  ?>" class="img-fluid" alt="image1" srcset="" style="width:100%;object-fit:cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col py-2">
                    <button type="button" data-toggle="modal" data-target="#imageModal2" style="border: none;outline:none">
                        <img src="<?= $data->image2 != '' ? $data->image2 : get_image()  ?>" alt="" srcset="" id="clickableImage2" style="object-fit:cover" width="200px">
                    </button>
                </div>
            </div>

            <div class="row my-1 border-bottom">
                <div class="col">
                    <div class="">
                        <h6>Image 3 : </h6>
                    </div>
                    <div class="modal fade" id="imageModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Image 3</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Image goes here -->
                                    <img src="<?= $data->image3 != '' ? $data->image3 : get_image()  ?>" class="img-fluid" alt="image3" srcset="" style="width:100%;object-fit:cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col py-2">
                    <button type="button" data-toggle="modal" data-target="#imageModal3" style="border: none;outline:none">
                        <img src="<?= $data->image3 != '' ? $data->image3 : get_image()  ?>" alt="" srcset="" id="clickableImage3" style="object-fit:cover" width="200px">
                    </button>
                </div>
            </div>


        </div>
    <?php endif ?>



</section>

<?php include('components/footer.view.php'); ?>