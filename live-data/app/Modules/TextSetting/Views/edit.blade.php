@extends('admin.layouts.default')
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
                            <a href='{{route("$modelName.index",$type)}}' >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
				<div class="body">
					{{ Form::open(['role' => 'form','url' =>route("$modelName.update",array("$type","$result->id")),'class' => 'mws-form', 'files' => true]) }}
					<div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('value', trans("messages.settings.value").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                       {{ Form::text('value', $result->value, ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
                                      <?php echo $errors->first('value'); ?>
                                    </span>
								</div>
                            </div>
                        </div>
						<div>	
                            <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>

                            <a href='{{route("$modelName.edit",array("$type","$result->id"))}}'  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
						</div>
					</div>	
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>
</div>	
@stop
