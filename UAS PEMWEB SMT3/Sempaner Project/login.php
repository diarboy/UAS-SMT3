<?php
use Phppot\Member;
session_start();
if (!empty($_POST["login-btn"])) {
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();

	$username = trim($_POST['username']);
    $password = trim($_POST['login-password']);

    // Validasi username dan password
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username atau password tidak boleh kosong.');</script>";
    } else {
        // Cek jika username = "admin"
        if ($username === 'admin') {
            $adminData = $member->getMember($username);

            if (!empty($adminData)) {
                // Verifikasi password admin
                if (password_verify($password, $adminData[0]["password"])) {
                    // Jika login berhasil, redirect ke dashboard admin
					$_SESSION['username'] = $username; //save sesi username
					$_SESSION['role'] = 'admin'; // simpan sesi role

                    echo "<script>
                            alert('Success! Welcome to Admin Sempaner.');
                            window.location.href = 'dashboard_admin.php?success';
                          </script>";
                } else {
                    echo "<script>alert('Password Admin salah.');</script>";
                }
            } else {
                echo "<script>alert('Username admin tidak ditemukan.');</script>";
            }
        } else {

            // Jika bukan admin, cek login user biasa
            $loginResult = $member->loginMember($username, $password);

            if ($loginResult === true) {

				$_SESSION['username'] = $username; //save sesi username
				$_SESSION['role'] = 'user'; // simpan sesi role

                echo "<script>
                        alert('Login berhasil. Selamat datang!');
                        window.location.href = 'dashboard.php';
                      </script>";
            } else {
                echo "<script>alert('Username atau password salah.');</script>";
            }
        }
    }
}
?>

<HTML>
<HEAD>
<TITLE>Masuk</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="login-signup">
				<a href="user-registration.php">Daftar</a>
			</div>
			<div class="signup-align">
				<form name="login" action="" method="post"
					onsubmit="return loginValidation()">
					<div class="signup-heading">Masuk</div>
				<?php if(!empty($loginResult)){?>
				<div class="error-msg"><?php echo $loginResult;?></div>
				<?php }?>
				<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Username<span class="required error" id="username-info"></span>
							</div>
							<input class="input-box-330" type="text" name="username"
								id="username">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Kata sandi<span class="required error" id="login-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="login-password" id="login-password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="login-btn"
							id="login-btn" value="Masuk">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>

function loginValidation() {
	var valid = true;
	$("#username").removeClass("error-field");
	$("#password").removeClass("error-field");

	var UserName = $("#username").val();
	var Password = $('#login-password').val();

	$("#username-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html("required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#login-password-info").html("required.").css("color", "#ee0000").show();
		$("#login-password").addClass("error-field");
		valid = false;
	}
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;
}
</script>
</BODY>
</HTML>
