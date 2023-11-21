<section class="w-100">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя пользователя</th>
                <th scope="col">Роль</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $user) {
            ?>
                <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td>
                        <?= $user->username ?>
                    </td>
                    <td>
                        <?= $user->role ?>
                    </td>

                    <td>
                        <a href=" <?= ROOT . '/admin/edit?id=' . $user->id ?>" class="btn btn-outline-warning">Редактировать</a>
                        <a href=" <?= ROOT . '/admin/view?id=' . $user->id ?>" class="btn btn-outline-primary">Просмотр</a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</section>