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

<div class="banner-section  data-img-bg" data-image-src="images/on-mba-banner1.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-6">

			</div>
			<div class="col-lg-5 col-md-6">
				<div class="d-md-flex d-block justify-content-end">
					<div class="banner-content">
						<h1>Online <strong class="text-uppercase">Mba Degree</strong></h1>
						<p>UGC Entitled <b class="redline">|</b> AICTE &amp; NAAC Approved</p>
					<p>Robust Placement Support <b class="redline">|</b> 400+ hrs of Recorded Lecture</p>
					<p>Live Interactive Session <b class="redline">|</b> Professional Enhancement workshop</p>						
					</div>
				</div>
				<div class="row" style="
	padding: 5px;
	margin-left: 28px;
	margin-top: 20px;
">
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Amity Online MBA" src="images/NMIMS-web.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“Granted Category 1 University by MHRD”</p>
							<p>“500+ Hiring Partners”</p>
							<p>“Special Scholarship for Armed Forces”</p>
						</div>
					</div>
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Amity Online MBA" src="images/Amity.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“Diverse learning mediums”</p>
							<p>“Dedicated Academic Advisor”</p>
							<p>“Placement opportunities”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Symbiosis Online MBA"
							src="images/Symbiosis.png" data-abhishek="1" style="cursor: pointer; border:none!important;"
							data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“21 years legacy of offering online education. ”</p>
							<p>“SCDL offers a range of ODL programs with high industry acceptance”</p>							
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Manipal Online MBA" src="images/MUJ.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“Has over 250 international collaborations with universities”</p>
							<p>“Focuses on interdisciplinary research and engagement<br>with the wider research community.”</p>							
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="DY Patil Online MBA" src="images/DPU.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“38 years of Excellence”</p>
							<p>“1,00,000+ strong alumni networks across the Globe”</p>
							<p>“NAAC A++ Accreditation”</p>
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Online MBA Manipal University"
							src="images/MAHE.png" data-abhishek="1" style="cursor: pointer; border:none!important;"
							data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“Has over 250 international collaborations with universities”</p>
							<p>“Focuses on interdisciplinary research and engagement<br>with the wider research community.”</p>	
						</div>
					</div>

					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="Jain Online MBA" src="images/Jain.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“20,000+ Courses on LinkedIn Learning.”</p>
							<p>“65+ Educational Institutions.”</p>
							<p>“45+ Programs & Specialisations.”</p>
						</div>
					</div>
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="LPU Online MBA" src="images/LPU.png"
							data-abhishek="1" style="cursor: pointer; border:none!important;" data-id="Request Callback"
							data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“Recognized by Times Higher Education World University Ranking”</p>
							<p>“LPU received the highest Grade A++ with a remarkable score of 3.68”</p>
							
						</div>
					</div>
					<div class="col-md-3 col-6 custom-item" style="
	margin-bottom: 10px; width: 140px;
">
						<img class="abhi topbannerunilogos img-fluid" alt="OP Jindal Online MBA"
							src="images/OP JIndal.png" data-abhishek="1" style="cursor: pointer; border:none!important;"
							data-id="Request Callback" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
							<div class="hover-popup">
							<p>“JGU is ranked as India’s Number 1 Private University<br>by the prestigious <br>QS World University Rankings 2023.”</p>
						
						</div>
					</div>

				</div>
				<a href="#" class="btn btn-primary" style="margin-bottom: -113px;margin-left: 101px;"><b>Admission open</b></a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<ul class="information-listing wow fadeInUp  animated">
		<li style="
	background-color: antiquewhite;
">
			<div class="information-box">
				<figure><img src="images/icon1.svg" alt="image"></figure>
				<strong>70+ </strong>
				<p>Specialisations <br> Offered</p>
			</div>
		</li>

		<li style="
	background-color: aquamarine;
">
			<div class="information-box">
				<figure><img src="images/icon2.svg" alt="image"></figure>
				<strong>24*7 Learning </strong>
				<p>Live and interactive lectures by expert faculty.</p>
			</div>
		</li>
		<li style="
	background-color: beige;
">
			<div class="information-box">
				<figure><img src="images/icon3.svg" alt="image"></figure>
				<strong>Placement assistance</strong>
				<p>Placement drive and career assistance </p>
			</div>
		</li>
		<li style="
	background-color: #a9a9a92b;
">
			<div class="information-box">
				<figure><img src="images/icon4.svg" alt="image"></figure>
				<strong>Easy EMIs </strong>
				<p>Monthly EMIs @ 0% interest rates</p>
			</div>
		</li>

		<li style="
	background-color: #00ffff1c;
">
			<div class="information-box">
				<figure><img src="images/icon5.svg" alt="image"></figure>
				<strong>Strong alumni network </strong>
				<p>Connect with the peers from top MNC’s</p>
			</div>
		</li>
	</ul>
</div>

<div class="container">
	<div class="universities-section">
		<div class="headingbar">
			<h2>Top <strong> Online MBA</strong> Programs Offered by Top Universities</h2>
		</div>

		<ul class="universities-listing">
			<li>
				<div class="universities-box" style="
	background-color: #a9a9a92b;
">
					<figure><img src="images/NMIMS-Logo.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 220,000.00/-</strong>
					<strong>4+ Specialisations available</strong>

					<!-- <p>Business Management,
						Marketing,
						Operations & Data Sciences,
						Human Resources,
						Finance</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[0]; ?>"
								rel="<?php echo $universityNames[0]; ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[0] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #a9a9a92b;
">
					<figure><img src="images/universitie-logo_1.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 199,000.00/-</strong>
					<strong>16+ Specialisations available</strong>
					<!-- <p>Business Analytics, Digital Marketing, Entrepreneurship and Leadership, Hospitality &
						Petroleum and Natural Gas Management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[1]; ?>"
								rel="<?php echo $universityNames[1]; ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[1] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #a9a9a92b;
">
					<figure><img src="images/universitie-logo_2.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 160,000.00/-</strong>
					<strong>14+ Specialisations available</strong>
					<!-- <p>Banking, Finance and Allied Services, International Finance and Accounting, Aviation
						Management, Sports Management, Luxury and Fashion Management & Digital Business.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[2] ?>"
								rel="<?php echo $universityNames[2] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[2] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #a9a9a92b;
">
					<figure><img src="images/universitie-logo_3.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 144,000.00/-</strong>
					<strong>8+ Specialisations available</strong>
					<!-- <p>International Business, Business Analytics, Data Science, Operations Management, Marketing
						Management & Information Technology.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[3] ?>"
								rel="<?php echo $universityNames[3] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[3] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: antiquewhite;
">
					<figure><img src="images/universitie-logo_4.webp" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 175,000.00/-</strong>
					<strong>12+ Specialisations available</strong>
					<!-- <p>Finance and marketing management, Health Care management, Pharmaceutical management, Fashion
						Management & Data Science.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[4] ?>"
								rel="<?php echo $universityNames[4] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[4] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: antiquewhite;
">
					<figure><img src="images/universitie-logo_5.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 150,000.00/-</strong>
					<strong>4+ Specialisations available</strong>
					<!-- <p>Tax planning & management, Behavioral Finance & analytics, Investment Management, Integrated
						marketing communication & Cross cultural management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[5] ?>"
								rel="<?php echo $universityNames[5] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[5] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color:antiquewhite;
">
					<figure><img src="images/universitie-logo_6.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 199,000.00/-</strong>
					<strong>20+ Specialisations available</strong>
					<!-- <p>Human Resource Management, Business and Corporate Laws, Supply Chain Management, Diploma in
						Data Science, Project Management, & Educational Administration.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[6] ?>"
								rel="<?php echo $universityNames[6] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[6] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color:antiquewhite;
">
					<figure><img src="images/universitie-logo_7.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 82,000.00/-</strong>
					<strong>4+ Specialisations available</strong>
					<!-- <p>Performance and Compensation Management, Security Analysis, Portfolio and Risk Management,
						Wealth Management & Investment Environment.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[7] ?>"
								rel="<?php echo $universityNames[7] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[7] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #00ffff1c;
">
					<figure><img src="images/universitie-logo_8.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 199,000.00/-</strong>
					<strong>4+ Specialisations available</strong>
					<!-- <p>Finance Management, Marketing Management, Human Resource Management, Operations Management,
						Business Analytics, Data Mining for Business Analytics, Predictive Modelling, Business
						Simulation, Sales and Distribution Management & Integrated Marketing Communications.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[8] ?>"
								rel="<?php echo $universityNames[8] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[8] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>


			<li>
				<div class="universities-box" style="
	background-color: #00ffff1c;
">
					<figure><img src="images/universitie-logo_9.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 199,000.00/-</strong>
					<strong>10+ Specialisations available</strong>
					<!-- <p>Marketing, Finance, Human Resource, Operations., Supply Chain, Material & Information
						Technology Management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[9] ?>"
								rel="<?php echo $universityNames[9] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[9] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #00ffff1c;
">
					<figure><img src="images/universitie-logo_10.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 199,200.00/-</strong>
					<strong>7+ Specialisations available</strong>
					<!-- <p>
						Fintech Management, Consultancy Management, Quality Management, Digital Business Management
						& Manufacturing Management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[10] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #00ffff1c;
">
					<figure><img src="images/universitie-logo_11.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: 169,200.00/-</strong>
					<strong>14+ Specialisations available</strong>
					<!-- <p>Event Management , Hospital and Health Care Management, Retail Management & Entrepreneurship
						Management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[11] ?>"
								rel="<?php echo $universityNames[11] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[11] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #6495ed5e;
">
					<figure><img src="images/universitie-logo_12.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 195,000.00/-</strong>
					<strong>10+ Specialisations available</strong>
					<!-- <p>Aviation Management, Corporate Strategy and Innovation management, Web Design and
						Development, Oil and Gas Mangement & International Management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[12] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #6495ed5e;
">
					<figure><img src="images/universitie-logo_13.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 180,000.00/-</strong>
					<strong>15+ Specialisations available</strong>
					<!-- <p>Telecom Management, International Business, Retail Management, Innovative Management &
						Hospital and Healthcare management</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[13] ?>"
								rel="<?php echo $universityNames[13] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[13] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #6495ed5e;
">
					<figure><img src="images/universitie-logo_14.jpg" alt="image"></figure>
					<h3>MBA | 24 Months</h3>
					<strong>Fees stats: ₹ 199,000.00/-</strong>
					<strong>20+ Specialisations available</strong>
					<!-- <p>Biotechnology Management, Insurance /Banking and Finance Management, Textile Management.</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[14] ?>"
								rel="<?php echo $universityNames[14] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[14] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

			<li>
				<div class="universities-box" style="
	background-color: #6495ed5e;
">
					<figure><img src="images/OP-Jindal.png" alt="image"></figure>
					<h3>MBA | 12 Months</h3>
					<strong>Fees stats: ₹ 160,000.00/-</strong>
					<strong>4+ Specialisations available</strong>
					<!-- <p>Marketing, Finance, Strategy & Leadership, Digital Finance</p> -->
					<div class="btn-grp d-flex">
						<span><a href="#" class="btn btn-primary download_brochure" data-bs-toggle="modal"
								data-bs-target="#exampleModal" data-pdf-name="<?php echo $universityPdfNames[15] ?>"
								rel="<?php echo $universityNames[15] ?>"><b>Download Brochure</b></a> </span>
						<span><a href="#" class="btn btn-secondary university_list" data-bs-toggle="modal"
								data-bs-target="#exampleModal" rel="<?php echo $universityNames[15] ?>"><b>Enquire
									Now</b></a></span>
					</div>
				</div>
			</li>

		</ul>

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

	<div class="talk-expert-section">
		<div class="row align-items-center">
			<div class="col-xl-7 col-lg-6 col-md-12">
				<h2>Have a Question?
					<span class="d-block">Talk to our experts for free counselling.</span>
				</h2>

			</div>
			<div class="col-xl-5 col-lg-6 col-md-12">
				<div class="talk-expert-form">
					<form class="talk-expert" name="talk-expert">

						<input type="hidden" id="mx_Website_Page" name="mx_Website_Page" value="Counselling Enquire">

						<?php include 'form_footer.php'; ?>
					</form>
				</div>

			</div>
		</div>

	</div>

</div>

<!-- <div class="supercharge-section">
	<div class="container">
		<div class="supercharge-heading">
			<div class="education-heading__shadow-text">education</div>
			<h2><span>Supercharge</span> your Career</h2>
		</div>

		<ul class="supercharge-listing">
			<li>
				<div class="supercharge-box">
					<h3>Networking</h3>
					<p>MBA includes professionals from various functions, industries & job profiles.</p>
				</div>
			</li>

			<li>
				<div class="supercharge-box">
					<h3>Managerial Skills</h3>
					<p>Helps professionals understand & implement leadership skills, managerial skills & employee
						retention methods etc.</p>
				</div>
			</li>

			<li>
				<div class="supercharge-box">
					<h3>
						Strategic Thinking</h3>
					<p>MBA Online Program helps you think strategically & wisely. Not only helps in business but
						also in personal life.</p>
				</div>
			</li>

			<li>
				<div class="supercharge-box">
					<h3>Enhance Self Confidence</h3>
					<p>Self Confidence is a must have skill when it comes to corporate sector. MBA helps you to
						build your self-confidence to the core.</p>
				</div>
			</li>
			<li>
				<div class="supercharge-box">
					<h3>
						Esteemed position in Reputed Organisation</h3>
					<p>MBA degree opens several doors to big companies & higher positions. It reduces the steps to
						advance in your career.</p>
				</div>
			</li>

			<li>
				<div class="supercharge-box">
					<h3>
						Wide range of Opportunities</h3>
					<p>MBA program helps you explore wide range of job opportunities fearlessly. It enables you to
						explore new trends, techniques, management tools & ideas in the market.</p>
				</div>
			</li>

		</ul>

	</div>

</div> -->

<div class="container">
	<div class="opening-accordion">
		<div class="accordion" id="accordionExample">
			<div class="accordion-item">
				<div class="accordion-header" id="headingOne">
					<button class="accordion-button" type="button" data-bs-toggle="collapse"
						data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Which is better, Online Or Regular?</button>
				</div>
				<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
					data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<p>Education teaches us about the world and people. We can change the world by educating
							ourselves. Online learning has increased flexibility and accessibility. People used to
							choose their careers and stick with them, and many people today have to work two jobs.
						</p>
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<div class="accordion-header" id="headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
						data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Is Online
						MBA good for getting job?</button>
				</div>
				<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
					data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<p>Apart from expanding your career opportunities, online MBA Programs also prepares you for
							high-salary paying jobs in today's competitive market. As per a recent study, the pay of
							average MBA graduates was 50% higher than their position before earning their degree.
						</p>
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<div class="accordion-header" id="headingThree">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
						data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How much
						would it cost to pursue Online MBA course?</button>
				</div>
				<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
					data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<p>Fees for Online/ Correspondence MBA courses are less than regular MBA programs. Every
							B-school has its own fee structure. Program fee ranges anywhere from Rs 50,000 upto Rs
							10 lakh.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

</body>
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
    border: 12px solid #ccc;
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
</style>
</html>