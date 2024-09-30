@extends('admin.layouts.default')
@section('content')

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
					{{ Form::open(['role' => 'form','route' =>"$modelName.save",'class' => 'mws-form', 'files' => true]) }}
					<div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('Title', trans("messages.$modelName.title").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('title'); ?>
                                    </span>
								</div>
                            </div>
                        </div>
						 <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('Order', trans("messages.$modelName.language_code").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
										{{ Form::text('languagecode', null, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                       <?php echo $errors->first('languagecode'); ?>
                                    </span>
								</div>
                            </div>
                        </div>
						 <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('Order', trans("messages.$modelName.folder_code").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
										{{ Form::text('foldercode', null, ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
										<?php echo $errors->first('foldercode'); ?>
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
@stop
