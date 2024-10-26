@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('setting-edit') }}
@stop

@section('content')
<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_edit") }}
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
				 {{ Form::open(['role' => 'form','url' =>  route("$modelName.edit","$model->id"),'class' => 'mws-form']) }}
				 <div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('Title', trans("messages.$modelName.title").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::text('title',$model->title, ['class' => 'form-control']) }}
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
										{{  Form::label('key', trans("messages.$modelName.key").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::text('key',  $model->key_value, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('key'); ?>
                                    </span>
									<small>e.g., 'Site.title'</small>
								</div>
                            </div>
                        </div>
						<div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('value', trans("messages.$modelName.value").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::textarea('value', $model->value, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('value'); ?>
                                    </span>
								</div>
                            </div>
                        </div>
						<div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('input_type', trans("messages.$modelName.input_type").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
										{{ Form::select('input_type',array(''=>'Please Select Input Type')+ Config::get('input_type'),$model->input_type, ['class' => 'form-control','data-live-search'=>"true"]) }}
                                       
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('input_type'); ?>
                                    </span>
									<small><em><?php echo "e.g., 'text' or 'textarea'";?></em></small>
								</div>
                            </div>
                        </div>
						
						<div>	
                            <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>
							<a href='{{ route("$modelName.edit","$model->id")}}'  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
                        </div>
					</div>	
				 {{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>	
@stop



