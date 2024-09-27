@php
    $courseCategories = CustomHelper::getCourseCategory();
    $courses = CustomHelper::getCoursesWithUniversityCount();
    // pr($courseCategories);die;
@endphp
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="navigation_main">
                <a class="navbar-brand" href="{{ route('home.index') }}">
                    <figure>
                        <img class="img-fluid" src="{{ WEBSITE_IMG_URL }}logo-01.svg" alt="logo">
                    </figure>
                </a>
                <div class="navigation">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item megaMenu">
                            <div class="responsive_nav">
                                <a class="collapsed sub_menu_dropdown active" data-bs-toggle="collapse"
                                    href="#collapseallprograms" role="button" aria-expanded="false"
                                    aria-controls="collapseallprograms">
                                    {{ trans('front_messages.global.explore_all_programs') }} <i class="fa fa-sort-desc"
                                        aria-hidden="true"></i>
                                </a>

                                <!-- WEb Menu -->
                                <div class="collapse submenu-nested collapsed " id="collapseallprograms">
                                    <div class="explore-programm-wrap">
                                        <div class="programm-tab-left">
                                            <h2>Browse By Domain</h2>
                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="tab1" data-bs-toggle="pill"
                                                        data-bs-target="#pills-1" type="button" role="tab"
                                                        aria-controls="pills-1" aria-selected="true">UG Courses
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="tab2" data-bs-toggle="pill"
                                                        data-bs-target="#pills-2" type="button" role="tab"
                                                        aria-controls="pills-2" aria-selected="false" tabindex="-1">PG
                                                        Courses
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link " id="tab3" data-bs-toggle="pill"
                                                        data-bs-target="#pills-3" type="button" role="tab"
                                                        aria-controls="pills-3" aria-selected="false"
                                                        tabindex="-1">Executive Programs
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link " id="tab4" data-bs-toggle="pill"
                                                        data-bs-target="#pills-4" type="button" role="tab"
                                                        aria-controls="pills-4" aria-selected="false"
                                                        tabindex="-1">Certification
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="programm-tab-content">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade active show" id="pills-1" role="tabpanel"
                                                    aria-labelledby="tab1" tabindex="0">
                                                    <div class="mob-tab-view">
                                                        <h2 class="content-box-heading">
                                                            UG Courses
                                                        </h2>
                                                        <div class="FlexnavBar">
                                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active" id="tab1"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#UGCourses-pills-1"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-1" aria-selected="true">BBA
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link" id="tab2"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#UGCourses-pills-2"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-2" aria-selected="false"
                                                                        tabindex="-1">BA
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab3"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#UGCourses-pills-3"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-3" aria-selected="false"
                                                                        tabindex="-1">BAJMC
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab4"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#UGCourses-pills-4"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-4" aria-selected="false"
                                                                        tabindex="-1">BCA
                                                                    </button>
                                                                </li>

                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab4"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#UGCourses-pills-5"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-4" aria-selected="false"
                                                                        tabindex="-1">BCOM
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade show active"
                                                                    id="UGCourses-pills-1" role="tabpanel"
                                                                    aria-labelledby="tab1" tabindex="0">
                                                                    <h2 class="content-box-heading"> Bachelor of
                                                                        Business Administration(BBA)</h2>

                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>


                                                                </div>


                                                                <div class="tab-pane fade" id="UGCourses-pills-2"
                                                                    role="tabpanel" aria-labelledby="tab1"
                                                                    tabindex="0">
                                                                    <h2 class="content-box-heading">Bachelor of
                                                                        Arts(BA)</h2>

                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>
                                                                </div>


                                                                <div class="tab-pane fade" id="UGCourses-pills-3"
                                                                    role="tabpanel" aria-labelledby="tab1"
                                                                    tabindex="0">
                                                                    <h2 class="content-box-heading">Bachelor of Arts -
                                                                        Journalism and Mass Communication (BA-JMC)</h2>

                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="pills-2" role="tabpanel"
                                                    aria-labelledby="tab1" tabindex="0">
                                                    <div class="mob-tab-view">
                                                        <h2 class="content-box-heading">
                                                            PG Courses
                                                        </h2>
                                                        <div class="FlexnavBar">
                                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active" id="tab1"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#PGCourses-pills-1"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-1"
                                                                        aria-selected="true">MBA
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link" id="tab2"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#PGCourses-pills-2"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-2" aria-selected="false"
                                                                        tabindex="-1"> Executive MBA
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab3"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#PGCourses-pills-3"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-3" aria-selected="false"
                                                                        tabindex="-1">MCA
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab4"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#PGCourses-pills-4"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-4" aria-selected="false"
                                                                        tabindex="-1">M.Com
                                                                    </button>
                                                                </li>

                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab4"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#PGCourses-pills-5"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-4" aria-selected="false"
                                                                        tabindex="-1">MA
                                                                    </button>
                                                                </li>

                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link " id="tab5"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#PGCourses-pills-5"
                                                                        type="button" role="tab"
                                                                        aria-controls="pills-5" aria-selected="false"
                                                                        tabindex="-1">MAJMC
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade show active"
                                                                    id="PGCourses-pills-1" role="tabpanel"
                                                                    aria-labelledby="tab1" tabindex="0">

                                                                    <div class="FlexnavBar SubFlexnavBar">
                                                                        <ul class="nav nav-pills" id="pills-tab"
                                                                            role="tablist">
                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link active"
                                                                                    id="tab1"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-1"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-1"
                                                                                    aria-selected="true">Finance
                                                                                </button>
                                                                            </li>
                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link"
                                                                                    id="tab2"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-2"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-2"
                                                                                    aria-selected="false"
                                                                                    tabindex="-1"> HR
                                                                                </button>
                                                                            </li>
                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link "
                                                                                    id="tab3"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-3"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-3"
                                                                                    aria-selected="false"
                                                                                    tabindex="-1">Marketing
                                                                                </button>
                                                                            </li>
                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link "
                                                                                    id="tab4"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-4"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-4"
                                                                                    aria-selected="false"
                                                                                    tabindex="-1">Supply Chain
                                                                                    Management
                                                                                </button>
                                                                            </li>

                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link "
                                                                                    id="tab4"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-5"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-4"
                                                                                    aria-selected="false"
                                                                                    tabindex="-1">Information
                                                                                    Technology
                                                                                </button>
                                                                            </li>

                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link "
                                                                                    id="tab5"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-5"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-5"
                                                                                    aria-selected="false"
                                                                                    tabindex="-1">Business Analytics
                                                                                </button>
                                                                            </li>

                                                                            <li class="nav-item" role="presentation">
                                                                                <button class="nav-link "
                                                                                    id="tab6"
                                                                                    data-bs-toggle="pill"
                                                                                    data-bs-target="#MBACourses-pills-6"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="pills-6"
                                                                                    aria-selected="false"
                                                                                    tabindex="-1">Healthcare
                                                                                    Management
                                                                                </button>
                                                                            </li>
                                                                        </ul>

                                                                        <div class="tab-content">
                                                                            <div class="tab-pane fade show active"
                                                                                id="MBACourses-pills-1"
                                                                                role="tabpanel" aria-labelledby="tab1"
                                                                                tabindex="0">
                                                                                <h2 class="content-box-heading">Finance
                                                                                </h2>
                                                                                <ul
                                                                                    class="content-box content-boxTwoCol">
                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>Amity University
                                                                                                    Online
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 165,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>NMIMS CDOE
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 131,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>Chandigarh University
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 117,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>Manipal University
                                                                                                    Online
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 135,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                </ul>

                                                                            </div>
																			
																			
																			<div class="tab-pane fade"
                                                                                id="MBACourses-pills-2"
                                                                                role="tabpanel" aria-labelledby="tab2"
                                                                                tabindex="0">
                                                                                <h2 class="content-box-heading">HR
                                                                                </h2>
                                                                                <ul
                                                                                    class="content-box content-boxTwoCol">
                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>Amity University
                                                                                                    Online
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 165,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>NMIMS CDOE
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 131,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>Chandigarh University
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 117,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a
                                                                                            href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                            <div
                                                                                                class="course-img-container d-flex align-items-center">
                                                                                                <figure>
                                                                                                    <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                                        class="">
                                                                                                </figure>
                                                                                                <p>Manipal University
                                                                                                    Online
                                                                                                </p>
                                                                                            </div>
                                                                                            <h3
                                                                                                class="certification-text">
                                                                                                MBA
                                                                                            </h3>
                                                                                            <p
                                                                                                class="upload-duraction">
                                                                                                ₹ 135,000.00/-
                                                                                            </p>
                                                                                        </a>
                                                                                    </li>

                                                                                </ul>

                                                                            </div>
																			
																			
																			
																			
																			
																			
                                                                        </div>


                                                                    </div>

                                                                </div>


                                                                <div class="tab-pane fade" id="PGCourses-pills-2"
                                                                    role="tabpanel" aria-labelledby="tab1"
                                                                    tabindex="0">
                                                                    <h2 class="content-box-heading">Executive MBA</h2>

                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>
                                                                </div>


                                                                <div class="tab-pane fade" id="PGCourses-pills-3"
                                                                    role="tabpanel" aria-labelledby="tab1"
                                                                    tabindex="0">
                                                                    <h2 class="content-box-heading">Master of Computer
                                                                        Applications (MCA)</h2>

                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    MBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>




                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="pills-3" role="tabpanel"
                                                    aria-labelledby="tab1" tabindex="0">
                                                    <div class="mob-tab-view">
                                                        <h2 class="content-box-heading">
                                                            Executive Programs
                                                        </h2>

                                                        <ul class="content-box">
                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>Amity University Online
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 165,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>NMIMS CDOE
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 131,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>Chandigarh University
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 117,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>Manipal University Online
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 135,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                        </ul>


                                                    </div>
                                                </div>


                                                <div class="tab-pane fade" id="pills-4" role="tabpanel"
                                                    aria-labelledby="tab1" tabindex="0">
                                                    <div class="mob-tab-view">
                                                        <h2 class="content-box-heading">
                                                            Certification
                                                        </h2>

                                                        <ul class="content-box">
                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>Amity University Online
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 165,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>NMIMS CDOE
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 131,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>Chandigarh University
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 117,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                    <div
                                                                        class="course-img-container d-flex align-items-center">
                                                                        <figure>
                                                                            <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                class="">
                                                                        </figure>
                                                                        <p>Manipal University Online
                                                                        </p>
                                                                    </div>
                                                                    <h3 class="certification-text">
                                                                        MBA
                                                                    </h3>
                                                                    <p class="upload-duraction">
                                                                        ₹ 135,000.00/-
                                                                    </p>
                                                                </a>
                                                            </li>

                                                        </ul>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- WEb Menu -->

                                <!-- Mobile Condition Menu -->
                                <div class="collapse mobileAccordion collapsed" id="collapseallprograms">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    UG Courses
                                                </button>
                                            </h2>
                                            <div id="collapseOne"
                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-0">
                                                    <div class="FlexTopheading">
                                                        <button class="back-btn" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                        </button>
                                                        <h2 class="box-heading">UG Courses</h2>
                                                    </div>
                                                    <div class="accordion Subaccordion" id="Subaccordion">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="SubheadingOne">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#SubcollapseOne"
                                                                    aria-expanded="true"
                                                                    aria-controls="SubcollapseOne">
                                                                    BBA
                                                                </button>
                                                            </h2>
                                                            <div id="SubcollapseOne"
                                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                                aria-labelledby="SubheadingOne"
                                                                data-bs-parent="#Subaccordion">
                                                                <div class="accordion-body programm-tab-content p-0">
                                                                    <div class="FlexTopheading">
                                                                        <button class="back-btn" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#SubcollapseOne"
                                                                            aria-expanded="true"
                                                                            aria-controls="SubcollapseOne">
                                                                        </button>
                                                                        <h2 class="box-heading">BBA</h2>
                                                                    </div>


                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="subheadingTwo">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#SubcollapseTwo"
                                                                    aria-expanded="false"
                                                                    aria-controls="SubcollapseTwo">
                                                                    BA
                                                                </button>
                                                            </h2>
                                                            <div id="SubcollapseTwo"
                                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                                aria-labelledby="subheadingTwo"
                                                                data-bs-parent="#Subaccordion">
                                                                <div class="accordion-body programm-tab-content p-0">
                                                                    <div class="FlexTopheading">
                                                                        <button class="back-btn" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#SubcollapseTwo"
                                                                            aria-expanded="false"
                                                                            aria-controls="SubcollapseTwo">
                                                                        </button>
                                                                        <h2 class="box-heading">BA</h2>
                                                                    </div>

                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="SubheadingThree">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#SubcollapseThree"
                                                                    aria-expanded="false"
                                                                    aria-controls="SubcollapseThree">
                                                                    BAJMC

                                                                </button>
                                                            </h2>
                                                            <div id="SubcollapseThree"
                                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                                aria-labelledby="SubheadingThree"
                                                                data-bs-parent="#Subaccordion">
                                                                <div class="accordion-body programm-tab-content  p-0">

                                                                    <div class="FlexTopheading">
                                                                        <button class="back-btn" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#SubcollapseThree"
                                                                            aria-expanded="false"
                                                                            aria-controls="SubcollapseThree">
                                                                        </button>
                                                                        <h2 class="box-heading">BAJMC</h2>
                                                                    </div>


                                                                    <ul class="content-box content-boxThreeCol">
                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Amity University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 165,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>NMIMS CDOE
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 131,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Chandigarh University
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 117,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a
                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                <div
                                                                                    class="course-img-container d-flex align-items-center">
                                                                                    <figure>
                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                            class="">
                                                                                    </figure>
                                                                                    <p>Manipal University Online
                                                                                    </p>
                                                                                </div>
                                                                                <h3 class="certification-text">
                                                                                    BBA
                                                                                </h3>
                                                                                <p class="upload-duraction">
                                                                                    ₹ 135,000.00/-
                                                                                </p>
                                                                            </a>
                                                                        </li>

                                                                    </ul>




                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    PG Courses
                                                </button>
                                            </h2>
                                            <div id="collapseTwo"
                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-0">
                                                    <div class="FlexTopheading">
                                                        <button class="back-btn" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                        </button>
                                                        <h2 class="box-heading">PG Courses </h2>
                                                    </div>
                                                    <div class="accordion Subaccordion" id="PGSubaccordion">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="PGSubheadingOne">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#PGSubcollapseOne"
                                                                    aria-expanded="true"
                                                                    aria-controls="PGSubcollapseOne">
                                                                    MBA
                                                                </button>
                                                            </h2>
                                                            <div id="PGSubcollapseOne"
                                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                                aria-labelledby="PGSubheadingOne"
                                                                data-bs-parent="#PGSubaccordion">
                                                                <div class="accordion-body programm-tab-content p-0 ">

                                                                    <div class="FlexTopheading">
                                                                        <button class="back-btn" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#PGSubcollapseOne"
                                                                            aria-expanded="true"
                                                                            aria-controls="PGSubcollapseOne">
                                                                        </button>
                                                                        <h2 class="box-heading">MBA</h2>
                                                                    </div>

                                                                    <div class="accordion Subaccordion"
                                                                        id="PGSubaccordion2">
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="MBASubheadingOne">
                                                                                <button
                                                                                    class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#MBASubcollapseOne"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="MBASubcollapseOne">
                                                                                    Finance
                                                                                </button>
                                                                            </h2>
                                                                            <div id="MBASubcollapseOne"
                                                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                                                aria-labelledby="MBASubheadingOne"
                                                                                data-bs-parent="#PGSubaccordion2">
                                                                                <div
                                                                                    class="accordion-body programm-tab-content p-0 ">
                                                                                    <div class="FlexTopheading">
                                                                                        <button class="back-btn"
                                                                                            type="button"
                                                                                            data-bs-toggle="collapse"
                                                                                            data-bs-target="#MBASubcollapseOne"
                                                                                            aria-expanded="true"
                                                                                            aria-controls="MBASubcollapseOne">
                                                                                        </button>

                                                                                        <h2 class="box-heading">Finance
                                                                                        </h2>

                                                                                    </div>
                                                                                    <ul
                                                                                        class="content-box content-boxThreeCol">
                                                                                        <li>
                                                                                            <a
                                                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                                                <div
                                                                                                    class="course-img-container d-flex align-items-center">
                                                                                                    <figure>
                                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                                                            class="">
                                                                                                    </figure>
                                                                                                    <p>Amity University
                                                                                                        Online
                                                                                                    </p>
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="certification-text">
                                                                                                    BBA
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="upload-duraction">
                                                                                                    ₹ 165,000.00/-
                                                                                                </p>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a
                                                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                                                <div
                                                                                                    class="course-img-container d-flex align-items-center">
                                                                                                    <figure>
                                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                                                            class="">
                                                                                                    </figure>
                                                                                                    <p>NMIMS CDOE
                                                                                                    </p>
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="certification-text">
                                                                                                    BBA
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="upload-duraction">
                                                                                                    ₹ 131,000.00/-
                                                                                                </p>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a
                                                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                                                <div
                                                                                                    class="course-img-container d-flex align-items-center">
                                                                                                    <figure>
                                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                                                            class="">
                                                                                                    </figure>
                                                                                                    <p>Chandigarh
                                                                                                        University
                                                                                                    </p>
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="certification-text">
                                                                                                    BBA
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="upload-duraction">
                                                                                                    ₹ 117,000.00/-
                                                                                                </p>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            <a
                                                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                                                <div
                                                                                                    class="course-img-container d-flex align-items-center">
                                                                                                    <figure>
                                                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                                                            class="">
                                                                                                    </figure>
                                                                                                    <p>Manipal
                                                                                                        University
                                                                                                        Online
                                                                                                    </p>
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="certification-text">
                                                                                                    BBA
                                                                                                </h3>
                                                                                                <p
                                                                                                    class="upload-duraction">
                                                                                                    ₹ 135,000.00/-
                                                                                                </p>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
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
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Executive Programs
                                                </button>
                                            </h2>
                                            <div id="collapseThree"
                                                class="accordion-collapse  Subaccordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body programm-tab-content p-0 ">
                                                    <div class="FlexTopheading">
                                                        <button class="back-btn" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="true" aria-controls="collapseThree">
                                                        </button>

                                                        <h2 class="box-heading">
                                                            Executive Programs
                                                        </h2>

                                                    </div>


                                                    <ul class="content-box content-boxThreeCol">
                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>Amity University Online
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 165,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>NMIMS CDOE
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 131,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>Chandigarh University
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 117,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>Manipal University Online
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 135,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                    </ul>




                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
                                                    Certification
                                                </button>
                                            </h2>
                                            <div id="collapseFour"
                                                class="accordion-collapse Subaccordion-collapse collapse"
                                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body programm-tab-content p-0 ">
                                                    <div class="FlexTopheading">
                                                        <button class="back-btn" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                            aria-expanded="true" aria-controls="collapseFour">
                                                        </button>

                                                        <h2 class="box-heading">
                                                            Certification
                                                        </h2>

                                                    </div>


                                                    <ul class="content-box content-boxThreeCol">
                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/amity-university-online/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307316-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>Amity University Online
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 165,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/nmims-online/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307545-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>NMIMS CDOE
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 131,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/chandigarh-university--/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719307407-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>Chandigarh University
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 117,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a
                                                                href="https://collegesathi.com/live/university/manipal-university-online/bba">
                                                                <div
                                                                    class="course-img-container d-flex align-items-center">
                                                                    <figure>
                                                                        <img src="https://collegesathi.com/live/uploads/university/1719320980-university-image.png"
                                                                            class="">
                                                                    </figure>
                                                                    <p>Manipal University Online
                                                                    </p>
                                                                </div>
                                                                <h3 class="certification-text">
                                                                    BBA
                                                                </h3>
                                                                <p class="upload-duraction">
                                                                    ₹ 135,000.00/-
                                                                </p>
                                                            </a>
                                                        </li>

                                                    </ul>




                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Mobile Condition Menu -->

                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('University.listing') }}">
                                {{ trans('front_messages.global.browse_university') }}</a>
                        </li>
                        {{--
                  <li class="nav-item">
                     <a class="nav-link" href="#">Resources</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">More</a>
                  </li>
                  --}}
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('survey.getAssist') }}">{{ trans('front_messages.global.add_survey') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu_icon">
                <div class="top_right_icon">
                    <ul>
                        <li class="search-button">
                            <a href="javascript:void(0);">
                                <img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="">
                            </a>
                        </li>
                        @if (Auth::user())
                            <li class="nav-item">

                                <div class="userDropdownProfile ">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span
                                            class="userName">{{ CustomHelper::getFirstLatterOfFullName(Auth::user()->full_name) }}</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <div class="profile-name">
                                            <strong>{{ Auth::user()->first_name }}</strong>
                                            <p>{{ Auth::user()->email }}</p>
                                        </div>
                                        <div class="logout"><a href="{{ route('User.change_password') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-logout" width="20"
                                                    height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                                                    </path>
                                                    <path d="M9 12h12l-3 -3"></path>
                                                    <path d="M18 15l3 -3"></path>
                                                </svg> {{ trans('front_messages.global.change_password') }}</a>
                                        </div>
                                        <div class="logout"><a href="{{ route('User.logout') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-logout" width="20"
                                                    height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                                                    </path>
                                                    <path d="M9 12h12l-3 -3"></path>
                                                    <path d="M18 15l3 -3"></path>
                                                </svg> {{ trans('front_messages.global.logout') }}</a>
                                        </div>



                                    </div>
                                </div>

                                <!--<div class="dropdown userdropdown">
                        <a class="" href="javascript:void(0);" role="button" id="username" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fa fa-user-o" aria-hidden="true"></i>
                           <span class="login-username">{{ Auth::user()->first_name }}</span>
                        </a>
                        <div class="dropdown-menu username" aria-labelledby="username">
                           <ul>
                              <li><a href="{{ route('User.logout') }}">{{ trans('front_messages.global.logout') }}</a>
                              </li>
                           </ul>
                        </div>
                     </div>-->
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary login-btn" href="{{ route('User.login') }}">
                                    Sign in
                                </a>

                                <!--
      <a class="btn btn-outline-primary" href="{{ route('User.login') }}">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                     </a>
      -->

                            </li>
                        @endif
                    </ul>
                </div>
                <button class="menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </div>
    <form action="{{ route('University.listing') }}">
        <div class="search-dropdown">
            <div class="input_search">
                <input type="search" placeholder="Search" name="search"
                    value="{{ isset($queryString['search']) && !empty($queryString['search']) ? $queryString['search'] : '' }}">
                <button class="btn btn-primary search_btn"><i class="fa fa-search"></i></button>
            </div>
            <a href="javascript:void(0);" class="search-close-btn btn text-decoration-none text-light"><i
                    class="fa fa-times" aria-hidden="true"></i></a>
        </div>
    </form>
</header>
