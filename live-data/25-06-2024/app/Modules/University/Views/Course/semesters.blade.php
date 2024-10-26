@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
{{ Breadcrumbs::render('semester', $uni_id) }}
@stop

{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
  
<div class="d-flex flex-end clearfix Semesters-head">
    <div class="flex-btns" >
        <a href='{{ route("$modelName.listCourse", $uni_id) }}'>
            <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
        </a>
    </div>
    @if($acitveSemesters > 0)
    <div class="flex-btns" >
        <a href='{{ route("$modelName.markAsAllInactive", array($course_id,$uni_id)) }}'>
            <button type="button" class="btn bg-indigo waves-effect">{{ trans('messages.global.mark_as_all_in_active') }}</button>
        </a>
    </div>
    @endif
    @if($inacitveSemesters > 0)
    <div class="flex-btns">
        <a href='{{ route("$modelName.markAsAllActive", array($course_id,$uni_id)) }}'>
            <button type="button" class="btn bg-indigo waves-effect">{{ trans('messages.global.mark_as_all_active') }}</button>
        </a>
    </div>  
    @endif
</div>

@for ($i = 0; $i < $noOfSemesters[0]; $i++) @php $sessionValue=Session::get('semester'); @endphp @if ($i % 2==0) <div class="row clearfix">
    @endif
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
            <div class="panel" style="color: #fff; border:1px solid green;">
                <div class="panel-heading" role="tab" id="panel-heading-id">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-target="#panel-collapse-id{{ $i }}" data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true" aria-controls="panel-collapse-id" class=" bg-green {{ $sessionValue == $i + 1 ? '' : 'collapsed' }}">{{ trans('messages.global.semester_heading') . ' ' . ($i + 1) }}
                            <span class="pull-right collapse-toggle-icon"></span>
                        </a>
                    </h4>
                </div>



                <div id="panel-collapse-id{{ $i }}" class="panel-collapse collapse {{ $sessionValue == $i + 1 ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    @include('University::elements.semester_table')
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            {{ trans('messages.global.add_subject_detail_heading') }}
                                        </h2>
                                    </div>
                                    {{ Form::open(['method' => 'get', 'role' => 'form', 'class' => 'mws-form', 'id' => "semester_form_$i"]) }}

                                    @include('University::elements.semester_form')

                                    <div class="row clearfix">
                                        <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button" style="margin-bottom: 8px;">
                                            <button type="button" class="btn bg-green btn-sm waves-effect btn-submit text-decoration-none submit_btn" data-semester_key="{{ $i }}">{{ trans('messages.global.submit') }}</button>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($i % 2 == 1 || $i == $noOfSemesters[0] - 1)
    </div>
    @endif
    @endfor


    {{-- Subjects detail view modal  --}}
    <div class="modal fade" id="subject_detail_view_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('messages.global.subject_detail') }}</h5>
                </div>
                <div class="modal-body" id="subject_detail_view">
                    <table class="table table-bordered table-striped table-hover ">
                        <thead>
                            <tr role="row">
                                <th width="20%"> {{ trans('messages.global.subject') }} </th>
                                <th width="80%"> {{ trans('messages.global.description') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="subject"></td>
                                <td id="description"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.global.close') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Subjects detail view modal  --}}



    <script>
        $(document).ready(function() {
            var ad_semester_url = '{{ route("Course.addSemester") }}';
            $(document).on("click", ".submit_btn", function() {
                var semester_key = $(this).data('semester_key');
                var subject = $("#subject_" + semester_key).val();
                var credit_score = $("#credit_score_" + semester_key).val();
                var uni_id = $("#uni_id").val();
                var course_id = $("#course_id").val();
                var semester = $("#semester_" + semester_key).val();
                var editor = CKEDITOR.instances['description_' + semester_key];
                var description = editor.getData();
                var formData = new FormData();
                formData.append('subject', subject);
                formData.append('credit_score', credit_score);
                formData.append('description', description);
                formData.append('uni_id', uni_id);
                formData.append('course_id', course_id);
                formData.append('semester', semester);

                $.ajax({
                    url: ad_semester_url,
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        $('.error').empty();
                        if (data.status == "success") {
                            window.location.reload();
                        } else {
                            $.each(data.errors, function(key, value) {
                                $('#error_' + key + '_' + semester_key).html(value);
                            });
                        }
                    }
                });
            });


            $(document).on('click', '.view_subject_detail', function() {
                var subject = $(this).data('subject');
                var description = $(this).data('description');
                $("#subject_detail_view_model").modal('show');
                $("#subject").html(subject);
                $("#description").html(description);
            });

        });
    </script>

    @stop