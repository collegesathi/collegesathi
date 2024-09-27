{{ Form::hidden('uni_id', $uni_id, ['class' => 'form-control ', 'id' => 'uni_id']) }}
{{ Form::hidden('course_id', $course_id, ['class' => 'form-control ', 'id' => 'course_id']) }}
{{ Form::hidden('semester', $i + 1, ['class' => 'form-control ', 'id' => 'semester_'.$i]) }}
{{ Form::hidden('specification_id', $specification_id, ['class' => 'form-control ', 'id' => 'specification_id']) }}

<div class="col-sm-12">
    <div class="form-group">
        <div class="form-line">
            {{ Form::label('subject_'.$i, trans('messages.global.subject') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
            {{ Form::text('subject_'.$i, '', ['class' => 'form-control', 'id' => 'subject_'.$i]) }}
        </div>
        <span id="error_subject_{{ $i }}" class="error"></span>
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group">
        <div class="form-line">
            {{ Form::label('credit_score_'.$i, trans('messages.global.credit_score') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
            {{ Form::text('credit_score_'.$i, '', ['class' => 'form-control', 'id' => 'credit_score_'.$i]) }}
        </div>
        <span id="error_credit_score_{{ $i }}" class="error"></span>
    </div>
</div>
<div class="col-sm-12">   
    <div class="form-group">
        <div class="form-line">
            {{ Form::label('description_'.$i, trans('messages.global.description') . '<span class="required"> </span>', ['class' => 'control-label'], false) }}
            {{ Form::textarea('description_'.$i, '', ['class' => 'form-control', 'rows' => 2, 'id' => 'description_'.$i]) }}
            <script>
                $(function() {
                    CKEDITOR.replace('description_{{$i}}', {
                        filebrowserUploadUrl: '<?php echo URL::to("base/uploder"); ?>',
                        filebrowserImageWindowWidth: '640',
                        filebrowserImageWindowHeight: '480',
                        height: 120,
                        enterMode: CKEDITOR.ENTER_BR
                    });
                });
            </script> 
        </div>
        <span id="error_description_{{ $i }}" class="error"></span>
    </div>
</div>
