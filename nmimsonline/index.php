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

?>


<div id="wrapper" class="">
	<!---Section01--->
	<section class="banner_section">
		<div class="main_banner">
			<img src="images/banner4.jpg" class="responsive_img" />
			<div class="L-banner-box mobile_banner_box">
				<h2>MBA Online</h2>
				<h3>One Degree, <br>Unlimited opportunities</h3>
				<div class="f-box">

				</div>
			</div>
			<div class="container">
				<div class="banner_overlay">
					<div class="L-banner-box">
						<h2>MBA Online</h2>
						<h3>One Degree, Unlimited opportunities</h3>
						<div class="f-box">

						</div>
					</div>
					<div class="R-banner-box">
						<div class="free_sample_form">
							<h3>Inquire Now</h3>
							<span>Admissions Open.</span>
							<form class="servicefrm" name="servicefrm">
								<input type="hidden" name="type" value="" />
								<div class="name-box">
									<ul>
										<li>
											<label>Name</label>
											<input class="name" name="name" id="txtName" onpaste="return false;"
												oncopy="return false;" placeholder="Name"
												onkeypress="return  OnlyAlphaValidationWithSpace(event)" />

										</li>
										<li>
											<label>Email ID</label>
											<input id="txtEmail" name="email" class="email" onpaste="return false;"
												oncopy="return false;" placeholder="Email" type="text" />
											<div id="requestsamplefrm_email_errorloc" class="errormsg">
												Please enter your valid email
											</div>
										</li>
										<li>
											<label>Your City</label>
											<select class="form-select form-control city" name="city"
												aria-label="Default select example">
												<option value="" selected>Select City *</option>
												<optgroup label="Metro Cities">
													<option value="New Delhi">New Delhi</option>
													<option value="Mumbai">Mumbai</option>
													<option value="Bangalore">Bangalore</option>
													<option value="Chennai">Chennai</option>
													<option value="Hyderabad">Hyderabad</option>
													<option value="Kolkata">Kolkata</option>
													<option value="Pune">Pune</option>
													<option value="Ahmedabad">Ahmedabad</option>
													<option value="Jaipur">Jaipur</option>
												</optgroup>
												<optgroup label="Andaman Nicobar Islands">
													<option value="Andaman Island">Andaman Island</option>
													<option value="Nicobar Islands">Nicobar Islands</option>
													<option value="Other:Andaman">Other</option>
												</optgroup>
												<optgroup label="Arunachal Pradesh">
													<option value="Itanagar">Itanagar</option>
													<option value="Other:Arunachal">Other</option>
												</optgroup>
												<optgroup label="Andhra Pradesh">
													<option value="Hyderabad">Hyderabad</option>
													<option value="Tirupati">Tirupati</option>
													<option value="Vijayawada">Vijayawada</option>
													<option value="Visakhapatnam">Visakhapatnam</option>
													<option value="Warangal">Warangal</option>
													<option value="Other:AndhraPradesh">Other</option>
												</optgroup>
												<optgroup label="Assam">
													<option value="Guwahati">Guwahati</option>
													<option value="Dispur">Dispur</option>
													<option value="Tezpur">Tezpur</option>
													<option value="Other:Assam">Other</option>
												</optgroup>
												<optgroup label="Bihar">
													<option value="Gaya">Gaya</option>
													<option value="Nalanda">Nalanda</option>
													<option value="Patna">Patna</option>
													<option value="Rajgir">Rajgir</option>
													<option value="Vaishali">Vaishali</option>
													<option value="Other:Bihar">Other</option>
												</optgroup>
												<optgroup label="Chhattisgarh">
													<option value="Raipur">Raipur</option>
													<option value="Other:Chhattisgarh">Other</option>
												</optgroup>
												<optgroup label="Delhi">
													<option value="Faridabad">Faridabad</option>
													<option value="Ghaziabad">Ghaziabad</option>
													<option value="Greater Noida">Greater Noida</option>
													<option value="Gurgaon">Gurgaon</option>
													<option value="New Delhi">New Delhi</option>
													<option value="Noida">Noida</option>
													<option value="Other:Delhi">Other</option>
												</optgroup>
												<optgroup label="Goa">
													<option value="Canacona">Canacona</option>
													<option value="Mapusa">Mapusa</option>
													<option value="Margao">Margao</option>
													<option value="Old Goa">Old Goa</option>
													<option value="Panaji">Panaji</option>
													<option value="Ponda">Ponda</option>
													<option value="Vasco Da Gama">Vasco Da Gama</option>
													<option value="Other:Goa">Other</option>
												</optgroup>
												<optgroup label="Gujarat">
													<option value="Ahmedabad">Ahmedabad</option>
													<option value="Anand">Anand</option>
													<option value="Gandhinagar">Gandhinagar</option>
													<option value="Rajkot">Rajkot</option>
													<option value="Surat">Surat</option>
													<option value="Vadodara">Vadodara</option>
													<option value="Other:Gujarat">Other</option>
												</optgroup>
												<optgroup label="Haryana">
													<option value="Chandigarh">Chandigarh</option>
													<option value="Faridabad">Faridabad</option>
													<option value="Gurgaon">Gurgaon</option>
													<option value="Karnal">Karnal</option>
													<option value="Other:Haryana">Other</option>
												</optgroup>
												<optgroup label="Himachal Pradesh">
													<option value="Dharamsala">Dharamsala</option>
													<option value="Kullu">Kullu</option>
													<option value="Manali">Manali</option>
													<option value="Shimla">Shimla</option>
													<option value="Other:HimachalPradesh">Other</option>
												</optgroup>
												<optgroup label="Jammu and Kashmir">
													<option value="Gulmarg">Gulmarg</option>
													<option value="Jammu">Jammu</option>
													<option value="Ladakh">Ladakh</option>
													<option value="Leh">Leh</option>
													<option value="Pahalgam">Pahalgam</option>
													<option value="Srinagar">Srinagar</option>
													<option value="Other:JammuKashmir">Other</option>
												</optgroup>
												<optgroup label="Jharkhand">
													<option value="Dhanbad">Dhanbad</option>
													<option value="Jamshedpur">Jamshedpur</option>
													<option value="Ranchi">Ranchi</option>
													<option value="Other:Jharkhand">Other</option>
												</optgroup>
												<optgroup label="Karnataka">
													<option value="Bangalore">Bangalore</option>
													<option value="Davangere">Davangere</option>
													<option value="Hampi">Hampi</option>
													<option value="Hassan">Hassan</option>
													<option value="Hubli">Hubli</option>
													<option value="Mangalore">Mangalore</option>
													<option value="Mysore">Mysore</option>
													<option value="Udupi">Udupi</option>
													<option value="Other:Karnataka">Other</option>
												</optgroup>
												<optgroup label="Kerala">
													<option value="Alleppey">Alleppey</option>
													<option value="Cochin">Cochin</option>
													<option value="Kovalam">Kovalam</option>
													<option value="Kozhikode">Kozhikode</option>
													<option value="Kumarakom">Kumarakom</option>
													<option value="Munnar">Munnar</option>
													<option value="Quilon">Quilon</option>
													<option value="Thekkady">Thekkady</option>
													<option value="Trivandrum">Trivandrum</option>
													<option value="Other:Kerala">Other</option>
												</optgroup>
												<optgroup label="Lakshadweep">
													<option value="Lakshadweep">Lakshadweep</option>
													<option value="Other:Lakshadweep">Other</option>
												</optgroup>
												<optgroup label="Madhya Pradesh">
													<option value="Bhopal">Bhopal</option>
													<option value="Gwalior">Gwalior</option>
													<option value="Indore">Indore</option>
													<option value="Khajuraho">Khajuraho</option>
													<option value="Orchha">Orchha</option>
													<option value="Ujjain">Ujjain</option>
													<option value="Other:MadhyaPradesh">Other</option>
												</optgroup>
												<optgroup label="Maharashtra">
													<option value="Amravati">Amravati</option>
													<option value="Aurangabad">Aurangabad</option>
													<option value="Mumbai">Mumbai</option>
													<option value="Nagpur">Nagpur</option>
													<option value="Nashik">Nashik</option>
													<option value="Navi Mumbai">Navi Mumbai</option>
													<option value="Pune">Pune</option>
													<option value="Thane">Thane</option>
													<option value="Other:Maharashtra">Other</option>
												</optgroup>
												<optgroup label="Manipur">
													<option value="Imphal">Imphal</option>
													<option value="Other:Manipur">Other</option>
												</optgroup>
												<optgroup label="Meghalaya">
													<option value="Shillong">Shillong</option>
													<option value="Other:Meghalaya">Other</option>
												</optgroup>
												<optgroup label="Mizoram">
													<option value="Aizawl">Aizawl</option>
													<option value="Other:Mizoram">Other</option>
												</optgroup>
												<optgroup label="Nagaland">
													<option value="Kohima">Kohima</option>
													<option value="Other:Nagaland">Other</option>
												</optgroup>
												<optgroup label="Odisha">
													<option value="Bhubaneswar">Bhubaneswar</option>
													<option value="Cuttack">Cuttack</option>
													<option value="Konark">Konark</option>
													<option value="Puri">Puri</option>
													<option value="Other:Odisha">Other</option>
												</optgroup>
												<optgroup label="Pondicherry">
													<option value="Pondicherry">Pondicherry</option>
													<option value="Other:Pondicherry">Other</option>
												</optgroup>
												<optgroup label="Punjab">
													<option value="Amritsar">Amritsar</option>
													<option value="Ludhiana">Ludhiana</option>
													<option value="Patiala">Patiala</option>
													<option value="Phagwara">Phagwara</option>
													<option value="Other:Punjab">Other</option>
												</optgroup>
												<optgroup label="Rajasthan">
													<option value="Ajmer">Ajmer</option>
													<option value="Alwar">Alwar</option>
													<option value="Bhilwara">Bhilwara</option>
													<option value="Bikaner">Bikaner</option>
													<option value="Bundi">Bundi</option>
													<option value="Jaisalmer">Jaisalmer</option>
													<option value="Jaipur">Jaipur</option>
													<option value="Jodhpur">Jodhpur</option>
													<option value="Kota">Kota</option>
													<option value="Ranakpur">Ranakpur</option>
													<option value="Shekhawati">Shekhawati</option>
													<option value="Udaipur">Udaipur</option>
													<option value="Other:Rajasthan">Other</option>
												</optgroup>
												<optgroup label="Sikkim">
													<option value="Gangtok">Gangtok</option>
													<option value="Other:Sikkim">Other</option>
												</optgroup>
												<optgroup label="Tamil Nadu">
													<option value="Chennai">Chennai</option>
													<option value="Coimbatore">Coimbatore</option>
													<option value="Kanyakumari">Kanyakumari</option>
													<option value="Kodaikanal">Kodaikanal</option>
													<option value="Madurai">Madurai</option>
													<option value="Ooty">Ooty</option>
													<option value="Rameshwaram">Rameshwaram</option>
													<option value="Thanjavur">Thanjavur</option>
													<option value="Trichy">Trichy</option>
													<option value="Other:TamilNadu">Other</option>
												</optgroup>
												<optgroup label="Tripura">
													<option value="Agartala">Agartala</option>
													<option value="Other:Tripura">Other</option>
												</optgroup>
												<optgroup label="Uttar Pradesh">
													<option value="Agra">Agra</option>
													<option value="Aligarh">Aligarh</option>
													<option value="Allahabad">Allahabad</option>
													<option value="kanpur">kanpur</option>
													<option value="Lucknow">Lucknow</option>
													<option value="Meerut">Meerut</option>
													<option value="Muzaffarnagar">Muzaffarnagar</option>
													<option value="Varanasi">Varanasi</option>
													<option value="Other:UttarPradesh">Other</option>
												</optgroup>
												<optgroup label="Uttarakhand/Uttaranchal">
													<option value="Dehradun">Dehradun</option>
													<option value="Haridwar">Haridwar</option>
													<option value="Nainital">Nainital</option>
													<option value="Rishikesh">Rishikesh</option>
													<option value="Roorkee">Roorkee</option>
													<option value="Other:Uttaranchal">Other</option>
												</optgroup>
												<optgroup label="West Bengal">
													<option value="Burdwan">Burdwan</option>
													<option value="Darjeeling">Darjeeling</option>
													<option value="Durgapur">Durgapur</option>
													<option value="Kolkata">Kolkata</option>
													<option value="Murshidabad">Murshidabad</option>
													<option value="Siliguri">Siliguri</option>
													<option value="Other:WestBengal">Other</option>
												</optgroup>
											</select>
											<div id="requestsamplefrm_enquiry_errorloc" class="errormsg">
												Please enter gender
											</div>
										</li>
										<li>
											<label>Mobile Number</label>
											<input type="text" name="contactno"
												class="form-control contactno <?php echo $mobileTextClass; ?>"
												id="txtContact<?php echo $mobileTextClass; ?>"
												onchange="SendOTP('<?php echo $mobileTextClass; ?>')"
												onpaste="return false;" oncopy="return false;" maxlength="10"
												placeholder="Mobile Number*" onkeypress="return isNum(event)" />
											<div id="requestsamplefrm_contactno_errorloc" class="errormsg">
												Please enter your contact no.
											</div>
											<div class="form-group" id="dvotp">
												<div class="position-relative">
													<div class="otp-container" style="width: 100%; max-width: 400px;">
														<input type="text" id="txtotpmobile01" maxlength="6"
															class="form-control txtotp txtotpmobile01"
															placeholder="Enter OTP" aria-required="true"
															style="width: 100%; padding: 5px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-size: 16px;"
															autocomplete="off">

													
													</div>
												</div>
											</div>
										</li>


									</ul>
									<div class="clearB"></div>
								</div>

								<!-- <div class="send-box btnsubmit inputID online-mba-submit">
									<?php if ($from_fb) { ?>
									<input type="hidden" id="from_fb" name="from_fb" value="<?php echo $from_fb; ?>">
									<?php } ?>
									<?php if ($source) { ?>
									<input type="hidden" id="source" name="source" value="<?php echo $source; ?>">
									<?php } ?>
									<?php if ($source_campaign) { ?>
									<input type="hidden" id="source_campaign" name="source_campaign"
										value="<?php echo $source_campaign; ?>">
									<?php } ?>
									<?php if ($source_medium) { ?>
									<input type="hidden" id="source_medium" name="source_medium"
										value="<?php echo $source_medium; ?>">
									<?php } ?>

									<input id="btnSubmit" type="submit" name="submit" value="SUBMIT"
										class="btnsubmit inputID online-mba-submit" style="margin-top: 15px;" />
									<input type="button" name="submitting_form" value="Submitting form..."
										class="btnsubmit online-mba-submiting-form inputID" style="margin-top: 15px;" />

								</div> -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!---End Section01-->

	<!--Section02-->
	<section class="section02">
		<div class="bfuture_ready_section">
			<div class="container">
				<div class="bfr_img">
					<img src="images/bfr_img1.jpg" />
				</div>
				<div class="bfr_content">
					<h2 class="heading01">
						Elevate <span class="r-color">Your Career</span>
					</h2>
					<span>An MBA program to launch your career to the next level!</span>
					<p>
						Get ready to take your career to the next level with NMIMS CDOE’s MBA program.
						Our five contemporary specialisations are designed for working professionals
						like you, offering flexible learning options from expert faculty. Gain the skills
						and knowledge needed to succeed in today’s competitive business landscape.
						Enrol now to transform your future.
					</p>
					<div class="bfr_gac"><img src="images/bfr_gac_bg.png" /></div>
				</div>
				<i class="clearB"></i>
			</div>
			<i class="clearB"></i>
		</div>
	</section>
	<!--End Section02-->
	<!--Section03-->
	<section class="section03">
		<div class="distance_learning_programme_section">
			<div class="container">
				<div class="DLP_block">
					<h2 class="heading01W">MBA Online Specialisations</h2>

					<div class="display-desktop">
						<div id="horizontalTab">
							<ul class="resp-tabs-list">
								<li class="blue">MBA Online Specialisations</li>
							</ul>
							<div class="resp-tabs-container">
								<div>
									<div class="pgdp-block">
										<div class="L-pgdp">
											<ul>
												<li>Business Management</li>
												<li>Marketing Management</li>
												<li>Financial Management</li>
												<li>Human Resource Management</li>
												<li>Operation & Data Science Management</li>
											</ul>
										</div>
										<div class="R-pgdp">
											<ul>
												<li></li>
												<li></li>
												<li></li>
												<li></li>
												<li>
												</li>
											</ul>
										</div>
										<i class="clearB"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end-->
					<div class="dlp_slider display-mobile">
						<div class="wow fadeInLeft">
							<div class="DLP_box">
								<h4 class="degree_head blue">MBA Online Specialisations</h4>
								<div class="degree_block">
									<ul>
										<li>Business Management</li>
										<li>Marketing Management</li>
										<li>Financial Management</li>
										<li>Human Resource Management</li>
										<li>Operation & Data Science Management</li>
									</ul>
								</div>
							</div>
							<!--end-->
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End Section03-->
	<!--Section04-->
	<section class="section4">
		<div class="leadthefuture_section">
			<div class="container">
				<div class="ltf01"><img src="images/ltf_01.png" /></div>
				<h2 class="heading01">
					Lead the <span class="r-color">Future</span>
				</h2>
				<div class="lead_future_slider">
					<div class="wow fadeInLeft">
						<div class="LFS_box blue">
							<h4 class="display-desktop">
								Live Interactive & Recorded Lectures
							</h4>
							<h4 class="display-mobile">
								Live <br />Live<br />Interactive &<br />Recorded Lectures
							</h4>
							<div class="musturd">
								<p>
									24/7 access to all content, including recorded sessions of lectures
								</p>
								<div class="lfs_img"><img src="images/book.png" /></div>
							</div>
						</div>
					</div>
					<div class="wow fadeInUp">
						<div class="LFS_box blue">
							<h4 class="display-desktop">
								High Focus on Academic Excellence
							</h4>
							<h4 class="display-mobile">
								High Focus<br /> on Academic<br /> Excellence
							</h4>
							<div class="musturd">
								<p>
									600+ faculty members, including academicians and industry experts Globally curated
									curriculum
								</p>
								<div class="lfs_img">
									<img src="images/presentation.png" />
								</div>
							</div>
						</div>
					</div>
					<!--End-->
					<div class="wow fadeInUp">
						<div class="LFS_box blue">
							<h4 class="display-desktop">
								Dynamic, Application Oriented Assessment
							</h4>
							<h4 class="display-mobile">
								Dynamic,<br /> Application Oriented<br /> Assessment
							</h4>
							<div class="musturd">
								<p>
									Computer-based exams at designated centres all over India
								</p>
								<div class="lfs_img"><img src="images/student.png" /></div>
							</div>
						</div>
					</div>
					<!--End-->
					<div class="wow fadeInRight">
						<div class="LFS_box blue">
							<h4 class="display-desktop">Convenient Payment Option</h4>
							<h4 class="display-mobile">
								Convenient<br /> Payment
								<br /> Option
							</h4>
							<div class="musturd">
								<p>Flexible payment options with loan facility</p>
								<div class="lfs_img">
									<img src="images/payement_method.png" />
								</div>
							</div>
						</div>
					</div>
					<!--End-->
					<div class="wow fadeInRight">
						<div class="LFS_box blue">
							<h4 class="display-desktop">
								Latest Tech Based Learning Systems
							</h4>
							<h4 class="display-mobile">
								Latest Tech <br /> Based Learning <br /> Systems
							</h4>
							<div class="musturd">
								<p>
									Excellent mobile application based learning platform Facilities like recorded
									lectures & eBooks
								</p>
								<div class="lfs_img">
									<img src="images/latest_tech.png" />
								</div>
							</div>
						</div>
					</div>
					<!--End-->

					<!--<div class="wow fadeInLeft">
							<div class="LFS_box musturd">
								<h4 class="display-desktop">Dynamic, Application Oriented Assessment </h4>
								<h4 class="display-mobile">Dynamic,<br>Application Oriented<br> Assessment</h4>
								<p>Computer-based exams at designated centres all over India</p>
								<div class="lfs_img"><img src="images/student.png"></div>
							</div>		
						</div>
						
						<div class="wow fadeInLeft">
							<div class="LFS_box red">
								<h4 class="display-desktop">Convenient Payment Option</h4>
								<h4 class="display-mobile">Convenient<br> Payment<br> Option</h4>
								<p>Flexible payment options with loan facility </p>
								<div class="lfs_img"><img src="images/book.png"></div>
							</div>		
						</div>-->

					<!--<div class="wow fadeInLeft">
							<div class="LFS_box musturd">
								<h4 class="display-desktop">Latest Online Learning Systems</h4>
								<h4 class="display-mobile">Latest<br>Online Learning<br> Systems</h4>
								<p>Excellent mobile application based learning platform Facilities like recorded lectures & eBooks </p>
								<div class="lfs_img"><img src="images/latest_tech.png"></div>
							</div>		
						</div>-->
					<div class="wow fadeInLeft">
						<div class="LFS_box blue">
							<h4 class="display-desktop">
								Best-in-class Student Services
							</h4>
							<h4 class="display-mobile">
								Best-in-class<br />Student<br /> Services
							</h4>
							<div class="musturd">
								<p>
									Multiple touchpoints; email, toll free no. and live chat Dedicated student support
									team
								</p>
								<div class="lfs_img"><img src="images/team.png" /></div>
							</div>
						</div>
					</div>
					<div class="wow fadeInLeft">
						<div class="LFS_box blue">
							<h4 class="display-desktop">Career Services</h4>
							<h4 class="display-mobile">Career<br />Services</h4>
							<div class="musturd">
								<p>
									Unique services offering career development & assistance Right mentoring and
									guidance
								</p>
								<div class="lfs_img"><img src="images/growth.png" /></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ltf02"><img src="images/ltf_02.png" /></div>
		</div>
	</section>
	<!--End Section04-->
	<!--Start Section 05-->
	<section class="section05">
		<div class="aboutnmims_section">
			<div class="container">
				<div class="a-center abt-block">
					<h2 class="heading03">About</h2>
					<p>
						NMIMS CDOE is the distance and online education centre of NMIMS University. NMIMS CDOE began its
						ODL & OL journey in 2013 with a state of the art learning management system to provide
						interactive learning on connected platforms 24/7. <br /><br />NMIMS CDOE is changing the
						dynamics of higher education delivery in India while empowering students across India and
						enabling them to fulfil their dreams and aspirations.
					</p>
				</div>
				<div class="a-center ngaf_block">
					<h2 class="heading03">NMIMS CDOE Forte</h2>
					<ul>
						<li>
							<div class="ngaf_box blue">
								<div class="L-ngaf">
									<h3>1,56,000+</h3>
									<p>Active Students</p>
								</div>
								<div class="R-ngaf">
									<img src="images/active_students.png" />
								</div>
								<i class="clearB"></i>
							</div>
						</li>
						<li>
							<div class="ngaf_box musturd">
								<div class="L-ngaf">
									<h3>27,000+</h3>
									<p>Alumni</p>
								</div>
								<div class="R-ngaf"><img src="images/alumni.png" /></div>
								<i class="clearB"></i>
							</div>
						</li>
						<li>
							<div class="ngaf_box blue">
								<div class="L-ngaf">
									<p>Students from</p>
									<h3>600+</h3>
									<p>Locations across India</p>
								</div>
								<div class="R-ngaf"><img src="images/location.png" /></div>
								<i class="clearB"></i>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<i class="clearB"></i>
		</div>
	</section>
	<!--End Section 05-->
	<!--Start Section 06-->
	<!-- <section class="section06">
		<div class="authorized-section">
		  <div class="R_authourized_block" style="float: right">
			<div class="authourize_right_blcok">
			  <div>
				<ul>
				  <li><img src="images/AEP_logo.png" /></li>
				  <li>
					<div>
					  <h4>
						Authorised
						<span class="r-color">Enrolment Partner</span>
					  </h4>
					  <span>AEP Name - e.g. ABC Corp</span>
					</div>
				  </li>
				  <i class="clearB"></i>
				</ul>
			  </div>
			  <div class="authorised_note">
				<p>
				  As an official Authorised Enrolment Partner (AEP) of NMIMS CDOE,
				  we provide logistical support to the students enrolled through
				  our AEP. We also assist & facilitate prospective students.
				  Program delivery is an exclusive prerogative of NMIMS CDOE and as
				  an AEP, we have no has no role to play in it.
				</p>
			  </div>
			</div>
		  </div>
		  <div class="L_authourized_block">
			<div class="la_img"><img src="images/aep_img1.png" /></div>
			<div class="la_rtext">
			  <h3>Connect</h3>
			  <p>< AEP Address></p>
			  <p>Website: < AEP Website></p>
			  <p>Email: < AEP Email></p>
			  <p>< AEP Phone Number></p>
			  <ul>
				<li>
				  <a
					href="https://www.linkedin.com/school/nmims/"
					target="_blank"
					><img src="images/linked_in.png"
				  /></a>
				</li>
				<li>
				  <a href="https://www.facebook.com/NMIMSSCE" target="_blank"
					><img src="images/facebook.png"
				  /></a>
				</li>
				<li>
				  <a
					href="https://www.instagram.com/nmimsglobal/"
					target="_blank"
					><img src="images/instagram.png"
				  /></a>
				</li>
			  </ul>
			</div>
		  </div>
		  <i class="clearB"></i>
		</div>
	  </section> -->
	<!--End Section 06-->
	<!--Start Section07-->
	<section class="section7">
		<div class="regional_office_section">
			<div class="container">
				<div class="L-regional_ofc">
					<h2 class="heading01">
						<!-- NMIMS CDOE Regional<span class="r-color"> Offices</span> -->
						NMIMS Mumbai Campus Address:
					</h2>
					<p>
						<span><!-- NMIMS CDOE holds a strong national presence with regional
				  offices in -->
						</span>
						<!-- Mumbai, Delhi, Ahmedabad, Bangalore, Chandigarh, Hyderabad,
				Indore, Lucknow, Navi Mumbai & Pune. -->
						NMIMS CDOE, 2nd Floor, NMIMS Building, V. L., Pherozeshah Mehta Rd, Vile Parle West, Mumbai,
						Maharashtra 400056
					</p>
				</div>
				<div class="R-regional_ofc">
					<img src="images/nmims_ofc.png" />
				</div>
			</div>
			<i class="clearB"></i>
		</div>
	</section>
	<!--End Section07-->
	<div class="disclamer">
		<div class="container">
			<p class="disclam">
				Disclaimer: As an Affiliate Enquiry Partner (AEP) of NMIMS CDOE, we display and showcase program
				information of NMIMS CDOE. Counselling, Admission, Program delivery and examination is solely managed by
				NMIMS CDOE and as an AEP, we have no role to play in it.
			</p>
		</div>
	</div>
	<footer>
		<div class="footer-section">
			<div class="container">
				<p>
					© 2019 All Rights Reserved. |
					<a href="">Privacy Policy</a>
				</p>
			</div>
		</div>
	</footer>
</div>

<?php include 'footer.php'; ?>
<script src="js/easy-responsive-tabs.js"></script>
<script src="js/slick.js"></script>
<script>
	$(document).ready(function () {
		$("#horizontalTab").easyResponsiveTabs({
			type: "default", //Types: default, vertical, accordion
			width: "auto", //auto or any width like 600px
			fit: true, // 100% fit in a container
			closed: "accordion", // Start closed if in accordion view
			activate: function (event) {
				// Callback function if tab is switched
				var $tab = $(this);
				var $info = $("#tabInfo");
				var $name = $("span", $info);
				$name.text($tab.text());
				$info.show();
			},
		});
	});

	//-- lead the future slider Script
	$(".lead_future_slider").slick({
		dots: false,
		autoplay: true,
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
			},
		}, {
			breakpoint: 900,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			},
		}, {
			breakpoint: 600,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			},
		},],
	});

	//-- lead the future slider Script
	$(".dlp_slider").slick({
		dots: false,
		autoplay: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
			},
		}, {
			breakpoint: 900,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			},
		}, {
			breakpoint: 600,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			},
		},],
	});

	$(window).on("load", function (e) {
		$(".cookidiv").fadeIn(1000);
	});
	$(".btn-close-cooki").click(function () {
		$(".cookidiv").fadeOut(500);
	});
</script>
</body>

</html>