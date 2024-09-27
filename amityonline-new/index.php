<?php
$from_fb = isset($_GET['from_fb']) ? $_GET['from_fb'] : NULL;
$source = isset($_GET['source']) ? $_GET['source'] : NULL;
$source_campaign = isset($_GET['source_campaign']) ? $_GET['source_campaign'] : NULL;
$source_medium = isset($_GET['source_medium']) ? $_GET['source_medium'] : NULL;
?>

<!doctype html>
<html lang="en">
	<?php include 'header.php'; ?>
	<?php
	$mobileTextClass = 'mobile01';
	//include 'form.php'; 
	?>
<div id="wrapper applyBox" >
	<!---Section01--->
		<section class="banner_section" >
			<div class="main_banner container-fluid" style="padding-right:0px!important; padding-left:0px!important;">
					<div class="bannerTxt_wrp">
							
					</div>
						<picture>
							 <!--<source srcset="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/banner.webp" type="image/webp">-->
							 <!--<source srcset="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/banner.webp" type="image/png">-->
							 <img class="moilogo ondpt img-responsive" alt="Amity Online MBA" style=""  src="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/Amitdesktop.webp" />
							 <img class="mobilebanner  img-responsive" alt="Amity Online MBA" style=""  src="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/AmityOnline.webp" />
						</picture>
							
				<div class="container">
					<div class="banner_overlay">
						<div class="L-banner-box">
							
							<div style="display:none;" class="f-box">
								<br><br><br><div class="db-box blue">
									<h3>Balance</h3>
									<span>work, life & study</span>
								</div>
								<div class="db-box musturd">
									<h3>Awarded Category 1 </h3>
									<span>Autonomy by UGC</span>
								</div>
								<div class="db-box grey">
									<h3>Grade A+ NAAC</h3>
									<span>Accredited</span>
								</div>
							</div>
						</div>
						
						<div class="R-banner-box">
						
							<div class="free_sample_formmem" id="lead_form ">
								<p class="formheadingg" style="background-color:#fff; color:#043E7A; font-weight:600;">Enter Your Details & Connect With Our Experts</p>
								<form class="servicefrm" name="servicefrm">								
									<div class="name-box">
										<ul style="
    margin-left: -44px;
">
											<li>
												<div class="form-row form-div form-bottom-1">
													<div class="form-group col-md-12 unit" >
													 <input  class="form-control" type="text" name="fname" id="txtName" oncopy="return false;" placeholder="Name" onkeypress="return  OnlyAlphaValidationWithSpace(event)">
													</div>
												</div>
											</li>							
																						<li>
											<div class="form-row form-div form-bottom-1">
												<div class="form-group col-md-12 unit">
												<input class="form-control contactno <?php echo $mobileTextClass; ?>" name="phoneno" id="txtContact<?php echo $mobileTextClass; ?>" onchange="SendOTP('<?php echo $mobileTextClass; ?>')" onpaste="return false;" oncopy="return false;" maxlength="10" placeholder="Mobile Number*" onkeypress="return isNum(event)">
												</div>
											 </div>
											 <div id="dvotp" class="col-md-6 row-btm">
		<div class="colmyclass otpclassp" style="padding: 0;">
			<input type="text" id="txtotp<?php echo $mobileTextClass; ?>" maxlength="6" class="form-control txtotp txtotp<?php echo $mobileTextClass; ?>" placeholder="OTP" aria-required="true" style="border-radius: 0;">
			
			<input id="btnVerify<?php echo $mobileTextClass; ?>" class="btnVerify form-control" onclick="VerifyOTP('<?php echo $mobileTextClass; ?>');" type="button" value="Verify" style="background: #8fbeec none repeat scroll 0 0; color: #000; border-radius: 0;">
			<input id="btnResend<?php echo $mobileTextClass; ?>" class="btnResend form-control" onclick="ResendCode('<?php echo $mobileTextClass; ?>');" type="button" value="Resend" style="background: #8fbeec none repeat scroll 0 0; color: #000; border-radius: 0;">
			<input id="btnVerifySuccess<?php echo $mobileTextClass; ?>" class="btnVerifySuccess form-control" type="button" value="Verified" style="background: #8fbeec none repeat scroll 0 0; color: #000; display:none; border-radius: 0;">
		</div>
	</div>
											</li>
										
											<li>
											<div class="form-row form-div form-bottom-1">
													<div class="form-group col-md-12 unit">
													 <input class="form-control form-text email" type="text" name="email" id="txtEmail" onpaste="return false;" oncopy="return false;" placeholder="Email">
													</div>
												</div>
												</li>
												
												<li>	
												<div class="form-row form-div form-bottom-1">
												<div class="form-group col-md-12 unit">
													<input class="form-control form-text city" type="text" name="city" id="city" placeholder="Enter City*" required="">
												</div>
												</div>
												</li>
										
										 
	

<?php if($from_fb){ ?>
	<input type="hidden" id="from_fb" name="from_fb" value="<?php echo $from_fb;?>">
<?php } ?>
<?php if ($source) {?>
	<input type="hidden" id="source" name="source" value="<?php echo $source; ?>">
<?php }?>
<?php if ($source_campaign) {?>
	<input type="hidden" id="source_campaign" name="source_campaign" value="<?php echo $source_campaign; ?>">
<?php }?>
<?php if ($source_medium) {?>
	<input type="hidden" id="source_medium" name="source_medium" value="<?php echo $source_medium; ?>">
<?php }?>
 
<input id="btnSubmit" type="submit" name="submit" value="SUBMIT" class="btnsubmit inputID online-mba-submit" style="margin-top: 15px;" />
<input type="button" name="submitting_form" value="Submitting form..." class="btnsubmit online-mba-submiting-form inputID"style="margin-top: 15px;" />
										
									 </li>

								
										</ul>
									
									</div>							
								 
								</form>						
															
							</div>
						</div>
					
				</div>
				
			</div>
		</div>
		</section>
</div>
	<!---End Section01-->
	
<!--*****************************************************************************************************************************************************-->
	

<!--*****************************************************************************************************************************************************-->

<!--Rankings and all-->

 <div class="Container-fluid" id="onmobile" style="background-color:#Fff;">
		<div class="container ">
			<h1 class="" style="font-size:30px; font-weight:600;  font-family: Arial, Helvetica, sans-serif; color:#fff;">Why Choose SCDL?</h1>
		   
		</div>
	</div>
<!--Ignore above -->

<!--Blue Section-->
<div >
	<section class="position-relative py-5 bg-white rank-section">
	<div class="" style="width: 90%; margin: 0 auto;" >
		<div class="rank__reletive position-relative py-5">
			<div class="row align-items-center position-relative zIndex2">
				<div class="col-lg-4 col-sm-4 col-12 text-center order-md-1 desktop wow fadeInLeft" data-wow-delay="0ms"
					style="visibility: visible; animation-delay: 0ms; animation-name: fadeInLeft;">
					<div class="image-box rounded position-relative">
						<figure class="image">
							<a><img class="img-fluid rounded wow zoomIn" src="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/onlineThumb.webp" alt=""
									style="visibility: visible; animation-name: zoomIn;"></a>
						</figure>
					</div>
				</div>

				<div class="col-lg-8 col-md-8 order-md-2">
					<div class="who__content">
						<div class="widget-title wow fadeInUp mb-3"
							style="visibility: visible; animation-name: fadeInUp;">
							<p class="text-uppercase small fw-bold text-white mb-0 wow fadeInUp"
								style="visibility: visible; animation-name: fadeInUp;">WHO WE ARE</p>
							<h2 class="font-weight-900 fs-2 text-yellow title-anim mb-2 wow fadeInUp"
								data-wow-delay="0ms"
								style="visibility: visible; animation-delay: 0ms; animation-name: fadeInUp;">
							 <h1 class="text-left" style="color:#FFD700; font-weight:700;">Welcome to Amity University Online</h1>
							</h2>
						</div>

						<p class="text-justify text-white wow fadeInUp" data-wow-delay="300ms"
							style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">Amity Online MBA is designed
							to give your career the perfect boost to achieve your full
							potential. Over the years, Amity University Online has succesfully implemented Online
							education in India through its well-researched curriculum, renowned faculty, cutting-edge
							technology and close industry &amp; academic partnerships. So, what are you waiting for?</p>

						<div class="position-relative mt-3 wow fadeInUp" data-wow-delay="600ms"
							style="visibility: visible; animation-delay: 600ms; animation-name: fadeInUp;">
							<div class="row">
								<div class="col-lg-4 col-12">
									<div class="d-flex align-items-center font-weight-500 poten_item">
										<svg id="fi_11651385" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
											xmlns="http://www.w3.org/2000/svg">
											<g>
												<g>
													<path 
														d="m83.62 175.64c-7.995 0-14.5 6.505-14.5 14.5v194.65c0 7.995 6.505 14.5 14.5 14.5h344.76c7.995 0 14.5-6.505 14.5-14.5v-34.893h49.102c11.038 0 20.019-8.98 20.019-20.019v-246.396c0-11.038-8.98-20.018-20.019-20.018h-172.137c-11.038 0-20.018 8.98-20.018 20.018v65.158h-216.207c-22.883 0-41.5 18.617-41.5 41.5v194.65c0 10.067 3.606 19.307 9.59 26.5h-28.524c-12.785.001-23.186 10.402-23.186 23.187 0 33.753 27.46 61.213 61.213 61.213h389.574c33.753 0 61.213-27.46 61.213-61.213 0-12.785-10.401-23.186-23.186-23.186h-28.525c5.985-7.194 9.59-16.433 9.59-26.5v-7.036c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v7.036c0 14.612-11.888 26.5-26.5 26.5h-344.759c-14.612 0-26.5-11.888-26.5-26.5v-194.651c0-14.612 11.888-26.5 26.5-26.5h216.207v12zm413.38 258.837c0 25.482-20.731 46.213-46.213 46.213h-389.574c-25.482 0-46.213-20.732-46.213-46.213 0-4.514 3.672-8.186 8.186-8.186h465.628c4.514 0 8.186 3.672 8.186 8.186zm-352.571-50.187 4.712-25.733c1.015-5.544 5.843-9.568 11.479-9.568h66.397c5.637 0 10.464 4.024 11.479 9.569l4.712 25.732zm283.451 0h-169.421l-5.207-28.434c-2.32-12.671-13.353-21.867-26.234-21.867h-66.397c-12.881 0-23.915 9.196-26.234 21.867l-5.207 28.435h-45.06v-193.651h215.707v139.239c0 11.038 8.98 20.019 20.018 20.019h108.035zm-108.035-305.826h172.137c2.767 0 5.019 2.251 5.019 5.018v246.397c0 2.767-2.251 5.019-5.019 5.019h-172.137c-2.767 0-5.018-2.251-5.018-5.019v-246.397c0-2.767 2.251-5.018 5.018-5.018z">
													</path>
													<path
														d="m219.633 460.99h72.734c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-72.734c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z">
													</path>
													<path
														d="m334.327 231.391h71.586c4.142 0 7.5-3.358 7.5-7.5v-67.749c0-4.142-3.358-7.5-7.5-7.5h-71.586c-4.142 0-7.5 3.358-7.5 7.5v67.749c0 4.142 3.358 7.5 7.5 7.5zm7.5-67.749h56.586v52.749h-56.586z">
													</path>
													<path
														d="m334.327 132.618h143.173c4.142 0 7.5-3.358 7.5-7.5v-27.154c0-4.142-3.358-7.5-7.5-7.5h-143.173c-4.142 0-7.5 3.358-7.5 7.5v27.154c0 4.142 3.358 7.5 7.5 7.5zm7.5-27.154h128.173v12.154h-128.173z">
													</path>
													<path
														d="m152.271 123.829h11.28c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-11.28c-2.767 0-5.019-2.251-5.019-5.019v-16.5c1.657.442 3.389.7 5.183.7h109.442c1.794 0 3.526-.258 5.183-.699v16.501c0 2.767-2.251 5.019-5.019 5.019h-63.385c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h63.385c11.038 0 20.019-8.98 20.019-20.019v-67.483c0-11.038-8.98-20.019-20.019-20.019h-109.77c-11.038 0-20.019 8.98-20.019 20.019v67.482c0 11.038 8.981 20.018 20.019 20.018zm-5.019-87.5c0-2.767 2.251-5.019 5.019-5.019h109.771c2.767 0 5.019 2.251 5.019 5.019v31.498c0 2.858-2.325 5.183-5.183 5.183h-21.137v-8.384c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v8.384h-37.169v-8.384c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v8.384h-21.137c-2.858 0-5.183-2.325-5.183-5.183z">
													</path>
													<path
														d="m334.327 268.87h143.173c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-143.173c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z">
													</path>
													<path
														d="m334.327 296.331h143.173c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-143.173c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z">
													</path>
													<path
														d="m334.327 323.792h143.173c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-143.173c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z">
													</path>
													<path
														d="m477.5 173.911h-42.122c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h42.122c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z">
													</path>
													<path
														d="m477.5 199.181h-42.122c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h42.122c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z">
													</path>
													<path
														d="m265.178 218.949h-5.47v-5.47c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v5.47h-5.47c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h5.47v5.47c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-5.47h5.47c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5z">
													</path>
													<path
														d="m202.96 248.91h-18.28c-14.204 0-25.76 11.556-25.76 25.76v14.22c0 19.244 15.656 34.9 34.9 34.9s34.9-15.656 34.9-34.9v-14.22c0-14.204-11.556-25.76-25.76-25.76zm-29.04 25.76c0-5.933 4.827-10.76 10.76-10.76h18.28c5.933 0 10.76 4.827 10.76 10.76v.49h-39.8zm19.9 34.12c-10.544 0-19.176-8.25-19.836-18.63h39.671c-.66 10.38-9.291 18.63-19.835 18.63z">
													</path>
												</g>
												<circle cx="435.38" cy="156.14" r="7.5"></circle>
											</g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
											<g></g>
										</svg> Placement Assistance
									</div>
								</div>
								<div class="col-lg-4 col-12">
									<div class="d-flex align-items-center font-weight-500 poten_item">
										<svg id="fi_14274277" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="m54.967 272.615h140.477c3.692 0 7.244-1.546 9.745-4.242 2.5-2.696 3.776-6.353 3.5-10.034-2.469-32.912-24.137-60.404-53.442-71.794 11.479-8.961 18.882-22.914 18.882-38.571 0-26.977-21.947-48.923-48.923-48.923s-48.923 21.947-48.923 48.923c0 15.658 7.402 29.61 18.882 38.571-29.305 11.391-50.974 38.883-53.443 71.794v.001c-.276 3.682 1 7.338 3.501 10.034 2.501 2.695 6.052 4.241 9.744 4.241zm37.316-124.641c0-18.154 14.77-32.923 32.923-32.923s32.923 14.77 32.923 32.923-14.77 32.923-32.923 32.923-32.923-14.769-32.923-32.923zm32.923 48.923c34.249 0 63.234 26 67.245 59.718h-134.491c4.011-33.718 32.997-59.718 67.246-59.718zm81.313-156.588c0-4.418 3.582-8 8-8h125.715c4.418 0 8 3.582 8 8s-3.582 8-8 8h-125.715c-4.419 0-8-3.582-8-8zm0 35.433c0-4.418 3.582-8 8-8h125.715c4.418 0 8 3.582 8 8s-3.582 8-8 8h-125.715c-4.419 0-8-3.582-8-8zm304.429 415.828c-4.877-65.005-50.869-118.423-111.139-135.386 26.884-14.578 45.181-43.053 45.181-75.724 0-21.049-7.606-40.348-20.199-55.32v-155.776c0-16.15-13.139-29.289-29.289-29.289h-10.695v-21.45c0-9.719-7.907-17.625-17.625-17.625h-179.612c-9.718 0-17.625 7.906-17.625 17.625v21.451h-139.656c-16.15-.001-29.289 13.138-29.289 29.288v256.272c0 16.15 13.139 29.29 29.289 29.29h91.846l-18.985 32.579c-2.065 3.544-2.089 7.763-.065 11.286 2.026 3.526 5.795 5.716 9.836 5.716h129.896c-20.288 23.82-33.455 53.937-35.94 87.064-.376 5.016 1.359 9.995 4.761 13.661s8.236 5.768 13.266 5.768h268.017c5.03 0 9.866-2.103 13.268-5.77 3.401-3.666 5.135-8.646 4.759-13.66zm-152.023-141.033c-.004 0-.009 0-.013 0s-.009 0-.013 0c-38.635-.007-70.065-31.441-70.065-70.077 0-38.641 31.437-70.077 70.078-70.077s70.078 31.437 70.078 70.077c0 38.636-31.43 70.07-70.065 70.077zm-52.367 9.367-2.901-4.979h12.162c.729.424 1.454.855 2.196 1.258-3.88 1.093-7.702 2.333-11.457 3.721zm61.947-164.974c-3.152-.351-6.349-.548-9.593-.548-10.122 0-19.836 1.77-28.865 4.994l-39.069-22.556c-3.708-2.141-8.31-2.145-12.011-.007-3.702 2.137-6.001 6.124-6.001 10.405v51.917c0 4.164 2.187 8.035 5.711 10.21-.924 2.375-1.744 4.799-2.458 7.27h-36.791c-1.66 0-3.062-1.402-3.062-3.062v-80.753c0-1.66 1.402-3.062 3.062-3.062h126.014c1.66 0 3.062 1.402 3.062 3.062v22.13zm-79.539 35.453v-36.25l23.783 13.731c-9.291 5.929-17.368 13.584-23.783 22.519zm-103.021-211.758c0-.88.744-1.625 1.625-1.625h179.612c.881 0 1.625.744 1.625 1.625v78.801c0 .881-.744 1.625-1.625 1.625h-125.37c-1.674 0-3.306.525-4.666 1.501l-28.084 20.166v-13.668c0-4.418-3.582-8-8-8h-13.492c-.881 0-1.625-.744-1.625-1.625zm-155.656 37.45h139.656v41.35c0 9.718 7.906 17.625 17.625 17.625h5.491v21.26c0 3 1.679 5.748 4.348 7.118 1.151.591 2.403.882 3.651.882 1.644 0 3.281-.507 4.667-1.501l38.659-27.758h122.796c9.718 0 17.625-7.907 17.625-17.625v-41.35h10.695c7.328 0 13.289 5.961 13.289 13.289v141.009c-7.332-5.233-15.502-9.366-24.286-12.106v-25.468c0-10.511-8.551-19.062-19.062-19.062h-126.014c-10.511 0-19.062 8.551-19.062 19.062v80.753c0 10.511 8.551 19.062 19.062 19.062h33.778c-.235 2.586-.373 5.199-.373 7.844 0 7.901 1.092 15.547 3.094 22.82h-258.928v-233.915c0-7.327 5.961-13.289 13.289-13.289zm-13.289 269.561v-6.357h265.122c3.647 7.184 8.263 13.793 13.691 19.646h-265.524c-7.328.001-13.289-5.961-13.289-13.289zm123.654 29.29h144.484l6.621 11.361c-12.012 5.951-23.16 13.441-33.17 22.219h-137.505zm353.805 139.423c-.276.297-.767.651-1.538.651h-268.017c-.772 0-1.263-.354-1.538-.651-.276-.297-.592-.812-.535-1.582 5.31-70.779 65.077-126.223 136.068-126.23h.013s.009 0 .013 0c70.991.007 130.758 55.451 136.068 126.231.057.769-.259 1.284-.534 1.581z">
											</path>
										</svg> Live Classes
									</div>
								</div>

								<div class="col-lg-4 col-12">
									<div class="d-flex align-items-center font-weight-500 poten_item">
										<svg id="fi_10546221" enable-background="new 0 0 32 32" viewBox="0 0 32 32"
											xmlns="http://www.w3.org/2000/svg">
											<g fill="rgb(0,0,0)">
												<path
													d="m29.3794 25.4067h-.874v-13.3037c0-1.2051-.98-2.1851-2.1846-2.1851h-2.895v-3.2919c0-.106-.042-.208-.1172-.2827l-4.2388-4.2388c-.0365-.0365-.0801-.0658-.1285-.0861-.0484-.0202-.1008-.0311-.1542-.0311h-7.981c-1.231 0-2.2319 1.001-2.2319 2.2319v5.6988h-2.895c-1.2046 0-2.1846.98-2.1846 2.1851v13.3037h-.874c-.2207 0-.3999.1792-.3999.3999v1.4771c0 1.5049 1.2241 2.729 2.729 2.729h22.1006c1.5049 0 2.729-1.2241 2.729-2.729v-1.4771c0-.2208-.1792-.4-.3999-.4zm-10.1924-22.0542 2.8745 2.8745h-2.166c-.3906 0-.7085-.3179-.7085-.7085zm-9.813.8667c0-.7896.6426-1.4321 1.4321-1.4321h7.5811v2.7314c0 .8315.6768 1.5083 1.5083 1.5083h2.7305v12.1812c0 .7896-.6426 1.4321-1.4321 1.4321h-10.3877c-.7896 0-1.4321-.6426-1.4321-1.4321v-14.9888zm-5.0796 7.8838c0-.7637.6211-1.3853 1.3848-1.3853h2.895v1.1997h-2.6797c-.2207 0-.3999.1792-.3999.3999v11.4893c0 .2207.1792.3999.3999.3999h13.8667c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-13.4668v-10.6894h2.2798v6.4907c0 1.231 1.001 2.2319 2.2319 2.2319h10.3877c1.231 0 2.2319-1.001 2.2319-2.2319v-6.4907h2.2798v10.6895h-2.4555c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999h2.8555c.2207 0 .3999-.1792.3999-.3999v-11.4893c0-.2207-.1792-.3999-.3999-.3999h-2.6797v-1.1997h2.895c.7637 0 1.3848.6216 1.3848 1.3853v13.3037h-7.9927c-.2207 0-.3999.1792-.3999.3999v1.292h-6.626v-1.292c0-.2207-.1792-.3999-.3999-.3999h-7.9927zm24.6851 15.1807c0 1.0635-.8657 1.9292-1.9292 1.9292h-22.1006c-1.0635 0-1.9292-.8657-1.9292-1.9292v-1.0771h8.8667v1.292c0 .2207.1792.3999.3999.3999h7.4258c.2207 0 .3999-.1792.3999-.3999v-1.292h8.8667z">
												</path>
												<path
													d="m21.2798 24.0898c.0698.0801.1699.1201.2803.1201.1099 0 .21-.04.2798-.1201.04-.04.0698-.0801.0898-.1299.02-.0503.0303-.1001.0303-.1499 0-.0601-.0103-.1104-.0303-.1602-.02-.0503-.0498-.0898-.0898-.1299-.04-.0303-.0801-.0601-.1299-.0801-.1001-.04-.21-.04-.3003 0-.0498.02-.0996.0498-.1299.0801-.04.04-.0698.0796-.0898.1299-.02.0498-.0303.1001-.0303.1602 0 .0498.0103.0996.0303.1499.02.0499.0497.0899.0898.1299z">
												</path>
												<path
													d="m14.2373 10.6152h5.6782c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-5.6782c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m11.689 10.6152h.7754c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-.7754c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m14.2373 8.1499h2.2988c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-2.2988c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m11.689 8.1499h.7754c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-.7754c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m14.2373 12.8955h5.6782c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-5.6782c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m11.689 12.8955h.7754c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-.7754c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m14.2373 15.1763h5.6782c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-5.6782c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m11.689 15.1763h.7754c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-.7754c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m14.2373 17.4565h5.6782c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-5.6782c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
												<path
													d="m11.689 17.4565h.7754c.2207 0 .3999-.1792.3999-.3999s-.1792-.3999-.3999-.3999h-.7754c-.2207 0-.3999.1792-.3999.3999s.1792.3999.3999.3999z">
												</path>
											</g>
										</svg> Online Exams
									</div>
								</div>

								<div class="col-lg-4 col-12">
									<div class="d-flex align-items-center font-weight-500 poten_item">
										<svg id="fi_14466257" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
											data-name="Layer 1">
											<path
												d="m383.09961 186.93414v-73.29065l23.06055-8.74524-5.29492 74.3963c-.34863 4.89905 3.53174 9.06543 8.44312 9.06543h7.5835c4.91138 0 8.79175-4.16632 8.44312-9.06531l-5.65869-79.52209 1.08643-.41199c6.26465-2.37598 10.31348-8.24072 10.31348-14.94116s-4.04883-12.56494-10.31348-14.94092l-149.43362-56.66943c-9.88672-3.74951-20.77441-3.74902-30.6582 0l-149.43408 56.66944c-6.26465 2.37598-10.3125 8.24072-10.3125 14.94092s4.04785 12.56519 10.31299 14.94116l149.43359 56.66943c4.94238 1.87451 10.13574 2.81177 15.3291 2.81177s10.38672-.93726 15.3291-2.81177c3.09766-1.17505 4.65723-4.6394 3.48242-7.73779-1.17578-3.09863-4.64062-4.65723-7.73828-3.48242-7.13965 2.70825-15.00537 2.70825-22.14746 0l-149.43359-56.66944c-2.31787-.87915-2.56787-2.89502-2.56787-3.72095 0-.82568.25-2.84155 2.56787-3.7207l149.43359-56.66943c7.1416-2.7085 15.00684-2.7085 22.14746 0l149.43359 56.66943c2.31836.87915 2.56934 2.89502 2.56934 3.7207 0 .82593-.25098 2.8418-2.56934 3.72095l-124.40918 47.17944c-3.09766 1.17505-4.65723 4.63916-3.48242 7.73755 1.17676 3.09863 4.6416 4.6582 7.73828 3.48267l74.74609-28.34583v69.92273c0 7.10474-5.04297 13.33032-11.99219 14.80322-29.60742 6.27515-65.26172 9.59204-103.10742 9.59204s-73.49951-3.31689-103.10742-9.59204c-6.94873-1.47266-11.9917-7.69849-11.9917-14.80322v-51.73218c0-3.31372-2.68652-6-6-6s-6 2.68628-6 6v50.68701c-.30713.20435-.60376.43225-.87744.69946-35.59814 34.75757-55.20312 81.2981-55.20312 131.04883 0 101.00562 82.17383 183.17993 183.17969 183.17993 36.77734 0 72.24902-10.85645 102.58301-31.396 2.74414-1.85791 3.46191-5.58862 1.60352-8.33228-1.85645-2.74341-5.58496-3.46338-8.33203-1.60425-11.48193 7.77454-23.75269 14.06323-36.57397 18.79504 18.23022-20.56866 32.56055-50.54083 40.93945-86.32251 6.56006 2.60999 12.79004 5.47998 18.65991 8.62 8.42139 4.52911 15.72656 9.39856 21.87012 14.52863-6.87744 9.91528-14.80469 19.10822-23.74902 27.48676-2.41895 2.26538-2.54297 6.06226-.27734 8.48071 1.18164 1.26099 2.77832 1.89819 4.37988 1.89819 1.46973 0 2.94336-.53687 4.10059-1.62109 18.10645-16.96069 32.36035-37.01514 42.36523-59.60596 10.3584-23.3894 15.61035-48.32251 15.61035-74.10718 0-50.25409-19.91284-97.04681-56.08008-131.88593zm-62.36523 34.15833c3.8125 9.97461 7.01221 20.64679 9.54565 31.86749-22.75 5.96002-48.02002 9.12-74.28003 9.12s-51.53003-3.15997-74.28003-9.12c2.53345-11.2207 5.73315-21.89294 9.54565-31.86755 20.32373 2.24982 42.15601 3.4198 64.73438 3.4198s44.41064-1.16992 64.73438-3.41974zm-188.65576-20.34082c3.68237 6.93774 10.2832 12.20319 18.32568 13.90778 4.31519.91455 8.76587 1.7608 13.31543 2.55194-3.04761 8.64716-5.70947 17.76477-7.94971 27.29865-6.55005-2.61005-12.78003-5.48004-18.6499-8.62-8.43066-4.51807-15.74219-9.40253-21.88989-14.54327 5.03223-7.22717 10.65649-14.11078 16.84839-20.59509zm-30.66187 44.30176c13.41431 10.51575 30.10742 19.54303 49.30322 26.64661-2.09985 15.02997-3.20996 30.79999-3.20996 47.12s1.11011 32.09998 3.20996 47.13c-19.14648 7.08533-35.80396 16.09204-49.20081 26.57489-10.6991-22.33441-16.69885-47.33136-16.69885-73.70483 0-25.99408 5.73193-51.04834 16.59644-73.76666zm13.90405 171.17548c6.12891-5.10815 13.4104-9.95728 21.79932-14.46887 5.86987-3.14001 12.09985-6.01001 18.65991-8.62 8.36841 35.73706 22.67334 65.67926 40.87134 86.24567-33.14478-12.29041-61.47461-34.56818-81.33057-63.1568zm195.83911 21.47113c-15.45996 28.83997-35.03979 44.72998-55.15991 44.72998s-39.69995-15.89001-55.15991-44.72998c-8.25-15.42004-14.69019-33.39001-19.12012-53.01001 22.75-5.96002 48.02002-9.12 74.28003-9.12s51.53003 3.15997 74.28003 9.12c-4.42993 19.62-10.87012 37.58997-19.12012 53.01001zm23.79004-79.88c-23.93994-6.04004-50.62988-9.39001-78.94995-9.39001s-55.01001 3.34998-78.94995 9.39001c-1.58008-12.61005-2.40015-25.67999-2.40015-39s.82007-26.38 2.40015-38.99005c23.93994 6.04004 50.62988 9.39001 78.94995 9.39001s55.01001-3.34998 78.94995-9.39001c1.58008 12.61005 2.40015 25.67004 2.40015 38.99005s-.82007 26.38995-2.40015 39zm13.33032-140.60858c4.54956-.79114 9.00024-1.63739 13.31543-2.552 8.0459-1.70544 14.64893-6.97449 18.33057-13.91638 6.19702 6.48376 11.8291 13.36267 16.86353 20.58667-6.15161 5.14697-13.46997 10.03723-21.90991 14.5603-5.86987 3.13995-12.09985 6.00995-18.6499 8.62-2.24023-9.53381-4.9021-18.65143-7.94971-27.29858zm64.31641 170.85669c-.66895 1.51025-1.36377 3.00494-2.073 4.49078-13.40405-10.49725-30.07666-19.51593-49.24365-26.60889 2.09985-15.03003 3.20996-30.81 3.20996-47.13s-1.11011-32.09003-3.20996-47.12c19.20093-7.10553 35.89795-16.13574 49.31421-26.65515 10.85596 22.69794 16.58545 47.73761 16.58545 73.77521 0 24.10034-4.90625 47.39868-14.58301 69.24805z">
											</path>
										</svg> Global Faculty
									</div>
								</div>

								<div class="col-lg-4 col-12">
									<div class="d-flex align-items-center font-weight-500 poten_item">
										<svg id="fi_12797149" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
											data-name="Layer 1">
											<path
												d="m50.852 83.022h29.517a7.6 7.6 0 0 0 7.561-7.561v-37.361zm37.063 346.958a6.388 6.388 0 1 1 0-12.776h268.156a6.388 6.388 0 1 1 0 12.776zm168.552-292.869a48.754 48.754 0 1 0 0 68.949 48.756 48.756 0 0 0 0-68.949zm-34.474-27.055a61.53 61.53 0 1 1 -61.53 61.529 61.531 61.531 0 0 1 61.53-61.529zm-55.054 135.093-19.818 34.758 15.615-3.306v.009a6.368 6.368 0 0 1 7.36 4.208l5.1 15.114 20.212-35.432c-5.53.641-10.939 1.68-16.441-1.018-6.47-3.174-8.595-9.239-12.028-14.328zm121.351-6 26.529 46.528a6.379 6.379 0 0 1 -6.711 9.647l-23.963-5.073-7.795 23.075a6.374 6.374 0 0 1 -11.613 1.228l-28.737-50.403c-11.1 7.135-16.913 7.135-28.012 0l-28.738 50.4a6.374 6.374 0 0 1 -11.613-1.228l-7.795-23.075-23.962 5.073a6.378 6.378 0 0 1 -6.711-9.647l26.531-46.526c-3.746-1.3-7.32-2.957-10.047-6.355-5.573-6.944-3.484-16.759-5.61-21.094-2.1-4.289-11.241-8.834-13.319-17.7-2.075-8.844 4.021-16.94 4.021-22.419s-6.1-13.575-4.022-22.418c2.078-8.859 11.218-13.408 13.32-17.695 2.126-4.335.037-14.15 5.61-21.094 5.555-6.922 15.549-6.989 19.275-9.98 3.742-3 5.971-12.745 14.043-16.7 8.112-3.978 17.206.208 22.117-.944 4.931-1.157 11.587-9.029 20.909-9.029s15.979 7.873 20.909 9.029c4.911 1.151 14.006-3.033 22.116.944 8.073 3.959 10.3 13.7 14.044 16.7 3.726 2.991 13.719 3.058 19.275 9.98 5.573 6.944 3.484 16.759 5.61 21.094 2.1 4.287 11.241 8.836 13.319 17.695 2.075 8.843-4.021 16.94-4.021 22.418s6.1 13.576 4.021 22.419c-2.078 8.859-11.217 13.408-13.319 17.7-2.126 4.335-.037 14.15-5.61 21.094-2.727 3.4-6.3 5.054-10.047 6.355zm-11.911-9.357a21.59 21.59 0 0 0 -5.3 3.051c-5.88 4.719-8.4 13.615-11.648 15.206-3.183 1.561-11.991-1.8-19.422-.053-7.562 1.774-13.787 8.679-18.014 8.679s-10.453-6.9-18.014-8.679c-7.431-1.743-16.24 1.614-19.422.053-3.245-1.591-5.769-10.488-11.648-15.206-5.905-4.738-15.071-5.22-17.329-8.033-2.238-2.789-.754-11.851-4.113-18.7-3.389-6.911-11.447-11.272-12.321-15-.883-3.765 4.371-11.635 4.371-19.525s-5.254-15.761-4.371-19.524c.874-3.727 8.932-8.09 12.321-15 3.359-6.848 1.875-15.91 4.113-18.7 2.255-2.809 11.434-3.3 17.329-8.033s8.4-13.616 11.648-15.206c3.183-1.561 11.99 1.8 19.422.053 7.562-1.774 13.787-8.679 18.014-8.679s10.452 6.905 18.014 8.679c7.431 1.743 16.239-1.614 19.422-.053 3.244 1.59 5.768 10.487 11.648 15.206s15.074 5.224 17.329 8.033c2.238 2.789.754 11.851 4.113 18.7 3.388 6.91 11.447 11.273 12.321 15 .883 3.763-4.371 11.635-4.371 19.524s5.254 15.762 4.371 19.525c-.874 3.727-8.933 8.09-12.321 15-3.359 6.848-1.875 15.91-4.113 18.7-1.621 2.02-8.631 3.484-12.027 4.982zm-27.8 30.7 20.206 35.437 5.105-15.114a6.367 6.367 0 0 1 7.359-4.208v-.009l15.615 3.306-19.818-34.758c-3.433 5.088-5.558 11.154-12.029 14.328-5.5 2.7-10.91 1.659-16.44 1.018zm-53.5-82.934a6.38 6.38 0 1 1 7.885-10.031l13.978 10.992 23.209-26.809a6.368 6.368 0 1 1 9.632 8.334l-26.955 31.136a6.4 6.4 0 0 1 -9 1.126l-18.751-14.745zm217.967 88.106a74.4 74.4 0 0 1 0 148.253v61.744a20.38 20.38 0 0 1 -20.338 20.339h-341.43a20.379 20.379 0 0 1 -20.337-20.335v-386.255a6.405 6.405 0 0 1 1.827-4.473l54.96-66.591a6.35 6.35 0 0 1 4.915-2.322v-.024h300.065a20.381 20.381 0 0 1 20.337 20.337v229.33zm-58.996 21.522a74.135 74.135 0 0 0 -21.734 49.71h-244.401a6.388 6.388 0 1 0 0 12.776h245a74.137 74.137 0 0 0 9.326 27.378h-254.326a6.388 6.388 0 1 0 0 12.776h263.679a74.152 74.152 0 0 0 48.675 24.094v61.744a7.6 7.6 0 0 1 -7.561 7.559h-341.43a7.6 7.6 0 0 1 -7.561-7.559v-379.864h36.652a20.378 20.378 0 0 0 20.337-20.336v-46.687h292a7.6 7.6 0 0 1 7.561 7.561v229.33a74.1 74.1 0 0 0 -46.219 21.518zm9.034 9.032a61.625 61.625 0 1 0 87.151 0 61.626 61.626 0 0 0 -87.151 0zm3.73 50.09 29.305 23.043a6.4 6.4 0 0 0 9-1.126l42.257-48.81a6.368 6.368 0 0 0 -9.632-8.333l-38.514 44.484-24.53-19.289a6.38 6.38 0 1 0 -7.885 10.031z"
												fill-rule="evenodd"></path>
										</svg> Global Accreditation
									</div>
								</div>
							  


							</div>
							<div class="text-left">
							<button type="button" class="btn mt-4 phonebtn" data-toggle="modal" style=" text-transform: none;background-color: #F9C300; color: #01458E; font-size: 16px; font-weight: 600; width:20%; padding:7px; border-radius: 20px;" data-target="#exampleModalCenter">
							  Apply Now
							</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

 


<!--*****************************************************************************************************************************************************-->

<!--Drive Results-->
		<section class="vellore__section position-relative mt-4 mb-5">
			<div class="container-fluid">
			
				 <div class="widget-title text-center wow fadeInUp mb-3" style="visibility: visible; animation-name: fadeInUp;">
					
				<h3 style="font-weight: 600; color: #01458E;">Drive Results. Stand Apart. Stay Ahead</h3>
				<hr style="border-top: 5px solid #F9C300; font-weight: bold; margin: 20px auto; width: 25%;">
				
				</div> 
				<div class=" align-items-center">
		
					<div class="" style="width: 90%; margin: 0 auto;">
						<p>
							Empower yourself by giving your career the right boost with Amity Online MBA programme. 
							India's first UGC recognized online MBA aims to help learners gain insights on all important concepts, practices, 
							and trends in the subject area. The online MBA is a two-year (4 semesters) programme with specialisations in 12 areas and 
							built-in projects to prepare students for prospective job opportunities.
						</p>
				  </div>
				</div>
			</div>
		</section>
		
		<!--Assured job placement-->
<div class="container-fluid mb-4" id="onn-desktop">
	<div class="container" style="text-align: center; margin-top: 30px;">
		<div class="col-md-12">
			<div class="banner-details-holder">
				<ul class="list" style="margin-bottom: 0; padding: 0; display: flex; list-style-type: none; justify-content: space-between;">
					<li class="list-item" style="flex: 1; text-align: center;">
						<img alt="Amity Online MBA" src="images/assured-Job-opportunity.png" style="width: 54px; height: 54px;">
						<p style="color: white;">Assured Job Placement <br> Opportunity</p>
					</li>

					<li class="list-item" style="flex: 1; text-align: center;">
						<img alt="Amity Online MBA" src="images/course-icon1.png" style="width: 54px; height: 54px;">
						<p style="color: white;">Learning Efforts:<br> 10-15 hours/week</p>
					</li>

					<li class="list-item" style="flex: 1; text-align: center;">
						<img alt="Amity Online MBA" src="images/course-icon2.png" style="width: 54px; height: 54px;">
						<p style="color: white;">Duration:<br> 2 Years</p>
					</li>

					<!-- Uncomment if you want to include the fourth item -->
					<!--
					<li class="list-item" style="flex: 1; text-align: center;">
						<img src="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/course-icon3.png" style="width: 100px;">
						<p style="color: white;">Credits:<br> 99</p>
					</li>
					-->

					<li class="list-item" style="flex: 1; text-align: center;">
						<img alt="Amity Online MBA" src="images/course-icon4.png" style="width: 54px; height: 54px;">
						<p style="color: white;">Mode:<br> Online</p>
					</li>
				</ul>

			</div>
		</div>

	</div>
</div>


<div class="container-fluid" id="onn-phone" > 
<div class="container">
	
	  
			<div class="banner-details-holder">
				  <div class="row">
					<div class="col-12 mt-3 mb-4">
						<div class="text-center">
							<img src="images/assured-Job-opportunity.png">
							<p style="color:white;">
								Assured Job Placement <br>
								Opportunity
							</p>
						</div>
					</div>
					<div class="col-12 mb-4">
						<div class="text-center">
							<img src="images/course-icon1.png">
						<p style="color:white">
							Learning Efforts:<br>
							10-15 hours/ week
						</p>
						</div>
					</div>
					<div class="col-12 mb-4">
						<div class="text-center">
							<img src="images/course-icon2.png">
						<p style="color:white">Duration : 2 Years</p>
						</div>
					</div>
					<!--<div class="col-12 mb-4">-->
					<!--    <div class="text-center">-->
					<!--        <img src="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/course-icon3.png">-->
					<!--    <p style="color:white">Credits: 99</p>-->
					<!--    </div>-->
					<!--</div>-->
					  <div class="col-12 mb-4">
						<div class="text-center">
							<img src="images/course-icon4.png">
						<p style="color:white">
							Mode:<br>
							Online  
					</p>
						</div>
					</div
					
				</div>  
			   
			</div>
		</div>

	</div>
</div> 

<!--*****************************************************************************************************************************************************-->
<!--Choose the path right for you-->
	
	
	<div class="container-fluid section3 mt-5" id="Programme-Curriculum" style="background: #f5ee8154;">
		<div class="row">
			<div class="container-container">
				<h3 style="font-weight: 600; color: #01458E;">Choose the path that's right for you</h3>
				<hr style="border-top: 5px solid #F9C300; font-weight: bold; margin: 20px auto; width: 25%;">
				<p>Amity University Online now offers Online MBA with 12 specialization to choose from.</p>
				
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-7">
						<div class="row">
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC; border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Entrepreneurship.png">
								</div>
								<p style="text-align:left;  font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Entrepreneurship &amp;<br>  Leadership Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC; border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Finance.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;">Finance  &amp;<br> Accounting Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC;  padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Hospitality.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Hospitality <br>  Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC; border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Human%20resource.png">
								</div>
								<p style=" text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Human Resource <br>Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC; border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Insurance.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Insurance <br>    Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC;  padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/International.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> International <br>  Business Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC; border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Information.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Information <br>  Technology Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC; border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Marketing.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Marketing and <br> Sales Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="border-bottom: solid 1px #CCC;  padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Petroleum.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Petroleum &amp; <br>  Natural Gas Mngmt. </p>
							</div>
							
							<div class="col-md-4" style=" border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/production.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Production &amp; <br>  Operations Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="  border-right: solid 1px #CCC; padding: 10px;">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/Retail.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Retail <br>  Mngmt. </p>
							</div>
							
							<div class="col-md-4" style="  padding: 10px; ">
								<div class="thumb" style="float:left; margin-right:10px;">
									 <img alt="Amity Online MBA" src="images/global.png">
								</div>
								<p style="text-align:left; font-size: 13.2px; line-height: 18px;  color: #000; margin-bottom: 0px !important;"> Global Finance <br>  Market </p>
							</div>
						</div>
					</div>
					<div class="col-md-4"><img alt="Amity Online MBA" style="border-radius:20px;" src="images/03.jpg" class="img-responsive"></div>
				</div>
			</div>
		</div>
	</div>
	
<!--Phone Form-->



<!--*****************************************************************************************************************************************************-->  
	<!--Our Alumni Working at-->
	<div class="container-fluid section8 bg01">
		<div class="container">
			<div class="row">
				<h2>Our Alumni working at</h2>
				<div class="alumni-carousel owl-carousel owl-theme owl-loaded owl-drag">	
			<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-5780px, 0px, 0px); transition: 0.25s; width: 11561px;"><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini16.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini17.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini18.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini19.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini20.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini21.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini22.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini23.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini24.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini25.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini26.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini27.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini28.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini29.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini30.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini1.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini2.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini3.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini4.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini5.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini6.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini7.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini8.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini9.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini10.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini11.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini12.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini13.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini14.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini15.png" alt="img"></div></div><div class="owl-item active" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini16.png" alt="img"></div></div><div class="owl-item active" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini17.png" alt="img"></div></div><div class="owl-item active" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini18.png" alt="img"></div></div><div class="owl-item active" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini19.png" alt="img"></div></div><div class="owl-item active" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini20.png" alt="img"></div></div><div class="owl-item active" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini21.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini22.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini23.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini24.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini25.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini26.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini27.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini28.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini29.png" alt="img"></div></div><div class="owl-item" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini30.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini1.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini2.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini3.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini4.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini5.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini6.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini7.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini8.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini9.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini10.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini11.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini12.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini13.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini14.png" alt="img"></div></div><div class="owl-item cloned" style="width: 182.667px; margin-right: 10px;"><div class="item"><img src="images/alumini15.png" alt="img"></div></div></div></div>
			</div>
		</div>
	</div>

<!--*****************************************************************************************************************************************************-->

	<!--Fee strucutre-->
	<div class="container-fluid section6 " id="fees" style="    background: #f6f6f6; padding-top: 40px; padding-bottom: 40px; padding-left: 0px; padding-right: 0px;">
		<div class="container">
		<div class="row">
				<div class="col-md-5 dontshowonphonee">
					<h3 class="nichewaliheading" style="font-size: 20px; font-family: 'Inter!important', sans-serif; font-weight: bold; color: #3c4752; margin-bottom: 20px; margin-bottom: 30px;">Fee Structure</h3>
					<div style="    background: #043e7a; padding: 5px 0; margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-6 col-6">
								<p style="color: #fff; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">Semester</p>
								</div>
							<div class="col-md-6 col-6">
								<p style="color: #fff; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0; float:left!important;">Amount</p>
							</div>
						</div>
					</div>
					
					<!--Semester 1-->
					<div style=" background: #fff; padding: 5px 0; margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">Semester 1</p>
								</div>
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">&#8377; 48,750/-</p>
							</div>
						</div>
					</div>
					
					<!--Semester 2-->
					<div style=" background: #fff; padding: 5px 0; margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">Semester 2</p>
								</div>
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">&#8377; 48,750/-</p>
							</div>
						</div>
					</div>
					
					<!--Semester 3-->
					<div style=" background: #fff; padding: 5px 0; margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">Semester 3</p>
								</div>
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">&#8377; 48,750/-</p>
							</div>
						</div>
					</div>
					
					<!--Semester 4-->
					<div style=" background: #fff; padding: 5px 0; margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">Semester 4</p>
								</div>
							<div class="col-md-6 col-6">
								<p style="color: #043e7a; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">&#8377; 48,750/-</p>
							</div>
						</div>
					</div>
						
					<div style="    background: #043e7a; padding: 5px 0; margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-6 col-6">
								<p style="color: #fff; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0;">Total Fees</p>
								</div>
							<div class="col-md-6 col-6">
								<p style="color: #fff; font-size: 18px; font-family: 'Inter!important', sans-serif; margin: 0; float:left!important;">&#8377; 1,95,000/-</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<h3 class="nichewaliheading" style="font-size: 20px; font-family: 'Inter', sans-serif; font-weight: bold; color: #3c4752; margin-bottom: 20px; margin-bottom: 30px;"> Eligibility for Amity Online MBA</h3>
					<h3 style="font-size: 20px; font-family: 'Inter', sans-serif; font-weight: bold; color: #3c4752;">For Indian Students</h3>
					<ul style="    padding: 0; padding-left: 20px;">
						<li style="font-size: 18px; font-family: 'Inter!important', sans-serif; color: #3c4752; line-height: 25px; margin-bottom: 10px;">10th class certificate (completing 10 years of  formal schooling.)</li>
						<li style="font-size: 18px; font-family: 'Inter!important', sans-serif; color: #3c4752; line-height: 25px; margin-bottom: 10px;">12th class certificate (completing 12 years of formal schooling.)</li>
						<li style="font-size: 18px; font-family: 'Inter!important', sans-serif; color: #3c4752; line-height: 25px; margin-bottom: 10px;">Bachelor’s Degree in any discipline from any recognized university with min.40% aggregate.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<!--*****************************************************************************************************************************************************-->
<!--Certificate-->

<section class="position-relative py-5 eligib-section cert_sec">
	<div class="" style="width: 88%; margin: 0 auto;">
	  <div class="position-relative zIndex2">
		<div class="row align-items-center">
		  <div class="col-lg-5 order-md-2 wow zoomIn" style="visibility: visible; animation-name: zoomIn;">
			<div class="certificateDv position-relative">
			  <div class="image-box position-relative p-3">
				<figure class="image">
				  <a><img class="img-fluid rounded rounded-3" src="https://hikeeducation.com/wp-content/themes/lt-university/page_template/images/Certi.webp" alt=""></a>
				</figure>
			  </div>
			</div>
		  </div>

		  <div class="col-lg-7 col-md-7 student_ctnr order-md-1">
			<div class="Text-left ">
			  <h1 class=" text-left mt-4" style="font-weight:900; font-size:35px; color:#073D84;">Online Degree from</h1>
			  <h1 class="text-left" style="font-weight:900; font-size:35px; color:#073D84;">Amity University Online</h1>
				  
				<p class="text-justify mt-2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Amity University Online provides amity plus services that has the benefits of
				e-lectures,<br> counselling from academic advisors, career assistance, etc.</p>
			</div>

			<p class="text-justify fs-4 text-blue font-weight-700 wow fadeInUp mt-3" data-wow-delay="0ms" style="visibility: visible; animation-delay: 0ms; animation-name: fadeInUp; color:#073D84;">Benefits of Amity Online MBA</p>
			<div class="row entitledTxt">
			  <!--<div class="col-lg-6 wow fadeInUp" data-wow-delay="300ms">
				<ul class="listing">
				  <li>Daily LIVE Classes by Faculty of International Repute</li>
				  <li>Career Assistance & Exclusive Virtual Job Fairs</li>
				</ul>
			  </div>-->
			  
			  <div class="col-lg-6 wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
				<ul class="listing" style="list-style: none; margin: 0px; padding: 0px;">
					<li style="font-size:14px;">Career Services and Placement Assistance</li>
				</ul>
			  </div>

			  <div class="col-lg-6 wow fadeInUp" data-wow-delay="600ms" style="visibility: visible; animation-delay: 600ms; animation-name: fadeInUp;">
				<ul class="listing" style="list-style: none; margin: 0px; padding: 0px;">
				<li style="font-size:14px;">Hands-on &amp; Immersive Learning through world-Class LMS</li>
				</ul>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>


<!--*****************************************************************************************************************************************************-->

<!--Accredited Respected Trusted-->

<div class="container-fluid section7" id="Accreditations">
		<div class="row">
			<div style="width: 90%; margin: 0 auto;">
				<div class="text-center mt-2" style="width: 100%;">
					<h3 style="font-weight: 600; color: #01458E;">Accredited. Respected. Trusted.</h3>
					<hr style="border-top: 5px solid #F9C300; font-weight: bold; margin: 20px auto; width: 25%;">
				</div>
				<div class="col-md-12 col-sm-12 text-justify">
					<p>Amity University Online enjoys the guidance of Online Amity University Academic Advisory Board. The excellent quality of online MBA & BBA Programmes including course material, faculty, delivery methodology and student support services have received highly prestigious and internationally acclaimed EOCCS Certification of EFMD and these Programmes are the FIRST and the ONLY Programmes across all institutions in India to receive the globally recognized EOCCS Certification. Amity Online MBA is India’s only Online MBA to be ranked globally in 2022 by QS.</p>
				</div>
				<div class="col-md-12 col-sm-12 text-center">
					<img alt="Amity Online MBA recognitions" src="images/top-logo-panel.jpg" class="img-responsive" style="margin:auto;">
				</div>
			</div>

		</div>
</div>


<!--*****************************************************************************************************************************************************-->
	<!--FAQs-->
	<div class="container-fluid section7" style="background:#Fff">
	  
			<div class="container">
				<h3 class="text-center" style="font-weight: 600; color: #01458E; text-align:Center;">Frequently Asked Questions (F.A.Q)</h3>
				<hr style="border-top: 5px solid #F9C300; font-weight: bold; margin: 20px auto; width: 25%;">
				<div class="accordion" >
					<div class="accordion-item">
						<div class="accordion-header" style="background-color:#f6f6f6">
						   <Strong>What is Online Amity University?</Strong>
						</div>
						<div class="accordion-content">
						   Online Amity University is the online learning platform of Amity University, one of India's leading private universities. It offers a wide range of undergraduate, postgraduate, and diploma programs across various disciplines, delivered entirely online.</a>
						</div>
					</div>
					<div class="accordion-item">
						<div class="accordion-header" >
							<Strong>Is the degree earned from Online Amity University recognized?  </Strong>
						</div>
						<div class="accordion-content">
							Yes, the degrees from Online Amity University are recognized by the University Grants Commission (UGC) and the Distance Education Bureau (DEB).
						</div>
					</div>
					 <div class="accordion-item">
						<div class="accordion-header" >
							<Strong>What is the passing criteria for Online Amity University? </Strong>
						</div>
						<div class="accordion-content">
							The minimum passing criteria for Amity Online MBA is 5 SGPA(semester grade point average) and 6 CGPA (cumulative grade point average)                        
						</div>
					</div>
					
					<div class="accordion-item">
						<div class="accordion-header" >
							<Strong>How are exams conducted for online programs at Online Amity University? </Strong>
						</div>
						<div class="accordion-content">
							Exams are typically conducted online through a secure platform. Some programs may require proctored exams or the submission of projects and assignments.
					   
						</div>
					</div>
					
					
					
					
					 <!-- Add more accordion items here -->
				</div>

			
	</div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!--Phone Form-->



<!--*****************************************************************************************************************************************************-->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!--CTA-->

<div class="p-2 text-center text-dark" style="width: 100%; background-color:#F9C300;">
			
	<!--<a href="#formSection" class="btn text-center phonebtn2" style="background-color: #01458E; color: #FFFFF; font-size: 18px; font-weight: 600; width: 20%; padding:7px ;margin: 0px auto; border-radius: 20px;">Request a Callback</a>-->
	
	<!--<button type="button" class="btn text-center phonebtn2" data-toggle="modal" style="background-color: #01458E; color: #FFFFF; font-size: 18px; font-weight: 600; width: 20%; padding:7px ;margin: 0px auto; border-radius: 20px;" data-target="#exampleModalCenter">-->
	<!--   Request a Callback-->
	<!--</button>    -->
	<button type="button" class="btn text-center phonebtn2" data-toggle="modal" style="background-color: #01458E; color: #FFFFFF; font-size: 18px; font-weight: 600; width: 20%; padding: 7px; margin: 0px auto; border-radius: 20px;" data-target="#exampleModalCenter">
	Request a Callback
</button>

	
</div>

<!--Online Management Program-->
<section class="onlyphone " style="background-color:#f6f6f6; border-bottom: solid 3px #fecc00; display:none;">
		<div class="p-2">
			<div class="text-center mt-2">
				<h3 style="font-weight:600; color:#3c4752;">Online MBA Programme</h3>
				 <hr style="border-top: 5px solid #D02F38; font-weight: bold; margin: 20px auto; width: 25%;">
			</div>
			
			<div class="p-2 text-justify text-dark">
				<p>Amity Online MBA aims to empower graduates to emerge as proficient and modern global business leaders, collaborating with top experts from Amity Online. Participants will have convenient access to recorded sessions and a wealth of additional resources.</p>
				<a href="#formSection" class="btn mt-4" style="background-color:#D02F38; color:#fff; font-size:18px; font-weight:600; width: 50%; margin: 0px auto; border-radius: 20px;">Enquire Now</a>
			</div>
		</div>
</section>



<!--*****************************************************************************************************************************************************-->

<!--Footer-->

<footer class="footer position-relative py-3 text-center text-white" style="padding-top: 5px;
	padding-bottom: 5px;
	background: #043e7a;">
<div class="container">
	<h2 style="    font-size: 16px; color: #ffffff;  text-align: center;">
		Copyright © 2024, Amity University Online. All rights Reserved 
		
	</h2> 
	<p style="display:none;">
		N Block, Amity University, Campus, Sector 125, Noida, Uttar Pradesh 201301
<br>Phone: 1800 102 3434
	</p>
</div>
</footer>
 
	<?php include 'footer.php'; ?>

	<script>
$(document).ready(function() {
    $('.accordion-header').click(function() {
        // Toggle the visibility of the corresponding .faq-content
        $(this).next('.accordion-content').slideToggle();

        // Optionally, change the icon or style of the header when it's clicked
        $(this).find('.faq-icon').text(function(i, oldText) {
            return oldText === '+' ? '-' : '+';
        });
    });
});

</script>
	
</body>
</html>