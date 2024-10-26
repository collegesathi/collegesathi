@php
$courseCategories = CustomHelper::getCourseCategory();
@endphp

<header>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-transparent">
      <div class="navigation_main hdrr">
        <a class="navbar-brand" href="{{ route('home.index') }}">
          <figure>
            <img class="img-fluid" src="{{ WEBSITE_IMG_URL }}COLLEGESATHI-8-years.svg" alt="logo">
          </figure>
        </a>
        <div id="srch-btn" style="
    margin-right: -22px;
">
<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchpopup">
            <span class="cursor-pointer fs-14 rounded px-2 py-2 textprimary" style="margin-right: -34px;font-size: 10px;margin-left: -17px;background-color: red;color: #fff;text-wrap: nowrap;">Search <span class="textprimary">|</span> <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" font-size="14" class="textprimary" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg></span>
                      </a>
</div>

        <!-- <div id="srch-btn">
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchpopup">
                <img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="">
              </a>
</div> -->
        <div class="navigation" style="
    margin-right: 103px;
">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item megaMenu">
              <div class="responsive_nav">
                <a class="collapsed sub_menu_dropdown active" data-bs-toggle="collapse" href="#collapseallprograms" role="button" aria-expanded="false" aria-controls="collapseallprograms">
                  {{ trans('front_messages.global.explore_all_programs') }} <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </a>




                <!-- WEb Menu -->
                <div class="collapse submenu-nested collapsed " id="collapseallprograms">
                  <div class="explore-programm-wrap">
                    <div class="programm-tab-left">
                      <h2>Browse By Domain</h2>
                      <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        @if (!empty($courseCategories))
                        @foreach ($courseCategories as $courseKey => $courseValue)
                        <li class="nav-item" role="presentation">
                          <button class="nav-link {{$courseKey == 1 ? 'active' : ''}}" id="tab{{$courseKey}}" data-bs-toggle="pill" data-bs-target="#pills-{{$courseKey}}" type="button" role="tab" aria-controls="pills-{{$courseKey}}" aria-selected="true">{{$courseValue}}
                          </button>
                        </li>
                        @endforeach
                        @endif
                      </ul>
                    </div>
                    <div class="programm-tab-content">
                      <div class="tab-content" id="pills-tabContent">

                        <?php
                        if (!empty($courseCategories)) {
                          foreach ($courseCategories as $courseKey => $courseValue) {
                            $allCourses  =  CustomHelper::getCoursesWithSpecifications($courseKey);

                            if (!empty($allCourses)) {
                        ?>
                              <div class="tab-pane fade{{$courseKey == 1 ? ' active show' : ''}}" id="pills-{{$courseKey}}" role="tabpanel" aria-labelledby="tab_course_key_{{$courseKey}}" tabindex="0">
                                <div class="mob-tab-view">
                                  <h2 class="content-box-heading">
                                    {{$courseValue}}
                                  </h2>
                                  <div class="FlexnavBar">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                      <?php
                                      $counter = 1;
                                      foreach ($allCourses as $course) { ?>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link  {{ ($counter == 6) ? 'active' : '' }}" id="tab_course_key_<?php echo $course->id; ?>" data-bs-toggle="pill" data-bs-target="#PGCourses-pills-{{$courseKey}}-<?php echo $course->id; ?>" type="button" role="tab" aria-controls="pills-<?php echo $course->id; ?>" aria-selected="{{ ($counter == 6) ? 'true' : 'false' }}"><?php echo $course->name; ?>
                                          </button>
                                        </li>
                                      <?php
                                        $counter++;
                                      } ?>
                                    </ul>
                                    <div class="tab-content">

                                      <?php
                                      $count = 1;
                                      foreach ($allCourses as $course) { ?>
                                        <div class="tab-pane fade{{ ($count == 6) ? ' show active' : '' }}" id="PGCourses-pills-{{$courseKey}}-<?php echo $course->id; ?>" role="tabpanel" aria-labelledby="tab_course_id_<?php echo $course->id; ?>" tabindex="0">

                                          <?php if (!empty($course->universityCourses) && ($course->coursesSpecifications->isEmpty())) { ?>
                                            <ul class="content-box content-boxTwoCol">
                                              <?php foreach ($course->universityCourses as $universityCourse) { ?>
                                                <li>
                                                  <a href="{{ route('University.universityCourseDetail', [$universityCourse->university_slug,$universityCourse->course_slug]) }}">
                                                    <div class="course-img-container d-flex align-items-center">
                                                      @if (isset($universityCourse->university->image) && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $universityCourse->university->image))
                                                      <figure>
                                                        <img src="{{ UNIVERSITY_IMAGE_URL }}{{ $universityCourse->university->image }}" class="">
                                                      </figure>
                                                      @endif
                                                      <p>{{ $universityCourse->university->title ?? "" }}</p>
                                                    </div>
                                                    <h3 class="certification-text"> {{ $universityCourse->name }} </h3>
                                                    <p class="upload-duraction"> {{ CustomHelper::displayPrice($universityCourse->total_fee) }} </p>
                                                  </a>
                                                </li>
                                              <?php
                                              } ?>
                                            </ul>
                                          <?php
                                          } ?>

                                          <?php if (!($course->coursesSpecifications->isEmpty())) { ?>
                                            <div class="FlexnavBar SubFlexnavBar">
                                              <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <?php
                                                $cs = 1;
                                                foreach ($course->coursesSpecifications as $coursesSpecification) { ?>
                                                  <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ ($cs == 1) ? 'active' : '' }}" id="tab_coursesp_id_<?php echo $coursesSpecification->id; ?>" data-bs-toggle="pill" data-bs-target="#MBACourses-pills-<?php echo $coursesSpecification->id; ?>" type="button" role="tab" aria-controls="pills-<?php echo $coursesSpecification->id; ?>" aria-selected="{{ ($cs == 1) ? 'true' : 'false' }}"><?php echo $coursesSpecification->name; ?>
                                                    </button>
                                                  </li>
                                                <?php
                                                  $cs++;
                                                } ?>
                                              </ul>


                                              <div class="tab-content">
                                                <?php
                                                $cs_1 = 1;
                                                foreach ($course->coursesSpecifications as $coursesSpecification) { ?>
                                                  <div class="tab-pane fade{{ ($cs_1 == 1) ? ' show active' : '' }}" id="MBACourses-pills-<?php echo $coursesSpecification->id; ?>" role="tabpanel" aria-labelledby="tab_coursesp_id_<?php echo $coursesSpecification->id; ?>" tabindex="0">
                                                    <h2 class="content-box-heading"><?php echo $coursesSpecification->name; ?> </h2>

                                                    <?php if (!empty($coursesSpecification->specificCourse)) { ?>
                                                      <ul class="content-box content-boxTwoCol">
                                                        <?php foreach ($coursesSpecification->specificCourse as $specificCrs) { ?>
                                                          <li>
                                                            <a href="{{ route('University.universityCourseSpecificationDetail', [$specificCrs->university_slug,$specificCrs->course_slug,$specificCrs->slug]) }}">
                                                              <div class="course-img-container d-flex align-items-center">
                                                                @if (isset($specificCrs->university->image) && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $specificCrs->university->image))
                                                                <figure>
                                                                  <img src="{{ UNIVERSITY_IMAGE_URL }}{{ $specificCrs->university->image }}" class="">
                                                                </figure>
                                                                @endif
                                                                <p>{{ $specificCrs->university->title ?? "" }}</p>
                                                              </div>
                                                              <h3 class="certification-text"> {{ $specificCrs->name }} </h3>
                                                              <p class="upload-duraction"> {{ CustomHelper::displayPrice($specificCrs->total_fee) }} </p>
                                                            </a>
                                                          </li>
                                                        <?php
                                                        } ?>
                                                      </ul>
                                                    <?php
                                                    } ?>

                                                  </div>
                                                <?php
                                                  $cs_1++;
                                                } ?>
                                              </div>
                                            </div>
                                          <?php
                                          } ?>

                                        </div>
                                      <?php
                                        $count++;
                                      } ?>
                                    </div>
                                  </div>

                                </div>
                              </div>
                        <?php
                            }
                          }
                        }
                        ?>



                      </div>
                    </div>

                  </div>

                </div>
                <!-- WEb Menu -->










                <!-- Mobile Condition Menu -->
                <div class="collapse mobileAccordion collapsed" id="collapseallprograms">
                  <div class="accordion" id="accordionExample">
                    @if (!empty($courseCategories))
                    @foreach ($courseCategories as $courseKey => $courseValue)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$courseKey}}" aria-expanded="false" aria-controls="collapse{{$courseKey}}">
                          {{$courseValue}}
                        </button>
                      </h2>
                      <div id="collapse{{$courseKey}}" class="accordion-collapse Subaccordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                          <div class="FlexTopheading">
                            <button class="back-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$courseKey}}" aria-expanded="false" aria-controls="collapse{{$courseKey}}">
                            </button>
                            <h2 class="box-heading">{{$courseValue}}</h2>
                          </div>
                          @php
                          $allCourses = CustomHelper::getCoursesWithSpecifications($courseKey);
                          @endphp
                          <div class="accordion Subaccordion" id="PGSubaccordion">
                            @if ($allCourses->isNotEmpty())
                            @foreach ($allCourses as $courseKey => $courseValue)
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="PGSubheadingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PGSubcollapse{{$courseKey}}" aria-expanded="true" aria-controls="PGSubcollapse{{$courseKey}}">
                                  {{$courseValue->name}}
                                </button>
                              </h2>
                              <div id="PGSubcollapse{{$courseKey}}" class="accordion-collapse Subaccordion-collapse collapse" aria-labelledby="PGSubheadingOne" data-bs-parent="#PGSubaccordion">
                                <div class="accordion-body programm-tab-content p-0 ">
                                  <div class="FlexTopheading">
                                    <button class="back-btn" type="button" data-bs-toggle="collapse" data-bs-target="#PGSubcollapse{{$courseKey}}" aria-expanded="true" aria-controls="PGSubcollapse{{$courseKey}}">
                                    </button>
                                    <h2 class="box-heading">{{$courseValue->name}}</h2>
                                  </div>

                                  @if ($courseValue->universityCourses->isNotEmpty() && $courseValue->coursesSpecifications->isEmpty())
                                  <ul class="content-box content-boxThreeCol">
                                    @foreach ($courseValue->universityCourses as $uniCourseValue)
                                    <li>
                                      <a href="{{ route('University.universityCourseDetail',[$uniCourseValue->university_slug,$uniCourseValue->course_slug]) }}">
                                        <div class="course-img-container d-flex align-items-center">
                                          @if (isset($uniCourseValue->university->image) && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $uniCourseValue->university->image))
                                          <figure>
                                            <img src="{{ UNIVERSITY_IMAGE_URL . $uniCourseValue->university->image }}" class="">
                                          </figure>
                                          @endif
                                          <p>{{$uniCourseValue->university->title ?? ""}}
                                          </p>
                                        </div>
                                        <h3 class="certification-text">
                                          {{$uniCourseValue->name}}
                                        </h3>
                                        <p class="upload-duraction">
                                          {{CustomHelper::displayPrice($uniCourseValue->total_fee)}}
                                        </p>
                                      </a>
                                    </li>
                                    @endforeach
                                  </ul>
                                  @endif


                                  @if ($courseValue->coursesSpecifications->isNotEmpty())
                                  <div class="accordion Subaccordion" id="PGSubaccordion2">
                                    @foreach ($courseValue->coursesSpecifications as $specificationKey => $specificationValue)
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="MBASubheadingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#MBASubcollapse{{$specificationKey}}" aria-expanded="true" aria-controls="MBASubcollapse{{$specificationKey}}">
                                          {{$specificationValue->name}}
                                        </button>
                                      </h2>
                                      <div id="MBASubcollapse{{$specificationKey}}" class="accordion-collapse Subaccordion-collapse collapse" aria-labelledby="MBASubheadingOne" data-bs-parent="#PGSubaccordion2">
                                        <div class="accordion-body programm-tab-content p-0 ">
                                          <div class="FlexTopheading">
                                            <button class="back-btn" type="button" data-bs-toggle="collapse" data-bs-target="#MBASubcollapse{{$specificationKey}}" aria-expanded="true" aria-controls="MBASubcollapse{{$specificationKey}}">
                                            </button>
                                            <h2 class="box-heading">{{$specificationValue->name}}
                                            </h2>
                                          </div>
                                          <ul class="content-box content-boxThreeCol">
                                            @if ($specificationValue->specificCourse->isNotEmpty())
                                            @foreach ($specificationValue->specificCourse as $specificCourse)
                                            <li>
                                              <a href="{{ route('University.universityCourseSpecificationDetail',[$specificCourse->university_slug,$specificCourse->course_slug,$specificCourse->slug]) }}">
                                                <div class="course-img-container d-flex align-items-center">
                                                  @if (isset($specificCourse->university->image) && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $specificCourse->university->image))
                                                  <figure>
                                                    <img src="{{ UNIVERSITY_IMAGE_URL . $specificCourse->university->image }}" class="">
                                                  </figure>
                                                  @endif
                                                  <p>{{$specificCourse->university->title ?? ""}}
                                                  </p>
                                                </div>
                                                <h3 class="certification-text">
                                                  {{$specificCourse->name}}
                                                </h3>
                                                <p class="upload-duraction">
                                                  {{CustomHelper::displayPrice($specificCourse->total_fee)}}
                                                </p>
                                              </a>
                                            </li>
                                            @endforeach
                                            @endif
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    @endforeach
                                  </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                            @endforeach
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @endif
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
            <li class="nav-item button-hdr">
            <a href="{{ route('survey.getAssist') }}" class="hdr ai-powered">
            <!-- <span class="badge">⚡AI-Powered</span> -->
            <span class="tips">✅ Expert Advice</span>
            <span style="
    position: absolute;
    top: -16px;
    left: 72px;
    background-color: #f2f2f2;
    border: 2px solid #ff0000;
    border-radius: 50%;
    padding: 5px;
    color: red;
    font-size: 20px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  ">
    🎓
  </span>
            </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="menu_icon">
        <div class="top_right_icon">
          <ul>          
            
          <li class="nav-item" style="margin-right: -67px;/* position: relative; */">
  <div style="
    border: 2px solid #ff0000;
    border-radius: 5px;
    color: red;
    font-size: 15px;
    font-weight: bold;
    text-align: center;
    width: 160px;
    background-color: #f2f2f2;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    position: relative;
    padding: 10px;
  ">
    <span style="color: #000000c7;">9785-800-008</span>
  </div>

  <!-- Icon placed on the border line -->
  <span style="
    position: absolute;
    top: -16px;
    left: 72px;
    background-color: #f2f2f2;
    border: 2px solid #ff0000;
    border-radius: 50%;
    padding: 5px;
    color: red;
    font-size: 20px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  ">
    ☎️
  </span>
</li>
<li id="searchButton" style="
    margin-right: -3px;
">
<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchpopup">
            <span class="cursor-pointer fs-14 rounded px-2 py-2 textprimary" style="margin-left: 61px; background-color: #EC1C24; color: #fff; text-wrap: nowrap;">Search <span class="textprimary">|</span> <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" font-size="14" class="textprimary" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg></span>
                      </a>
            </li>
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
        <input type="search" placeholder="Search" name="search" value="{{ isset($queryString['search']) && !empty($queryString['search']) ? $queryString['search'] : '' }}">
        <button class="btn btn-primary search_btn"><i class="fa fa-search"></i></button>
      </div>
      <a href="javascript:void(0);" class="search-close-btn btn text-decoration-none text-light"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
  </form>

  <!-- Modal -->
  <div class="modal fade fade-flip search-popup" id="searchpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchpopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg_gray">
                <form action="{{ route('University.listing') }}">
                    <div class="search-section-start">
                        <a class="navbar-brand" href="{{ route('home.index') }}">
                            <figure>
                                <img class="img-fluid" src="/images/COLLEGESATHI-8-years.svg" alt="logo">
                            </figure>
                        </a>
                        <div class="search-bar d-flex align-items-center">
                            <button class="search-icon"><img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="img"></button>
                            <input type="text" id="searchInput" name="search" placeholder="Search for Best Universities, Courses & more..." value="{{ isset($queryString['search']) && !empty($queryString['search']) ? $queryString['search'] : '' }}">
                            <!-- Microphone icon for voice search -->
                            <button type="button" id="voiceSearchBtn" style="background: none; border: none; cursor: pointer; margin-left: 5px;">
                                <img src="/images/mic.svg" alt="Voice Search" width="25">
                            </button>
                        </div>
                        <div class="trending-search-box text-center mt-4">
                            <h3 class="mb-4">Trending Searches
                              <span>👇</span>
                            </h3>
                            <ul class="trending-list d-flex flex-wrap align-items-center justify-content-center mb-0 p-0">
                            <li><a href="https://www.collegesathi.com/universities?search=online+mba">Online MBA</a></li>
                  <li><a href="https://www.collegesathi.com/universities?search=executive+mba">Online Executive
                      MBA</a></li>
                  <li><a href="https://www.collegesathi.com/universities?search=ma">Online MA</a></li>
                  <li><a href="https://www.collegesathi.com/universities?search=bba">Online BBA</a></li>
                  <li><a href="https://www.collegesathi.com/universities?search=mca">Online MCA</a></li>
                  <li><a href="https://www.collegesathi.com/universities?search=m.com">Online M.Com</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</header>
<body>
    <div id="app">
        <!-- Add your Vue component here -->
        <example-component></example-component>
    </div>
</body>
<style>
  .button-hdr {
            display: flex;
            gap: 10px;
        }
        .hdr {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        /* .ai-powered {
          background-color: #008000a8;
            color: #000;
            border: 3px solid #ff0051;
        }
       
        span.tips {       
    font-size: 17px;
    font-family: sans-serif;
} */
.ai-powered {
    background-color: #0080007d;
    color: #000;
    position: relative;
    padding: 20px;
    display: inline-block;
    /* border-radius: 5px; */
    border: 2px solid transparent; /* Transparent border for gradient effect */
    background: linear-gradient(90deg, transparent, transparent) padding-box, /* Inner box */
                linear-gradient(90deg, white, lightgrey) border-box; /* Rotating blue border */
    box-shadow: 0 0 10px 5px rgba(255, 255, 255, 0.5); /* White shadow around the box */
    animation: rotate-border 3s linear infinite; /* Animate the gradient movement */
}

/* Animation for rotating the gradient border */
@keyframes rotate-border {
    0% {
        background-position: 0%;
    }
    100% {
        background-position: 100%;
    }
}

/* Blink text keyframes (unchanged) */
span.tips {
    color: white; 
    font-size: 17px;
    font-family: sans-serif;
    animation: blink-text 1s infinite; /* Animation for blinking text */
    position: relative;
    z-index: 2; /* Ensure the text is above everything */
}

@keyframes blink-text {
    0% {
        color: black;
    }
    50% {
        color: darkblue; /* Change the text color for the blink effect */
    }
    100% {
        color: black;
    }
}

 #srch-btn {
    display: none; /* Hide by default */
}

@media (max-width: 767px) {
    #srch-btn {
        display: block; /* Show on mobile devices (up to 767px wide) */
    }
}

.search-bar {
    position: relative;
    width: 100%;
}

#voiceSearchBtn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

</style>
<script>
  // Voice search function using Web Speech API
function startVoiceRecognition() {
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US'; // Set the language for recognition

    recognition.onstart = function() {
        console.log('Voice recognition started...');
    };

    recognition.onspeechend = function() {
        recognition.stop();
        console.log('Voice recognition ended.');
    };

    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript;
     

        // Insert the recognized voice input into the search box
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.value = transcript;
        }
    };

    recognition.onerror = function(event) {
        console.error('Error in recognition:', event.error);
    };

    recognition.start();
}

// Attach event listener to the voice search button
document.getElementById('voiceSearchBtn').addEventListener('click', () => {
    startVoiceRecognition();
});


$('#searchButton').on('click', function() {
    $('#searchModal').modal('hide');  // Hide the modal
    $('.modal-backdrop').remove();    // Remove the backdrop
});
$('#srch-btn').on('click', function() {
    $('#searchModal').modal('hide');  // Hide the modal
    $('.modal-backdrop').remove();    // Remove the backdrop
});

// Array of placeholder texts
const placeholderTexts = [
        'Search for Best Universities',
        'Search for Best Courses',
        'Search for Specializations',
        'Search for Online Programs'
    ];

    let currentIndex = 0;
  function changePlaceholder() {
    const searchInput = document.getElementById('searchInput');
    searchInput.placeholder = placeholderTexts[currentIndex];
    currentIndex = (currentIndex + 1) % placeholderTexts.length;
  }
  setInterval(changePlaceholder, 2000);
</script>

