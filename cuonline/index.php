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
<main>
	<section class="hero-banner position-relative mg-bottomx" id="home">
		<div class="banner-overlay position-absolute top-0 start-0 end-0 bottom-0 pt-5" style="z-index: 1">
			<div class="container">
				<div class="signUp-form bg-white border-bottom shadow-sm p-4 border-radius ms-auto" id="signup">
					<form class="servicefrm" name="servicefrm">
						<div class="register-form-container">
							<h3 class="mb-3">
								Sign Up for a Free Career Counselling Session!
							</h3>
							<div class="register-form">
								<div class="row g-2">
									<div class="mb-2 col-md-12 col-6">
										<div class="position-relative">
											<input type="text" class="name" name="name" id="txtName"
												onpaste="return false;" oncopy="return false;" placeholder="Name" required
												onkeypress="return OnlyAlphaValidationWithSpace(event)" >
											<!--<div class="errormsg frm_name_error">Please enter full name.</div>
											<div class="errormsg frm_name_error2">Please enter a valid name.</div>-->

										</div>
									</div>
									<div class="mb-2 col-md-12 col-6">
										<div class="position-relative">
											<input id="txtEmail" name="email" class="email" onpaste="return false;"
												oncopy="return false;" placeholder="Email" type="text" required>
											<!--<div id="" class="errormsg frm_email_error">Please enter your email.</div>
											<div id="" class="errormsg frm_email_error2">Please enter your valid email.
											</div>-->

										</div>
									</div>
									<div class="mb-2 col-md-10 col-6">
										<div class="position-relative">
											<input type="text" name="contactno"
												class="form-control contactno <?php echo $mobileTextClass; ?>"
												id="txtContact<?php echo $mobileTextClass; ?>"
												onchange="SendOTP('<?php echo $mobileTextClass; ?>')"
												onpaste="return false;" oncopy="return false;" maxlength="10"
												placeholder="Mobile Number*" onkeypress="return isNum(event)"
												style="border-radius: 0;" />
											<!--<div class="errormsg frm_contactno_error">Please enter your mobile number.
											</div>
											<div class="errormsg frm_contactno_error2">Mobile number should be 10 digit.
											</div>
											<div class="errormsg frm_contactno_error3">Please enter valid mobile number.
											</div>-->
										</div>

									</div>
									<div class="mb-2 col-md-10 col-6" id="dvotp">
										<div class="position-relative">
											<div class="otp-container" style="width: 100%; max-width: 400px;">
												<input type="text" id="txtotp<?php echo $mobileTextClass; ?>"
													maxlength="6"
													class="form-control txtotp txtotp<?php echo $mobileTextClass; ?>"
													placeholder="Enter OTP" aria-required="true"
													style="width: 100%; padding: 15px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-size: 16px;">

												<div class="button-group"
													style="display: flex; justify-content: space-between; gap: 10px;">
													<input id="btnVerify<?php echo $mobileTextClass; ?>"
														class="btnVerify form-control"
														onclick="VerifyOTP('<?php echo $mobileTextClass; ?>');"
														type="button" value="Verify"
														style="flex: 1; background: #4a90e2; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">

													<input id="btnResend<?php echo $mobileTextClass; ?>"
														class="btnResend form-control"
														onclick="ResendCode('<?php echo $mobileTextClass; ?>');"
														type="button" value="Resend"
														style="flex: 1; background: #4a90e2; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">

													<input id="btnVerifySuccess<?php echo $mobileTextClass; ?>"
														class="btnVerifySuccess form-control" type="button"
														value="Verified"
														style="flex: 1; background: #4a90e2; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: not-allowed; display:none;">
												</div>
											</div>
										</div>
									</div>
									<div class="mb-2 col-md-10 col-6">
										<div class="position-relative"> 
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
										</div>
										<!--<div id="" class="errormsg frm_city_error">Please select city.</div>-->
									</div>

									<div class="mb-3 col-md-12 col-6" data-select2-id="select2-data-6-42dj">
										<div class="select_custom position-relative"
											data-select2-id="select2-data-5-7o1y">
											<select name="ddlProgram" id="ddlProgram" class="form-select chgColor">
												<option value="0">Select Program</option>
												<option value="ONMB304">MBA X (Powered By Harvard)</option>
												<option value="ONMB301">Master of Business Administration (General)
												</option>
												<option value="ONCA301">MASTER OF COMPUTER APPLICATIONS</option>
												<option value="ONBB201">Bachelor of Business Administration</option>
												<option value="ONBC201">Bachelor of Computer Applications</option>
												<option value="ONMT301">Master of Science (Data Science)</option>
												<option value="ONMT302">Master of Science (Mathematics)</option>
												<option value="ONBJ201">Bachelor of Arts (Journalism and Mass
													Communication)</option>
												<option value="ONMB303">Master of Business Administration (Business
													Analytics)</option>
												<option value="ONSE301">Master of Arts (Economics)</option>
												<option value="ONLE301">Master of Arts (English)</option>
												<option value="ONMJ301">Master of Arts (Journalism and Mass
													Communication)</option>
												<option value="ONBB203">Bachelor of Business Administration (Business
													Analytics)</option>
												<option value="ONBB202">Bachelor of Business Administration - ACCA
												</option>
											</select>
											<span id="rfvProgram" style="visibility:hidden;">Select Program</span>
										</div>
									</div>

								</div>

								<div class="row g-2">
									<div class="col-12">
										<h5 style="
							font-size: 12px;
							font-weight: normal;
							color: #666;
							margin-bottom: 0;
						  ">
											Date of birth?
										</h5>
									</div>
									<div class="mb-3 col-4">
										<div class="select_custom position-relative">
											<select name="ddlDay" id="ddlDay" class="form-select chgColor">
												<option value="0">DD</option>
												<option value="01">1</option>
												<option value="02">2</option>
												<option value="03">3</option>
												<option value="04">4</option>
												<option value="05">5</option>
												<option value="06">6</option>
												<option value="07">7</option>
												<option value="08">8</option>
												<option value="09">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>

											</select>
											<span id="rfvDay" style="visibility:hidden;">Select Day</span>
										</div>
									</div>
									<div class="mb-3 col-4">
										<!-- <label for="inputEmail4">Date</label> -->
										<div class="select_custom position-relative">
											<select name="ddlMnt" id="ddlMnt" class="form-select chgColor">
												<option value="0">MM</option>
												<option value="01">JANUARY</option>
												<option value="02">FEBRUARY</option>
												<option value="03">MARCH</option>
												<option value="04">APRIL</option>
												<option value="05">MAY</option>
												<option value="06">JUNE</option>
												<option value="07">JULY</option>
												<option value="08">AUGUST</option>
												<option value="09">SEPTEMBER</option>
												<option value="10">OCTOBER</option>
												<option value="11">NOVEMBER</option>
												<option value="12">DECEMBER</option>

											</select>
											<span id="rfvMonth" style="visibility:hidden;">Select Month</span>
										</div>
									</div>
									<div class="mb-3 col-4">
										<!-- <label for="inputEmail4">Date</label> -->
										<div class="select_custom position-relative">
											<select name="ddlyear" id="ddlyear" class="form-select chgColor">
												<option value="0">YYYY</option>
												<option value="1960">1960</option>
												<option value="1961">1961</option>
												<option value="1962">1962</option>
												<option value="1963">1963</option>
												<option value="1964">1964</option>
												<option value="1965">1965</option>
												<option value="1966">1966</option>
												<option value="1967">1967</option>
												<option value="1968">1968</option>
												<option value="1969">1969</option>
												<option value="1970">1970</option>
												<option value="1971">1971</option>
												<option value="1972">1972</option>
												<option value="1973">1973</option>
												<option value="1974">1974</option>
												<option value="1975">1975</option>
												<option value="1976">1976</option>
												<option value="1977">1977</option>
												<option value="1978">1978</option>
												<option value="1979">1979</option>
												<option value="1980">1980</option>
												<option value="1981">1981</option>
												<option value="1982">1982</option>
												<option value="1983">1983</option>
												<option value="1984">1984</option>
												<option value="1985">1985</option>
												<option value="1986">1986</option>
												<option value="1987">1987</option>
												<option value="1988">1988</option>
												<option value="1989">1989</option>
												<option value="1990">1990</option>
												<option value="1991">1991</option>
												<option value="1992">1992</option>
												<option value="1993">1993</option>
												<option value="1994">1994</option>
												<option value="1995">1995</option>
												<option value="1996">1996</option>
												<option value="1997">1997</option>
												<option value="1998">1998</option>
												<option value="1999">1999</option>
												<option value="2000">2000</option>
												<option value="2001">2001</option>
												<option value="2002">2002</option>
												<option value="2003">2003</option>
												<option value="2004">2004</option>
												<option value="2005">2005</option>
												<option value="2006">2006</option>
												<option value="2007">2007</option>
												<option value="2008">2008</option>

											</select>
											<span id="rfvYear" style="visibility:hidden;">Select Year</span>
										</div>
									</div>
								</div>


								<div id="DivCheckBox" class="row g-2">
									<div class="col-12">
										<input type="checkbox" id="chkConfirmation"
											style="width:12px; height:12px; margin-right:5px; float:left;">
										<h5
											style="font-size: 11px; font-weight: normal; color: #000; margin-bottom: 15px;">
											I Confirm I Have Passed 12th Standard/Diploma.
										</h5>
									</div>
								</div>
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

								<div class="mb-2 col-md-10 col-6">
								<div class="position-relative">
										<input id="btnSubmit" type="submit" name="submit" value="SUBMIT"
											class="btnsubmit inputID online-mba-submit" style="margin-top: 0px;" />
										<input type="button" name="submitting_form" value="Submitting form..."
											class="btnsubmit online-mba-submiting-form inputID"
											style="margin-top: 15px;" />

									</div>

								</div>

					</form>
				</div>


				<div id="divResendOTP" class="row g-2">

					<div class="col-md-12 text-center text-md-start otpEdit">
						<span id="lblPrintMessage"></span>
						<div class="otp-sec">
							<p>
								Resend OTP in
								<span class="fw-bold">60</span> seconds.
							</p>
							<a id="lnkbtnResendOTP"
								href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;lnkbtnResendOTP&quot;, &quot;&quot;, true, &quot;vgIDOL&quot;, &quot;&quot;, false, true))">Resend
								OTP</a>
						</div>
					</div>
					<div class="col-md-12 otpInput">
						<div class="formField">
							<input name="txtMobileOTP" type="text" maxlength="4" id="txtMobileOTP"
								class="rd30 form-control" placeholder="OTP" />
							<input type="hidden" name="hfMobileOTP" id="hfMobileOTP" />

							<span id="rfvMobileOTP" style="visibility:hidden;">Enter OTP</span>
							<div id="vsMobileOTP" style="display:none;">

							</div>
						</div>
					</div>
				</div>
			</div>
			<p id="p_Error"></p>
		</div>
		<div class="register-form-container login-form" id="div_loginform">
			<h3 class="mb-3">
				Login for a free career counselling session!
			</h3>
			<div class="register-form">
				<div class="row g-0">
					<div class="mb-3 col-md-12 col-6">
						<input name="txtUserId" type="text" id="txtUserId" class="form-control"
							placeholder="Email ID or CUOL ID" />
						<span id="rfvUserId" style="visibility:hidden;">Enter User Id</span>

					</div>
					<div class="col-md-12 col-6">
						<input name="txtPassword" type="password" id="txtPassword" class="form-control"
							placeholder="Enter Password" />
						<span id="rfvPassword" style="visibility:hidden;">Enter Password</span>
					</div>
					<div class="mb-0 col-md-12 col-6">
						<span id="p_LoginError" style="color: #e31e24; font-size: 11px"></span>
					</div>
				</div>
				<div class="mb-0 col-md-12 col-12 d-none">
					<a id="" class="showSingle" href="#" style="color: #ffffff; text-decoration: none">Forgot
						Password?</a>
				</div>
				<div class="mt-3 col-md-12 col-12">
					<input type="submit" name="btnSignIn" value="Sign In"
						onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;btnSignIn&quot;, &quot;&quot;, true, &quot;LoginCUSET&quot;, &quot;&quot;, false, false))"
						id="btnSignIn" class="form-control btn btn-primary" />
				</div>
				<div class="mt-3 col-md-12 col-12">
					<button type="button" class="form-control btn btn-primary" id="btn_register_now">
						Register Now
					</button>
				</div>
			</div>
		</div>

		</form>
		<p class="m-0 d-none">
			I hereby accept and agree to upGrad's terms and conditions and
			privacy policy and authorize upGrad Education Private Limited ,
			its authorized representatives and affiliates to connect with me
			via calls/SMS/ emails, in connection with the courses and
			programs offered by upGrad, irrespective of my being registered
			with the National Do Not Call Registry, which I agree to
			de-register from, if required.
		</p>
		</div>
		</div>
		</div>
		<div id="carouselExampleDark" class="carousel carousel-dark slide h-90" data-bs-ride="carousel">
			<ol class="carousel-indicators d-none">
				<li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
				<li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
			</ol>

			<div class="carousel-inner h-100">
				<div class="carousel-item active sliderImg slider-img h-100" data-bs-interval="5000">
					<div class="inner-page-banner__content" style="bottom: 110px">
						<div class="container">
							<div class="in-banner-content">
								<div class="apply-page-banner-title-left">
									<!--<img
						src="img/apply-page-banner-title-left-text.png"
						class="img-fluid bannerpic-one mb-4"
					  />-->
									<img src="img/apply-page-banner-title-left-text.webp"
										class="img-fluid bannerpic-one " />
								</div>
								<!--
					<div class="applyin-banner-content-logos">
					  <img
						src="img/apply-page-banner-title-left-logos.png"
						class="img-fluid in-banner-content-logos-pic"
					  />
					</div>
					-->
								<!--
					<div class="applyin-banner-content-logos-tab">
					  <img
						src="img/apply-page-banner-title-left-tablogos.png"
						class="img-fluid in-banner-content-logos-pic"
					  />
					</div>
					-->
							</div>
						</div>
					</div>
					<div class="mobile-layeron-herobanner">
						<img src="img/apply-online-cu-bg-mobile-hurry.jpg" class="mb-1 mainbanner-badge-logo"
							alt="image" />
						<!--<div
				  class="container h-100 position-relative d-flex align-items-center"
				>
				  <div class="container">
					<div class="centeroff-textimage">
					  <div class="banner-content mobile-layeron-textsize">
						<img
						  src="img/apply-page-banner-title-left-text.png"
						  class="img-fluid mt-4 mb-4"
						  alt="image"
						/>
						<img
						  src="img/apply-page-banner-title-left-logos.png"
						  class="mb-1 mainbanner-badge-logo"
						  alt="image"
						/>
					  </div>
					</div>
				  </div>
				</div>-->
					</div>
				</div>

				<!--<div class="carousel-item sliderImg slider-img2 h-100" data-bs-interval="5000">
							<div class="container h-100 position-relative d-flex align-items-center">
								<div class="banner-content">
									<h2 class="mb-3">Global Learning at your pace & your place</h2>
									<p class="mb-4">Learn anytime and anywhere through blended pedagogies that equip you with the requisite professional & life skills</p>
									<a class="btn btn-primary btn-lg" href="#programs">Explore our Programs</a>
									
									<div class="helpline d-flex flex-row align-items-center">
										<img src="img/phone-icon.svg" alt="phone">
										<div class="help-no mx-2">
											<small>Need Help?</small>
											<a href="tel:1800121388800">1800 1213 88800</a>
										</div>
									</div>
									
								</div>
							</div>
						</div>-->
			</div>
			<!--<a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
					</a>-->
		</div>
	</section>

	<div class="banner-bar">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell1">
						<img src="new-assets/uploads/Harvard_94x94-Icon.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>Harvard Certified</h5>
							<p>Modules</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell2">
						<img src="new-assets/uploads/Icon_EMI-Options-new.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>No Cost EMI</h5>
							<p>Plan Available</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell3">
						<img src="new-assets/uploads/Hiring-Partner_94x94-Icon.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>300+</h5>
							<p>Hiring Partners</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell4">
						<img src="new-assets/uploads/icon-2.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>Scholarship Schemes</h5>
							<p>Available</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell5">
						<img src="new-assets/uploads/Icon_Book-Seat-new.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>Book Your Seat</h5>
							<p>By Paying &#8377; 10,000</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell6">
						<img src="new-assets/uploads/icon-5.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>16+ Specializations</h5>
							<p>In MBA Program</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell7">
						<img src="new-assets/uploads/On-Demand_94x94-Icon.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>On Demand</h5>
							<p>Examination</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-6 gx-0">
					<div class="cell8">
						<img src="new-assets/uploads/Industry-Experts_94x94-Icon.png" class="cell-img" />
						<div class="banner-bar__cont">
							<h5>Free Industry</h5>
							<p>Experts Session</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- adding new block start here -->
	<!--
	<section style="width:100%;background-color:#282627;;">
		<div class="banner-bar">
			<div class="container">
				<ul class="m-0 p-0 clearfix">
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/Harvard_94x94-Icon.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>Harvard Certified </h5>
							<p>Courses</p>
						</div>
					</li>
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/icon-3.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>No Cost EMI</h5>
							<p>Plan Available</p>
						</div>
					</li> 
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/Hiring-Partner_94x94-Icon.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>300+</h5>
							<p>Hiring Partners</p>
						</div>
					</li>
					<li class="d-flex align-items-start concess-block">
						<img src="new-assets/uploads/icon-2.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>Up To 30%</h5>
							<p>Early Bird Concession</p>
						</div>
					</li>
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/Book-Your-Seat_94x94-Icon.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>Book Your Seat</h5>
							<p>By Paying &#8377; 10,000</p>
						</div>
					</li>
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/icon-5.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>16+ Specializations</h5>
							<p>In MBA Program</p>
						</div>
					</li>  
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/On-Demand_94x94-Icon.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>On Demand</h5>
							<p>Examination</p>
						</div>
					</li>      
					<li class="d-flex align-items-start">
						<img src="new-assets/uploads/Industry-Experts_94x94-Icon.png" alt="icon">
						<div class="banner-bar__cont">
							<h5>Free Industry</h5>
							<p> Experts Session</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>
-->
	<!-- adding new block end here -->

	<section class="ugpg-programs p-80" id="programs">
		<div class="container">
			<div class="main-heading text-center mb-5">
				<h2>All-Inclusive <br />Online UG & PG Programs</h2>
				<p>
					Choose an internationally-recognized online undergraduate or
					postgraduate program of your choice.
				</p>
			</div>
			<div class="program-list mb-5">
				<div class="prog-heading">
					<h3 class="d-inline-block m-0 py-3">UNDERGRADUATE PROGRAMS</h3>
				</div>
				<div class="row gy-4">
					<div class="col-xl-3 col-md-4 d-none d-xl-block">
						<div class="card program-card border-0 overflow-hidden student-bg h-100"></div>
					</div>
					<div class="col-xl-9">
						<div class="row gy-4">
							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online BBA
											</h3>
										</div>
										<div class="h-60">
											<h4>Bachelor of Business Administration</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> 10+2 (Recognized Board)</span>
						  </li>
						  -->
											<li>Duration:<span> 3 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 26,000</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;19,500</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online BCA
											</h3>
										</div>
										<div class="h-60">
											<h4>Bachelor of Computer Applications</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> 10+2 (Recognized Board)</span>
						  </li>
						  -->
											<li>Duration:<span> 3 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 27,500</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377; 20,625</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online BA JMC
											</h3>
										</div>
										<div class="h-60">
											<h4>
												Bachelor of Arts-Journalism & Mass Communication
											</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
									  <li>
										Eligibility:<span> 10+2 (Recognized Board)</span>
									  </li>
									   -->
											<li>Duration:<span> 3 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 22,500</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;16,875</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online BBA Business Analytics
											</h3>
										</div>
										<div class="h-60">
											<h4>
												Bachelor of Business Administration<br />(Business
												Analytics)
											</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
													<li>Eligibility:<span> 10+2 (Recognized Board)</span></li>
													-->
											<li>Duration:<span> 3 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 31,667</span>
												<span class="animate-text">
													After 13% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
											<!-- <li><span class="animate-text">ACCA Certified</span></li> -->
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag"> -->
												<span><b>&#8377;27,550</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online BBA ACCA
												<br>
												<br>
											</h3>
										</div>
										<div class="h-60">
											<h4>
												Bachelor Of Business Administration (With ACCA)
											</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
									  <li>
										Eligibility:<span> 10+2 (Recognized Board)</span>
									  </li>
									   -->
											<li>Duration:<span> 3 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 66,667</span><span class="animate-text">
													After 15% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;56,667</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
			<div class="program-list">
				<div class="prog-heading">
					<h3 class="d-inline-block m-0 py-3">POSTGRADUATE PROGRAMS</h3>
				</div>
				<div class="row">
					<div class="col-xl-3 d-none d-xl-block">
						<div class="card program-card border-0 overflow-hidden student-bg-2 h-100"></div>
					</div>
					<div class="col-xl-9">
						<div class="row gy-4">
							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online MBA
											</h3>
										</div>
										<div class="h-60">
											<h4>Master of Business Administration</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> Bachelors (Recognized)</span>
						  </li>
						  -->
											<li>Duration:<span> 2 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 50,000</span>
												<span class="animate-text">
													After 25% Early Bird Discount on Programme Sem Fee
												</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;37,500</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden h-100">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online MCA
											</h3>
										</div>
										<div class="h-60">
											<h4>Master of Computer Applications</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
									<li>
										Eligibility:<span> Bachelors (Recognized)</span>
									</li>
									-->
											<li>Duration:<span> 2 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 30,000</span>
												<span class="animate-text">
													After 25% Early Bird Discount on Programme Sem Fee
												</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;22,500</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-lg-4 col-sm-6">
										<div class="card program-card border-0 overflow-hidden">
											<div class="card-body">
												<div class="h-60">
													<h4>Master of Arts<br> - Liberal Arts</h4>
												</div>
												<ul class="p-0 m-0">
													<li>Eligibility:<span> Bachelors (Recognized)</span></li>
													<li>Duration:<span> 2 years</span></li>
												</ul>
											</div>
											<div class="card-footer">
												<div class="row g-0 d-flex align-items-center">
													<div class="col-7" style="padding-left: 15px">
														<img src="img/prize-tag.svg" alt="tag">
														<span><b>&#8377;25000</b>/Sem</span>
													</div>
													<div class="col-5" style="background: #333333;">
														<a href="#signup" class="d-block h-100 text-center btnApply">Apply Now</a>
													</div>
												</div>
											</div>
										</div>
									</div> -->

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online M.Sc Data Science
											</h3>
										</div>
										<div class="h-60">
											<h4>Master of Science (Data Science)</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
											  <li>
												Eligibility:<span> Bachelors (Recognized)</span>
											  </li>
											  -->
											<li style="margin-top: -25px">
												Duration:<span> 2 years</span>
											</li>
											<li class="totalFee">
												<span class="del">&#8377; 30,000</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;22,500</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online MA JMC <br />
												<span style="color: #fff !important">.</span>
											</h3>
										</div>
										<div class="h-60">
											<h4>
												Master of Arts - Journalism & Mass Communication
											</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> Bachelors (Recognized)</span>
						  </li>
						  -->
											<li>Duration:<span> 2 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 25,000</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;18,750</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="col-lg-4 col-sm-6">
										<div class="card program-card border-0 overflow-hidden h-100">
											<div class="card-body">
												<div class="h-60">
													<h4>Master of <br>Commerce with ACCA</h4>
												</div>
												<ul class="p-0 m-0">
													<li>Eligibility:<span> Bachelors (Recognized)</span></li>
													<li>Duration:<span> 2 years</span></li>
											<li><span class="animate-text">ACCA Certified</span></li>
												</ul>
											</div>
											<div class="card-footer">
												<div class="row g-0 d-flex align-items-center">
													<div class="col-7" style="padding-left: 15px">
														<img src="img/prize-tag.svg" alt="tag">
														<span><b>&#8377;3,00,000</b></span>
													</div>
													<div class="col-5" style="background: #333333;">
														<a href="#signup" class="d-block h-100 text-center btnApply">Apply Now</a>
													</div>
												</div>
											</div>
										</div>
									</div>-->
							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden h-100">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online M.Sc Mathematics
											</h3>
										</div>
										<div class="h-60">
											<h4>Master of Science (Mathematics)</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> Bachelors (Recognized)</span>
						  </li>
						  -->
											<li>Duration:<span> 2 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 25,000</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;18,750</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- ma English -->
							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden h-100">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online MBA Business Analytics
											</h3>
										</div>
										<div class="h-60">
											<h4>
												Master of Business Administration<br />(Business
												Analytics)
											</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
													<li>Eligibility:<span> Bachelors (Recognized)</span></li>
													-->
											<li>Duration:<span> 2 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 50,000</span>
												<span class="animate-text">
													After 10% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
											<!-- <li class="totalFee"><span class="no_del">INR 2,00,000</span></li> -->
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag"> -->
												<span><b>&#8377;45,000</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online MA Economics
											</h3>
										</div>
										<div class="h-60">
											<h4>Master of Arts (Economics)</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> Bachelors (Recognized)</span>
						  </li>
						  -->
											<li style="margin-top: -25px">
												Duration:<span> 2 years</span>
											</li>
											<li class="totalFee">
												<span class="del">&#8377; 25,000</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer" style="margin-top: -5px">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;18,750</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-sm-6">
								<div class="card program-card border-0 overflow-hidden">
									<div class="card-body">
										<div class="">
											<h3 style="font-size: 25px; font-weight: 700">
												Online MA English
											</h3>
										</div>
										<div class="h-60">
											<h4>Master of Arts (English)</h4>
										</div>
										<ul class="p-0 m-0">
											<!--
						  <li>
							Eligibility:<span> Bachelors (Recognized)</span>
						  </li>
						  -->
											<li>Duration:<span> 2 years</span></li>
											<li class="totalFee">
												<span class="del">&#8377; 25,000</span><span class="animate-text">
													After 25% Early Bird Discount on Programme Sem
													Fee</span>
											</li>
										</ul>
									</div>
									<div class="card-footer">
										<div class="row g-0 d-flex align-items-center">
											<div class="col-7" style="padding-left: 15px">
												<!-- <img src="img/prize-tag.svg" alt="tag" /> -->
												<span><b>&#8377;18,750</b>/Sem</span>
											</div>
											<div class="col-5" style="background: #333333">
												<a href="#signup" class="d-block h-100 text-center btnApply">Apply
													Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!--			
					<div class="col-lg-4 col-sm-6">
						<div class="card program-card border-0 overflow-hidden">
							<div class="card-body">
								<div class="">
									<h3 style="font-size:25px;font-weight:1000;"> Online  M.Com </h3>
								</div>
								<div class="h-60">
									<h4>Master of  Commerce</h4>
								</div>
								<ul class="p-0 m-0">
									<li>Duration:<span> 2 years</span></li>
									<li class="totalFee">
										<span class="del">&#8377; 32500</span>
										<span class="animate-text">
										After 30% Early Bird Discount on Programme Sem
										Fee</span>
									</li>
									
								</ul>
							</div>
							<div class="card-footer">
								<div class="row g-0 d-flex align-items-center">
									<div class="col-7" style="padding-left: 15px">
										<span><b>&#8377;22750</b>/Sem</span>
									</div>
									<div class="col-5" style="background: #333333">
										<a  href="#signup"  class="d-block h-100 text-center btnApply">Apply Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
								-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="program-outcomes p-60">
		<div class="container">
			<!--
		  <div class="main-heading text-center mb-5 text-black">
			<h2>Program Outcomes</h2>
			<p>
			  Synonymous with academic research, pioneering innovation,
			  best-in-class educational opportunities, our easy-to-access
			  educational initiatives will help you:
			</p>
		  </div>
		  <div class="row justify-content-center mb-5">
			<div class="col-lg-4 col-md-6">
			  <div class="card text-center d-flex align-items-center mb-3">
				<img src="img/po-icon-1.svg" alt="icon" />
				<p>
				  Take your career to the next level with new-age & relevant
				  skills
				</p>
			  </div>
			</div>
			<div class="col-lg-4 col-md-6">
			  <div class="card text-center d-flex align-items-center mb-3">
				<img src="img/po-icon-2.svg" alt="icon" />
				<p>
				  Amplify your professional worth with globally-recognized
				  higher degree
				</p>
			  </div>
			</div>
		  </div>
		  -->
			<div class="main-heading text-center mb-3 text-black" style="max-width: 100%">
				<h2 style="line-height: 35px">
					<span style="font-weight: 400; font-family: 'Poppins'">
						Why study with
					</span>
					<span class="why-study-lineheight">Chandigarh University Online?</span>
				</h2>
				<br />
				<!--
			<p style="font-size: 14px; line-height: 20px">
			  UGC & AICTE recognized Chandigarh University, with top-class
			  technology, imparts world-class curricula curated by experienced
			  subject matter experts for undergraduate & postgraduate programs.
			  The flexibility to study at any time and from anywhere avails you
			  the freedom to plan your studies at your own pace.
			</p>
			-->
			</div>

			<!--
		  <div class="down-arrow text-center">
			<img src="img/down-arrow-icon.svg" alt="icon" />
		  </div>
		  -->
		</div>

		<div class="whystudy-onlinecumain">
			<div class="container">
				<!-- set one -->
				<div class="border-bothside">
					<div class="whystudy-showcard">
						<div class="whystudy-sidefull1">
							<div class="whystudy-sideicon">
								<img src="new-assets/images/why-ugc.png" class="whystudy-sideicon-pic" />
							</div>
							<div class="whystudy-headingfull">
								<h4 class="whystudy-headingtext">UGC Entitled Programs:</h4>
							</div>
							<div class="whystudy-detailfull">
								<p class="whystudy-detailtext">
									Recognized by the University Grants Commission, ensuring
									credibility and quality assurance.
								</p>
								<p class="whystudy-detailtext">
									Provides a stamp of approval for academic standards and
									curriculum relevance.
								</p>
							</div>
						</div>
					</div>
					<div class="whystudy-showcard">
						<div class="whystudy-sidefull2">
							<div class="whystudy-sideicon">
								<img src="new-assets/images/why-harvard.png" class="whystudy-sideicon-pic" />
							</div>
							<div class="whystudy-headingfull">
								<h4 class="whystudy-headingtext">
									Courses Empowered By Harvard &amp; KPMG:
								</h4>
							</div>
							<div class="whystudy-detailfull">
								<p class="whystudy-detailtext">
									Backed by prestigious institutions, offering cutting-edge
									and industry-relevant content.
								</p>
								<p class="whystudy-detailtext">
									Access to world-class resources and insights from renowned
									experts in business and management.
								</p>
							</div>
						</div>
					</div>
					<div class="whystudy-showcard">
						<div class="whystudy-sidefull2">
							<div class="whystudy-sideicon">
								<img src="new-assets/images/why-career-placement-assistance.png"
									class="whystudy-sideicon-pic" />
							</div>
							<div class="whystudy-headingfull">
								<h4 class="whystudy-headingtext">
									Experienced & Globally Renowned Faculty:
								</h4>
							</div>
							<div class="whystudy-detailfull">
								<p class="whystudy-detailtext">
									Learn from seasoned professionals with vast expertise,
									ensuring a rich and insightful learning experience.
								</p>
								<p class="whystudy-detailtext">
									Gain global perspectives and practical knowledge from
									faculty members with diverse backgrounds.
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- set two -->
				<div class="border-bothside">
					<div class="whystudy-showcard">
						<div class="whystudy-sidefull1">
							<div class="whystudy-sideicon">
								<img src="new-assets/images/why-affordable-fee-structure.png"
									class="whystudy-sideicon-pic" />
							</div>
							<div class="whystudy-headingfull">
								<h4 class="whystudy-headingtext">
									Affordable Fee With No Cost EMI Options:
								</h4>
							</div>
							<div class="whystudy-detailfull">
								<p class="whystudy-detailtext">
									Enables access to quality education without financial
									constraints, promoting inclusivity and affordability.
								</p>
								<p class="whystudy-detailtext">
									Flexibility in payment through EMI options, making
									education more accessible to a wider audience.
								</p>
							</div>
						</div>
					</div>
					<div class="whystudy-showcard">
						<div class="whystudy-sidefull2">
							<div class="whystudy-sideicon">
								<img src="new-assets/images/why-regular-live-interactive-sessions.png"
									class="whystudy-sideicon-pic" />
							</div>
							<div class="whystudy-headingfull">
								<h4 class="whystudy-headingtext">
									Regular Live Interactive Sessions with Industry Experts:
								</h4>
							</div>
							<div class="whystudy-detailfull">
								<p class="whystudy-detailtext">
									Engage in real-time discussions and gain valuable insights
									from industry leaders and practitioners.
								</p>
								<p class="whystudy-detailtext">
									Enhances learning through interactive experiences and
									firsthand industry knowledge.
								</p>
							</div>
						</div>
					</div>
					<div class="whystudy-showcard">
						<div class="whystudy-sidefull2">
							<div class="whystudy-sideicon">
								<img src="new-assets/images/why-study-from-well-experienced.png"
									class="whystudy-sideicon-pic" />
							</div>
							<div class="whystudy-headingfull">
								<h4 class="whystudy-headingtext">
									Advanced Learning Management System (LMS):
								</h4>
							</div>
							<div class="whystudy-detailfull">
								<p class="whystudy-detailtext">
									Access to a sophisticated learning platform that
									facilitates seamless navigation and resource management.
								</p>
								<p class="whystudy-detailtext">
									Offers personalized learning paths, assessments, and
									collaboration tools for an enriched educational journey.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--
	<section class="whystudy-mainsection" style="margin-bottom:50px;">
		
	</section>
	-->
	<div class="clearfix"></div>
	<section class="top-numbers pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-6">
					<h2><span class="count">478</span></h2>
					<h6>International <br />Collaborations</h6>
				</div>
				<div class="col-md-3 col-6">
					<h2><span class="count">2400</span>+</h2>
					<h6>Patents</h6>
				</div>
				<div class="col-md-3 col-6">
					<h2><span class="count">10</span>K</h2>
					<h6>Research <br />Publications</h6>
				</div>
				<div class="col-md-3 col-6">
					<h2><span class="count">146</span></h2>
					<h6>Startups</h6>
				</div>
			</div>
		</div>
	</section>

	<section class="cu-advantages p-60">
		<div class="container">
			<div class="main-heading text-center mb-5">
				<h2>Advantages You Will Get</h2>
				<p>
					Envisioned to engage you through blended pedagogies for the
					requisite professional and life skills, our curriculum at par with
					the best regular programs.
				</p>
			</div>
			<div class="center slider">
				<div class="sl-item">
					<div class="card adv-card text-center">
						<span class="d-flex align-content-center mx-auto">
							<img src="img/adv-icon-1.svg" alt="icon" class="mx-auto" />
						</span>
						<h3>Best-in-class Learning</h3>
						<p>
							Learn from University Professors<br />
							Latest industry-relevant curriculum<br />
							200+ hours of online videos<br />
							200+ ebooks
						</p>
					</div>
				</div>
				<div class="sl-item">
					<div class="card adv-card text-center">
						<span class="d-flex align-content-center mx-auto">
							<img src="img/adv-icon-2.svg" alt="icon" class="mx-auto" />
						</span>
						<h3>Career Assistance</h3>
						<p>
							Resume Support<br />
							Interview Preparation<br />
							Personality Development Sessions<br />
							Spoken English Classes<br />
						</p>
					</div>
				</div>
				<div class="sl-item">
					<div class="card adv-card text-center">
						<span class="d-flex align-content-center mx-auto">
							<img src="img/adv-icon-3.svg" alt="icon" class="mx-auto" />
						</span>
						<h3>Learner Support</h3>
						<p>
							24*7 Doubt Clarification<br />
							Dedicated Student Mentor<br />
							Easy EMI/financing options
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="program-outcomes p-80">
		<div class="container">
			<div class="main-heading text-center mb-5 text-black">
				<h2>
					National &amp; International Regulatory Bodies That Rate &amp;
					Recognize Us
				</h2>
				<p>
					Knowing the affiliations &amp; evaluations of your institution are
					important as not only they authenticate its credibility but also
					enhances the value of your degree.
				</p>
			</div>
			<!-- <div class="text-center">
						<span class="nt-icons position-relative mx-4">
							<img src="img/ugc-logo.webp" alt="image" class="mx-auto">
							</span>
							<span class="nt-icons position-relative mx-4">
								<img src="img/image%2011.webp" alt="image" class="mx-auto">
								</span>
						<span class="nt-icons position-relative mx-4">
						<img src="img/qs-logo.webp" alt="image" class="mx-auto">
						</span>
						
						
						
						<span class="nt-icons position-relative mx-4">
						<img src="img/wes-logo.webp" alt="image" class="mx-auto">
						</span>
						<span class="nt-icons position-relative mx-4">
							<img src="img/image%2010.webp" alt="image" class="mx-auto">
							</span>
							<span class="nt-icons position-relative mx-4">
								<img src="img/acca-logo.webp" alt="image" class="mx-auto">
								</span>
					</div> -->
			<!--	
			<div class="certified-logos">
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img src="img/ugc-logo.webp" alt="image" class="mx-auto" />
				  </span>
				</div>
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img src="img/image%2011.webp" alt="image" class="mx-auto" />
				  </span>
				</div>
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img src="img/qs-logo.webp" alt="image" class="mx-auto" />
				  </span>
				</div>
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img src="img/wes-logo.webp" alt="image" class="mx-auto" />
				  </span>
				</div>
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img src="img/image%2010.webp" alt="image" class="mx-auto" />
				  </span>
				</div>
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img src="img/acca-logo.webp" alt="image" class="mx-auto" />
				  </span>
				</div>
				<div class="logos-item">
				  <span class="nt-icons position-relative mx-4">
					<img
					  src="img/harvard-bp-logo.webp"
					  alt="image"
					  class="mx-auto"
					/>
				  </span>
				</div>
			</div>
			-->
		</div>
	</section>

	<section class="rank-section mentor-section pt-9 pb-9" style="background: #fff !important">
		<div class="container">
			<!--
			<div class="section-heading text-center mb-5">
					 <h2>Recognitions &amp; Certifications</h2>
			</div> -->
			<div class="row">
				<div class="col-lg-10-new margin-lg-1">
					<div class="blaze-slider2" style="--slides-to-show: 2; --slide-gap: 25px">
						<div class="blaze-container">
							<div class="blaze-track-container">
								<div class="blaze-track" style="
						transition-property: transform;
						transition-timing-function: ease;
						transition-duration: 300ms;
						transform: translate3d(0px, 0px, 0px);
					  ">
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 ls-is-cached lazyloaded-logo-item"
											data-src="img/harvard-bp-logo.webp" alt="" src="img/harvard-bp-logo.webp" />
									</div>
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 lazyloaded-logo-item"
											data-src="img/qs-logo.webp" alt="" src="img/qs-logo.webp" />
									</div>
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 lazyloaded-logo-item"
											data-src="img/image 11.webp" alt="" src="img/image%2011.webp" />
									</div>
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 lazyloaded-logo-item naacgrade-icon"
											data-src="img/image 10.webp" alt="" src="img/image%2010.webp" />
									</div>
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 lazyloaded-logo-item"
											data-src="img/ugc-logo.webp" alt="" src="img/ugc-logo.webp" />
									</div>
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 lazyloaded-logo-item"
											data-src="img/acca-logo.webp" alt="" src="img/acca-logo.webp" />
									</div>
									<div class="card-logo-item">
										<img class="img-fluid-new rounded-3 lazyloaded-logo-item"
											data-src="img/wes-logo.webp" alt="" src="img/wes-logo.webp" />
									</div>
								</div>
							</div>
							<button class="blaze-prev">&lt;</button>
							<button class="blaze-next">&gt;</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="alumnimain">
		<div class="">
			<div class="">
				<div class="section-heading text-center mt-5 mb-2">
					<h2 style="color: #fff">Our Alumni Work At</h2>
				</div>
				<div class="alumnimain-company pb-6">
					<img src="img/index-hiring-partner-desktopimage.png" class="alumnimain-company-img"
						id="alumnimain-company-desktop" />
					<img src="img/index-hiring-partner-mobileimage.png" class="alumnimain-company-img"
						id="alumnimain-company-mobile" />
				</div>
			</div>
		</div>
	</section>
	<!--
	  <section class="path-sec p-80">
		<div class="container">
		  <div class="main-heading text-center mb-5 text-black">
			<h2>Attend our Online campus</h2>
			<p>
			  Get 24X7 learning access to the university with high-quality
			  online education at an affordable cost.
			</p>
		  </div>
		  <div class="row">
			<div class="col-md-4 text-center">
			  <img src="img/oc-icon-1.svg" alt="image" />
			  <span>1</span>
			  <h3>Find your Course</h3>
			</div>
			<div class="col-md-4 text-center">
			  <img src="img/oc-icon-2.svg" alt="image" />
			  <span>2</span>
			  <h3>Talk to our expert guides</h3>
			</div>
			<div class="col-md-4 text-center">
			  <img src="img/oc-icon-3.svg" alt="image" />
			  <span>3</span>
			  <h3>Apply online</h3>
			</div>
		  </div>
		</div>
	  </section>
	  -->

	<!-- colabration section -->

	<!-- <div class="social-links"> 
				<ul class="list-unstyled">
					<li>
						<a href="tel:1800121388800" target="_blank"><img src="img/white-call-icon.webp" alt="icon" width="35">
							<span><b>1800 1213 88800</b></span>
						</a>
					</li>
					
				</ul>
			</div> -->
	<section class="rank-section mentor-section pt-9 pb-9">
		<div class="container">
			<div class="row">
				<div class="section-heading text-center mb-5">
					<h2>Get Mentored by Corporate Titans</h2>
				</div>
				<div class="blaze-slider" style="--slides-to-show: 2; --slide-gap: 25px">
					<div class="blaze-container">
						<div class="blaze-track-container">
							<div class="blaze-track" style="
					  transition-property: transform;
					  transition-timing-function: ease;
					  transition-duration: 300ms;
					  transform: translate3d(0px, 0px, 0px);
					">
								<div class="card">
									<div class="row position-relative">
										<div class="col-md-4-new1 text-center text-md-start position-relative">
											<img class="img-fluid-new rounded-3 lazyloaded"
												data-src="new-assets/images/mentor-5.webp" alt="Mentor Image"
												src="new-assets/images/mentor-5.webp" />
											<span class="quote d-flex justify-content-center">&ldquo;</span>
										</div>
										<div class="col-md-8-new1 text-center text-md-start">
											<div class="card-body mt-0 p-0 ps-xl-3">
												<h5>Aparna Dhingra</h5>
												<span>Head HR and Administration, BMW India</span>
												<img class="mt-2 mb-3 lazyloaded"
													data-src="new-assets/images/bmw-logo.webp" alt="Corporate Logo"
													src="new-assets/images/bmw-logo.webp" />
												<p>
													I am very impressed with this University. What I
													like is that CU is including industry exposure on
													every level and is aligning its learning outcomes
													to our expectations while grooming the students.
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="row position-relative">
										<div class="col-md-4-new1 text-center text-md-start position-relative">
											<img class="img-fluid-new rounded-3 lazyloaded"
												data-src="new-assets/images/mentor-6.webp" alt="Mentor Image"
												src="new-assets/images/mentor-6.webp" />
											<span class="quote d-flex justify-content-center">&ldquo;</span>
										</div>
										<div class="col-md-8-new1 text-center text-md-start">
											<div class="card-body mt-0 p-0 ps-xl-3">
												<h5>Arvind Mehra</h5>
												<span>Executive Director &amp; CEO, Global Operations,
													Mahindra Aerospace</span>
												<img class="mt-2 mb-3 lazyloaded"
													data-src="new-assets/images/mahindra-aero-logo.webp"
													alt="Corporate Logo"
													src="new-assets/images/mahindra-aero-logo.webp" />
												<p>
													Bringing corporates and universities closer helps
													to build a lot of corporate awareness among
													students during their studies so that they can
													become industry-ready after they graduate.
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="row position-relative">
										<div class="col-md-4-new1 text-center text-md-start position-relative">
											<img class="img-fluid-new rounded-3 lazyloaded"
												data-src="new-assets/images/mentor-1.webp" alt="Mentor Image"
												src="new-assets/images/mentor-1.webp" />
											<span class="quote d-flex justify-content-center">&ldquo;</span>
										</div>
										<div class="col-md-8-new1 text-center text-md-start">
											<div class="card-body mt-0 p-0 ps-xl-3">
												<h5>Raj Raghavan</h5>
												<span>Sr. VP &amp; Head of HR, Indigo</span>
												<img class="mt-2 mb-3 lazyloaded"
													data-src="new-assets/images/indigo-logo.webp" alt="Corporate Logo"
													src="new-assets/images/indigo-logo.webp" />
												<p>
													The experience of Online Learning has been
													inspirational in developing an achiever's
													attitude.
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="row position-relative">
										<div class="col-md-4-new1 text-center text-md-start position-relative">
											<img class="img-fluid-new rounded-3 lazyloaded"
												data-src="new-assets/images/mentor-2.webp" alt="Mentor Image"
												src="new-assets/images/mentor-2.webp" />
											<span class="quote d-flex justify-content-center">&ldquo;</span>
										</div>
										<div class="col-md-8-new1 text-center text-md-start">
											<div class="card-body mt-0 p-0 ps-xl-3">
												<h5>Rajeshwar Tripathi</h5>
												<span>Chief Human Resource Officer, Mahindra and
													Mahindra Ltd</span>
												<img class="mt-2 mb-3 lazyloaded"
													data-src="new-assets/images/mahindra-logo.webp" alt="Corporate Logo"
													src="new-assets/images/mahindra-logo.webp" />
												<p>
													I am overwhelmed by the courtesy and the grandness
													of the university. It's an amazing place with
													world class facilities. I feel that students are
													very lucky to get to learn here.
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="row position-relative">
										<div class="col-md-4-new1 text-center text-md-start position-relative">
											<img class="img-fluid-new rounded-3 ls-is-cached lazyloaded"
												data-src="new-assets/images/mentor-3.webp" alt="Mentor Image"
												src="new-assets/images/mentor-3.webp" />
											<span class="quote d-flex justify-content-center">&ldquo;</span>
										</div>
										<div class="col-md-8-new1 text-center text-md-start">
											<div class="card-body mt-0 p-0 ps-xl-3">
												<h5>Chaitanya Sreenivas</h5>
												<span>Sr. VP HR &amp; HR Head, IBM India &amp; South
													Asia</span>
												<img class="mt-2 mb-3 ls-is-cached lazyloaded"
													data-src="new-assets/images/ibm-logo.webp" alt="Corporate Logo"
													src="new-assets/images/ibm-logo.webp" />
												<p>
													What Chandigarh University is doing for the
													country as well as for its students is remarkable.
													It has brought together truly diverse courses that
													have made a visible impact on the lives of
													students who graduate from this excellent
													institution.
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="row position-relative">
										<div class="col-md-4-new1 text-center text-md-start position-relative">
											<img class="img-fluid-new rounded-3 lazyloaded"
												data-src="new-assets/images/mentor-4.webp" alt="Mentor Image"
												src="new-assets/images/mentor-4.webp" />
											<span class="quote d-flex justify-content-center">&ldquo;</span>
										</div>
										<div class="col-md-8-new1 text-center text-md-start">
											<div class="card-body mt-0 p-0 ps-xl-3">
												<h5>Mahesh C Tahilyani</h5>
												<span>Managing Director, Forbes and company ltd.</span>
												<img class="mt-2 mb-3 lazyloaded"
													data-src="new-assets/images/forbes-logo.webp" alt="Corporate Logo"
													src="new-assets/images/forbes-logo.webp" />
												<p>
													Industries, corporates and universities need to
													come together as new developments are rapidly
													happening worldwide and the students need to catch
													up with all of that. CU contributes to making that
													happen.
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button class="blaze-prev">&lt;</button>
						<button class="blaze-next">&gt;</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--
	<section class="recog-section pt-3 pb-9">
		<div class="container">
			<div class="row align-items-center mt-5">
				<div class="col-lg-5-new">
					<div class="section-heading">
						<h2>Get a UGC-Entitled Globally Recognized Degree</h2>
					</div>
					<div class="degree-content">
						<h6>Online Degrees from Chandigarh University are:</h6>
						<ul class="degree-list list-unstyled clearfix mt-4">
							<li>UGC-Entitled</li>
							<li>Universally Accepted in India and Abroad</li>
							<li>Degrees from a Globally Ranked University</li>
							<li>Equivalent to CU's On-Campus Programme Degrees</li>
						</ul>
						<a href="https://apply.onlinecu.in/index.aspx?type=onlinecu" title="Apply Today" target="_blank" class="btn btn-primary btn-arrow mt-3 mb-5">Apply Today</a>
					</div>
				</div>
				<div class="col-lg-7-new">  
					<img class="img-fluid-new ls-is-cached lazyloaded" data-src="new-assets/images/certificate.webp" alt="Certificate Image" src="new-assets/images/certificate.webp">
				</div>
			</div>
		</div>
	</section>
	-->
	<!-- testimonial section start here -->
	<section class="section-testimonial">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-heading text-center mb-5">
						<h2>Learner's Testimonial</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="testimonial-set">
					<div class="blaze-slider3">
						<div class="blaze-container">
							<div class="blaze-track-container">
								<div class="blaze-track">
									<div class="testimonial-card1">
										<div class="testimonial-card1-inner">
											<div class="testimonial-card1-picblock">
												<!--
												<div class="testimonial-card1-piccenter">
													<img src="new-assets/images/testimonial-profile-icon.png" class="testimonial-card1-pic">
												</div> -->
												<div class="testimonial-card1-commentblock">
													<p class="testimonial-card1-commenttext">
														I joined Chandigarh University Online for the
														online BA-JMC course, and I consider it the best
														decision of my life, especially since I scored
														high marks in the English language in the 12th.
														I can confidently say that they offer a plethora
														of opportunities to students, as they are home
														to over 300 hiring partners. I am grateful to
														the professors, guest faculties, and others at
														Chandigarh University Online who have helped me
														experience the best online learning journey. I
														would definitely recommend others to enroll in
														their undergraduate and postgraduate programs,
														as their online courses are now UGC-approved and
														globally recognized.
													</p>
													<br />
													<br />
												</div>
												<p class="testimonial-card1-nametext">
													Sneha Biswas
												</p>
												<p class="testimonial-card1-programtext">
													Online BA-JMC
												</p>
											</div>
										</div>
									</div>
									<div class="testimonial-card1">
										<div class="testimonial-card1-inner">
											<div class="testimonial-card1-picblock">
												<!--
												<div class="testimonial-card1-piccenter">
													<img src="new-assets/images/testimonial-profile-icon.png" class="testimonial-card1-pic">
												</div>
												-->
												<div class="testimonial-card1-commentblock">
													<p class="testimonial-card1-commenttext">
														The ease of learning with the Advanced Learning
														Management System and the opportunity to learn
														from reputed faculties were the main reasons I
														chose to join Chandigarh University Online. By
														taking up the undergraduate course in online
														BBA, I had the opportunity to be trained by
														their top-notch faculties. This not only helped
														me gain knowledge in the specialization but also
														provided insights into building a successful
														career in line with current job market trends.
														Looking back, I realize that choosing online BBA
														at Chandigarh University Online was a
														trustworthy decision, and I am looking forward
														to pursuing my master's degree from them only.
													</p>
												</div>
												<p class="testimonial-card1-nametext">
													Mahima Jalan
												</p>
												<p class="testimonial-card1-programtext">
													Online BBA
												</p>
											</div>
										</div>
									</div>
									<div class="testimonial-card1">
										<div class="testimonial-card1-inner">
											<div class="testimonial-card1-picblock">
												<!--
												<div class="testimonial-card1-piccenter">
													<img src="new-assets/images/testimonial-profile-icon.png" class="testimonial-card1-pic">
												</div>
												-->
												<div class="testimonial-card1-commentblock">
													<p class="testimonial-card1-commenttext">
														I selected the Online MA in English program from
														Chandigarh University Online a year ago, and it
														has been an amazing journey so far. I receive
														excellent support from my faculties and
														professors, all from the comfort of my home. I
														am truly amazed to see that for each
														specialization, there is a designated course
														coordinator available to help us resolve any
														doubts we may have regarding the subject matter.
														I am satisfied with the course I have chosen and
														am exploring career opportunities, especially as
														a screenwriter. I am thankful to all the faculty
														members for making my experience at Chandigarh
														University Online a memorable one.
													</p>
												</div>
												<p class="testimonial-card1-nametext">
													Gurjot Badal
												</p>
												<p class="testimonial-card1-programtext">
													Online MA in English
												</p>
											</div>
										</div>
									</div>
									<div class="testimonial-card1" style="">
										<div class="testimonial-card1-inner">
											<div class="testimonial-card1-picblock">
												<!--
												<div class="testimonial-card1-piccenter">
													<img src="new-assets/images/testimonial-profile-icon.png" class="testimonial-card1-pic">
												</div>
												-->
												<div class="testimonial-card1-commentblock">
													<p class="testimonial-card1-commenttext">
														When I was looking for a reputable university
														that offers a postgraduate degree in online MBA
														(Digital Marketing), Chandigarh University
														Online came to my rescue. I didn't need to look
														any further when I discovered that they provide
														the course with Harvard Certification, all from
														the comfort of my home. I have completed half of
														the course in this specialization, and so far,
														it has been a wonderful experience. The
														Chandigarh University Online Advanced Learning
														Management System has been incredibly helpful,
														providing me with dedicated learner support. I
														am quite amazed to learn that this university
														offers a top-notch learning environment, even
														virtually, whether it's the programs, faculties,
														or any other services.
													</p>
												</div>
												<p class="testimonial-card1-nametext">
													Kamaljeet Singh
												</p>
												<p class="testimonial-card1-programtext">
													Online MBA (Digital Marketing)
												</p>
											</div>
										</div>
									</div>
									<div class="testimonial-card1">
										<div class="testimonial-card1-inner">
											<div class="testimonial-card1-picblock">
												<!--
												<div class="testimonial-card1-piccenter">
													<img src="new-assets/images/testimonial-profile-icon.png" class="testimonial-card1-pic">
												</div>
												-->
												<div class="testimonial-card1-commentblock">
													<p class="testimonial-card1-commenttext">
														It's been great associating with Chandigarh
														University Online to pursue an online MA in
														Economics. The faculties teaching this
														specialized course have been invaluable, guiding
														us through both the technical concepts and
														practical applications. When I joined the online
														degree program, I initially thought there would
														be fewer subjects to study compared to a regular
														course. However, the course curriculum is just
														as comprehensive as that of a traditional
														program. Their Advanced Learning Management
														System for this subject has helped me absorb the
														content and access it at my fingertips.
														Chandigarh University Online should be the go-to
														destination for acquiring valuable technical
														skills sought after in the tech industry.
													</p>
												</div>
												<p class="testimonial-card1-nametext">Pukhar Raj</p>
												<p class="testimonial-card1-programtext">
													Online MA in Economics
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button class="blaze-prev">&lt;</button>
							<button class="blaze-next">&gt;</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="news-sec margin-know-what">
		<div class="container">
			<div class="main-heading text-center mb-5 text-black">
				<h2>Spotlight on Success: <br />Events &amp; Achievements</h2>
				<p>
					An internationally-recognized university, CU has been in limelight
					for numerous positive reasons.
				</p>
			</div>
			<div class="news slider">
				<div class="news-item">
					<div class="card news-card shadow border-0 position-relative">
						<img src="img/leadership-talk-with-harvard-event.jpg" alt="image" />
						<div class="card-body p-4 clearfix">
							<!-- https://news.cuchd.in/2023/07/annual-convocation-for-2023-batch-held.html -->
							<a href="javascript:openharwardpopup()" class="stretched-link">
								Leadership Convergence With Harvard Business School Online
								Esteemed Dignitaries
							</a>
							<p>
								Chandigarh University higher management held a meeting with
								esteemed dignitaries from Harvard Business School Online to
								foster global learning opportunities among students
								enriching their overall educational landscape.
							</p>
						</div>
					</div>
				</div>
				<div class="news-item">
					<div class="card news-card shadow border-0 position-relative">
						<img src="img/news-image-3.webp" alt="image" />
						<div class="card-body p-4 clearfix">
							<!-- https://news.cuchd.in/2023/07/chandigarh-university-is-highest-ranked.html -->
							<a href="#" target="_blank" class="stretched-link">Chandigarh University is the
								highest-ranked private
								university in India</a>
							<p>
								Chandigarh University (CU) achieved a significant milestone
								and secured the first rank among India's private
								universities in the latest edition of the coveted
								Quacquarelli Symonds (QS) World University Ranking
							</p>
							<!--									<button class="float-end"><a href="#"><img src="img/arrow-icon.svg" alt="image">Read More</a></button>-->
						</div>
					</div>
				</div>
				<div class="news-item">
					<div class="card news-card shadow border-0 position-relative">
						<img src="img/news-image-1.webp" alt="image" />
						<div class="card-body p-4 clearfix">
							<!-- https://news.cuchd.in/2023/07/chandigarh-university-continues-its.html -->
							<a href="#" target="_blank" class="stretched-link">Chandigarh University continues its
								success streak;
								bags
								27th rank among universities in NIRF 2023 ranking</a>
							<p>
								Chandigarh University (CU) continued improving its
								performance among the public and private universities of the
								country and secured the 27th spot in the National
								Institutional Ranking Framework (NIRF) 2023
							</p>
							<!--									<button class="float-end"><a href="#"><img src="img/arrow-icon.svg" alt="image">Read More</a></button>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- testimonial section end here -->

	<section class="top-numbers pt-5 pb-3 mt-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-6 col-sm-12">
					<h4 class="mt-0 mb-4 interested-sectioninapply-text">
						Interested in exploring <br /><span style="font-size: 37px">our online programs?</span>
					</h4>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<a href="#home" title="Apply Today" target="_blank" class="btn btn-primary btn-arrow mt-3 mb-3"
						style="
				  background: #fff;
				  color: #e31e24;
				  float: right;
				  outline: none;
				  border: 0px solid #e31e24;
				">Apply Now</a>
				</div>
			</div>
		</div>
	</section>

	<footer class="pb-5 pt-5" style="background: transparent">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-12">
					<div class="ft-logo">
						<img src="img/logo.webp" alt="image" width="310" style="filter: grayscale(0)" />
						<!--
				<a href="#" class="naac-logo mx-3">
				  <img
					src="img/online-ugc-logo.webp"
					alt="Online UGC logo"
					width="100"
					style="filter: grayscale(0)"
				  />
				</a>
				-->
					</div>

					<!--
			  <div class="stuFes">
				<a href="StudentFacilitation.aspx">Student Facilitation</a>
			  </div>
			  -->
				</div>
				<div class="col-md-6 col-12">
					<div class="footer-ft-data ft-data d-flex justify-content-end">
						<img src="img/location-icon.svg" alt="icon" />
						<div class="ft-add">
							<p>
								<b style="display: block">Chandigarh University</b>Address:
								NH-05 Chandigarh-Ludhiana <br />Highway, Mohali, Punjab
								(INDIA)
							</p>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-4 col-6">
							<div class="ft-data d-flex">
								<img src="img/phone-icon-2.svg" alt="icon">
								<div class="ft-add">
									<p>
										<b>Toll Free:</b> 1800 1213 88800<br>
										<b>Mail:</b> admissions@cuidol.in
									</p>
								</div>
							</div>
						</div> -->
			</div>
		</div>
		<div class="container">
			<div class="ft-social pt-3 mt-3">
				<div class="row">
					<!-- <div class="col-md-6">
								<div class="d-flex align-items-center">
									<p>Get Social with Us</p>
									<a href="https://www.facebook.com/cuonlinelearning" target="_blank"><img src="img/facebook.svg" alt="facebook"></a>
									<a href="https://twitter.com/CULearnOnline" target="_blank"><img src="img/twitter.svg" alt="twitter"></a>
									<a href="https://www.linkedin.com/company/cuonlinelearning/" target="_blank"><img src="img/linkedin.svg" alt="linkedin"></a>
									<a href="https://www.youtube.com/channel/UCUie-riiCGS2Lqbj7MqIgqA" target="_blank"><img src="img/youtube.svg" alt="youtube"></a>
									<a href="https://www.instagram.com/cuonlinelearning/" target="_blank"><img src="img/instagram.svg" alt="instagram"></a>
								</div>
							</div> -->
					<div class="col-md-12 text-center">
						<p class="m-0">
							&copy; 2024 Chandigarh University. All rights reserved
						</p>
					</div>
				</div>
			</div>
		</div>

	</footer>

	<section class="harward-popup-section" id="hardwardeventpicid">
		<div class="harward-popup-sectionsub">
			<div class="harward-popup-center">
				<div class="harward-popup-close">
					<a href="javascript:closeharwardpopup()" class="harward-popup-close-btn">
						<img src="img/harward-closepopup.png" />
					</a>
				</div>
				<div class="container-popup-event">
					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">1 / 9</div>
						<img src="img/leadership-harwardevent-pic-01.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">2 / 9</div>
						<img src="img/leadership-harwardevent-pic-02.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">3 / 9</div>
						<img src="img/leadership-harwardevent-pic-03.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">4 / 9</div>
						<img src="img/leadership-harwardevent-pic-04.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">5 / 9</div>
						<img src="img/leadership-harwardevent-pic-05.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">6 / 9</div>
						<img src="img/leadership-harwardevent-pic-06.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">7 / 9</div>
						<img src="img/leadership-harwardevent-pic-07.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">8 / 9</div>
						<img src="img/leadership-harwardevent-pic-08.jpg" style="width: 100%" />
					</div>

					<div class="mySlides-popup-event">
						<div class="numbertext-popup-event">9 / 9</div>
						<img src="img/leadership-harwardevent-pic-09.jpg" style="width: 100%" />
					</div>

					<a class="prev" onclick="plusSlides(-1)"> &lt; </a>
					<a class="next" onclick="plusSlides(1)"> &gt; </a>

					<div class="caption-container-popup-event">
						<p id="caption"></p>
					</div>

					<div class="row-harward">
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-01.jpg" style="width: 100%"
								onclick="currentSlide(1)" alt="The Woods" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-02.jpg" style="width: 100%"
								onclick="currentSlide(2)" alt="Cinque Terre" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-03.jpg" style="width: 100%"
								onclick="currentSlide(3)" alt="Mountains and fjords" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-04.jpg" style="width: 100%"
								onclick="currentSlide(4)" alt="Northern Lights" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-05.jpg" style="width: 100%"
								onclick="currentSlide(5)" alt="Nature and sunrise" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-06.jpg" style="width: 100%"
								onclick="currentSlide(6)" alt="Snowy Mountains" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-07.jpg" style="width: 100%"
								onclick="currentSlide(7)" alt="Northern Lights" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-08.jpg" style="width: 100%"
								onclick="currentSlide(8)" alt="Nature and sunrise" />
						</div>
						<div class="column">
							<img class="demo cursor" src="img/leadership-harwardevent-pic-09.jpg" style="width: 100%"
								onclick="currentSlide(9)" alt="Snowy Mountains" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<style>
		.footer-fixed-bar {
			background: #dedddd;
		}

		.footer-fixed-bar p {
			font-size: 18px;
			font-weight: 700;
		}

		.footer-fixed-bar a {
			text-transform: capitalize !important;
		}
	</style>
	<div class="footer-fixed-bar">
		<p>Admissions Deadline Extended &nbsp;&nbsp; :</p>
		<a href="#home" target="_blank">Till 31st July 2024</a>
	</div>
</main>

<?php include 'footer.php'; ?>

</body>
<style>
	.btnsubmit {
    height: 48px;
    padding: 0;  min-width: 130px;
   line-height: 45px;
    font-size: 15px;
     font-weight: 500;
    background-color: #E31E24;
    border-color: #E31E24;
}
</style>
</html>