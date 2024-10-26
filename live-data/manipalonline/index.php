<?php 
$from_fb 			= isset($_GET['from_fb']) ? $_GET['from_fb'] : NULL; 
$source           	= isset($_GET['source']) ? $_GET['source'] : NULL; 
$source_campaign 	= isset($_GET['source_campaign']) ? $_GET['source_campaign'] : NULL; 
$source_medium  	= isset($_GET['source_medium']) ? $_GET['source_medium'] : NULL;
?>

<!doctype html>
<html lang="en">
<?php 	$mobileTextClass = 'mobile01'; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description"
        content="Manipal University Jaipur Online offers distance education courses for Online BA, BCA, BCom, MBA, MCA, MCom & MA-JMC in 2023">
    <title>Manipal University Jaipur Online | Online Degree Courses 2023</title>

    <link rel="icon" type="image/x-icon" href="images/fav-icon.png.webp">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<header>
        <div class="container">
            <div class="header">
                <div class="logo">
                    <figure><a href="index.php"><img src="images/logo.webp" alt="logo"></a></figure>
                </div>
                <nav class="navbar navbar-expand-lg">
                    <button id="nav-menus" class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="index.php">Home</a></li>
                            <li class="nav-item"><a href="#about" class="anchor-link">About</a></li>
                            <li class="nav-item"><a href="#Approvals" class="anchor-link">Approvals</a></li>
                            <li class="nav-item"><a href="#Prospects" class="anchor-link">Courses</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
 
	<div class="banner-section  data-img-bg" data-image-src="images/bg-mani.webp">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-7 col-md-12">
                    <div class="banner-content wow fadeInUp">
                        <span class="d-block">Welcome To Manipal University</span>

                        <h1>Enhance Your Career
                            <strong class="d-block">Pursue Online Degree Now</strong>
                        </h1>
                        <p>Study at Manipal University Jaipur where Online Degree Courses gives you the flexibility to
                            study at home, or anywhere anytime.</p>
                        <div class="course-highlight">
                            <h3>BBA | BCOM | BCA | MBA | MCA | MCOM | MA-JMC</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="d-md-flex d-block justify-content-end">
                        <div class="inquire-box wow fadeInUp">
                            <h2>Free Counseling</h2>
                            <div class="inquire-form">
								<form class="servicefrm" name="servicefrm">
									<?php include 'form.php'; ?>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="organisation-ad-section">
        <div class="container">
            <div class="ad-blocker-card">
                <p>Admissions Closing Soon, Limited seats available!!.</p>
                <a href="#" class="btn apply-now-btn">Apply Now</a>
            </div>
        </div>
    </div>

    <span id="Prospects" class="scrollTop"></span>
	
    <div class="program-listting-section">
        <div class="container">
            <div class="heading text-center">
                <h2>Online Programme Offered</h2>
                <p>Get high-stature degree on completion of your programme.</p>
            </div>
            <ul class="nav nav-pills wow fadeInUp" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-Under-Graduate-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-Under-Graduate" type="button" role="tab"
                        aria-controls="pills-Under-Graduate" aria-selected="true">Under-Graduate Course</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Post-Graduate-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-Post-Graduate" type="button" role="tab"
                        aria-controls="pills-Post-Graduate" aria-selected="false">Post-Graduate Course</button>
                </li>

            </ul>
            <div class="tab-content wow fadeInUp" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-Under-Graduate" role="tabpanel"
                    aria-labelledby="pills-Under-Graduate-tab" tabindex="0">


                    <ul class="program-listing">
                        <li>
                            <div class="program-card">
                                <h3>BBA</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-briefcase"></i></div>
                                    <h4>Bachelor of Business Administration</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 3 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>12th Passed</span>
                                    <span><i class="fa fa-rupee"></i>22,500/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>

                        </li>


                        <li>
                            <div class="program-card">
                                <h3>BCA</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-laptop"></i></div>
                                    <h4>Bachelor of Computer Applications</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 3 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>12th Passed</span>
                                    <span><i class="fa fa-rupee"></i>22,500/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>

                        </li>


                        <li>
                            <div class="program-card">
                                <h3>B.COM</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-calculator"></i></div>
                                    <h4>Bachelor of Commerce</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 3 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>12th Passed</span>
                                    <span><i class="fa fa-rupee"></i>16,500/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-Post-Graduate" role="tabpanel"
                    aria-labelledby="pills-Post-Graduate-tab" tabindex="0">
                    <ul class="program-listing">
                        <li>
                            <div class="program-card">
                                <h3>MBA</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-briefcase"></i></div>
                                    <h4>Master of Business Administration</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 2 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>Graduation</span>
                                    <span><i class="fa fa-rupee"></i>43,750/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>

                        </li>


                        <li>
                            <div class="program-card">
                                <h3>MCA</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-solid fa-desktop"></i></div>
                                    <h4>Master of Computer Applications</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 2 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>Graduation</span>
                                    <span><i class="fa fa-rupee"></i>39,500/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>

                        </li>


                        <li>
                            <div class="program-card">
                                <h3>M.COM</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-calculator"></i></div>
                                    <h4>Master of Commerce</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 2 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>Graduation</span>
                                    <span><i class="fa fa-rupee"></i>27,000/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>

                        </li>

                        <li>
                            <div class="program-card">
                                <h3>MA-JMC</h3>
                                <div class="headprogram">
                                    <div class="iconcard"><i class="fa fa-newspaper-o"></i></div>
                                    <h4>Master of Arts In Journalism & Mass Communication</h4>
                                </div>
                                <div class="course-info">
                                    <span><i class="fa fa-clock-o"></i> 2 Year</span>
                                    <span><i class=" fa fa-graduation-cap"></i>Graduation</span>
                                        <span><i class="fa fa-rupee"></i>35,000/- Semester</span>
                                </div>
                                <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a>
                                </div>
                            </div>

                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
	
    <span id="Approvals" class="scrollTop"></span>
	
    <div class="recognized-approvals-section">
        <div class="container">
            <div class="heading text-center">
                <h2>Approved & Recognized by</h2>
            </div>
            <div class="owl-carousel owl-theme approvals-carousel wow fadeInUp">
                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap1.webp" alt="image">
                    </div>
                </div>
                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap2.webp" alt="image">
                    </div>
                </div>
                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap3.webp" alt="image">
                    </div>
                </div>

                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap4.webp" alt="image">
                    </div>
                </div>
                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap5.webp" alt="image">
                    </div>
                </div>
                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap6.webp" alt="image">
                    </div>
                </div>

                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap7.webp" alt="image">
                    </div>
                </div>
                <div class="item">
                    <div class="recognized-image-card">
                        <img src="images/ap8.webp" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="certificate-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <figure class="wow fadeInUp"><img src="images/grouprecognised-1.webp" alt="image"></figure>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="certificate-content wow fadeInUp">
                        <h2>Earn <strong>Your Degree</strong> Which Enhance Your career</h2>
                        <p>If you’re looking for an online degree without leaving your home, then Manipal university has
                            what you need! The university offers a variety of degrees and made it easy to access them
                            from anywhere and anytime.</p>

                        <ul class="certificate-list ">
                            <li> <span><img src="images/degree-from-top-ranked.webp" alt="image"></span> Degree from Top
                                Ranked University</li>
                            <li> <span><img src="images/programme-degree.webp" alt="image"></span> No Difference From
                                Campus Programme Degree</li>
                            <li> <span><img src="images/universally-accepted.webp" alt="image"></span> Universally
                                Accepted</li>
                        </ul>
                        <div class="applynow-btn"><a href="#" class="btn btn-outline applybtn">Apply Now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <span id="about" class="scrollTop"></span>
	
    <div class="about-section">
        <div class="container">
            <div class="heading text-center">
                <h2><strong>About</strong>- Why Join Manipal University</h2>
            </div>
            <div class="about-content">
                <p>Manipal University Jaipur (MUJ) was launched in 2011 on an invitation from the Government of
                    Rajasthan. The University has redefined academic excellence in the region, with Manipal’s way of
                    learning; one that inspires all students to learn and innovate through practical, hands-on
                    experience. Manipal University Jaipur offers career-oriented courses across different streams.
                    Access UGC-entitled degrees from world-class universities that are NAAC accredited. Pursue online
                    degrees that are at par with conventional on-campus degrees and accepted by governments, corporate
                    organizations, and higher education institutions. In Manipal Univertsity online mba will prepare you
                    to become an effective leader in a modern world that keeps changing.</p>
            </div>

            <ul class="counter-number wow fadeInUp">
                <li>
                    <div class="counter-card">
                        <figure><img src="images/3000-students.webp" alt="image"></figure>
                        <strong>30000+</strong>
                        <p>STUDENTS</p>
                    </div>

                </li>
                <li>
                    <div class="counter-card">
                        <figure><img src="images/50k-alumini1.webp" alt="image"></figure>
                        <strong>50k+</strong>
                        <p>ALUMNI</p>
                    </div>

                </li>
                <li>
                    <div class="counter-card">
                        <figure><img src="images/600-campus-event.webp" alt="image"></figure>
                        <strong>600+</strong>
                        <p>CAMPUS EVENTS</p>
                    </div>

                </li>
                <li>
                    <div class="counter-card">
                        <figure><img src="images/600-profile-visitor.webp" alt="image"></figure>
                        <strong>600+</strong>
                        <p>HIGH PROFILE VISITOR</p>
                    </div>

                </li>

            </ul>


        </div>
    </div>
    <div class="advantage-section">
        <div class="container">
            <div class="heading text-center">
                <h2>The Online Manipal Advantages</h2>
                <p> Here’s what you can expect from our programmes</p>
            </div>
            <ul class="advantage-listing wow fadeInUp">
                <li>
                    <div class="advantage-card">
                        <figure><img src="images/features-1.webp" alt="image"></figure>
                        <strong>Empowered Education</strong>
                        <p>University programs are designed by industry leaders with degrees that are recognized
                            globally and nationally. And give access to the programs anytime and anywhere</p>

                    </div>
                </li>

                <li>
                    <div class="advantage-card">
                        <figure><img src="images/features-2.webp" alt="image"></figure>
                        <strong>Study At Your Place</strong>
                        <p>Manipal’s digital platform makes it easy for students to learn on the go. They can attend
                            live lectures, listen to recordings, and even learn from their mobile devices.</p>

                    </div>
                </li>

                <li>
                    <div class="advantage-card">
                        <figure><img src="images/features-3.webp" alt="image"></figure>
                        <strong>Experienced Faculty</strong>
                        <p>The University work with faculty who have PhD’s and are at the forefront of their field. They
                            will give you real-world, practical advice to boost your confidence and communication.</p>

                    </div>
                </li>

                <li>
                    <div class="advantage-card">
                        <figure><img src="images/features-4.webp" alt="image"></figure>
                        <strong>Digital learning Platform</strong>
                        <p>With this college, students can get access to 1000+ hours of tutorials and can take remotely
                            proctored exams, quizzes, and practice tests, for the opportunity to interact with peers.
                        </p>

                    </div>
                </li>

                <li>
                    <div class="advantage-card">
                        <figure><img src="images/features-5.webp" alt="image"></figure>
                        <strong>24*7 Student Support</strong>
                        <p>Manipal University provides 24*7 student support. And the staff is always available to help
                            students with academic or personal issues.</p>

                    </div>
                </li>

                <li>
                    <div class="advantage-card">
                        <figure><img src="images/features-1.webp" alt="image"></figure>
                        <strong>Expert’s FREE Guidance</strong>
                        <p>Manipal University provides free guidance from experts to help students with their studies.
                            It also has a strong research focus and many facilities for students.</p>

                    </div>
                </li>

            </ul>

        </div>
    </div>

    <div class="Counseling-form">
        <div class="container">
            <div class="Counseling-blocker">
                <div class="row">
                    <div class="col-md-6">
                        <figure class="wow fadeInUp"><img src="images/forrmm.webp" alt="image"></figure>
                    </div>
                    <div class="col-md-6">
                        <div class="inquire-box wow fadeInUp">
                            <h2>Free Counseling</h2>
                            <div class="inquire-form">
                                <form class="servicefrm_footer" name="servicefrm_footer">
									<?php include 'form.php'; ?>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	 
	<?php include 'footer.php'; ?>
	 
    </body>
    
    </html>