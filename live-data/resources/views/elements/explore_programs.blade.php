
<?php
$courseCategoryDropdown = CustomHelper::getConfigValue('COURSE_CATEGORY_TYPE_DROPDOWN');
$featuredCourses = CustomHelper::getFeaturedCourses();
$courseCategoryArray = [];

if (!empty($featuredCourses)) {
    foreach ($featuredCourses as $featuredCourse) {
        if (!empty($featuredCourse->getUniversityDetails)) {
            $courseCategoryArray[$featuredCourse->course_category][] = $featuredCourse;
        }
    }
}
?>
@if(!empty($courseCategoryArray))
<section class="top-programs my-3">
    <div class="container">
        <!-- Header -->
        <div class="program-header text-center mx-auto">
            <h2>Explore Top-Ranked Programs</h2>
            <p>Discover the best Master's and Bachelor's degrees from leading universities. Choose a program that matches your goals and elevates your career potential.</p>
        </div>
        <!-- Header / -->

        <!-- Body -->
        <div class="body mt-4">
            <ul class="nav justify-content-between nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($courseCategoryDropdown as $key => $courseCategory)
                <?php
                $course_spec= 'After Graduation';
   if($courseCategory== 'UG Courses'){
    $course_spec= 'After 12th';
   } elseif($courseCategory== 'Executive Programs'){
    $course_spec= 'Working Professionals';
   } elseif($courseCategory== 'Certification'){
    $course_spec= 'Get Certified';
   } ?>
                <li class="nav-item" role="presentation" style="
    border-radius: 7px;
    border: 2px solid #ff0000;
">
        <button class="nav-link {{ ($key == 0) ? 'active' : '' }}" id="pills-{{ strtolower(str_replace(' ', '-', $courseCategory)) }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ strtolower(str_replace(' ', '-', $courseCategory)) }}" type="button" role="tab" aria-controls="pills-{{ strtolower(str_replace(' ', '-', $courseCategory)) }}" aria-selected="{{ ($key == 0) ? 'true' : 'false' }}">
            <p class="mb-0">{{ $courseCategory }}</p>
            <span class="badge">{{ $course_spec }}</span>
        </button>
    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="pills-tabContent" style="
    margin-top: -12px;
">
                @foreach($courseCategoryDropdown as $key => $courseCategory)
                <?php 
                $course_dur= '2 years';
                if($courseCategory== 'UG Courses'){
                 $course_dur= '3 years';
                } elseif($courseCategory== 'Executive Programs'){
                 $course_dur= '3-24 months';
                } elseif($courseCategory== 'Certification'){
                 $course_dur= '3-12 months';
                }
                // Get the courses for the current category
                $courseArray = ($courseCategoryArray[$key]) ?? []; 

                // Remove duplicate courses based on course name
                $uniqueCourses = [];
                foreach($courseArray as $course) {
                    if (!in_array($course->name, array_column($uniqueCourses, 'name'))) {
                        $uniqueCourses[] = $course;
                    }
                }
                ?>
                <div class="tab-pane fade {{ ($key == 0) ? 'show active' : '' }}" id="pills-{{ strtolower(str_replace(' ', '-', $courseCategory)) }}" role="tabpanel" aria-labelledby="pills-{{ strtolower(str_replace(' ', '-', $courseCategory)) }}-tab" tabindex="0">
                    <div class="pg-courses-tab inner-tab-content my-5 py-4 px-5">
                        <div class="pg-cards-list d-flex flex-wrap" style="margin-bottom: -43px;">

                            @foreach ($uniqueCourses as $index => $course)
                            <div class="pg-card position-relative mb-5 {{ ($index >= 4) ? 'view-more' : '' }}">
                                <div class="c-header pb-4 mb-2 position-relative">
                                    <small class="badge c-badge position-absolute">{{ $course_dur }}</small>
                                </div>
                                <div class="c-body text-center">
                                    <img src="./assets/man.png" alt="">
                                    <!-- <b class="d-block mt-2">{{ $course->name ?? 'Course Name' }}</b> -->
                                    <p class="d-block mt-2">Online {{ $course->name ?? 'Course Name' }}</p>
                                </div>
                                <div class="c-footer pb-2">
                                    <a href="{{ route('formPage') }}" class="nav-link">View Program</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                          <!-- "View All" Button -->
                          @if (count($uniqueCourses) > 4)
                        <div class="text-center mt-3 view-all-wrapper d-md-none">
                            <button class="btn btn-primary view-all-btn">View All</button>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Body -->
    </div>
</section>
@endif


<style>
    .c-body p {
    display: inline-block;
    width: 100%; /* Or a specific width */
    white-space: nowrap; /* Prevent the text from wrapping */
    overflow: hidden; /* Hide the overflowed text */
    text-overflow: ellipsis; /* Show the ellipsis (...) for overflowing text */
}
/* Scoped CSS */
.top-programs .program-header {
    max-width: 786px;
}

.top-programs .nav-pills {
    max-width: 681px;
    margin-left: auto;
    margin-right: auto;
}

.top-programs .pg-cards-list .pg-card {
    width: 100%;
    max-width: calc(100% / 7 - 10px);
    /* Visible 7 cards on large desktop screens */
    margin-right: 10px;
    height: 119px;
    gap: 0px;
    border-radius: 8px;
}

/* Responsive for screens below 1200px */
@media (max-width: 1199px) {
    .top-programs .pg-cards-list .pg-card {
        max-width: calc(100% / 5 - 10px);
        /* Visible 5 cards */
    }
}

/* Responsive for screens below 992px */
@media (max-width: 991px) {
    .top-programs .pg-cards-list .pg-card {
        max-width: calc(100% / 4 - 10px);
        /* Visible 4 cards */
    }
}

/* Responsive for screens below 768px */
@media (max-width: 767px) {
    .top-programs .pg-cards-list .pg-card {
        max-width: calc(100% / 3 - 10px);
        /* Visible 3 cards on tablet */
    }
}

/* Responsive for screens below 500px */
@media (max-width: 540px) {

    .top-programs .nav-pills {
        flex-direction: row !important;
        justify-content: inherit;
        flex-wrap: nowrap !important;
        /* margin-left: 49px; */
    }

    .top-programs .nav-pills .nav-link {
        /* padding: 0 !important; */
        margin: 0 !important;
        text-align: center !important;
        /* background: none !important; */
    }

    .top-programs .nav-pills .nav-link.active p {
        font-weight: 700 !important;
        /* color: #EC1E24 !important; */
        border-bottom: 1px solid #EC1E24;

    }

    .top-programs .nav-pills .nav-link p {
        font-size: 10px !important;
    }

    .top-programs .nav-pills .nav-link span {
        display: none ;
    }
    .top-programs .pg-cards-list .pg-card {
        max-width: calc(100% / 2 - 10px);
        /* Visible 2 cards on small mobile */
    }

    .top-programs .pg-courses-tab {
        margin-top: 1.33rem !important;
    }
}

.top-programs .view-more {
    display: none;
}

@media(max-width: 540px) {

    .top-programs .btn {
    font-size: 14.33px !important;
    /* width: 100%; */
    padding-top: 10px;
    padding-bottom: 10px;
}
}

/* Show all cards on larger screens */
@media (min-width: 768px) {
    .top-programs .view-more {
        display: block;
    }
}

@media (min-width: 768px) {
    .top-programs .view-all-wrapper {
        display: none;
    }
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      
        const defaultTab =  'pills-pg-courses';
        const defaultButton = document.getElementById(defaultTab + '-tab');

        if (defaultButton) {
            defaultButton.classList.add('active');
            defaultButton.setAttribute('aria-selected', 'true');
            const targetTab = document.querySelector(defaultButton.getAttribute('data-bs-target'));
            if (targetTab) {
                targetTab.classList.add('show', 'active'); // This makes the tab content visible
            }
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewAllButtons = document.querySelectorAll('.view-all-btn');

    viewAllButtons.forEach(button => {
        button.addEventListener('click', function () {
            const cardContainer = this.closest('.pg-courses-tab');
            const hiddenCards = cardContainer.querySelectorAll('.view-more');
            
            hiddenCards.forEach(card => {
                card.style.display = 'block';
            });

            this.style.display = 'none';
        });
    });
});
</script>