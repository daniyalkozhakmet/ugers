<?php include('components/header.view.php');
?>

<section class="d-flex justify-content-between align-items-center flex-column my-4">
	<h1 class="text-start">Login </h1>
	<form class="w-100 " method="POST" action="<?= ROOT . '/login' ?>">
		<div class="form-group">
			<label for="exampleInputEmail1">Username</label>
			<input value="<?= old_value('username') ?>" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email or username">
			<div class="text-danger"><?= isset($user) ? $user->getError('username') : '' ?></div><br>
		</div>
		<div class="form-group " id="show_hide_password">
			<label for="exampleInputPassword1">Password</label>
			<div class="input-group">
				<input value="<?= old_value('password') ?>" name="password" type="password" class="form-control" placeholder="Password">
				<span class="input-group-text" id="basic-addon2"><a href=""><i class="bi bi-eye-fill" aria-hidden="true"></i></a></span>
			</div>
			<div class="text-danger"><?= isset($user) ? $user->getError('username') : '' ?></div><br>
		</div>
		<div class="d-flex justify-content-between align-items-end">
			<button type="submit" class="btn btn-primary">Login</button>
		</div>
	</form>
</section>
<script>
	$(document).ready(function() {
		$("#show_hide_password a").on('click', function(event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("bi bi-eye-fill ");
				$('#show_hide_password i').removeClass("bi bi-eye-slash");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("bi bi-eye-fill ");
				$('#show_hide_password i').addClass("bi bi-eye-slash");
			}
		});
	});
</script>

<?php include('components/footer.view.php'); ?>