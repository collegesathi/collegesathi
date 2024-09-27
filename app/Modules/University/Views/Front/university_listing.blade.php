@extends('layouts.default')
@section('content')

@php
    if (Session::has('enquiry_message')) { 
        Session::flash(SUCCESS, trans("front_messages.enquiry.success_message"));
        Session::forget('enquiry_message');
        Session::save();
    }
@endphp 

<iframe src="{{ route('University.downloadProspectus') }}" style="height:0;" title="description"></iframe>

<section class="best_colleges">
    <div class="container">
        <div class="programs_listing">
            @include('University::Front.elements.course_filter_list')
            <div class="best_college_listing">
                <ul class="management_listing my-0 university-data">
                    @include('University::Front.elements.universities')
                </ul>

                @if ($lastPage != $currentPage)
                <div class="collage_listing_btn seemore">
                    <a class="btn btn-primary view_more" data-page="{{ $result->currentPage() + 1 }}" href="javascript:void(0);">{{ trans('front_messages.global.view_more') }}</a>
                </div>
                @endif

            </div> 
        </div>
    </div>
</section>

@include('University::Front.elements.apply_university')



@include('University::Front.elements.compare_modal')

{{-- <div class="modal fade" id="compareModal" tabindex="-1" aria-labelledby="compareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="compareList">
                    <h2>Add University to Compare</h2>
                    <div id="universityCompareList"></div>
                </div>
            </div>
          </div>
        </div>
    </div> --}}



    {{-- Enquire Now Form Model --}}
    @include('elements.enquire_now')
    {{-- Enquire Now Form Model --}}

    {{-- Enquire Now Sticky Button Element --}}
    @include('elements.enquire_now_sticky_button')
    {{-- Enquire Now Sticky Button Element --}}
@stop

@section('stylesheet')
{{ HTML::style(WEBSITE_CSS_URL . 'slick-theme.css') }}
{{ HTML::style(WEBSITE_CSS_URL . 'slick.css') }}
{{ HTML::style(WEBSITE_CSS_URL . 'jquery.raty.css') }}
{{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'intl-tel-input/intlTelInput.css') }}

@stop


{{ HTML::style('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
{{ HTML::script('plugins/momentjs/moment.js') }}

{{ HTML::script('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}
@section('javascript')
<script type="text/javascript">
    var universityApply_url = "{{ route('University.applyUniversity') }}";
    var getStateUrl = "{{ route('getStates.by_country') }}";
    var getCityUrl = "{{ route('getCity.by_state') }}";
    var veryfyotp = "{{ route('University.send-otp') }}";
</script>
{{ HTML::script(WEBSITE_JS_URL . 'slick.min.js') }}
{{ HTML::script(WEBSITE_JS_URL . 'jquery.raty.js') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'intl-tel-input/intlTelInput.js') }}
{{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
{{ Html::script(WEBSITE_JS_URL . 'apply_university_application.js') }}


 
<script type="text/javascript">
    var viewMoreUniversity = '{{ route("University.viewMoreUniversity") }}';

    $(document).on('click', '.view_more', function() {
        var page = $(this).attr('data-page');
        $.ajax({
            url: "{{ Request::fullUrl() }}",
            data: {
                page: page
            },
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            beforeSend: function() {
                blockedUI();
            },
            success: function(data) {
                unblockedUI();
                if (data.status == "success") {
                    $(".university-data").append(data.html);
                    if (data.lastPage == data.currentPage) {
                        $(".seemore").hide();
                    } else {
                        $(".seemore").show();
                        $(".view_more").attr('data-page', data.currentPage + 1);
                    }
                }
            }
        });
    });


    $(document).on('click', '.send_request', function() {
        var newcourseSlug = '';
        var courseSlug = $(this).data('slug');
        var checkedCourses = $('input[name="courses[]"]:checked').map(function() {
            newcourseSlug += $(this).data('slug') + ',';
            return $(this).val();
        }).get();

        if (checkedCourses.length > 0) {
            var coursesList = 'courses=' + newcourseSlug;
            var coursesQueryString = coursesList;
        } else {
            var coursesList = '';
            var coursesQueryString = coursesList;
        }

        courseFilterAjaxRequest(coursesQueryString);
    });


    function courseFilterAjaxRequest(coursesQueryString) {
        if (coursesQueryString != "") {
            var url = "{{ route('University.listing') }}" + "?" + coursesQueryString;
        } else {
            var url = "{{ route('University.listing') }}";
        }

        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            type: "POST",
            processData: false,
            contentType: false,
            beforeSend: function() {
                blockedUI();
            },
            success: function(res) {
                unblockedUI();
                if (res.status == 'success') {
                    var newUrl = url;
                    history.pushState({
                        path: newUrl
                    }, '', newUrl);
                    $(".university-data").html(res.html);


                    if (res.lastPage == res.currentPage) {
                        $(".seemore").hide();
                    } else {
                        $(".seemore").show();
                        $(".view_more").attr('data-page', res.currentPage + 1);
                    }
                }
            }
        });
    }


    window.onload = (event) => {
        var country = "<?php echo COUNTRY; ?>";
        var old_state = "<?php echo $old_state; ?>";
        if (old_state == '') {
            getState(country, "state", "city", "state_div", "city_div", "applyUniversityForm", "", "form-select");
        }
    };


    phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer',
        'not_valid_mobile_customer');

    $(document).ready(function() {
        var dateOfBirth = 'dob';
        var calDateFormat = '{{ JS_DATE_FORMAT }}';
        showDateInPast(dateOfBirth, calDateFormat);
    });



    $(document).on('click', '#download_prospectus_btn', function() {
        var uni_id = $(this).data('uni_id');
        var slug = $(this).data('slug');
        $("#uni_id").val(uni_id);
        $("#slug").val(slug);
    });


    $('.rating').raty({
        path: '{{ WEBSITE_IMG_URL }}',
        targetKeep: true,
        readOnly: true,
        score: function() {
            return $(this).attr('data-score');
        }
    });


    
    $(document).on('blur', '.contactno', function() {
        // alert($(this).val());

        SendOTP('{{ $mobileTextClass }}');
    });


    $(document).on('click','.load_more_filter_courses',function(){
        var route = $(this).data('route');
        var page = $(this).attr('data-page');
        $.ajax({
            url: route,
            data: {
                page: page
            },
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            beforeSend: function() {
                blockedUI();
            },
            success: function(data) {
                console.log(data);
                unblockedUI();
                if (data.status == "success") {
                    $(".course_filters").append(data.html);
                    if (data.lastPage == data.currentPage) {
                        $(".load_more_button_bg").hide();
                    } else {
                        $(".load_more_button_bg").show();
                        $(".load_more_filter_courses").attr('data-page', data.currentPage + 1);
                    }
                }
            }
        });        
    });
</script>


{{-- Enquire Now Script --}}
<script>
    window.addEventListener('load', function() {
        setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById('enquireNowModel'));
            myModal.show();
        }, 2000);
    });
</script>
{{-- Enquire Now Script --}}
@stop