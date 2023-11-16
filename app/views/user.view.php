<?php include('components/header.view.php'); ?>


<section class="d-flex justify-content-between align-items-center flex-column my-4">
    <h1>User </h1>
    <?php
    if (isset($error)) {
    ?>
        <?php include('components/alert.view.php'); ?>
        <?php
    } else {
        if (isset($message)) {
        ?>
            <p class="alert alert-info w-100"> <?= $message ?></p>
        <?php

        }
        ?>
        <form class="w-100 " method="POST" action="<?= ROOT . '/admin/edit?id=' . $user->id ?>">
            <div class="form-group my-2">
                <label for="exampleInputEmail1">Username</label>
                <input value="<?= $user->username ?>" name="username" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email or username">
            </div>

            <div class="form-group my-2">
                <label for="exampleInputPassword1">Password</label>
                <input value="<?= old_value('password') ?>" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">

            </div>

            <div class="form-group my-2">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input value="<?= old_value('password_confirmation') ?>" name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm password">
            </div>

            <div class="d-flex justify-content-between align-items-end my-2">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    <?php
    }

    ?>

</section>


<?php include('components/footer.view.php'); ?>