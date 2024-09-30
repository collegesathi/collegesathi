@extends('layouts.default')
@section('content')
{{ HTML::style(WEBSITE_CSS_URL.'dashboard.css') }}
<!--- ckeditor js start  here -->
<!-- Ckeditor -->






<!-- This heading -->
@include('elements.user.dashboard_heading') 
<div class="inner_banner student_dashboard">
   <div class="container">
      <h1> {{ trans("messages.$modelName.send_price_request") }}</h1>
   </div>
</div>
@include('elements.breadcrumb')
<div class="dashboard_content">
   <div class="container">
      @include('elements.tutor_left_link') 
      <div class="siderbar_content">
         <div class="create_webinar dashboard_form">
           {{ Form::open(['role' => 'form', 'files'=>true,  'class' => 'mws-form', 'files' => true]) }}
           
          
           <div class="row">
               <div class="col-sm-12">
                  <div class="form-group">
                     {{  Form::label('price', trans("messages.$modelName.price").' <span class="field-required"> * </span>', ['class' => 'control-label'],false) }}
                     {{ Form::text("price" , null , ['class' => 'form-control','rows'=>6,'placeholder'=>trans("messages.$modelName.price")]) }}
                     <span class="error help-inline">
                     {{$errors->first('price')}}
                     </span>
                  </div>
               </div>
               </div>
               <div class="row">
               <div class="col-sm-12">
                  <div class="form-group">
                     {{  Form::label('description', trans("messages.$modelName.description").' <span class="field-required"> * </span>', ['class' => 'control-label'],false) }}
                     {{ Form::textarea("description" , null , ['class' => 'form-control','rows'=>7,'placeholder'=>trans("messages.$modelName.description")]) }}
                     <span class="error help-inline">
                     <?php echo $errors->first('description'); ?>
                     </span>
                  </div>
               </div>
            </div>
            <div class="row">
				<div class="col-md-12 text-center">
				  <div class="save-btn">
					  <button type="submit"  class="btn btn-secondary" >{{ trans('messages.global.submit') }}</button>
					  <a href='{{ route("Tutor.tutorDashboard")}}' class="text-decoration-none"><button type="button" class="btn btn-cancel">{{ trans('messages.global.cancel')}}</button></a>
				  </div>
				</div>
			</div>
			
            {{ Form::close() }}
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>





@stop
