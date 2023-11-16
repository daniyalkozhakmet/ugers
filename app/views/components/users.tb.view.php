<section class="w-100">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
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
                        <a href=" <?= ROOT . '/admin/edit?id=' . $user->id ?>" class="btn btn-outline-warning">Edit</a>
                        <a href=" <?= ROOT . '/admin/view?id=' . $user->id ?>" class="btn btn-outline-primary">View</a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</section>