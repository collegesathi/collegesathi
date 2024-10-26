@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
	{{ Breadcrumbs::render('faq-page-edit',$uni_id,$course_id) }}
@stop
<!-- Ckeditor -->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<!--- ckeditor js end  here -->


<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id) . ' -> ' : '' }}
                        {{ isset($course_id) && !empty($course_id) ? CustomHelper::universityCourseNameById($course_id) . ' -> ' : '' }}
                        {{ trans("messages.$modelName.table_heading_index") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            @if($universityFaq)
                                <a href='{{ route("UniversityFaq.index",$uni_id)}}' >
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                                </a>
                            @elseif($courseFaq)
                                <a href='{{ route("CourseFaq.index",[$uni_id,$course_id])}}' >
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                                </a>
                            @else
                                <a href='{{ route("$modelName.index")}}' >
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                                </a>
                            @endif

                        </li>
                    </ul>
                </div>
                <div class="body">

                    @if($universityFaq)
                    {{ Form::open(['role' => 'form','url' =>  route("UniversityFaq.edit",[$result->id,$uni_id]),'files'=>true,'class' => 'mws-form']) }}
                    @elseif($courseFaq)
                    {{ Form::open(['role' => 'form','url' =>  route("CourseFaq.update",[$result->id,$uni_id,$course_id]),'files'=>true,'class' => 'mws-form']) }}
                    @else
                    {{ Form::open(['role' => 'form','url' => route("$modelName.edit","$result->id"),'files'=>true,'class' => 'mws-form']) }}
                    @endif

                   
                    <div class="mt-20">	
                        <!-- Tab panes -->
                        <div class="tab-content">

								<div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{  Form::label('question', trans("messages.$modelName.question").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
												{{ Form::text("question", isset($result['question'])?$result['question']:'', ['class' => 'form-control','id' => 'question']) }} 
												
												 
                                            </div>
                                            <span id="description_error" class="error"><?php echo   $errors->first('question')   ?></span>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{  Form::label('answer', trans("messages.$modelName.answer").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
												{{ Form::textarea("answer",isset($result['answer'])?$result['answer']:'', ['class' => 'form-control ','id' => 'answer']) }}
                                                <script>
                                                   $(function () {
                                                        CKEDITOR.replace('answer', {
															filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
															filebrowserImageWindowWidth : '640',
															filebrowserImageWindowHeight : '480',
															enterMode : CKEDITOR.ENTER_BR
                                                        });
                                                    });
                                                </script>
                                            </div>
                                            <span id="description_error" class="error"><?php echo   $errors->first('answer')   ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
						<div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										{{  Form::label('faq_order', trans("messages.$modelName.order").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
										{{ Form::text("faq_order",$result->faq_order, ['class' => 'form-control']) }}
									</div>
									<span class="error help-inline">
										<?php echo $errors->first('faq_order'); ?>
									</span>
								</div>
							</div>
						</div>
								
								
                        <div>	
                            <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>

                            @if($universityFaq)
                                <a href="{{ route('UniversityFaq.edit',[$result->id,$uni_id]) }}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
                            @elseif($courseFaq)
                                <a href="{{ route('CourseFaq.edit',[$result->id,$uni_id,$course_id]) }}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
                            @else
                                <a href='{{ route("$modelName.edit","$result->id") }}'  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
                            @endif
						</div>
                    </div>
					{{ Form::close() }} 
                </div>
            </div>
        </div>	
    </div>
</div>
@stop
