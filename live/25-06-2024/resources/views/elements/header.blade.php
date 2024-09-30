@php
$courses = CustomHelper::getCoursesWithUniversityCount();
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
                        <a class="collapsed sub_menu_dropdown active" data-bs-toggle="collapse" href="#collapseallprograms" role="button" aria-expanded="false" aria-controls="collapseallprograms">
                           {{ trans('front_messages.global.explore_all_programs') }} <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </a>
                        <div class="collapse submenu-nested collapsed" id="collapseallprograms">
                           <div class="explore-programm-wrap">
                              <div class="programm-tab-left">
                                 <h2>Browse By Domain</h2>
                                 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    @if (!empty($courses->toArray()))
                                    @php $counter = 1; @endphp
                                    @foreach ($courses as $coursesWithUniversityCount)
                                    @if (count($coursesWithUniversityCount->getCoursesDetails) > 0)
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link {{ $counter == 1 ? 'active' : '' }}" id="tab{{ $coursesWithUniversityCount->id }}" data-bs-toggle="pill" data-bs-target="#pills-{{ $coursesWithUniversityCount->id }}" type="button" role="tab" aria-controls="pills-{{ $coursesWithUniversityCount->id }}" aria-selected="{{ $counter == 1 ? 'true' : 'false' }}">{{ CustomHelper::getStringLimit($coursesWithUniversityCount->name, 13) }}
                                          <span>({{ count($coursesWithUniversityCount->getCoursesDetails) }})</span></button>
                                    </li>
                                    @php $counter++; @endphp
                                    @endif
                                    @endforeach
                                    @endif
                                 </ul>
                              </div>
                              <div class="programm-tab-content">
                                 <div class="tab-content" id="pills-tabContent">
                                    @if (!empty($courses->toArray()))
                                    @php $count = 1; @endphp
                                    @foreach ($courses as $coursesWithUniversityCount)
                                    @if (count($coursesWithUniversityCount->getCoursesDetails) > 0)
                                    <div class="tab-pane fade {{ $count == 1 ? 'show active' : '' }}" id="pills-{{ $coursesWithUniversityCount->id }}" role="tabpanel" aria-labelledby="tab{{ $coursesWithUniversityCount->id }}" tabindex="0">
                                       <button class="colss-btn">
                                          {{ $coursesWithUniversityCount->name }}
                                          <span>({{ count($coursesWithUniversityCount->getCoursesDetails) }})</span>
                                       </button>
                                       <div class="mob-tab-view">
                                          <h2 class="content-box-heading">
                                             {{ $coursesWithUniversityCount->name }}
                                             <span>({{ count($coursesWithUniversityCount->getCoursesDetails) }})</span>
                                          </h2>
                                          <ul class="content-box">
                                             @foreach ($coursesWithUniversityCount->getCoursesDetails as $coursesDetails)

                                             <li>
                                                <a href="{{ route('University.universityCourseDetail', [$coursesDetails->getUniversityDetails->slug, $coursesDetails->slug]) }}">
                                                   <div class="course-img-container d-flex align-items-center">
                                                      <figure>
                                                         <?php
                                                         echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $coursesDetails->getUniversityDetails->image, '', ['alt' => $coursesDetails->getUniversityDetails->image, 'height' => '38', 'width' => '101', 'zc' => 2]);
                                                         ?>
                                                      </figure>
                                                      <p>{{ $coursesDetails->getUniversityDetails->title }}
                                                      </p>
                                                   </div>
                                                   <h3 class="certification-text">
                                                      {{ $coursesDetails->name }}
                                                   </h3>
                                                   <p class="upload-duraction">
                                                      {{ CustomHelper::displayPrice($coursesDetails->total_fee) }}
                                                   </p>
                                                </a>
                                             </li>
                                             @endforeach
                                          </ul>
                                       </div>
                                    </div>
                                    @php $count++; @endphp
                                    @endif
                                    @endforeach
                                    @endif
                                 </div>
                              </div>
                           </div>
                           <!-- <ul class="dropdown_menu">
                              <li><a href="javascript:void(0);">Browse Universities</a></li>
                              <li><a href="javascript:void(0);"> Download Brochure</a></li>
                              <li><a href="javascript:void(0);">Top Universities</a></li>
                              </ul> -->
                        </div>
                     </div>
                  </li>
                  <li class="nav-item ">
                     <a class="nav-link" href="{{ route('University.listing') }}"> {{ trans('front_messages.global.browse_university') }}</a>
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
                     <a class="nav-link" href="{{ route('survey.getAssist') }}">{{ trans('front_messages.global.add_survey') }}</a>
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
                           <div class="logout"><a href="{{ route('User.change_password') }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M9 12h12l-3 -3"></path>
                                    <path d="M18 15l3 -3"></path>
                                 </svg> {{ trans('front_messages.global.change_password') }}</a>
                           </div>
                           <div class="logout"><a href="{{ route('User.logout') }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
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
            <input type="search" placeholder="Search" name="search" value="{{ isset($queryString['search']) && !empty($queryString['search']) ? $queryString['search'] : '' }}">
            <button class="btn btn-primary search_btn"><i class="fa fa-search"></i></button>
         </div>
         <a href="javascript:void(0);" class="search-close-btn btn text-decoration-none text-light"><i class="fa fa-times" aria-hidden="true"></i></a>
      </div>
   </form>
</header>