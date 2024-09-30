@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('block-add') }}
@stop

@section('content')
<?php $langCode = ""; ?>
<!-- Ckeditor -->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<!-- CKeditor ends-->


<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_add") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.index")}}' >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">
                    {{ Form::open(['role' => 'form','route' => "$modelName.save",'class' => 'mws-form']) }}

                    @include('admin.elements.multilanguage_tab')

                    <div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{  Form::label('page_name', trans("messages.$modelName.page_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
                                        {{ Form::text('page_name','', ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('page_name'); ?>
                                    </span>


                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                         {{  Form::label('block_name', trans("messages.$modelName.block_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
										{{ Form::text("block_name",'', ['class' => 'form-control']) }}
								 </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('block_name'); ?>
                                    </span>


                                </div>
                            </div>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">


                            @foreach($languages as $langCode => $title)
                            <?php $i = $langCode; ?> 
                            <div role="tabpanel" class="tab-pane animated {{ ($i ==  $language_code ) ? 'active':'' }} " id="{{ $i }}_div">

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
                                            <span id="description_error" class="error"><?php echo ($i == $language_code ) ? $errors->first('description') : ''; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
@stop

