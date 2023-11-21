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
                            <a href=" <?= ROOT . '/claim/edit?id=' . $claim->id ?>" class="btn btn-outline-warning"><i class="bi bi-gear"></i></a>
                        <?php endif ?>

                        <a href=" <?= ROOT . '/claim/single?id=' . $claim->id ?>" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <?php if ($claim->is_deleted == false) : ?>
                            <a href=" <?= ROOT . '/claim/delete?id=' . $claim->id ?>" class="btn btn-outline-danger" onclick="return confirmBeforeClick()"><i class="bi bi-trash-fill"></i></a>
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