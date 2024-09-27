<?php

$from_fb = isset($_GET['from_fb']) ? $_GET['from_fb'] : NULL;
$source = isset($_GET['source']) ? $_GET['source'] : NULL;
$source_campaign = isset($_GET['source_campaign']) ? $_GET['source_campaign'] : NULL;
$source_medium = isset($_GET['source_medium']) ? $_GET['source_medium'] : NULL;

$universityNames = ['NMIMS University', 'Amity University', 'Jain University', 'LPU University', 'Manipal University', 'Chandigarh University', 'Symbiosis University', 'Uttaranchal University', 'IMT University', 'MIT University', 'Bits Pilani University', 'DPU University', 'UPES University', 'ICFAI University', 'Ignou University', 'OP Jindal Global University', 'Imarticus', 'SP Jain Global', 'Other'];

$universityPdfNames = ['NMIMS_University', 'Amity_University', 'Jain_University', 'LPU_University', 'Manipal_University', 'Chandigarh_University', 'Symbiosis_University', 'Uttaranchal_University', 'IMT_University', 'MIT_University', '', 'DPU_University', '', 'ICFAI_University', 'Ignou_University', 'op_jindal', '', '', ''];

?>
<!doctype html>

<html lang="en">

<?php include 'header.php'; ?>
<div class="containter-fluid visible-desktop fixed-top" style="background-color: white; border-bottom:1px solid grey">
        <div class="container" style="padding: 10px;">
            <div class="row">
                <div class="col-md-2">
                    <!--<img src=" https://mbaonlinecourse.com/images/Newlogo.png" class="img-responsive" height="auto" width="100%" alt="distancemba" srcset="">-->
                     <img src="http://localhost/mukul/online-all-mba/images/Artboard 1@3x-8.png" class="img-fluid mt-2" height="auto" width="80%" alt="distancemba" srcset="">
                </div>
                <div class="col-md-10" style="margin-top: 8px;display:flex;justify-content:end">
                     <div class="row">
                            <div class="col-12">
                                <button type="button" class=" abhi btn-custom btn-customtop" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal_uni">
                                    Enquire Now
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>

<div class="container-fluid hidden-desktop visible-phone" style="background-color: white; position: fixed; top: 0; width: 100%; z-index: 1000; padding: 0; margin-bottom:20px;">
    <div class="container" style="padding: 10px; max-width: 100%; border-bottom: 1px solid #05375b4f;">
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-6" style="flex: 1;">
                <img src="http://localhost/mukul/online-all-mba/images/Artboard 1@3x-8.png" class="img-responsive logophone" alt="distancemba" style="max-width: 100%; height: auto;">
            </div>
            <div class="col-md-6" style="flex: 1; text-align: right;">
                <button type="button" class="rahul btn-custom btn-custom1" data-rahul="1" data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni" style="width: auto;     padding: 5px 0px 5px 0px;
    margin-top: 1px;">
                    Enquire now
                </button>
            </div>
        </div>
    </div>
</div>


    
<!-- old nav bar -->
<nav class="navbar" style="display: none;">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img src="http://localhost/mukul/online-all-mba/images/newlogo.html" alt="distancemba" class="img-responsive"></a>
            </div>
        </div>
</nav>
    
<!--<div id="lp-enquire-sticky-button" data-id="Enquire Now" ><a data-toggle="modal" href="#exampleModal1"  data-target="#exampleModal1" style="cursor: pointer;">Enquire Now</a></div>-->

<!--Form On top header only on phone-->
<div class="container-fluid onlymob" style="display:none;">
     <h2 style="font-size:15px!important; padding-bottom:10px!important; color:#000;" > Enter your details and get free career counselling in top B-Schools.</h2>
     <div class="contact-div header-contact-form header-contact-bg padding-top-xs onlymob"
                                                            id="get_free_counselling">

                                                            <form class="contact-form1" method="POST"
                                                                action="https://distancemba.co.in/online-mba/lp-verify_mob.php" name="frmid"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="pageurl" id="pageurl" value='index.html'>
                                                                <input type="hidden" name="entryform" id="entryform" value>
                                                                <div class="clearfix">
                                                                    <div class="header-contact-bg-pad"><br>
                                                                        <h3 id="heading" class="text-left"
                                                                            style="padding-left:16px;"></h3>
                                                                        <br>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-12 col-12 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control" type="text"
                                                                                    name="fname" id="fname"
                                                                                    placeholder="Full Name*"
                                                                                    required>
                                                                            </div>
                                                                            <!--<div class="form-group col-md-6 col-12 unit">-->
                                                                            <!--    <input style="border-radius:10px!important;" class="form-control" type="text"-->
                                                                            <!--        name="lname" id="lname"-->
                                                                            <!--        placeholder="Last Name*"-->
                                                                            <!--        required>-->
                                                                            <!--</div>-->
                                                                        </div>

                                                                        <div class="form-row form-div form-bottom-1">
                                                                            <div class="form-group col-md-12 col-12 unit">
                                                                                <input style="border-radius:10px!important;"
                                                                                    class="form-control form-text phoneno"
                                                                                    name="phoneno" id="phoneno"
                                                                                    placeholder="Mobile Number*"
                                                                                    autocomplete="off" type="text"
                                                                                    maxlength="10" pattern="^\d{10}$" oninvalid="this.setCustomValidity('Please enter correct phone')" oninput="this.setCustomValidity('')" required>
                                                                            </div>
                                                                        </div>


                                                                        <div class="form-row form-div form-bottom-1">
                                                                            <div class="form-group col-md-6 col-12 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control form-text"
                                                                                    type="text" name="email" id="email"
                                                                                    placeholder="Email*" required required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Please enter correct email')" oninput="this.setCustomValidity('')">
                                                                            </div>
                                                                            <div class="form-group col-md-6 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control form-text"
                                                                                    type="text" name="city" id="city"
                                                                                    placeholder="Enter City*"
                                                                                    required>
                                                                            </div>
                                                                        </div>
    
                                                                         <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                                                            <select style="border-radius:10px!important;" class="form-control selectcls"
                                                                                name="mx_Interested_In_Speclization" id="mx_Interested_In_Speclization" required>
                                    											<option value="">Select Specialization</option>
                                    											<option value="MBA (Banking and Finance Management)">MBA (Banking and Finance Management)</option>
                                    											<option value="MBA (Business Management)">MBA (Business Management)</option>
                                    											<option value="MBA (Financial Management)">MBA (Financial Management)</option>
                                    											<option value="MBA (Human Resource Management)">MBA (Human Resource Management)</option>
                                    											<option value="MBA (International Trade Management)">MBA (International Trade Management)</option>
                                    											<option value="MBA (Information Technology and Systems Mangement)">MBA (Information Technology and Systems Mangement)</option>
                                    											<option value="MBA (Marketing Management)">MBA (Marketing Management)</option>
                                    											<option value="MBA (Operations Management)">MBA (Operations Management)</option>
                                    											<option value="MBA (Retail Management)">MBA (Retail Management)</option>
                                    											<option value="MBA (Supply Chain Management)">MBA (Supply Chain Management)</option>
                                    											<option value="Master of Business Administration (Executive MBA)">Master of Business Administration (Executive MBA)</option>
                                    											<option value="MBA (X) in Business Analytics">MBA (X) in Business Analytics</option>
											
										                                    </select>
                                                                        </div>

                                                                        <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                                                            <select style="border-radius:10px!important;" class="form-control selectcls"
                                                                                name="university" id="university" required>
                                                                                <option value="">Select University
                                                                                </option>
                                                                                <option
                                                                                    value="Manipal University">
                                                                                    Manipal University</option>
                                                                                <option value="Symbiosis University">
                                                                                    Symbiosis University</option>
                                                                                <option
                                                                                    value="Dr. D. Y. Patil Vidyapeeth University">
                                                                                    Dr. D. Y. Patil
                                                                                    Vidyapeeth University</option>
                                                                                <option value="Jain University">Jain
                                                                                    University</option>
                                                                                <option
                                                                                    value="Amity University, distance and Distance Learning (ODL)">
                                                                                    Amity
                                                                                    University, distance and Distance
                                                                                    Learning (ODL)</option>
                                                                                <option
                                                                                    value="Lovely Professional University Distance Learning">
                                                                                    Lovely
                                                                                    Professional University Distance
                                                                                    Learning</option>
                                                                                <option value="Chandigarh University">
                                                                                    Chandigarh University</option>
                                                                              <!--  <option
                                                                                    value="Indira Gandhi National Open University (IGNOU)">
                                                                                    Indira Gandhi
                                                                                    National Open University (IGNOU)
                                                                                </option>-->
                                                                                <option
                                                                                    value="Welingkar Institute of Management Development & Research">
                                                                                    Welingkar Institute of Management
                                                                                    Development & Research</option>
                                                                                <!--<option value="Manipal University">-->
                                                                                <!--    Manipal University</option>-->
                                                                                <option value="Other">Other</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div style="display:none;">
                                                                            <label for="honeypot">Leave this field blank:</label>
                                                                            <input type="text" id="honeypot" name="honeypot">
                                                                        </div>



                                                                        <div
                                                                            class="form-div phoneno-bottom error-div unit">
                                                                            <input class="header-contact-form"
                                                                                type="checkbox" name="tnc" id="tnc"
                                                                                checked="checked"> I agree to get
                                                                            updates from Distance-MBA
                                                                        </div>

                                                                        <!--============= SUCESSS AND FAILURE MESSAGE DISPLAY HERE ========-->
                                                                        <div class="left form-error-top"> <span
                                                                                class="form-success sucessMessage">
                                                                            </span>
                                                                            <span class="form-failure failMessage">
                                                                            </span>
                                                                        </div>

                                                                        <div class="form-row form-div form-bottom-1"
                                                                            id="verify_id1" style="display:none11;">
                                                                            <!--  <div class="form-group col-md-6">-->
                                                                            <!-- <input type="text" class="form-control form-text" name="verify_otp" id="verify_otp" placeholder="Verify OTP" autocomplete="off">-->
                                                                            <!--</div> -->
                                                                            <!-- <div class="form-group col-md-6">-->
                                                                            <!-- <input type="submit" class="submit-btn contact-form-submit" style="color:#fff!important; width:100%; height:30px" name="btnVerifyPhone" id="btnVerifyPhone" value="Verify OTP">-->
                                                                            <!--</div>-->
                                                                        </div>


                                                                        <!-- <div class="form-group col-md-6" id="sendotp_div">-->
                                                                        <!--<input type="submit" class="submit-btn contact-form-submit" style="color:#fff!important; width:100%; height:30px" name="sendotp" id="sendotp" value="Send OTP">-->
                                                                        <!--</div> -->


                                                                        <div class="form-group col-md-6"
                                                                            id="form_data_div1" style="display:none1;">
                                                                            
                                                                            <input type="submit" class="submit-btn contact-form-submit text-center "
                                                                                style="color:#fff!important; height: 46px !important;border-radius: 35px !important;width: 100% !important;"
                                                                                name="btnSubmit" id="btnSubmit"
                                                                                value="Submit">
                                                                        </div>

                                                                        <span id="loader"></span>
                                                                        <br><br>
                                                                    </div>
                                                                </div>
                                                               	 <input type="hidden" name="utm_campaign" id="utm_campaign" value="" >
								 
								                                <input type="hidden" name="utm_content" id="utm_content" value="" >
								 
                                								 <input type="hidden" name="SourceIPAddress" id="SourceIPAddress" value="" >
                                								 
                                								 <input type="hidden" name="utm_medium" id="utm_medium" value="" >
                                								 
                                								 <input type="hidden" name="SourceReferrerURL" id="SourceReferrerURL" value="" >
                                								 <input type="hidden" name="utm_keyword" id="utm_keyword" value="" >
                                                            </form>
                                                        </div>
</div>
  
  <!--Top Banner-->
  
<!--<div class="container-fluid visible-desktop" id="enquire" data-toggle="modal" data-id="Get Free Counselling" data-target="#exampleModal1"  style="cursor:pointer; background: url('https://mbaonlinecourse.com/images/mainbannergn.png') no-repeat;-->
<!--      background-size: contain; height:600px;">-->
<!--</div>-->

<!--<div class="visible-phone">-->
<!--    <img class="img-fluid" alt="Online-Distance-MBA" id="enquire" data-toggle="modal" data-id="Get Free Counselling" data-target="#exampleModal1" style="cursor:pointer; width:100%; margin-top:81px;"  src="https://mbaonlinecourse.com/images/mainbannergn.png">-->
<!--</div>-->


    <!--Test-->
    <div class="banner-section  data-img-bg" data-image-src="http://localhost/mukul/online-all-mba/images/Website-Online-MBA-programs-banner-8000.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-6">

			</div>
			<div class="col-lg-5 col-md-6">
				<div class="d-md-flex d-block justify-content-end">
					<div class="banner-content">
						<h1>Online <strong class="text-uppercase">Mba Degree</strong></h1>
                        <p>Achieve your career dreams with dynamic Online MBA courses from <span style="font-weight: bold;color: #ff0043;">top institutions</span>, offering the flexibility you need to thrive!</p>						
					</div>
				</div>
				<div class="row" style="
	padding: 5px;
	margin-left: 96px;
	margin-top: 20px;
">
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Amity Online MBA" src="images/Amity.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
						<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Amity Online MBA" src="images/Amity.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Symbiosis Online MBA"
							src="images/Symbiosis.png" data-abhishek="1" style="cursor: pointer; border:none!important;"
							data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Manipal Online MBA" src="images/MUJ.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="DY Patil Online MBA" src="images/DPU.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Online MBA Manipal University"
							src="images/MAHE.png" data-abhishek="1" style="cursor: pointer; border:none!important;"
							data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Jain Online MBA" src="images/Jain.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="LPU Online MBA" src="images/LPU.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="OP Jindal Online MBA"
							src="images/OP JIndal.png" data-abhishek="1" style="cursor: pointer; border:none!important;"
							data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“First line of the note”</p>
							<p>“Second line of the note”</p>
							<p>“Third line of the note”</p>
						</div>
					</div>

				</div>
				<a href="#" class="btn btn-primary"
					style="width: 264px;margin-bottom: -113px;margin-left: 125px;"><b>Admission open</b></a>
			</div>
		</div>
	</div>
</div>

<section class="p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="crp_box ovr_top">
                        <div class="row align-items-center m-0">
                            <div class="col-xl-2 col-lg-3 col-md-2 col-sm-12">
                                <div class="crt_169">
                                    <div class="crt_overt style_2">
                                        <h4>4.9</h4>
                                    </div>
                                    <div class="crt_stion">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="crt_io90">
                                        <h6>200 Rating</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-9 col-md-10 col-sm-12">
                                <div class="part_rcp">
                                    <ul>
                                        <li>
                                            <div class="dro_140">
                                                <div class="dro_141"><i class="fa fa-graduation-cap" style="
    margin-top: -10px;
"></i></div>
                                                <div class="dro_142" style="
    margin-left: 7px;
">
                                                    <h6>Presenting Best<br>Colleges</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dro_140">
                                                <div class="dro_141 st-1"><i class="fa fa-business-time" style="
    margin-top: -10px;
"></i></div>
                                                <div class="dro_142" style="
    margin-left: 7px;
">
                                                    <h6>Full Admission<br>Support</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dro_140">
                                                <div class="dro_141 st-2"><i class="fa fa-user-shield" style="
    margin-top: -10px;
"></i></div>
                                                <div class="dro_142" style="
    margin-left: 7px;
">
                                                    <h6>15k+ Enrolled<br>Students</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dro_140">
                                                <div class="dro_141 st-3"><i class="fa fa-journal-whills" style="
    margin-top: -10px;
"></i></div>
                                                <div class="dro_142" style="
    margin-left: 7px;
">
                                                    <h6>100+ Courses<br>Offered</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-----------------------------------------------------------------------Top Banner------------------------------------------------------------------------->
    <div id="home" style="display:none;" class="header-form-bgimage-lp">
        <div  class="container-fluid">
            <div class="row d-flex text-center">
                <div class="vertically-middle">
                <h1>Top Distance / Online MBA Institutes In India</h1>
                <p> Powering Education. Empowering Professionals.</p>
                </div>
            </div>
        </div>
    </div>
    <!--================================= HEADER-FORM-1 END =============================================-->
    
<!--online MBA Degree Courses-->
<div class="container-fluid bg-img" style="display:none;">
    <div class="container mainhederconte" style="padding-bottom:30px;" id="container">
        
        <div id="row">
            <div id="mainheader" class=""><!-- removed class bg-white-->
                <h2 style="font-size:46px;margin-bottom:10px" class="gradient-text mobileheader uparwaliline">Online MBA Degree Programs</h2>
                <h2 class="mobileheader">from India Top B-schools</h2>
                <p class="pmobile">Move up the management ladder with the best Online MBA Courses from top B-schools in India and abroad.</p>
                    
                <div class="custom-list">
                    <div class="custom-item">
                        <span class="custom-icon"></span>
                            UGC Entitled, AICTE Approved, AACSB Accredited Programs 
                    </div>
                    <div class="custom-item">
                        <span class="custom-icon"></span>
                        Continuous Learning Opportunities
                    </div>
                    <div class="custom-item">
                        <span class="custom-icon"></span>
                        Career Focused Programs
                    </div>
                    <div class="custom-item">
                        <span class="custom-icon"></span>
                        50% Average Hike across MBA courses
                    </div>
                    
                </div>
                
                <div class="row mt-3 no-gutters" style=" margin-left:-17px; margin-top:19px;" id="buttons-row">
                    <div class="col-md-3 col-12">
                        <div class="bttncenter">
                            <button type="button" class="btn btntop" id="enquire" data-toggle="modal" style="background-color: #002049!important; color: rgb(255, 255, 255); border-radius: 10px!important; font-size:17px"   
                            data-id="Get Free Counselling" data-target="#exampleModal1">
                                Get Free Counselling
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-12">
                        <div class="bttncenter">
                            <button type="button" class="btn btntop secondbtn" id="enquire1" data-toggle="modal"
                                        style="background-color: #002049!important; color: rgb(255, 255, 255); border-radius: 10px!important; font-size:17px; margin-left: 35px;"
                                            data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                        </div>
                    </div>
                
                </div>
            </div>
            <div id="img-container">
                <!--<img src="https://mbaonlinecourse.com/images/top-disc.webp"  alt="Online MBA">-->
            </div>
        </div>
    </div>
</div>







<div class="sec-two-lp" style="display:none;">
    <div class="container-fluid">
            <div class="row d-flex text-center ">
                <div class="vertically-middle mb-30">
                <img src="http://localhost/mukul/online-all-mba/images/newlogo.html" alt="distancemba" />
                </div>
            </div>
             <div class="row d-flex text-center ">
                <div class="vertically-middle w-60">
                <h2 class="mt-30 mb-30">Admissions Open For Online MBA 2024</h2>
                <p class="mt-30 mb-30">Explore Top Online MBA Institutes In India. Select and choose the most suitable course for you. UGC / AICTE / NAAC Recognized programs.</p>
                </div>
            </div>
             <div class="row d-flex text-center mt-30 ">
                <div class="vertically-middle">
                       <button type="button" class="btn btntop" id="enquire" data-toggle="modal" style="background-color: #002049!important; color: rgb(255, 255, 255);" data-id="Enquire Now" data-target="#exampleModal1"> Enquire Now </button>
                </div>
            </div>
        </div>
</div>

<div class="sec-three-lp">
        <div class="container-fluid">
             <div class="row d-flex text-center ">
                <div class="vertically-middle w-80">
                <h2 class="mt-30 mb-30">Top Online MBA Colleges In India</h2>
                <p class="mt-30 mb-30">Compare and select the most suitable course from top-rated Online MBA institutes from India.</p>
                </div>
            </div>
        </div>
</div>




    <!--Top Online Learning Insitutes-->
<div class="containeriuytre mt-20">
   
    <div class="Container custcont" >
         <p class="graident-color gradienthead">Best Online, Distance & PGDM</p>
    <h2 class="gradientmobb">Programs from <span class="graident-color ">Top Universities</span></h2> 
    <hr>
        
        <div class="row" style="margin-top:25px!important;">
        <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/NMIMS.jpg" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/NMIMS-1.jpg" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        NMIMS CDOE, Mumbai
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                         <div class="row p-3">
                            <div class="col-md-7 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-7 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">NIRF, NAAC A+, UGC, AICTE</span>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,96,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Human Resources, Finance, Marketing, Operations etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback"data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Amity-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Amity%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/Amity.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                      Amity University, Noida
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">AICTE,UGC, NIRF, NAAC A+</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,79,400/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong> Marketing, Human Resources, Accounting and Financial, IT, Insurance, Hospitality,etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2 download_brochure" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Symbiosis-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/SCDL.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/SCDL.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                     Symbiosis Center of Distance Learning, Pune
                    </div>
                        <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online PGDM</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">AICTE</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Stars 60,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Banking and Financial Services, IT, Business Administration, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback"data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Manipal-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Manipal.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/MUJ.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Manipal University, Jaipur
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-7 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-7 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">AICTE,UGC, NIRF, NAAC A+</span>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,57,500/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>HR, Finance, Marketing, Operations, International Business, and Analytics & Data Science etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--DPU-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/DPU.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/DPU.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Dr. DY Patil University, Pune
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                         <div class="row p-3">
                            <div class="col-md-7 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-7 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, NAAC A, NIRF, AICTE</span>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,59,200/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Hospital and Healthcare, Marketing, Internationl Business, Entrepreneurship,  etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Mahe-->
        
            
            <!--Jain-->
             <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Jain%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/Jain.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Jain University, Bangalore
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                         <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">NAAC, AICTE, QS Ranking</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,60,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong> HR, Finance, Marketing, General Mgmt., Systems and Operations, International Finance etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--LPU-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Lovely%20Professional%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/LPU.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                       Lovely Professional University, Punjab
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">NAAC A+, AICTE, NIRF, UGC</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,24,100</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Finance, Human Resource Management, Marketing, Information Technology, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--OPJ-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/OP%20Jindal%20Global%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/Frame%20493.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                       O.P Jindal Global University, Harayana
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">1 Year</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">QS Ranking, Memeber of AACSB</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,50,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Operations, Strategic Management, Marketing, Finance etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Bharti Vidyapeeth-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Bharati%20Vidyapeeth%20Institute.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/pngwing.com%20(1)%201.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Bharati Vidyapeeth Institute, Pune
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                          <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">AICTE, NAAC A+, UGC</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,30,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Finance, Human Resource Management, Marketing, Information Technology, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!--Chandigarh University-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Chandigarh%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/Chandigarh_University_Seal%201.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Chandigarh University, Punjab
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">NAAC A+, UGC, QS Ranking, NIRF</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,50,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Marketing, HRM, IBs, Entrepreneurship, Finance, Hospital Management,  IT, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Parul University-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Parul%20university.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/Frame%20527.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Parul University, Gujrat
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, NAAC A++, NIRF, QS Ranking</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 90,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Banking and Finance, HRM Finance Marketing, International Trade, Operations etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Uttranchal Univeristy-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Uttaranchal%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/logo/uu.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                       Uttaranchal University, Uttarakhand
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, AICTE, NAAC A+, <br>QCI </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 80,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Marketing Management, Financial Management, Human Resource Management, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
                <!--Chandigarh University-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Shoolni.jpg" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/university/Shoolni-1.jpg" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Shoolini University, Himachal
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, QS Ranking, NIRF</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,20,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Marketing, HRM, Bio-Tech, Finance, Health care Management,  IT, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback"data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Parul University-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/UPES.jpg" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/university/UPES-1.jpg" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        UPES University, Uttarakhand
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, NAAC A, NIRF, QS Ranking</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 175,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Oil & Gas Mgmt, Power Mgmt, Infra Mgmt,HRM Finance Marketing, Operations Mgmt, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Uttranchal Univeristy-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/SP%20Jain%20(1).jpg" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/university/SP%20Jain-1%20(1).jpg" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                       SP Jain University, Mumbai
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Executive MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">18 Months</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">AACA, TEQSA, CPE </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 14,86,800/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Marketing Management, Financial Management, Human Resource Management, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
               <!--Chandigarh University-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Amrita%20Vishwa%20Vidyapeetham.jpg" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/university/Amrita%20Vishwa%20Vidyapeetham-1.jpg" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        Online Amrita, Coimbatore
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">NAAC A++, UGC, WES, NIRF</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 1,70,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Marketing, HRM, IBs, Entrepreneurship, Finance, Hospital Management,  IT, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Parul University-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/GLA.jpg" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/university/GLA-1.jpg" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                        GLA University, Mathura
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, NAAC A+, NIRF</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 96,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Banking and Finance, HRM Finance Marketing, Operations etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Uttranchal Univeristy-->
            <div class="col-md-4 col-12 mb-3">
                <div id="customcard-card" class="card" style=" border: 1px solid #d1d1d1; border-radius: 18px; padding: 0px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 8%); transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;">
                    <div class="position-relative">
                        <img style="width:100%!important; border-radius: 14px 14px 0px 0px;" src="http://localhost/mukul/online-all-mba/images/university/Sharda%20University.png" id="customcard-card-img-top" class="card-img-top" alt="Image">
                        <div id="customcard-card-img-overlay" class="card-img-overlay">
                            <div id="customcard-logo">
                                <img style="height:60px; width:60px;" src="http://localhost/mukul/online-all-mba/images/university/Sharda%20University-1.png" alt="Logo" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div id="customcard-university-name" style="padding:13px">
                       Sharda University, Noida
                    </div>
                    <div id="customcard-card-body" class="card-body" style="padding: 18px 18px 0px 18px;">
                        <div class="row p-3">
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text" >
                                    <span class="custom-iconm"></span>
                                    <span class="custom-text">Online MBA</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-iconc"></span>
                                    <span class="custom-text">2 Years</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <span class="custom-icons"></span>
                                    <span class="custom-text">UGC, NIRF, NAAC A+ </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-6">
                                <div id="customcard-icon-text">
                                    <i class="custom-icon-inr" aria-hidden="true"></i>
                                    <span class="custom-text">Fee Starts 100,000/-</span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <hr style="border:0; height:2px; background-color:black;">
                                <p style="font-size:12px;"><strong>Specialisation :</strong>Marketing Management, Financial Management, Human Resource Management, etc...</p>
                                
                            </div>
                             <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" rahul btn-custom btn-custom1" data-rahul="1" style="" data-id="Get Free Counselling" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>">
                                    Enquire Now
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <button type="button" class=" abhi btn-custom btn-custom2" data-abhishek="1" style="" data-id="Request Callback" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>">
                                    Download Brochure
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
            
            
        </div> 
        
    </div>   
        
     
    
    <div class="container">
            
          
        
        <div style="display:none;" class="row justify-content-center">
                <!--Colleges-->
                
                <!--Manipal University Jaipur-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/muju.html" class="img-fluid rounded" alt="manipal" />
                                <h3>Manipal University Online</h3>
                            </div>
                            <div class="col-sm-8 col-12">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From Manipal University</h4>
                                    <ul>
                                        <li style="font-size:14px;">Manipal University Jaipur UGC-Recognized University</li>
                                        <li style="font-size:14px;">Eligibility: Bachelor’s degree with a minimum of 50% aggregate marks.</li>
                                    </ul>
                                     <div class="ondexk"><div>                                     </div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">UGC-entitled, NAAC A++ accredited</span>
                                                </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12">
                                            <div class="bothbutton">
                                           <button type="button" class="btn rahul" data-rahul="1"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div>
                                        </div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                             <button type="button" class="btn abhi" data-abhishek="1"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                        </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!--Amity University Online-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 col-12 my-auto text-center">
                                <img class="lp-img img-fluid rounded" src="../https_/mbaonlinecourse.com/images/lp/logos/amity.html" alt="amity" />
                                <h3>Amity University Online</h3>
                            </div>
                            <div class="col-sm-8 col-12">
                                <div class="lp-ul f-16 mb-20">
                                     <h4 class="feeheader">MBA From Amity University</h4>
                                    <ul>
                                        <li style="font-size:14px;">Approved by UGC, AICTE, AIU, ACU, NAAC</li>
                                        <li style="font-size:14px;">It offers various UG, PG and PhD programmes, including BA, BBA, BTech.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">UGC-entitled, EOCCS certified</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="2"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                             <button type="button" class="btn abhi" data-abhishek="2"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                        </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Lovely Professional University Online-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 col-12 my-auto text-center">
                                <img class="lp-img img-fluid rounded" src="http://localhost/mukul/online-all-mba/images/lp/logos/lpu.jpg" alt="LPU" />
                                <h3>Lovely Professional University Online</h3>
                            </div>
                            <div class="col-sm-8 col-12">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From Lovely Professional University</h4>
                                    <ul>
                                        <li style="font-size:14px;">Recognized by UGC and offers various management programs</li>
                                       
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                   <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">UGC Accredited, NAAC A++ University</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="3"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="3"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Symbiosis Center of Distance Learning-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                               <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/scdl.html" class="img-fluid rounded" alt="scol" />
                                      <h3>Symbiosis Center of Distance Learning</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">PG Diploma in Business Administration</h4>
                                    <ul>
                                        <li style="font-size:14px;">International / SAARC Graduate from a recognised / accredited University / Institution.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">PG Diploma</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">AICTE Approved</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="4"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="4"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Form On top header only on phone-->
<div class=" onlymob" style="display:none;">
     <h2 style="font-size:15px!important; padding-bottom:10px!important; color:#000;" > Enter your details and get free career counselling in top B-Schools.</h2>
     <div class="contact-div header-contact-form header-contact-bg padding-top-xs onlymob"
                                                            id="get_free_counselling">

                                                            <form class="contact-form1" method="POST"
                                                                action="https://distancemba.co.in/online-mba/lp-verify_mob.php" name="frmid"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="pageurl" id="pageurl" value='index.html'>
                                                                <input type="hidden" name="entryform" id="entryform" value>
                                                                <div class="clearfix">
                                                                    <div class="header-contact-bg-pad"><br>
                                                                        <h3 id="heading" class="text-left"
                                                                            style="padding-left:16px;"></h3>
                                                                        <br>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-12 col-12 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control" type="text"
                                                                                    name="fname" id="fname"
                                                                                    placeholder="Full Name*"
                                                                                    required>
                                                                            </div>
                                                                            <!--<div class="form-group col-md-6 col-12 unit">-->
                                                                            <!--    <input style="border-radius:10px!important;" class="form-control" type="text"-->
                                                                            <!--        name="lname" id="lname"-->
                                                                            <!--        placeholder="Last Name*"-->
                                                                            <!--        required>-->
                                                                            <!--</div>-->
                                                                        </div>

                                                                        <div class="form-row form-div form-bottom-1">
                                                                            <div class="form-group col-md-12 col-12 unit">
                                                                                <input style="border-radius:10px!important;"
                                                                                    class="form-control form-text phoneno"
                                                                                    name="phoneno" id="phoneno"
                                                                                    placeholder="Mobile Number*"
                                                                                    autocomplete="off" type="text"
                                                                                    maxlength="10" pattern="^\d{10}$" oninvalid="this.setCustomValidity('Please enter correct phone')" oninput="this.setCustomValidity('')" required>
                                                                            </div>
                                                                        </div>


                                                                        <div class="form-row form-div form-bottom-1">
                                                                            <div class="form-group col-md-6 col-12 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control form-text"
                                                                                    type="text" name="email" id="email"
                                                                                    placeholder="Email*" required required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Please enter correct email')" oninput="this.setCustomValidity('')">
                                                                            </div>
                                                                            <div class="form-group col-md-6 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control form-text"
                                                                                    type="text" name="city" id="city"
                                                                                    placeholder="Enter City*"
                                                                                    required>
                                                                            </div>
                                                                        </div>
    
                                                                         <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                                                            <select style="border-radius:10px!important;" class="form-control selectcls"
                                                                                name="mx_Interested_In_Speclization" id="mx_Interested_In_Speclization" required>
                                    											<option value="">Select Specialization</option>
                                    											<option value="MBA (Banking and Finance Management)">MBA (Banking and Finance Management)</option>
                                    											<option value="MBA (Business Management)">MBA (Business Management)</option>
                                    											<option value="MBA (Financial Management)">MBA (Financial Management)</option>
                                    											<option value="MBA (Human Resource Management)">MBA (Human Resource Management)</option>
                                    											<option value="MBA (International Trade Management)">MBA (International Trade Management)</option>
                                    											<option value="MBA (Information Technology and Systems Mangement)">MBA (Information Technology and Systems Mangement)</option>
                                    											<option value="MBA (Marketing Management)">MBA (Marketing Management)</option>
                                    											<option value="MBA (Operations Management)">MBA (Operations Management)</option>
                                    											<option value="MBA (Retail Management)">MBA (Retail Management)</option>
                                    											<option value="MBA (Supply Chain Management)">MBA (Supply Chain Management)</option>
                                    											<option value="Master of Business Administration (Executive MBA)">Master of Business Administration (Executive MBA)</option>
                                    											<option value="MBA (X) in Business Analytics">MBA (X) in Business Analytics</option>
											
										                                    </select>
                                                                        </div>

                                                                        <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                                                            <select style="border-radius:10px!important;" class="form-control selectcls"
                                                                                name="university" id="university" required>
                                                                                <option value="">Select University
                                                                                </option>
                                                                                <option
                                                                                    value="Manipal University">
                                                                                    Manipal University</option>
                                                                                <option value="Symbiosis University">
                                                                                    Symbiosis University</option>
                                                                                <option
                                                                                    value="Dr. D. Y. Patil Vidyapeeth University">
                                                                                    Dr. D. Y. Patil
                                                                                    Vidyapeeth University</option>
                                                                                <option value="Jain University">Jain
                                                                                    University</option>
                                                                                <option
                                                                                    value="Amity University, distance and Distance Learning (ODL)">
                                                                                    Amity
                                                                                    University, distance and Distance
                                                                                    Learning (ODL)</option>
                                                                                <option
                                                                                    value="Lovely Professional University Distance Learning">
                                                                                    Lovely
                                                                                    Professional University Distance
                                                                                    Learning</option>
                                                                                <option value="Chandigarh University">
                                                                                    Chandigarh University</option>
                                                                              <!--  <option
                                                                                    value="Indira Gandhi National Open University (IGNOU)">
                                                                                    Indira Gandhi
                                                                                    National Open University (IGNOU)
                                                                                </option>-->
                                                                                <option
                                                                                    value="Welingkar Institute of Management Development & Research">
                                                                                    Welingkar Institute of Management
                                                                                    Development & Research</option>
                                                                                <!--<option value="Manipal University">-->
                                                                                <!--    Manipal University</option>-->
                                                                                <option value="Other">Other</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div style="display:none;">
                                                                            <label for="honeypot">Leave this field blank:</label>
                                                                            <input type="text" id="honeypot" name="honeypot">
                                                                        </div>



                                                                        <div
                                                                            class="form-div phoneno-bottom error-div unit">
                                                                            <input class="header-contact-form"
                                                                                type="checkbox" name="tnc" id="tnc"
                                                                                checked="checked"> I agree to get
                                                                            updates from Distance-MBA
                                                                        </div>

                                                                        <!--============= SUCESSS AND FAILURE MESSAGE DISPLAY HERE ========-->
                                                                        <div class="left form-error-top"> <span
                                                                                class="form-success sucessMessage">
                                                                            </span>
                                                                            <span class="form-failure failMessage">
                                                                            </span>
                                                                        </div>

                                                                        <div class="form-row form-div form-bottom-1"
                                                                            id="verify_id1" style="display:none11;">
                                                                            <!--  <div class="form-group col-md-6">-->
                                                                            <!-- <input type="text" class="form-control form-text" name="verify_otp" id="verify_otp" placeholder="Verify OTP" autocomplete="off">-->
                                                                            <!--</div> -->
                                                                            <!-- <div class="form-group col-md-6">-->
                                                                            <!-- <input type="submit" class="submit-btn contact-form-submit" style="color:#fff!important; width:100%; height:30px" name="btnVerifyPhone" id="btnVerifyPhone" value="Verify OTP">-->
                                                                            <!--</div>-->
                                                                        </div>


                                                                        <!-- <div class="form-group col-md-6" id="sendotp_div">-->
                                                                        <!--<input type="submit" class="submit-btn contact-form-submit" style="color:#fff!important; width:100%; height:30px" name="sendotp" id="sendotp" value="Send OTP">-->
                                                                        <!--</div> -->


                                                                        <div class="form-group col-md-6"
                                                                            id="form_data_div1" style="display:none1;">
                                                                             <style>
                                                                                @media only screen and (max-width: 767px) {
                                                                                    #btnSubmit {
                                                                                        width: 100%!important;
                                                                                        max-width: 100%!important;
                                                                                        height: 30px!important;
                                                                                        border-radius: 15px!important;
                                                                                        margin: 0px 0px 0px 0px;
                                                                                    }
                                                                                }
                                                                            </style>
                                                                            <input type="submit" class="submit-btn contact-form-submit text-center "
                                                                                style="color:#fff!important; width:100%; height:30px; border-radius:21px;"
                                                                                name="btnSubmit" id="btnSubmit"
                                                                                value="Submit">
                                                                        </div>

                                                                        <span id="loader"></span>
                                                                        <br><br>
                                                                    </div>
                                                                </div>
                                                               	 <input type="hidden" name="utm_campaign" id="utm_campaign" value="" >
								 
								 <input type="hidden" name="utm_content" id="utm_content" value="" >
								 
								 <input type="hidden" name="SourceIPAddress" id="SourceIPAddress" value="" >
								 
								 <input type="hidden" name="utm_medium" id="utm_medium" value="" >
								 
								 <input type="hidden" name="SourceReferrerURL" id="SourceReferrerURL" value="" >
								 <input type="hidden" name="utm_keyword" id="utm_keyword" value="" >
                                                            </form>
                                                        </div>
</div>
                
                <!--DY Patil University Online-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/dpu.html" class="img-fluid rounded" alt="dpu" />
                                <h3>DY Patil University Online </h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                     <h4 class="feeheader">MBA From DY Patil University</h4>
                                    <ul>
                                        <li>DY Patil Pune has also been accredited with an A++ grade by (NAAC). </li>
                                        <li>The Institute has been approved UGC , AICTE</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">AICTE Approved, NIRF Top Rank</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="5"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="5"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Jain University-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/jain.html" class="img-fluid rounded" alt="dpu" />
                                <h3>Jain University Online</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Jain Online MBA Program</h4>
                                    <ul>
                                        <li style="font-size:14px;">Jain University (Deemed-to-be-Univeristy) is awarded Graded Autonomy by UGC.  </li>
                                        <li style="font-size:14px;">(NAAC) rated A++ grade with a CGPA of 3.71 </li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">UGC-entitled, EOCCS certified</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="6"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="6"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Chandigarh University Online-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/cu.html" class="img-fluid rounded" alt="cu" />
                                <h3>Chandigarh University Online MBA</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From Chandigarh University</h4>
                                    <ul>
                                        <li style="font-size:14px;">Graduates of recognized professional programmes like CA/ ICWA etc. are also eligible.</li>
                                        <li style="font-size:14px;">Some of the popular courses include B.Tech, BBA, M.Tech, MCA and M.Pharm courses.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">Internationally Recognized Program</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="7"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="7"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <!--Allince University Online MBA-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/alliance.html" class="img-fluid rounded" alt="ALLIANCE" />
                                <h3>Alliance University Online MBA</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From Alliance University</h4>
                                    <ul>
                                        <li style="font-size:14px;">1st Private University in South India</li>
                                        <li style="font-size:14px;">216 World-Class Faculty from India and abroad</li>
                                        <li style="font-size:14px;">55 Study Abroad Options in Global Universities</li>
                                        <li style="font-size:14px;">21,000+ Global Alumni in 45+ Countries</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">Accredited by IAC</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="8"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="8"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--SRM Online-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/srm.html" class="img-fluid rounded" alt="SRM" />
                                <h3>SRM Online</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From SRM University</h4>
                                    <ul>
                                        <li style="font-size:14px;">Recognized by AICTE and UGC Entitled</li>
                                        <li style="font-size:14px;">SRM Institute of Science and Technology (SRM IST Chennai) has been accredited by NAAC with a grade of 'A++'</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">AICTE Recognized · UGC Entitled</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="9"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="9"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Form On top header only on phone-->
<div class="container-fluid onlymob" style="display:none;" >
     <h2 style="font-size:15px!important; padding-bottom:10px!important; color:#000;" > Enter your details and get free career counselling in top B-Schools.</h2>
     <div class="contact-div header-contact-form header-contact-bg padding-top-xs onlymob"
                                                            id="get_free_counselling">

                                                            <form class="contact-form1" method="POST"
                                                                action="https://distancemba.co.in/online-mba/lp-verify_mob.php" name="frmid"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="pageurl" id="pageurl" value='index.html'>
                                                                <input type="hidden" name="entryform" id="entryform" value>
                                                                <div class="clearfix">
                                                                    <div class="header-contact-bg-pad"><br>
                                                                        <h3 id="heading" class="text-left"
                                                                            style="padding-left:16px;"></h3>
                                                                        <br>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-12 col-12 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control" type="text"
                                                                                    name="fname" id="fname"
                                                                                    placeholder="Full Name*"
                                                                                    required>
                                                                            </div>
                                                                            <!--<div class="form-group col-md-6 col-12 unit">-->
                                                                            <!--    <input style="border-radius:10px!important;" class="form-control" type="text"-->
                                                                            <!--        name="lname" id="lname"-->
                                                                            <!--        placeholder="Last Name*"-->
                                                                            <!--        required>-->
                                                                            <!--</div>-->
                                                                        </div>

                                                                        <div class="form-row form-div form-bottom-1">
                                                                            <div class="form-group col-md-12 col-12 unit">
                                                                                <input style="border-radius:10px!important;"
                                                                                    class="form-control form-text phoneno"
                                                                                    name="phoneno" id="phoneno"
                                                                                    placeholder="Mobile Number*"
                                                                                    autocomplete="off" type="text"
                                                                                    maxlength="10" pattern="^\d{10}$" oninvalid="this.setCustomValidity('Please enter correct phone')" oninput="this.setCustomValidity('')" required>
                                                                            </div>
                                                                        </div>


                                                                        <div class="form-row form-div form-bottom-1">
                                                                            <div class="form-group col-md-6 col-12 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control form-text"
                                                                                    type="text" name="email" id="email"
                                                                                    placeholder="Email*" required required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Please enter correct email')" oninput="this.setCustomValidity('')">
                                                                            </div>
                                                                            <div class="form-group col-md-6 unit">
                                                                                <input style="border-radius:10px!important;" class="form-control form-text"
                                                                                    type="text" name="city" id="city"
                                                                                    placeholder="Enter City*"
                                                                                    required>
                                                                            </div>
                                                                        </div>
    
                                                                         <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                                                            <select style="border-radius:10px!important;" class="form-control selectcls"
                                                                                name="mx_Interested_In_Speclization" id="mx_Interested_In_Speclization" required>
                                    											<option value="">Select Specialization</option>
                                    											<option value="MBA (Banking and Finance Management)">MBA (Banking and Finance Management)</option>
                                    											<option value="MBA (Business Management)">MBA (Business Management)</option>
                                    											<option value="MBA (Financial Management)">MBA (Financial Management)</option>
                                    											<option value="MBA (Human Resource Management)">MBA (Human Resource Management)</option>
                                    											<option value="MBA (International Trade Management)">MBA (International Trade Management)</option>
                                    											<option value="MBA (Information Technology and Systems Mangement)">MBA (Information Technology and Systems Mangement)</option>
                                    											<option value="MBA (Marketing Management)">MBA (Marketing Management)</option>
                                    											<option value="MBA (Operations Management)">MBA (Operations Management)</option>
                                    											<option value="MBA (Retail Management)">MBA (Retail Management)</option>
                                    											<option value="MBA (Supply Chain Management)">MBA (Supply Chain Management)</option>
                                    											<option value="Master of Business Administration (Executive MBA)">Master of Business Administration (Executive MBA)</option>
                                    											<option value="MBA (X) in Business Analytics">MBA (X) in Business Analytics</option>
											
										                                    </select>
                                                                        </div>

                                                                        <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                                                            <select style="border-radius:10px!important;" class="form-control selectcls"
                                                                                name="university" id="university" required>
                                                                                <option value="">Select University
                                                                                </option>
                                                                                <option
                                                                                    value="Manipal University">
                                                                                    Manipal University</option>
                                                                                <option value="Symbiosis University">
                                                                                    Symbiosis University</option>
                                                                                <option
                                                                                    value="Dr. D. Y. Patil Vidyapeeth University">
                                                                                    Dr. D. Y. Patil
                                                                                    Vidyapeeth University</option>
                                                                                <option value="Jain University">Jain
                                                                                    University</option>
                                                                                <option
                                                                                    value="Amity University, distance and Distance Learning (ODL)">
                                                                                    Amity
                                                                                    University, distance and Distance
                                                                                    Learning (ODL)</option>
                                                                                <option
                                                                                    value="Lovely Professional University Distance Learning">
                                                                                    Lovely
                                                                                    Professional University Distance
                                                                                    Learning</option>
                                                                                <option value="Chandigarh University">
                                                                                    Chandigarh University</option>
                                                                              <!--  <option
                                                                                    value="Indira Gandhi National Open University (IGNOU)">
                                                                                    Indira Gandhi
                                                                                    National Open University (IGNOU)
                                                                                </option>-->
                                                                                <option
                                                                                    value="Welingkar Institute of Management Development & Research">
                                                                                    Welingkar Institute of Management
                                                                                    Development & Research</option>
                                                                                <!--<option value="Manipal University">-->
                                                                                <!--    Manipal University</option>-->
                                                                                <option value="Other">Other</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div style="display:none;">
                                                                            <label for="honeypot">Leave this field blank:</label>
                                                                            <input type="text" id="honeypot" name="honeypot">
                                                                        </div>



                                                                        <div
                                                                            class="form-div phoneno-bottom error-div unit">
                                                                            <input class="header-contact-form"
                                                                                type="checkbox" name="tnc" id="tnc"
                                                                                checked="checked"> I agree to get
                                                                            updates from Distance-MBA
                                                                        </div>

                                                                        <!--============= SUCESSS AND FAILURE MESSAGE DISPLAY HERE ========-->
                                                                        <div class="left form-error-top"> <span
                                                                                class="form-success sucessMessage">
                                                                            </span>
                                                                            <span class="form-failure failMessage">
                                                                            </span>
                                                                        </div>

                                                                        <div class="form-row form-div form-bottom-1"
                                                                            id="verify_id1" style="display:none11;">
                                                                            <!--  <div class="form-group col-md-6">-->
                                                                            <!-- <input type="text" class="form-control form-text" name="verify_otp" id="verify_otp" placeholder="Verify OTP" autocomplete="off">-->
                                                                            <!--</div> -->
                                                                            <!-- <div class="form-group col-md-6">-->
                                                                            <!-- <input type="submit" class="submit-btn contact-form-submit" style="color:#fff!important; width:100%; height:30px" name="btnVerifyPhone" id="btnVerifyPhone" value="Verify OTP">-->
                                                                            <!--</div>-->
                                                                        </div>


                                                                        <!-- <div class="form-group col-md-6" id="sendotp_div">-->
                                                                        <!--<input type="submit" class="submit-btn contact-form-submit" style="color:#fff!important; width:100%; height:30px" name="sendotp" id="sendotp" value="Send OTP">-->
                                                                        <!--</div> -->


                                                                        <div class="form-group col-md-6"
                                                                            id="form_data_div1" style="display:none1;">
                                                                             <style>
                                                                                @media only screen and (max-width: 767px) {
                                                                                    #btnSubmit {
                                                                                        width: 100%!important;
                                                                                        max-width: 100%!important;
                                                                                        height: 30px!important;
                                                                                        border-radius: 15px!important;
                                                                                        margin: 0px 0px 0px 0px;
                                                                                    }
                                                                                }
                                                                            </style>
                                                                            <input type="submit" class="submit-btn contact-form-submit text-center "
                                                                                style="color:#fff!important; width:100%; height:30px; border-radius:21px;"
                                                                                name="btnSubmit" id="btnSubmit"
                                                                                value="Submit">
                                                                        </div>

                                                                        <span id="loader"></span>
                                                                        <br><br>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="utm_campaign" id="utm_campaign" value="" >
								 
								 <input type="hidden" name="utm_content" id="utm_content" value="" >
								 
								 <input type="hidden" name="SourceIPAddress" id="SourceIPAddress" value="" >
								 
								 <input type="hidden" name="utm_medium" id="utm_medium" value="" >
								 
								 <input type="hidden" name="SourceReferrerURL" id="SourceReferrerURL" value="" >
								 <input type="hidden" name="utm_keyword" id="utm_keyword" value="" >
                                                            </form>
                                                        </div>
</div>
                
                <!--BITS Pilani Distance MBA-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/bits.html" class="img-fluid rounded" alt="nmims" />
                                <h3>BIMTECH</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">PGDM with Specialisation in GenAI</h4>
                                    <ul>
                                        <li style="font-size:14px;">Birla Institute of Technology & Science, Pilani is a deemed university. </li>
                                        <li style="font-size:14px;">It is stitutated in  in Pilani, Jhunjhunu district, Rajasthan, India.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">PG Diploma</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">AACSB Accredited</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="10"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="10"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--ICFAI-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/icfai.html" class="img-fluid rounded" alt="ICFAI" />
                                <h3>(  ICFAI  ) </h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From ICFAI</h4>
                                    <ul>
                                        <li style="font-size:14px;">The ICFAI University offers various undergraduate and postgraduate programs through Online learning.</li>
                                        <li style="font-size:14px;">Approved by AICTE.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">NAAC A++ Accredited</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="11"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="11"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                
                <!--IMT Center For Distance Learning-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="http://localhost/mukul/online-all-mba/images/lp/logos/imt.jpg" class="img-fluid rounded" alt="ICFAI" />
                                <h3>IMT Center For Distance Learning</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">PG Diploma Executive</h4>
                                    <ul>
                                        <li style="font-size:14px;">It is approved by AICTE.</li>
                                        <li style="font-size:14px;">Eligibility: Bachelor’s Degree in any discipline from any recognized University</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">PG Diploma</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">AICTE Approved</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="12"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="12"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--NMIMS SCE Distance-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="http://localhost/mukul/online-all-mba/images/lp/logos/nmims.jpg" class="img-fluid rounded" alt="ICFAI" />
                                <h3>NMIMS SCE Distance</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">MBA From  NMIMS</h4>
                                    <ul>
                                        <li style="font-size:14px;">In 2003, NMIMS was declared a deemed-to-be university under section 3 of the UGC Act 1956.</li>
                                        <li style="font-size:14px;">Strong industry linkages at NMIMS have placed it amongst the nation prime centers</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">UGC Entitled </span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="13"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="13"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Welingker WeSchool-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/weschool.html" class="img-fluid rounded" alt="weschool" />
                                <h3>  Welingker Weschool</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Online PGDM</h4>
                                    <ul>
                                        <li style="font-size:14px;">Welingkar's offers Post Graduate Diploma in Management (PGDM) of 2 years duration (4 semesters) in Hybrid Online Learning mode with 18 subject specializations to choose from</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">PG Diploma</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">Top Ranked NIRF Ranking</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="14"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="14"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Punjab University Distance MBA-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="http://localhost/mukul/online-all-mba/images/lp/logos/pu.jpg" class="img-fluid rounded" alt="weschool" />
                                <h3> Panjab University Distance MBA</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Distance MBA From Panjab University</h4>
                                    <ul>
                                        <li style="font-size:14px;">Punjab University has been well-known by the University Grant Commission that is (UGC). And it is also approved and accredited by the National Assessment and Accreditation Council (NAAC).</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">NAAC A++ Accredited</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="15"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="15"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Anna University-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="http://localhost/mukul/online-all-mba/images/lp/logos/annamalai.png" class="img-fluid rounded" alt="weschool" />
                                <h3> Anna University Online</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Distance MBA From Anna University</h4>
                                    <ul>
                                        <li>Anna University follows a dual semester system namely, Even Semester and Odd Semester.</li>
                                        <li>Anna University has 593 affiliated colleges located in different cities of Tamil Nadu.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">Top NIRF Ranking, Recognized by AICTE</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="16"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="16"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Vekanteshwara University Online-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/vu.html" class="img-fluid rounded" alt="annamalai" />
                                <h3>Vekanteshwara University Online</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Online MBA From VOU</h4>
                                    <ul>
                                        <li style="font-size:14px;">Fifty-two years as a premier institute of higher learning.</li>
                                        <li style="font-size:14px;">Upgraded as Directorate of Online Education (DDE) in April 1995 as per the UGC norms</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">UGC Appoved</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="17"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="17"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-Parul university-->
                <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src="../https_/mbaonlinecourse.com/images/lp/logos/parul-university.html" class="img-fluid rounded" alt="Parul university" />
                                <h3>Parul university</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Distance MBA from Parul University</h4>
                                    <ul>
                                        <li style="font-size:14px;">The ICFAI University offers various undergraduate and postgraduate programs through Online learning.</li>
                                        <li style="font-size:14px;">Approved by AICTE.</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">Master's Degree</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">NAAC A++ Accredited</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                            <button type="button" class="btn rahul" data-rahul="18"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-id="Get Free Counselling" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                                            Get Free Counselling
                                        </button>
                                        </div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton">
                                              <button type="button" class="btn abhi" data-abhishek="18"
                                           style="background-color: #002049!important; color: rgb(255, 255, 255);"
                                            data-toggle="modal" data-id="Download Brochure" data-target="#exampleModal1">
                                            Download Brochure
                                        </button>
                                            </div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      
         
         
            <!--    <div class="col-md-6">
                    <div class="h-card b-shadow">
                        <div class="row cssmobflex">
                            <div class="col-sm-4 my-auto text-center">
                                <img  class="lp-img" src=" https://mbaonlinecourse.com/images/lp/logos/mdi-gurgaon.jpg" class="img-fluid rounded" alt="weschool" />
                                <h3> MDI Gurgaon</h3>
                            </div>
                            <div class="col-sm-8">
                                <div class="lp-ul f-16 mb-20">
                                    <h4 class="feeheader">Online PG Diploma in Management</h4>
                                   <ul>
                                        <li style="font-size:14px;">It is approved by AICTE.</li>
                                        <li style="font-size:14px;">Eligibility: Bachelors Degree in any discipline from any recognized University</li>
                                    </ul>
                                    <div class="ondexk"><div></div></div>
                                    <div class="feetomobile">
                                        <h4 class="feeheader"></h4>
                                            <ul class="custom-list">
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconm"></span>
                                                    <span class="custom-text">PG Diploma</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-iconc"></span>
                                                    <span class="custom-text">24 Months</span>
                                                </li>
                                                <li class="custom-itemmmmm">
                                                    <span class="custom-icons"></span>
                                                    <span class="custom-text">AICTE Approved</span>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-6 col-12"><div class="bothbutton"></div></div>
                                        <div class="col-md-6 col-12"><div class="bothbutton"></div></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                
                
        </div>
        
         <div id="home" style="display:none;" class="header-form-bgimage-lp">
        <div class="container-fluid">
            <div class="row d-flex text-center">
                <div class="vertically-middle">
                <h1>Top Distance / Online MBA Institutes In India</h1>
                <p> Powering Education. Empowering Professionals.</p>
                </div>
            </div>
        </div>
    </div>
    </div>

    
</div>
<section class="min gray">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-8">
							<div class="sec-heading center">
								<h2>Top-Ranked Courses<span class="theme-cl"> Shaping Tomorrow's Leaders</span></h2>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-center">
						
						<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
							<div class="cates_crs_wrip">
								<div class="crs_trios">
									<div class="crs_cate_icon"><i class="fa fa-landmark"></i></div>
									<div class="crs_cate_link"><a href="#" data-toggle="modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal_uni">Enquire Now</a></div>
								</div>
								<div class="crs_capt_cat">
									<h4>Distance MBA</h4>
									<p>Marketing, Financial, Business Management, Human Resource, International Trade, Banking and Finance, Supply Chain, Operations etc.</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
							<div class="cates_crs_wrip">
								<div class="crs_trios">
									<div class="crs_cate_icon"><i class="fa  fa-graduation-cap" aria-hidden="true"></i></div>
									<div class="crs_cate_link"><a href="#" data-toggle="modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal_uni">Enquire Now</a></div>
								</div>
								<div class="crs_capt_cat">
									<h4>Part-Time MBA</h4>
									<p>Marketing, Financial, Business Management, Human Resource, International Trade, Banking and Finance, Supply Chain, Operations etc.</p>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
							<div class="cates_crs_wrip">
								<div class="crs_trios">
									<div class="crs_cate_icon"><i class="fa fa-stamp"></i></div>
									<div class="crs_cate_link"><a href="#" data-toggle="modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal_uni">Enquire Now</a></div>
								</div>
								<div class="crs_capt_cat">
									<h4>Correspondence MBA</h4>
									<p>Marketing, Financial, Business Management, Human Resource, International Trade, Banking and Finance, Supply Chain, Operations etc.</p>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
							<div class="cates_crs_wrip">
								<div class="crs_trios">
									<div class="crs_cate_icon"><i class="fa fa-school"></i></div>
									<div class="crs_cate_link"><a href="#" data-toggle="modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal_uni">Enquire Now</a></div>
								</div>
								<div class="crs_capt_cat">
									<h4>MBA in ODL Mode</h4>
									<p>Marketing, Financial, Business Management, Human Resource, International Trade, Banking and Finance, Supply Chain, Operations etc.</p>
								</div>
							</div>
						</div>
					
					</div>
					
				</div>
			</section>

            <section class="min gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading center">
                        <h2>Our Process<span class="theme-cl">Your Way</span></h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <!-- Single Location -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wrk_grid">
                        <div class="wrk_grid_ico">
                            <i class="fa fa-user-graduate"></i>
                        </div>
                        <div class="wrk_caption">
                            <h4>CAREER CONSULTANCY</h4>
                            <p>
                                Get relevant career paths traced by experts to ascertain the best opportunities
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Single Location -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wrk_grid active">
                        <div class="wrk_grid_ico">
                            <i class="fa fa-book-reader"></i>
                        </div>
                        <div class="wrk_caption">
                            <h4>LEARNING SUPPORT</h4>
                            <p>
                                Unparalleled guidance from industry mentors, teaching assistants and peers
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Single Location -->
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="wrk_grid">
                        <div class="wrk_grid_ico">
                            <i class="fa fa-file-word"></i>
                        </div>
                        <div class="wrk_caption">
                            <h4>PLACEMENT ASSISTANCE</h4>
                            <p>
                                Make informed career choices with career counselling sessions from industry experts
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<!--new-->
<div class="container-fluid" style="background-color:#f5e8f5; padding-top-30px; padding-bottom:30px; margin-bottom:30px;">
    <div class="text-center container">
       <p class="pt-5 " style="font-size:25px; font-weight:700;">Choose From Best Govt. Approved Indian Universities For Online MBA</p>
       <div class="row mt-5 pt-2">
           <div class="col-md-2 col-6"> <img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/Symbiosis.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/Amity.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/NMIMS-1.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/CU.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/DPU.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/OP%20JIndal.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
       </div>
       <div class="row mt-2 ">
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/Jain.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/LPU.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/MUJ.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/Parul.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/online%20UU.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/SHarda.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
       </div>
       
       <div class="row mt-2">
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/GLA.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/Bharati%20Vidyapeeth%20Institute%20(1).png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/SRM.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/Ignou.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/IIMR.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>     
            <div class="col-md-2 col-6"><img alt="Online MBA" class="img-fluid mb-3" src="http://localhost/mukul/online-all-mba/images/logosuni/VIgnan.png" data-bs-toggle="modal" data-bs-target="#exampleModal_uni"></div>
       </div>
       <button type="button" class="btn rahul mt-4" data-rahul="18"
        style="background-color: #002049!important; color: rgb(255, 255, 255);"
        data-id="Get Free Counselling" data-bs-toggle="modal"
		data-bs-target="#exampleModal_uni">
            Enquire Now
        </button>
    </div>
    
</div>

<div class="admission-section">
		<div class="process-heading">
			<h2>
				<span class="d-block">Online Program</span>
				Admission Process
			</h2>
		</div>

		<ul class="process-listing">
			<li>
				<div class="process-box">
					<figure><img src="images/counselling.png" alt="image"></figure>

					<strong>Career <br>
						Counselling</strong>
				</div>
			</li>

			<li>
				<div class="process-box">
					<figure><img src="images/application.png" alt="image"></figure>

					<strong>Online <br>
						Application</strong>
				</div>
			</li>

			<li>
				<div class="process-box">
					<figure><img src="images/feepayment.png" alt="image"></figure>

					<strong>Online <br>
						Fee Payment</strong>
				</div>
			</li>

			<li>
				<div class="process-box">
					<figure><img src="images/enrollment.png" alt="image"></figure>

					<strong>Online <br>
						Enrollment</strong>
				</div>
			</li>

			<li>
				<div class="process-box">
					<figure><img src="images/course.png" alt="image"></figure>

					<strong>Start<br>
						Learning</strong>
				</div>
			</li>

		</ul>

	</div>

<!--<script-->
<!--      type="text/javascript"-->
<!--      src="https://lsqbot.converse.leadsquared.com/bot-script.js"-->
<!--    ></script>-->
<!--LSQ Chatbot-->
<!--<iframe style="bottom: 15px; right: 10px;     height: 400px;" id="lsq-chatbot" src="https://botweb.converse.leadsquared.com/?botId=786&tenantId=67907&type=WEB&channelId=e534fb4d-4ba5-4499-b215-b31278386607"></iframe>-->

<!--FAQs-->
<div class="container mt-2 mb-4 pb-2">
  <hr>
  <h2 class="mb-4"><Span class="graident-color ">Frequently Asked </Span> Questions</h2>
  
  <div class="faq-item">
    <div class="faq-header">
      <span style="font-size:18px; font-weight:bold;">Is MBA Online worth it?</span>
      <span class="faq-icon">+</span>
    </div>
    <div class="faq-content">
        <p class="mt-3 mb-2" style="fonts-size:16px;">Those with an Online MBA often can command higher salaries than those without one. In addition, having an online MBA can give you a competitive edge when applying for jobs. It can also help you advance more quickly in your career once you are hired.</p>
    </div>
  </div>
  
  <div class="faq-item">
    <div class="faq-header">
      <span style="font-size:18px; font-weight:bold;">Is online MBA equal to regular MBA?</span>
      <span class="faq-icon">+</span>
    </div>
    <div class="faq-content">
        <p class="mt-3 mb-2" style="fonts-size:16px;">There is essentially no difference in career opportunities when it comes to online MBA vs regular MBA.</p>
    </div>
  </div>
  
  <div class="faq-item">
    <div class="faq-header">
      <span style="font-size:18px; font-weight:bold;">Distance MBA or Online MBA?</span>
      <span class="faq-icon">+</span>
    </div>
    <div class="faq-content">
        <p class="mt-3 mb-2" style="fonts-size:16px;">Distance MBA provides a traditional and slower-paced approach, Online MBA offers a more contemporary, interactive, and technologically-driven learning experience.</p>
    </div>
  </div>
  
  <div class="faq-item">
    <div class="faq-header">
      <span style="font-size:18px; font-weight:bold;">Online MBA or Online PGDM?</span>
      <span class="faq-icon">+</span>
    </div>
    <div class="faq-content">
        <p class="mt-3 mb-2" style="fonts-size:16px;">An MBA is similar to a PGDM. It equips one with the necessary skills to become a successful manager. However, an online PGDM course is not only beneficial for graduate students but also for working professionals.</p>
    </div>
  </div>
  
  <div class="faq-item">
    <div class="faq-header">
      <span style="font-size:18px; font-weight:bold;">Is Online MBA degree valid?</span>
      <span class="faq-icon">+</span>
    </div>
    <div class="faq-content">
        <p class="mt-3 mb-2" style="fonts-size:16px;">
        Nationally Recognized Degree: Your online MBA will be valid for further education, government jobs, and professional certifications. Enhanced Credibility: Employers recognize accredited online MBAs from reputed universities, adding value to your resume.
        </p>
       
    </div>
  </div>
  
</div>



 <div id="home" class="header-form-bgimage-lp">
        <div class="container-fluid">
            <div class="row d-flex text-left">
                <div class="vertically-middle">
                <h1 style="font-size:32px;">Top Distance / Online MBA Institutes In India</h1>
                <p> Powering Education. Empowering Professionals.</p>
                 <button type="button" class=" abhi btn-custom btn-custom4" data-abhishek="1"  data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                        Apply Now
                </button>    
                </div>
            </div>
        </div>
    </div>

<!---->


<div class="containter-fluid" style="background-color: #B70606; display:none;">
      
            <div class="row text-center">
                <div class="col-sm-12 mt-40 mb-40">
                    <h2 class="text-white" style="transform: translateY(30px);">Still Not Sure About Programs?</h2>
                    <p class="text-white mt-20 mb-20" style="transform: translateY(30px);">Contact Our Counselling Experts & Get Free Counselling</p>
                    <div style="    transform: translateY(30px);>
                  
                    <button type="button" class=" abhi btn-custom btn-custom3" data-abhishek="1"  data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
                        Request a Callback
                    </button>
                </div>
                </div>
            </div>
        
</div>

 <!--Footer  -->
                                                                                                                                                                                                                                                                                                                                                                                           
<style>
   #exampleModal1 .modal-body{padding:0px;}
</style>

 <!--Footer  -->
      <footer class="light-footer skin-light-footer style-2 sticky-stopper pt-30" style="background-color: rgb(243, 240, 240);">
        <div class="footer-bottom">
            <!-- Footer -->
            <footer class=" text-lg-start bg-light text-muted" style="padding:30px;">


                <!-- Section: Links  -->
                <section class="">
                    <div class="container  text-md-start mt-5">
                        <!-- Grid row -->
                        <div class="row mt-3">
                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-3 col-xl-3 ">
                                <!-- Content -->

                                <div style="padding-top: 10px; margin-bottom: 10px;">
                                    <img src="http://localhost/mukul/online-all-mba/images/Artboard 1@3x-8.png" height="30px" width="auto%" alt="logo" srcset="">
                                </div>
                                <p  style="font-size: 14px!important; text-align: justify;">
                                    Welcome to the MBA Online Course. Our website is more than just a resource; it’s a gateway to transforming your career. Our goal is to empower you to make informed decisions and achieve your professional aspirations through an exceptional online MBA experience.

                                </p>

                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                                <!-- Links -->
                                <h5 style="font-weight: 600!important; color: #000; padding-left: 40px;"
                                    class="text-uppercase fw-bold mb-4 mt-4 leftpaddmob">
                                    Top B-Schools
                                </h5>
                                <ul style="color:black">
                                    
                                    <li class="mobleftmar"><a></a>Amity Online University</li>
                                    <li class="mobleftmar">Manipal Online</li>
                                    <li class="mobleftmar">Jain Online </li>
                                    <li class="mobleftmar">DY Patil Online</li>
                                    <li class="mobleftmar">O.P Jindal Global University</li>
                                </ul>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                                <!-- Links -->
                                <h5 style="font-weight: 600!important; color: #777777; padding-left: 40px; display:none;"
                                class="text-uppercase fw-bold mb-4 leftpaddmob">
                                Colleges
                            </h5>
                            <ul style="color:black;">
                                                               <li class="mobleftmar">NMIMS Online</li>

                               <li class="mobleftmar">LPU Online</li>
                               <li class="mobleftmar">Sharda University</li>
                               <li class="mobleftmar">Symbiosis Centre of Distance Learning</li>
                               <li class="mobleftmar">Chandigarh University</li>
                               <li class="mobleftmar">Uttranchal Univeristy</li>
                               
                            </ul>
                            
                            

                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4" style="display:none;">
                                
                                <!-- Grid column -->
                            
                                <!-- Links -->
                                <h5 style="font-weight: 600!important; color: #000; padding-left: 40px;"
                                class="text-uppercase fw-bold mb-4 leftpaddmob">
                               Navigation
                            </h5>
                            <ul style="color:black;">
                               <li class="mobleftmar"><a href="https://distancemba.co.in/blog.php">Blogs</a></li>
                               
                            </ul>
                                <!-- Links -->
                                <section style="display: none;"
                                    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                                    <!-- Left -->
                                    <div class="me-5 d-none d-lg-block">
                                        <span>Get connected with us on social networks:</span>
                                    </div>
                                    <!-- Left -->

                                    <!-- Right -->
                                    <div>
                                        <a href="#" class="me-4 text-reset">
                                            <i class="fa fa-facebook-f fa-2x" style="color: #3b5998 ;"></i>
                                        </a>

                                        </a>
                                        <a href="#" class="me-4 text-reset">
                                            <i class="fa fa-instagram fa-2x" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                          -webkit-background-clip: text;
                                  /* Also define standard property for compatibility */
                                  background-clip: text;
                          -webkit-text-fill-color: transparent;"></i>
                                        </a>
                                        <a href="#" class="me-4 text-reset">
                                            <i class="fa fa-linkedin fa-2x" style="color: #0072b1 ;"></i>
                                        </a>

                                    </div>
                                    <!-- Right -->
                                </section>
                           
                            <!-- Grid column -->
                        </div>
                        <!-- Grid row -->
                    </div>
                    </div>
                </section>
                <!-- Section: Links  -->

                <!-- Copyright -->

                <!-- Copyright -->
            </footer>
            <!-- Footer -->
            <div class="container-fluid">

                <div class="row align-items-center" style="background-color: rgb(240, 237, 237);">
                    <div class="col-lg-12 col-md-12 text-center">
                        <h5 style="text-align: center"> Copyright &copy;
                            2024 MBA Online Course
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin: 0px 90px 0 70px;">
            <div class="modal-header">
                <img src="images/main%20site%20logo.html" height="50px" width="auto" alt="distance-mba">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="contact-div header-contact-form header-contact-bg padding-top-xs" id="get_free_counselling">
                    <form class="contact-form1" method="POST" action="https://distancemba.co.in/online-mba/lp-verify_mob.php" name="frmid" enctype="multipart/form-data" onsubmit="return validateForm();">
                        <input type="hidden" name="pageurl" id="pageurl" value='index.html'>
                        <input type="hidden" name="entryform" id="entryform" value>
                        <div class="clearfix">
                            <div class="header-contact-bg-pad"><br>
                                <h3 id="heading" class="text-left" style="padding-left:16px;text-align: center;"></h3>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-12 col-12 unit">
                                        <input style="border-radius:10px!important; width: 100%;" class="form-control" type="text" name="fname" id="fname" placeholder="Full Name*" required>
                                        <span class="errormsg" id="errname"></span>
                                    </div>
                                </div>
                                <div class="form-row form-div form-bottom-1" style="margin-bottom:0px;">
                                    <div class="form-group col-md-12 col-12 unit">
                                        <input style="border-radius:10px!important;" class="form-control form-text phoneno" name="phoneno" id="phoneno" placeholder="Mobile Number*" autocomplete="off" type="text" maxlength="10" onkeydown="return valid_entry_num(event.key)" required>
                                        <span class="errormsg" id="errp"></span>
                                    </div>
                                </div>
                                <div class="form-row form-div form-bottom-1" style="margin-bottom:0px;">
                                    <div class="form-group col-md-12 col-12 unit">
                                        <input style="border-radius:10px!important; width: 100%;" class="form-control form-text" type="email" name="email" id="email" placeholder="Email*" required >
                                        <span class="errormsg" id="erre"></span>
                                    </div>
                                    <div class="form-group col-md-12 unit">
                                        <input style="border-radius:10px!important; width: 100%;" class="form-control form-text" type="text" name="city" id="city" placeholder="City*" onkeydown="return valid_entry_char(event.key)" required>
                                        <span class="errormsg" id="errc"></span>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-div form-bottom-1 form-bottom-2 unit">
                                    <select style="border-radius: 10px !important; margin: 6px -16px; width: 107%;" class="form-control selectcls" name="university" id="university" required>
                                        <option value="">Select University</option>
                                        <option value="Amity University">Amity University</option>
                                        <option value="Manipal University">Manipal University</option>
                                        <option value="O.P. Jindal Global University">O.P. Jindal Global University</option>
                                        <option value="Jain University">Jain University</option>
                                        <option value="Dr. DY. Patil Vidyapeeth University">Dr. DY. Patil Vidyapeeth University</option>
                                        <option value="Lovely Professional University">Lovely Professional University</option>
                                        <option value="Uttaranchal University">Uttaranchal University</option>
                                        <option value="Symbiosis Centre of Distance Learning (SCDL)">Symbiosis Centre of Distance Learning (SCDL)</option>
                                        <option value="Institute of Management Technology, Ghaziabad">Institute of Management Technology, Ghaziabad (IMT)</option>
                                        <option value="Sharda University">Sharda University</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div style="display:none;">
                                    <label for="honeypot">Leave this field blank:</label>
                                    <input type="text" id="honeypot" name="honeypot">
                                </div>
                                <div class="form-div phoneno-bottom error-div unit">
                                    <input class="header-contact-form" type="checkbox" name="tnc" id="tnc" checked="checked"> I agree to get updates from counsellor
                                </div>
                                <div class="left form-error-top"> 
                                    <span class="form-success sucessMessage"></span>
                                    <span class="form-failure failMessage"></span>
                                </div>
                                <div class="form-group col-md-6" id="form_data_div1" style="display:none1;">
                                    <input type="submit" class="submit-btn contact-form-submit text-center" style="color:#fff!important; height: 46px !important;border-radius: 35px !important;" name="btnSubmit" id="btnSubmit" value="Submit">
                                </div>
                                <span id="loader"></span>
                                <br>
                            </div>
                        </div>
                         <input type="hidden" name="utm_campaign" id="utm_campaign" value="" >
						<input type="hidden" name="utm_content" id="utm_content" value="" >
						<input type="hidden" name="SourceIPAddress" id="SourceIPAddress" value="" >
                        <input type="hidden" name="utm_medium" id="utm_medium" value="" >
                        <input type="hidden" name="SourceReferrerURL" id="SourceReferrerURL" value="" >
                        <input type="hidden" name="utm_keyword" id="utm_keyword" value="" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script>
$(document).ready(function() {
    $('.faq-header').click(function() {
        // Toggle the visibility of the corresponding .faq-content
        $(this).next('.faq-content').slideToggle();

        // Optionally, change the icon or style of the header when it's clicked
        $(this).find('.faq-icon').text(function(i, oldText) {
            return oldText === '+' ? '-' : '+';
        });
    });
});

</script>
<style>.custom-item {
    position: relative;
}

.hover-popup {
    display: none;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #fff;
    padding: 10px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    width: 200px;
    text-align: center;
}

.custom-item:hover .hover-popup {
    display: block;
}

.hover-popup p {
    font-weight: bold;
    font-size: 14px;
}

section.min {
    padding: 0px 0 0px;
    position: relative;
}
.gray {
    background: #f7f8f9;
}

.wrk_grid {
    position: relative;
    display: block;
    width: 100%;
    border-radius: 0.4rem;
    background: #d3d3d33d;
    padding: 2rem 1rem;
    text-align: center;
    margin-bottom: 30px;
    transition:all ease 0.4s;
    box-shadow: 0 0 10px 0 rgb(62 28 131 / 7%);
    -webkit-box-shadow: 0 0 10px 0 rgb(62 28 131 / 7%);
}
.wrk_grid.active{
	background: #0081ff;
}
.wrk_grid_ico {
    display: inline-flex;
    width: 62px;
    height: 62px;
    margin: 2rem auto;
    justify-content: center;
    align-items: center;
    background: #ff5500;
    border-radius: 50%;
    color: #ffffff;
    font-size: 25px;
    box-shadow: 0px 0px 0px 10px rgb(3 185 124 / 20%);
	-webkit-box-shadow: 0px 0px 0px 10px rgb(3 185 124 / 20%);
}
.wrk_grid.active .wrk_grid_ico {
    background: #ffffff;
    color: #ff5500;
    box-shadow: 0px 0px 0px 10px rgb(255 255 255 / 20%);
	-webkit-box-shadow: 0px 0px 0px 10px rgb(255 255 255 / 20%);
}
.wrk_caption {
    padding: 0 1rem;
}
.wrk_caption p {
    margin: 0;
    /*font-size: 15px;*/
    line-height: 1.7;
}
.wrk_grid.active h4, .wrk_grid.active p{
	color:#ffffff;
}
.theme-cl {
    color: #172de4 !important;
}

</style>
</body>


</html>