@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
	{{ Breadcrumbs::render('specialization-add') }}
@stop


  
@php
$langCode = "";
$image_count = 1;
@endphp
<!-- Ckeditor -->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
{{ HTML::style(WEBSITE_CSS_URL . 'select2.min.css') }}
<!--- ckeditor js end  here -->
<div class="container-fluid" id="main-container">
   <div class="row clearfix" >
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
            <div class="header">
               <h2>
                {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_add") }}
               </h2>
               <ul class="header-dropdown m-r--5 btn-right-top-margin">
                  <li>
                    @if($universityBlog)

                    <a href='{{ route("UniversityBlog.index",$uni_id) }}'>
                        <button type="button" class="btn bg-indigo waves-effect"><i
                           class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                        </a>
                    @else
                    <a href='{{ route("$modelName.index") }}'>
                        <button type="button" class="btn bg-indigo waves-effect"><i
                        class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                        </a>
                    @endif
                  </li>
               </ul>
            </div>
            <div class="body">

                @if($universityBlog)
                   {{ Form::open(['role' => 'form','url' =>  route("UniversitySpecialization.save","$uni_id"),'files'=>true,'class' => 'mws-form', 'id' =>'formSubmitData']) }}
                @else
                  {{ Form::open(['role' => 'form','route' => "Specialization.save",'files'=>true,'class' => 'mws-form', 'id' =>'formSubmitData']) }}
               @endif

               <div class="mt-20">
                  <div class="row clearfix">
                     <div class="col-sm-6 align-center">
                        <div class="form-group add-image image">
                           <input name="image" id="profile_image" class="form-control image-input-file" type="file"/>
                           <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                              <div id="pImage">
                                 <img src="{{WEBSITE_UPLOADS_URL}}user-profile-not-available.jpeg" alt="Blog image" class="profileImage" />
                              </div>
                           </span>
                           <br/>
                           <div>
                              <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg')}}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto" rel="image"> {{ trans('messages.global.upload_image') }} <span class="required"> * </span></a>
                           </div>
                           <span class="error help-inline image_error" id="image_error_div">
                           <?php echo $errors->first('image'); ?>
                           </span>
                        </div>
                     </div>
                     <div class="col-sm-6 ">
                        <div class="form-group align-center add-image image_1">
                           <input name="image_1" id="profile_image_1" class="form-control image-input-file" type="file" />
                           <span class="help-inline required profile_image_1" id="ContentTypeNameSpan">
                              <div id="pImage1">
                                 <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="Blog image" class="profileImage" />
                              </div>
                           </span>
                           <br />
                           <div>
                              <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto" rel="image_1">
                              {{ trans('messages.global.upload_image') }} <span class="required"> * </span>
                              </a>
                           </div>
                           <span class="error help-inline image_1" id="image_error_div_1">
                           <?php
                              $image_name = 'image_1';
                              echo $errors->first($image_name); ?>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               @include('admin.elements.multilanguage_tab')
               <!-- Tab panes -->
               <div class="tab-content">
                  @foreach($languages as $langCode => $title)
                  <?php $i = $langCode; ?>
                  <div role="tabpanel" class="tab-pane animated {{ ($i ==  $language_code ) ? 'active':'' }} " id="{{ $i }}_div">
                     <div class="row clearfix">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <div class="form-line">
                                 {{  Form::label('title', trans("messages.global.title").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                 {{ Form::text("data[$i][".'title'."]", '', ['class' => 'form-control']) }}
                              </div>
                              <span class="error help-inline title">
                              <?php echo $errors->first('title'); ?>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="row clearfix">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <div class="form-line">
                                 {{  Form::label($i.'_body', trans("messages.$modelName.description").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                 {{ Form::textarea("data[$i][".'description'."]",'', ['class' => 'form-control ','id' => 'description'.$i]) }}
                                 <script>
                                    $(function () {
                                        CKEDITOR.replace('description{{$i}}', {
                                            filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
                                            filebrowserImageWindowWidth : '640',
                                            filebrowserImageWindowHeight : '480',
                                            height: 450,
                                            enterMode : CKEDITOR.ENTER_BR
                                        });
                                    });
                                 </script>
                              </div>
                              <span id="description_error" class="error description"><?php echo ($i == $language_code ) ? $errors->first('description') : ''; ?></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               <div class="row clearfix">

                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{  Form::label('meta_title', trans("messages.$modelName.meta_title").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                           {{ Form::text("meta_title", null, ['class' => 'form-control']) }}
                        </div>
                        <span class="error help-inline meta_title">
                        <?php echo $errors->first('meta_title'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{  Form::label('meta_keyword', trans("messages.$modelName.meta_keyword").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                           {{ Form::text("meta_keyword", null, ['class' => 'form-control']) }}
                        </div>
                        <span class="error help-inline meta_keyword">
                        <?php echo $errors->first('meta_keyword'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{  Form::label('meta_description', trans("messages.$modelName.meta_description").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                           {{ Form::textarea("meta_description",null, ['class' => 'form-control ']) }}
                        </div>
                        <span class="error help-inline meta_description">
                        <?php echo $errors->first('meta_description'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div>
                  <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>
                  <a href="{{ route($modelName.'.add')}}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
               </div>
            </div>
            {{ Form::close() }}
         </div>
      </div>
   </div>
</div>
</div>
{{ Html::script(WEBSITE_ADMIN_JS_URL.'select2/select2.full.min.js') }}
{{ Html::script(WEBSITE_ADMIN_JS_URL.'blog.js') }}
@stop
