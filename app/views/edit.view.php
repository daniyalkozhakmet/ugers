<?php include('components/header.view.php');
?>
<section class="d-flex justify-content-between align-items-center flex-column my-4">
    <div class="d-flex justify-content-between align-items-center w-100 my-3">
        <h2 >Редактировать <?= $data->invent_num ?></h2>
        <a href=" <?= ROOT . '/claim/single?id=' . $data->id ?>" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
            </svg></a>
    </div>

    <form class="w-100 " method="POST" action="<?= ROOT . '/claim/edit?id=' . $data->id ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleFormControlSelect1">Административный район</label>
            <select class="form-control" id="neighborhoodSelect" name="neighborhood">
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
        <div class="form-group">
            <label for="invent_num">Инвентарный номер</label>
            <input value="<?= $data->invent_num ?>" name="invent_num" type="text" class="form-control" id="invent_num" aria-describedby="inventHelp" placeholder="Введите инвентарный номер">
            <div class="text-danger"><?= $claim->getError('invent_num') ?></div><br>
        </div>
        <div class="form-group">
            <label for="address">Адрес</label>
            <input value="<?= $data->address ?>" name="address" type="text" class="form-control" id="address" placeholder="Введите адрес">
            <div class="text-danger"><?= $claim->getError('address') ?></div><br>
        </div>
        <div class="form-group">
            <label for="direction">Направление</label>
            <textarea name="direction" class="form-control" id="direction"><?= $data->direction ?></textarea>
            <div class="text-danger"><?= $claim->getError('direction') ?></div><br>
        </div>
        <div class="form-group">
            <label for="date_of_excavation">Дата разрытия</label>
            <input value="<?= $data->date_of_excavation ?>" name="date_of_excavation" type="date" class="form-control" id="date_of_excavation">
            <div class="text-danger"><?= $claim->getError('date_of_excavation') ?></div><br>
        </div>
        <div class="form-group">
            <label for="open_square">Площадь вскрытия АБП, м2</label>
            <input value="<?= $data->open_square ?>" name="open_square" type="text" class="form-control" id="open_square" placeholder="Введите площадь вскрытия">
            <div class="text-danger"><?= $claim->getError('open_square') ?></div><br>
        </div>
        <div class="form-group">
            <label for="date_recovery_ABP">Дата восстановления АБП</label>
            <input value="<?= $data->date_recovery_ABP ?>" name="date_recovery_ABP" type="date" class="form-control" id="date_recovery_ABP">
            <div class="text-danger"><?= $claim->getError('date_recovery_ABP') ?></div><br>
        </div>
        <div class="form-group">
            <label for="square_restored_area">Фактически восстановленная площадь м2</label>
            <input value="<?= $data->square_restored_area ?>" name="square_restored_area" type="text" class="form-control" id="square_restored_area" placeholder="Введите фактически восстановленная площадь м2">
            <div class="text-danger"><?= $claim->getError('square_restored_area') ?></div><br>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Тип улицы</label>
            <select class="form-control" id="streetTypeSelect" name="street_type">
                <option value="Магистральная">Магистральная</option>
                <option value="Районная">Районная</option>
            </select>
            <div class="text-danger"><?= $claim->getError('street_type') ?></div><br>
        </div>
        <div class="form-group">
            <label for="type_of_work">Вид работ</label>
            <select class="form-control" id="typeOfWorkSelect" name="type_of_work">
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
        <div class="form-group my-3 d-flex align-items-center justify-content-between border px-1">
            <div>
                <label for="exampleFormControlFile1">Фото отчет 1 (котлован после монтажа муфт)</label>
                <input type="file" class="form-control-file d-block my-2" name="image1" onchange="display_image(this.files[0],this)">
                <div class="text-danger"><?= $claim->getError('image1') ?></div><br>
            </div>

            <div>
                <img src="<?= $data->image1 != '' ? $data->image1 : get_image()  ?>" alt="" class="img-thumbnail js-image-preview" id="image1" style="width: 200px;object-fit:cover">
            </div>
        </div>
        <div class="form-group my-3 d-flex d-flex align-items-center justify-content-between border px-1">
            <div>
                <label for="exampleFormControlFile1">Фото отчет 2 (разрытие восстановлено)</label>
                <input type="file" class="form-control-file d-block my-2" name="image2" onchange="display_image(this.files[0],this)">
                <div class="text-danger"><?= $claim->getError('image2') ?></div><br>
            </div>

            <div class="d-flex align-items-center justify-content-end">
                <img src="<?= $data->image2 != '' ? $data->image2 : get_image() ?>" alt="" class="img-thumbnail js-image-preview" id="image2" style="width: 200px;object-fit:cover">
            </div>
        </div>
        <div class="form-group my-3 d-flex align-items-center justify-content-between border px-1">
            <div>
                <label for="exampleFormControlFile1">Фото отчет 3 (котлован через 15 дней)
                </label>
                <input type="file" class="form-control-file d-block my-2" name="image3" onchange="display_image(this.files[0],this)">
                <div class="text-danger"><?= $claim->getError('image3') ?></div><br>
            </div>

            <div>
                <img src="<?= $data->image3 != '' ? $data->image3 : get_image() ?>" alt="" class="img-thumbnail js-image-preview " id="image3" style="width: 200px;object-fit:cover">
            </div>
        </div>

        <div class="form-group">
            <label for="date_recovery_ABP">Месяц подписания акта выполненных работ</label>
            <input value="<?= $data->date_of_sign ?>" name="date_of_sign" type="date" class="form-control" id="date_of_sign">
            <div class="text-danger"><?= $claim->getError('date_of_sign') ?></div><br>
        </div>
        <div class="form-group my-3 d-flex align-items-center justify-content-between border px-1">
            <div>
                <label for="exampleFormControlFile1">Фото заявки по провалу
                </label>
                <input type="file" class="form-control-file d-block my-2" name="claim_photo" onchange="display_image(this.files[0],this)">
                <div class="text-danger"><?= $claim->getError('claim_photo') ?></div><br>
            </div>

            <div>
                <img src="<?= $data->claim_photo != '' ? $data->claim_photo : get_image() ?>" alt="" class="img-thumbnail js-image-preview " id="claim_photo" style="width: 200px;object-fit:cover">
            </div>
        </div>
        <div class="form-group">
            <label for="date_of_sending">Дата отправки заявки по правалу</label>
            <input value="<?= $data->date_of_sending ?>" name="date_of_sending" type="date" class="form-control" id="date_of_sending">
            <div class="text-danger"><?= $claim->getError('date_of_sending') ?></div><br>
        </div>
        <div class="form-group">
            <label for="date_of_fixing">Дата устранения провала</label>
            <input value="<?= $data->date_of_fixing ?>" name="date_of_fixing" type="date" class="form-control" id="date_of_fixing">
            <div class="text-danger"><?= $claim->getError('date_of_fixing') ?></div><br>
        </div>
        <div class="form-group my-3 d-flex align-items-center justify-content-between border px-1">
            <div>
                <label for="exampleFormControlFile1">Фото отчет 5 (обнаружение провала)
                </label>
                <input type="file" class="form-control-file d-block my-2" name="image5" onchange="display_image(this.files[0],this)">
                <div class="text-danger"><?= $claim->getError('image5') ?></div><br>
            </div>

            <div>
                <img src="<?= $data->image5 != '' ? $data->image5 : get_image() ?>" alt="" class="img-thumbnail js-image-preview " id="image5" style="width: 200px;object-fit:cover">
            </div>
        </div>
        <div class="form-group my-3 d-flex align-items-center justify-content-between border px-1">
            <div>
                <label for="exampleFormControlFile1">Фото отчет 6 (устранения провала)
                </label>
                <input type="file" class="form-control-file d-block my-2" name="image6" onchange="display_image(this.files[0],this)">
                <div class="text-danger"><?= $claim->getError('image6') ?></div><br>
            </div>

            <div>
                <img src="<?= $data->image6 != '' ? $data->image6 : get_image() ?>" alt="" class="img-thumbnail js-image-preview " id="image6" style="width: 200px;object-fit:cover">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-end my-3">
            <button type="submit" class="btn btn-primary" onclick="showSpinner()">Редактировать</button>
        </div>
    </form>
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="background-color: rgba(255, 255, 255, 0);">
                <div class="modal-body text-center" style="background-color: rgba(255, 255, 255, 0);">
                    <div class="spinner-border text-light" role="status" style="width:150px;height:150px">
                        <span class="visually-hidden">Разрузка...</span>
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
            case 'image4':
                query = 'image4';
                break;
            case 'image5':
                query = 'image5';
                break;
            case 'image6':
                query = 'image6';
                break;
            case 'claim_photo':
                query = 'claim_photo';
                break;
            default:
                break
        }
        document.querySelector(`#${query}`).src = URL.createObjectURL(file)
    }

    function setSelectedOption(selectId, valueToMatch) {
        // Get the select element
        var selectElement = document.getElementById(selectId);

        // Loop through the options
        for (var i = 0; i < selectElement.options.length; i++) {
            // Check if the option's value matches the given string
            if (selectElement.options[i].value === valueToMatch) {
                // Set the selected attribute to true for the matching option
                selectElement.options[i].selected = true;
                break; // Exit the loop since we found a match
            }
        }
    }

    // Example usage
    var neighborhoodSelect = "neighborhoodSelect";
    var neighborhood = <?= json_encode($data->neighborhood)  ?>;
    var streetTypeSelect = "streetTypeSelect";
    var streetType = <?= json_encode($data->street_type)  ?>;
    var typeOfWorkSelect = "typeOfWorkSelect";
    var typeOfWork = <?= json_encode($data->type_of_work)  ?>;
    setSelectedOption(neighborhoodSelect, neighborhood);
    setSelectedOption(streetTypeSelect, streetType);
    setSelectedOption(typeOfWorkSelect, typeOfWork);

    function showSpinner() {
        // Show the modal when the form is submitted
        $('#loadingModal').modal('show');
    }
</script>

<?php include('components/footer.view.php'); ?>