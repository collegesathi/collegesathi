@extends('layouts.default')
@section('content')


{{ Form::open(['role' => 'form', 'route' => "survey.saveDegreeCategory", 'files' => true, 'class' => 'mws-form', 'id' => 'degreeData']) }}
    <section class="bg_gray degree_section">
        <div class="container">

            <div class="progress_bar">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar" style="width: 0%"></div>
                </div>
            </div>

            <div class="degree_heading text-center">
                <span>{{ trans('front_messages.global.best_match') }}</span>
                <h1>{{ trans('front_messages.global.degree_you_are_interested_in') }}</h1>
            </div>
            <div class="error help-inline course_error">
                <?php echo $errors->first('education_degree'); ?>
            </div>
            <div class="degree_contant_box">
                <ul>
                    @php
                         $data = Request::session()->get( 'category' );
                    @endphp
  
                    @foreach ($category as $categoryKey => $value)

                        <li>
                            <input class="education_degree" name="education_degree" id="{{ $value }}" type="radio" value="{{ $categoryKey }}"<?php if($data == $categoryKey){ echo "checked"; }?>>
                            <label for="{{ $value }}">
                                <span> <img class="main_img" src="{{WEBSITE_IMAGE_URL }}degree_icon.svg" alt="img"> </span>
                                <span> <img class="white_img" src="{{ WEBSITE_IMAGE_URL }}degree_icon_white.svg" alt="img"></span>
                                <small>{{ !empty($value)? $value :'N/A' }}</small>
                            </label>
                        </li>
                    @endforeach
 
                </ul>
            </div>
        </div>
    </section>   
{{ Form::close() }}
    <div class="overley_backdrop"></div>
   
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    $(document).ready(function() {
        $('ul li').on('click', function() {
            // Get the value from the clicked list item's input
            var value = $(this).find('input').val();

            // Set the value to the form input
            $('#degreeData').find('input[name="education_degree"]').val(value);

            // Submit the form
            $('#degreeData').submit();
        });
    });
</script>