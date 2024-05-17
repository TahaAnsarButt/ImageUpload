<?php
if (!$this->session->has_userdata('ImageUploadUserId')) {
	redirect('Login');
} else {

	// print_r($this->session->userdata());
?>

	<?php
	$this->load->view('header');
	?>
	<style>
		body {
			font-family: Arial, sans-serif;

		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
		}

		.pagination {
			text-align: center;
			margin-top: 2rem;
			margin: 0 5px;
		}

		.pagination a {
			color: #007BFF;
			padding: 8px 16px;
			text-decoration: none;
			margin: 0 5px;
			border-radius: 4px;
		}

		.pagination a:hover {
			background-color: #007BFF;
			color: white;
		}

		.pagination .active {
			color: white;
		}

		.card-container {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 20px;
		}

		.card {
			border: 1px solid #ddd;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 2px 20px 0px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			text-align: left;
		}

		.card img {
			max-width: 100%;
			height: auto;
			margin-bottom: 10px;
			border-radius: 10px;
		}

		h3 {
			margin-top: 10px;
			font-size: 18px;
			text-transform: capitalize;
		}

		h1 {
			text-align: center;
			margin: 2rem;
		}

		p {
			font-size: 14px;
		}

		#page-numbers {
			margin-top: 20px;
			font-size: 16px;
		}
	</style>

	<body class="mod-bg-1 ">
		<!-- DOC: script to save and load page settings -->
		<script>
			/**
			 *	This script should be placed right after the body tag for fast execution 
			 *	Note: the script is written in pure javascript and does not depend on thirdparty library
			 **/
			'use strict';

			var classHolder = document.getElementsByTagName("BODY")[0],
				/** 
				 * Load from localstorage
				 **/
				themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
				themeURL = themeSettings.themeURL || '',
				themeOptions = themeSettings.themeOptions || '';
			console.log(themeSettings.themeOptions);

			/** 
			 * Load theme options
			 **/
			if (themeSettings.themeOptions) {
				classHolder.className = themeSettings.themeOptions;
				console.log("%c✔ Theme settings loaded", "color: #148f32");
			} else {
				console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
			}
			if (themeSettings.themeURL && !document.getElementById('mytheme')) {
				var cssfile = document.createElement('link');
				cssfile.id = 'mytheme';
				cssfile.rel = 'stylesheet';
				cssfile.href = themeURL;
				document.getElementsByTagName('head')[0].appendChild(cssfile);
			}
			/** 
			 * Save to localstorage 
			 **/
			var saveSettings = function() {
				themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
					return /^(nav|header|mod|display)-/i.test(item);
				}).join(' ');
				if (document.getElementById('mytheme')) {
					themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
				};
				localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
			}

			/** 
			 * Reset settings
			 **/
			var resetSettings = function() {
				localStorage.setItem("themeSettings", "");
			}
		</script>
		<!-- BEGIN Page Wrapper -->
		<div class="page-wrapper">

			<div class="page-inner">
				<!-- BEGIN Left Aside -->

				<!-- END Left Aside -->
				<div class="page-content-wrapper">
					<!-- BEGIN Page Header -->
					<?php
					$this->load->view('template');
					?>

					<main id="js-page-content" role="main" class="page-content">
						<?php
						if ($this->session->flashdata('info')) {

						?>
							<div class="alert alert-success alert-dismissible show fade" id="msgbox">
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

						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div id="panel-4" class="panel">
								<div class="panel-hdr">
									<h2>
										<?php echo  'Image'; ?><i>Upload</i>
									</h2>
								</div>
								<div class="panel-container show">
									<div class="panel-content">
										<div class="tab-content py-3">

											<div>

												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
														<form name="images" id="UploadImage" method="POST" action="<?php echo base_url('ImageStore/UploadPic') ?>" enctype="multipart/form-data">

															<div class="row" style="display:flex">

																<div class="col-md-3 mb-2">

																	<label for="image">Upload Image</label>
																	<input type="file" class="form-control" id="image" name="image" required>
																</div>
																<div class="col-md-3 mb-2">
																	<label for="description">Description</label>
																	<textarea class="form-control" id="description" name="description" required></textarea>
																</div>



																<div class="col-md-3 mt-4">

																	<button type="submit" class="btn btn-primary" id="savebtn">Upload</button>
																</div>
															</div>
													</div>


													</form>
													<div class="col-md-6 mt-4">
														<input type="text" id="TID" value="" style="display: none;">
													</div>
												</div>

												<div class="col-lg-12 mt-3">
													<div id="panel-4" class="panel">
														<div class="panel-hdr">
															<h2>
																<?php echo  'All '; ?> <span class="fw-300"><i>Images</i></span>
															</h2>
														</div>
														<div class="panel-container show">
															<div class="panel-content" id="images">


															</div>
															<div class="pagination" id="pagination" style="display: flex; align-items:center; justify-content:center">
																<a href="#" id="prev">Previous</a>
																<a href="#" class="page-link" data-page="1">1</a>
																<a href="#" class="page-link" data-page="2">2</a>
																<a href="#" class="page-link" data-page="3">3</a>
																<a href="#" class="page-link" data-page="4">4</a>
																<a href="#" class="page-link" data-page="5">5</a>
																<a href="#" id="next">Next</a>
																<p id="page-numbers"> </p>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>




					</main>

					<?php
					$this->load->view('after-main');
					?>

					<?php
					$this->load->view('Foter');
					?>

					<script>
						function loadimg(page = 1, perPage = 10) {
							$.get("<?php echo base_url('ImageStore/getImages') ?>", function(data) {
								let htm = ``;
								console.log(data);

								// Calculate the starting index and ending index of images for the current page
								const startIndex = (page - 1) * perPage;
								const endIndex = startIndex + perPage;

								// Loop through the data and generate HTML for images within the current page range
								data.slice(startIndex, endIndex).forEach(item => {
									htm += `
												<div class="card col-md-3 m-1" style="max-width:300px;max-height:500px; min-width:300px;min-height:300px">
													<img src="<?php echo base_url('assets/img/FTC/'); ?>${item.Picture}" alt="image" style="margin-top: 20px;" class="rounded mb-2">
													</br>
													<span>
														<b>Uploaded By: </b> ${item.name}
														</br>
														<b>Uploaded At: </b> ${item.EntryDate}
														</br>
														<b>Department: </b> ${item.deptName}
														</br>
														<b>Section: </b> ${item.sectionName}
														</br>
														<b>CardNo: </b> ${item.username}
														</br>
														<b>Description: </b> ${item.Description ? item.Description : ''}
													</span>
													<a href="<?php echo base_url('assets/img/FTC/'); ?>${item.Picture}" download="img_${item.TID}" class="btn btn-primary mt-2 btn-block">Download</a>
													</br>
													<button type="button" class="btn btn-danger btn-sm updatebtn2" onclick="deleteitem(${item.TID})">Delete<i class="fal fa-trash" aria-hidden="true"></i></button>
												</div>
											`;
								});

								// Append generated HTML to the DOM inside a row
								$("#images").html(`<div class="row">${htm}</div>`);

								// Create pagination controls
								const totalPages = Math.ceil(data.length / perPage);
								const maxVisiblePages = 5; // Number of pages to display at once
								let startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
								let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

								// Adjust startPage and endPage if they're at the beginning or end of the pagination range
								if (endPage - startPage + 1 < maxVisiblePages) {
									startPage = Math.max(1, endPage - maxVisiblePages + 1);
								}

								let paginationHtml = `<nav aria-label="Page navigation"><ul class="pagination">`;
								if (startPage > 1) {
									paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadimg(${startPage - 1}, ${perPage})">&laquo;</a></li>`;
								}
								for (let i = startPage; i <= endPage; i++) {
									paginationHtml += `<li class="page-item ${page === i ? 'active' : ''}"><a class="page-link" href="#" onclick="loadimg(${i}, ${perPage})">${i}</a></li>`;
								}
								if (endPage < totalPages) {
									paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="loadimg(${endPage + 1}, ${perPage})">&raquo;</a></li>`;
								}
								paginationHtml += `</ul></nav>`;
								$("#pagination").html(paginationHtml);
							});

						}
						function deleteitem(TID) {
                            let confirmm = confirm("Are you sure you want to delete?");
                            if (confirmm) {
                                let url1 = "<?php echo base_url('ImageStore/deleteitem') ?>";
                                $.ajax({
                                    url: url1,
                                    method: 'POST',
                                    data: {
                                        TID: TID
                                    },
                                    success: function(response) {
                                        loadimg()
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle error here
                                    }
                                });
                            }
                        }
					</script>
					<script>
						$(document).ready(function() {
							loadimg()

						});
						sessionStorage.getItem('user_id')
						console.log("userdata",sessionStorage.getItem('user_id'))
					</script>

	</body>

	</html>

<?php

}

?>