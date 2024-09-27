@php
$courseCategories = CustomHelper::getCourseCategory();
@endphp
<header>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-transparent">
      <div class="navigation_main">
        <a class="navbar-brand" href="{{ route('home.index') }}">
          <figure>
            <img class="img-fluid" src="{{ WEBSITE_IMG_URL }}COLLEGESATHI-8-years.svg" alt="logo">
          </figure>
        </a>
        <div class="search-button" id="srch-btn">
              <a href="javascript:void(0);">
                <img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="">
              </a>
</div>
        <div class="navigation">
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
                                          <button class="nav-link  {{ ($counter == 1) ? 'active' : '' }}" id="tab_course_key_<?php echo $course->id; ?>" data-bs-toggle="pill" data-bs-target="#PGCourses-pills-{{$courseKey}}-<?php echo $course->id; ?>" type="button" role="tab" aria-controls="pills-<?php echo $course->id; ?>" aria-selected="{{ ($counter == 1) ? 'true' : 'false' }}"><?php echo $course->name; ?>
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
                                        <div class="tab-pane fade{{ ($count == 1) ? ' show active' : '' }}" id="PGCourses-pills-{{$courseKey}}-<?php echo $course->id; ?>" role="tabpanel" aria-labelledby="tab_course_id_<?php echo $course->id; ?>" tabindex="0">

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
            <li class="nav-item">
              <a class="nav-link" href="{{ route('survey.getAssist') }}">{{ trans('front_messages.global.free_counselling') }}</a>
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
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="userName">{{ CustomHelper::getFirstLatterOfFullName(Auth::user()->full_name) }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <div class="profile-name">
                    <strong>{{ Auth::user()->first_name }}</strong>
                    <p>{{ Auth::user()->email }}</p>
                  </div>
                  <div class="logout">
                    <a href="{{ route('User.change_password') }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                        </path>
                        <path d="M9 12h12l-3 -3"></path>
                        <path d="M18 15l3 -3"></path>
                      </svg>
                      {{ trans('front_messages.global.change_password') }}
                    </a>
                  </div>
                  <div class="logout">
                    <a href="{{ route('User.logout') }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                        </path>
                        <path d="M9 12h12l-3 -3"></path>
                        <path d="M18 15l3 -3"></path>
                      </svg>
                      {{ trans('front_messages.global.logout') }}
                    </a>
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
        <input type="search" placeholder="Search" name="search" value="{{ isset($queryString['search']) && !empty($queryString['search']) ? $queryString['search'] : '' }}">
        <button class="btn btn-primary search_btn"><i class="fa fa-search"></i></button>
      </div>
      <a href="javascript:void(0);" class="search-close-btn btn text-decoration-none text-light"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
  </form>
</header>
<style>
 #srch-btn {
    display: none; /* Hide by default */
}

@media (max-width: 767px) {
    #srch-btn {
        display: block; /* Show on mobile devices (up to 767px wide) */
    }
}
</style>