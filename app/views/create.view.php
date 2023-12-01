<?php include('components/header.view.php'); ?>
<section class="d-flex justify-content-between align-items-center flex-column my-4">

    <form class="w-100 " method="POST" action="<?= ROOT . '/claim/create' ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-6 ">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Административный район</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="neighborhood">
                        <option value="Алатау">Алатау</option>
                        <option value="Алмалы">Алмалы</option>
                        <option value="Ауезов">Ауезов</option>
                        <option value="Бостандык">Бостандык</option>
                        <option value="Жетысу">Жетысу</option>
                        <option value="Медеу">Медеу</option>
                        <option value="Наурызбай">Наурызбай</option>
                        <option value="Турксиб">Турксиб</option>
                    </select>
                    <div class="text-danger"><?= $claim->getError('neighborhood') ?></div><br>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="invent_num">Инвентарный номер</label>
                    <input value="<?= old_value('invent_num') ?>" name="invent_num" type="text" class="form-control" id="invent_num" aria-describedby="inventHelp" placeholder="Введите инвентарный номер">
                    <div class="text-danger"><?= $claim->getError('invent_num') ?></div><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="date_of_excavation">Дата разрытия</label>
                    <input value="<?= old_value('date_of_excavation') ?>" name="date_of_excavation" type="date" class="form-control" id="date_of_excavation">
                    <div class="text-danger"><?= $claim->getError('date_of_excavation') ?></div><br>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="date_recovery_ABP">Дата восстановления АБП</label>
                    <input value="<?= old_value('date_recovery_ABP') ?>" name="date_recovery_ABP" type="date" class="form-control" id="date_recovery_ABP">
                    <div class="text-danger"><?= $claim->getError('date_recovery_ABP') ?></div><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="open_square">Площадь вскрытия АБП, м2</label>
                    <input value="<?= old_value('open_square') ?>" name="open_square" type="text" class="form-control" id="open_square" placeholder="Введите площадь вскрытия">
                    <div class="text-danger"><?= $claim->getError('open_square') ?></div><br>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="square_restored_area">Фактически восстановленная площадь м2</label>
                    <input value="<?= old_value('square_restored_area') ?>" name="square_restored_area" type="text" class="form-control" id="square_restored_area" placeholder="Введите фактически восстановленная площадь м2">
                    <div class="text-danger"><?= $claim->getError('square_restored_area') ?></div><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Тип улицы</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="street_type">
                        <option value="Магистральная">Магистральная</option>
                        <option value="Районная">Районная</option>
                    </select>
                    <div class="text-danger"><?= $claim->getError('street_type') ?></div><br>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="type_of_work">Вид работ</label>
                    <select class="form-control" id="exampleFormControlSelect2" name="type_of_work">
                        <option value="Асфальт 5см">Асфальт 5см</option>
                        <option value="Асфальт 8см">Асфальт 8см</option>
                        <option value="Асфальт 12см">Асфальт 12см</option>
                        <option value="Временная брусчатка 5см">Временная брусчатка 5см</option>
                        <option value="Временная брусчатка 8см">Временная брусчатка 8см</option>
                        <option value="Временная брусчатка 12см">Временная брусчатка 12см</option>
                        <option value="Востанавление тротуарной плиткой (брусчатка)">Востанавление тротуарной плиткой (брусчатка)</option>
                        <option value="Газон">Газон</option>
                        <option value="Бордер (поребрик)">Бордер (поребрик)</option>
                        <option value="Вр.Брус на асфальт 5см">Вр.Брус на асфальт 5см</option>
                        <option value="Вр.Брус на асфальт 8см">Вр.Брус на асфальт 8см</option>
                        <option value="Вр.Брус на асфальт 12см">Вр.Брус на асфальт 12см</option>
                    </select>
                    <div class="text-danger"><?= $claim->getError('type_of_work') ?></div><br>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Адрес</label>
            <input value="<?= old_value('address') ?>" name="address" type="text" class="form-control" id="address" placeholder="Введите адрес">
            <div class="text-danger"><?= $claim->getError('address') ?></div><br>
        </div>
        <div class="form-group">
            <label for="direction">Направление</label>
            <textarea name="direction" class="form-control" id="direction"><?= old_value('direction') ?></textarea>
            <div class="text-danger"><?= $claim->getError('direction') ?></div><br>
        </div>



        <div class="d-flex justify-content-between align-items-end my-3">
            <button type="submit" class="btn btn-primary" onclick="showSpinner()">Создать</button>
        </div>

    </form>
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="background-color: rgba(255, 255, 255, 0);">
                <div class="modal-body text-center" style="background-color: rgba(255, 255, 255, 0);">
                    <div class="spinner-border text-light" role="status" style="width:150px;height:150px">
                        <span class="visually-hidden">Рагрузка...</span>
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