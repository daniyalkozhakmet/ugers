<?php include('components/header.view.php'); ?>
<section class="d-flex justify-content-between align-items-center flex-column my-4">

    <form class="w-100 " method="POST" action="<?= ROOT . '/claim/create' ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleFormControlSelect1">Neighborhood</label>
            <select class="form-control" id="exampleFormControlSelect1" name="neighborhood">
                <option value="Alatau">Alatau</option>
                <option value="Almaly">Almaly</option>
                <option value="Auezov">Auezov</option>
                <option value="Bostandyk">Bostandyk</option>
                <option value="Zhetisu">Zhetisu</option>
                <option value="Medeu">Medeu</option>
                <option value="Nauryzbay">Nauryzbay</option>
                <option value="Turksib">Turksib</option>
            </select>
            <div class="text-danger"><?= $claim->getError('neighborhood') ?></div><br>
        </div>
        <div class="form-group">
            <label for="invent_num">Invent</label>
            <input value="<?= old_value('invent_num') ?>" name="invent_num" type="text" class="form-control" id="invent_num" aria-describedby="inventHelp" placeholder="Enter invent">
            <div class="text-danger"><?= $claim->getError('invent_num') ?></div><br>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input value="<?= old_value('address') ?>" name="address" type="text" class="form-control" id="address" placeholder="Address">
            <div class="text-danger"><?= $claim->getError('address') ?></div><br>
        </div>
        <div class="form-group">
            <label for="direction">Direction</label>
            <textarea name="direction" class="form-control" id="direction"><?= old_value('direction') ?></textarea>
            <div class="text-danger"><?= $claim->getError('direction') ?></div><br>
        </div>
        <div class="form-group">
            <label for="date_of_excavation">Date razritiya</label>
            <input value="<?= old_value('date_of_excavation') ?>" name="date_of_excavation" type="date" class="form-control" id="date_of_excavation">
            <div class="text-danger"><?= $claim->getError('date_of_excavation') ?></div><br>
        </div>
        <div class="form-group">
            <label for="open_square">Plosahed vskrityia</label>
            <input value="<?= old_value('open_square') ?>" name="open_square" type="text" class="form-control" id="open_square" placeholder="Plosahed vskrityia">
            <div class="text-danger"><?= $claim->getError('open_square') ?></div><br>
        </div>
        <div class="form-group">
            <label for="date_recovery_ABP">Data vostanavleniya ABP</label>
            <input value="<?= old_value('date_recovery_ABP') ?>" name="date_recovery_ABP" type="date" class="form-control" id="date_recovery_ABP">
            <div class="text-danger"><?= $claim->getError('date_recovery_ABP') ?></div><br>
        </div>
        <div class="form-group">
            <label for="square_restored_area">Fakticheski vostanavlennaiya ploshad</label>
            <input value="<?= old_value('square_restored_area') ?>" name="square_restored_area" type="text" class="form-control" id="square_restored_area" placeholder="Direction">
            <div class="text-danger"><?= $claim->getError('square_restored_area') ?></div><br>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tip ulici</label>
            <select class="form-control" id="exampleFormControlSelect1" name="street_type">
                <option value="Magistralnaiya">Magistralnaiya</option>
                <option value="Raionnaiya">Raionnaiya</option>
            </select>
            <div class="text-danger"><?= $claim->getError('street_type') ?></div><br>
        </div>
        <div class="form-group">
            <label for="type_of_work">Vid rabot</label>
            <select class="form-control" id="exampleFormControlSelect2" name="type_of_work">
                <option value="Asfalt 5cm">Asfalt 5cm</option>
                <option value="Asfalt 8cm">Asfalt 8cm</option>
                <option value="Asfalt 12cm">Asfalt 12cm</option>
                <option value="Vremennaya bruschatks 5cm">Vremennaya bruschatks 5cm</option>
                <option value="Vremennaya bruschatks 8cm">Vremennaya bruschatks 8cm</option>
                <option value="Vremennaya bruschatks 12cm">Vremennaya bruschatks 12cm</option>
                <option value="Vostanavleniye trotuarnoi plitkoi (bruschatka)">Vostanavleniye trotuarnoi plitkoi (bruschatka)</option>
                <option value="Gazon">Gazon</option>
                <option value="Bordur (perebrik)">Bordur (perebrik)</option>
                <option value="Vr.Brus na Asfalt 5cm">Vr.Brus na Asfalt 5cm</option>
                <option value="Vr.Brus na Asfalt 8cm">Vr.Brus na Asfalt 8cm</option>
                <option value="Vr.Brus na Asfalt 12cm">Vr.Brus na Asfalt 12cm</option>
            </select>
            <div class="text-danger"><?= $claim->getError('type_of_work') ?></div><br>
        </div>
        <div class="d-flex justify-content-between align-items-end my-3">
            <button type="submit" class="btn btn-primary" onclick="showSpinner()">Create</button>
        </div>

    </form>
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="background-color: rgba(255, 255, 255, 0);">
                <div class="modal-body text-center" style="background-color: rgba(255, 255, 255, 0);">
                    <div class="spinner-border text-light" role="status" style="width:150px;height:150px">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function display_image(file, inputTag) {
        query = '';
        switch (inputTag.name) {
            case 'image1':
                query = 'image1';
                break;
            case 'image2':
                query = 'image2';
                break;
            case 'image3':
                query = 'image3';
                break;
            default:
                break
        }
        document.querySelector(`#${query}`).src = URL.createObjectURL(file)
    }
    const date_of_excavation = document.getElementById(
        "date_of_excavation"
    )
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

    if (!date_of_excavation.value) {
        date_of_excavation.value = date
    }

    function showSpinner() {
        // Show the modal when the form is submitted
        $('#loadingModal').modal('show');
    }
</script>

<?php include('components/footer.view.php'); ?>