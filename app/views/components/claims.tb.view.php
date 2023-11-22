<section class="w-100">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Инвентарный</th>
                <th scope="col">РЭС</th>
                <th scope="col">Административный р.</th>
                <th scope="col">Тип улицы</th>
                <th scope="col">Создан</th>
                <th scope="col">Удален</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($claims as $claim) {
            ?>
                <tr>
                    <th scope="row"><?= $claim->invent_num ?></th>
                    <td>
                        <?= $claim->res ?>
                    </td>
                    <td>
                        <?= $claim->neighborhood ?>
                    </td>
                    <td>
                        <?= $claim->street_type ?>
                    </td>
                    <td>
                        <?= date('Y-m-d', strtotime($claim->created_at))   ?>
                    </td>
                    <?php if ($claim->is_deleted) : ?>
                        <td>
                            <?= date('Y-m-d', strtotime($claim->deleted_at))   ?>
                        </td>
                    <?php else : ?>
                        <td>----</td>
                    <?php endif ?>
                    <td>
                        <?php if ($claim->is_deleted == false) : ?>
                            <a href=" <?= ROOT . '/claim/edit?id=' . $claim->id ?>" class="btn btn-outline-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                </svg></a>
                        <?php endif ?>

                        <a href=" <?= ROOT . '/claim/single?id=' . $claim->id ?>" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                            </svg></a>
                        <?php if ($claim->is_deleted == false) : ?>
                            <a href=" <?= ROOT . '/claim/delete?id=' . $claim->id ?>" class="btn btn-outline-danger" onclick="return confirmBeforeClick()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg></a>
                        <?php endif ?>

                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    $pager->display();
    ?>
</section>
<script>
    function confirmBeforeClick() {
        // Display a confirmation dialog
        var confirmed = confirm("Вы уверены, что хотите удалить это?");

        // Return true to allow the click if the user confirms, or false if they cancel
        return confirmed;
    }
</script>