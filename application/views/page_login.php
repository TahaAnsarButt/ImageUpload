<?php
if ($this->session->has_userdata('ImageUploadUserId')) {
	redirect('ImageStore');
} else {
?>


	<!DOCTYPE html>
	<!-- 
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.2
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>
			Forward Image
		</title>
		<meta name="description" content="Login">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
		<!-- Call App Mode on ios devices -->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<!-- Remove Tap Highlight on Windows Phone IE -->
		<meta name="msapplication-tap-highlight" content="no">
		<!-- base css -->
		<link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
		<link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
		<!-- Place favicon.ico in the root directory -->
		<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
		<link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<!-- Optional: page related CSS-->
		<link rel="stylesheet" media="screen, print" href="css/page-login.css">

		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>/assets/css/notifications/toastr/toastr.css">
		<!-- <style> body{ background-image: url('media/video/pexels-pixabay-46798.jpg');
        width: 100%; max-width: 100%; height: auto;
        }</style> -->
	</head>

	<body>
		<div class="blankpage-form-field">

			<div class="container mt-5">

				<?php

				if ($this->session->flashdata('info')) {



				?>
					<div class="alert alert-danger alert-dismissible show fade">
						<div class="alert-body">
							<button class="close" data-dismiss="alert">
								<span>&times;</span>
							</button>
							<?php echo $this->session->flashdata('info'); ?>
						</div>
					</div>
				<?php
				}

				?>
				<div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
					<a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
						<img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
						<span class="page-logo-text mr-1">Image-Upload</span>
						<i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
					</a>
				</div>
				<div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">

					<!-- Updated this section -->
					<!-- <form method="POST" name="form1" action="<?php echo base_url('Login/process_login'); ?>">
						<div class="form-group">
							<label class="form-label" for="username">Username</label>
							<input type="text" id="username" name="username" class="form-control" placeholder="Enter Username" required>
							<span class="help-block">
								Your unique username to app
							</span>
						</div>
						<div class="form-group">
							<label class="form-label" for="password">Password</label>
							<input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
							<span class="help-block">
								Your password
							</span>
						</div>
						
						<button type="submit" class="btn btn-default float-right">Secure login</button>
					</form> -->

					<div class="form-group">
						<input type="number" class="form-control" name="username" id="username" placeholder="CardNo">
						<span id="username-error" class="error invalid-feedback">The Card No field is required</span>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						<span id="password-error" class="error invalid-feedback">The password field is required</span>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" onclick="login()">LOGIN</button>
					</div>
				</div>
				<div class="blankpage-footer text-center">
					<!--   <a href="#"><strong>Recover Password</strong></a> | <a href="#"><strong>Register Account</strong></a> -->
				</div>
			</div>
			<div class="login-footer p-2">
				<div class="row">
					<!--   <div class="col col-sm-12 text-center">
                    <i><strong>System Message:</strong> You were logged out from 198.164.246.1 on Saturday, March, 2017 at 10.56AM</i>
                </div> -->
				</div>
			</div>

			<video poster="media/video/pexels-pixabay-46798.jpg" id="bgvid" playsinline autoplay muted loop>
				<!-- <source src="media/video/pexels-cottonbro-10349005.webm" type="video/webm">
            <source src="media/video/pexels-cottonbro-10349005.mp4" type="video/mp4"> -->
				<!-- <img src="media/video/pexels-pixabay-46798.jpg" style="width: 100%; max-width: 100%; height: auto;"> -->

			</video>
			<!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
			<script src="js/vendors.bundle.js"></script>
			<script src="js/app.bundle.js"></script>
			<!-- Page related scripts -->
	</body>

	</html>


	<script src="<?php echo base_url() ?>assets/js/notifications/toastr/toastr.js"></script>
	<script src="<?php echo base_url() ?>assets/js/crypto-js.min.js"></script>



	<script>
		$(document).ready(function() {
			// login();
		})

		function login() {
			// let LOGIN_ACCESS_BY_GRADE_ID = [1, 2, 3, 4, 18, 19];

			url = "http://10.10.100.4:8010/api/login/check_credentials/";
			let cardno = $('input[id=username]');
			let password = $('input[id=password]');

			if (cardno.val().length <= 0) {
				cardno.addClass('is-invalid')
				is_valid = false
			} else {
				cardno.removeClass('is-invalid')
				is_valid = true
			}

			if (password.val().length <= 0) {
				password.addClass('is-invalid')
				is_valid = false
			} else {
				password.removeClass('is-invalid')
				is_valid = true
			}

			if (!is_valid) {
				return;
			}


			var fd = new FormData();
			fd.append("username", cardno.val());
			fd.append("password", password.val());
			$.ajax({
				url: url,
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(data, status) {
					if (data && data.error) {
						alert(data.error);
					} else {
						console.log("all data", data);
						console.log("encrpt", data.encypt);
						// console.log("gradeid", data.gradeID);
						// console.log("grade name", data.gradeName);

						console.log("all data", data);
          console.log("all data", data);
          console.log("id data", data.id);
          console.log("username data", data.picture.name);
          console.log("dept id data", data['companyInfo']['Department']['id']);
          console.log("dept id name", data['companyInfo']['Department']['name']);
          console.log("section data", data['companyInfo']['Section']['name']);
          console.log("section id data", data['companyInfo']['Section']['id']);
          console.log("managemnt rights name", data['selfservice_manager_permissions']);
          console.log("sub management rights", data['subRequests']);


        //   console.log("rights", rights);
					console.log("encrpt", data.encypt);
					// console.log("gradeid", data.gradeID);
					// console.log("grade name", data.gradeName);
          sessionStorage.setItem("user_id",data.id)
          sessionStorage.setItem("user_name",data.picture.name)
          sessionStorage.setItem("deptid",data['companyInfo']['Department']['id'])
          sessionStorage.setItem("deptname",data['companyInfo']['Department']['name'])
          sessionStorage.setItem("sectid",data['companyInfo']['Section']['id'])
          sessionStorage.setItem("sectname",data['companyInfo']['Section']['name'])
          // sessionStorage.setItem("rights",...data['selfservice_manager_permissions']...data['subRequests'])
          sessionStorage.setItem("sectname",data['companyInfo']['Section']['name'])


						const encryptedData = data.encypt;
						const decryptedBytes = CryptoJS.AES.decrypt(encryptedData, 'Password@2022').toString(CryptoJS.enc.Utf8);
						console.log('Decrypted password:', decryptedBytes);

						// if (data.gradeID == 1 || data.gradeID == 2 || data.gradeID == 3 || data.gradeID == 4 || data.gradeID == 18 || data.gradeID == 19) {
							if (data.imageUploadStatus)
								if (!(decryptedBytes.replace(/"/g, "") === password.val())) {
									toastr["error"]("Password is incorrect")
									toastr.options = {
										"closeButton": true,
										"debug": false,
										"newestOnTop": true,
										"progressBar": true,
										"positionClass": "toast-top-center",
										"preventDuplicates": false,
										"onclick": null,
										"showDuration": "300",
										"timeOut": 0,
									}
									$('input[id=password]').val('');
									return true;
								} else {
									storeSession(data);
								}
							else {
								toastr["error"]("You do not have rights to access to upload Image.")
								toastr.options = {
									"closeButton": true,
									"debug": false,
									"newestOnTop": true,
									"progressBar": true,
									"positionClass": "toast-top-center",
									"preventDuplicates": false,
									"onclick": null,
									"showDuration": "300",
									"timeOut": 0,
								}
								$('input[id=username]').val('');
								$('input[id=password]').val('');
								return true;
							}

						// } else {
						// 	toastr["error"]("You do not have rights to access Gift Souvenir.")
						// 	toastr.options = {
						// 		"closeButton": true,
						// 		"debug": false,
						// 		"newestOnTop": true,
						// 		"progressBar": true,
						// 		"positionClass": "toast-top-center",
						// 		"preventDuplicates": false,
						// 		"onclick": null,
						// 		"showDuration": "300",
						// 		"timeOut": 0,
						// 	}
						// 	$('input[id=username]').val('');
						// 	$('input[id=password]').val('');
						// 	return true;
						// }

					}

				},
				error: function() {
					alert("Error: Server is not responding.");

				}
			});
		}

		function storeSession(data) {

			console.log("data: ", data);

			url = "<?php echo base_url(''); ?>Login/authenticate2";

			$.post(url, {
				data: data
			}, function(data) {
				if (data == true) {
					window.location.href = "<?php echo base_url(''); ?>ImageStore";
				}
			});
		}
	</script>
<?php

}

?>
