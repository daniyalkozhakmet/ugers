<section class="w-100">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Invent num</th>
                <th scope="col">Res</th>
                <th scope="col">Neighborhood</th>
                <th scope="col">Street type</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
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
                    <td>
                        <a href=" <?= ROOT . '/claim/edit?id=' . $claim->id ?>" class="btn btn-outline-warning">Edit</a>
                        <a href=" <?= ROOT . '/claim/single?id=' . $claim->id ?>" class="btn btn-outline-primary">View</a>
                        <a href=" <?= ROOT . '/claim/single?id=' . $claim->id ?>" class="btn btn-outline-danger">Delete</a>
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