@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
	{{ Breadcrumbs::render('faq-page-view',$uni_id,$course_id) }}
@stop


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
				 <div class="body table-responsive">
					<table class="table table-bordered table-striped table-hover ">
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.$modelName.question") }}</th>
						<td><p class="description_maintain" > {{ isset($result->question) ? strip_tags($result->question) : 'N/A' }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.$modelName.answer") }}</th>
						<td><p class="description_maintain" >{{ isset($result->answer) ? strip_tags($result->answer) : 'N/A' }}</p></td>
					</tr>
					
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.$modelName.order") }}</th>
						<td><p class="description_maintain" >{{ isset($result->faq_order) ? strip_tags($result->faq_order) : 'N/A' }}</p></td>
					</tr>
					</table>
				 </div>
			</div>
		</div>	
	</div>
</div>
@stop
