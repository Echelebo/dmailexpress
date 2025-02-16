<?php include_once "menu.php"; ?>

 <!-- breadcrumb start -->
    <div class="breadcrumb-area bg-overlay-2" style="background-image:url('assets/img/banner/breadcrumb.png')">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title mb-0">
                            <h2 class="page-title">Tracking</h2>
                            <ul class="page-list">
                                <li><a href="/">Home</a></li>
                                <li>Track Parcel</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->
    <!-- /Menu -->

<div class="slide">
    </div>
		<main class="slide">

			<div class="container">
				<section class="track-num">
					<h2 for="track">Please insert your tracking number</h2>
					<br />
					<br />
				</section>
			  <ul class="nav nav-tabs">
				<li class="active"><a href="#home">CONSULT LOCAL SHIPPING</a></li>
				<!--<li><a href="#menu1">CONSULT SHIPPING ONLINE</a></li>-->
			  </ul>

			  <div class="tab-content">
					<div id="home" class="tab-pane1 fade1 in1 active">
						<div class="">
							<section class="track-num">

								<br>
								<form action="tracking-result.php" id="userForm" method="post">
									<div class="search-bar">
										<div class="form-group mob-track">
											<div class="input-group">
												<input class="form-control" name="shipping" id="shipping" type="text" placeholder="Example 472304198">
											</div>
										</div>
										<button type="submit" name="button" id="send" class="btn btn-default" style="background-color: #e11d07; color: #ffffff;"><img src="dashboard/img/tracking.png" alt="x" />&nbsp;Track my parcel</button>
									</div>
								</form>
							</section>
						</div>
					</div>
					<!--<div id="menu1" class="tab-pane fade">
						<div class="">
							<section class="track-num">
								<br>
								<form action="tracking-online.php" id="userForm2" method="post">
									<div class="search-bar">
										<div class="form-group mob-track">
											<div class="input-group">
												<input class="form-control" name="shipping_online" id="shipping_online" type="text" placeholder="Example IEL-1000001">
											</div>
										</div>
										<button type="submit" name="button" id="send" class="btn btn-info"><img src="dashboard/img/tracking.png" alt="x" />&nbsp;Track my parcel Online</button>
									</div>
								</form>
							</section>
						</div>
					</div>-->
				</div>
			</div>
        </main>

    <!-- Footer -->
 <?php include_once "footer.php"; ?>
    <!-- /Footer -->
    </div>
	<script src="process/jquery.min.js"></script>
	<script src="process/jquery.validate.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	$.validator.setDefaults({
		submit: function() {
			alert("submitted!");
		}
	});

	$(document).ready(function() {
		$("#userForm").validate({
			rules: {
				name: "required",
				shipping: {
					required: true,
					minlength: 6
				},

			},
			messages: {
				name: "Please enter your name",
				shipping: {
						required: "Please enter a valid tracking number...",
						minlength: "Your tracking number must consist of at least 13 characters"
				},
			}
		});
	});

	$(document).ready(function() {
		$("#userForm2").validate({
			rules: {
				name: "required",
				shipping_online: {
					required: true,
					minlength: 6
				},

			},
			messages: {
				name: "Please enter your name",
				shipping_online: {
						required: "Please enter a valid tracking number...",
						minlength: "Your tracking number must consist of at least 13 characters"
				},
			}
		});
	});
	</script>
	<script>
	$(document).ready(function(){
		$(".nav-tabs a").click(function(){
			$(this).tab('show');
		});
	});
	</script>
</body>
</html>
