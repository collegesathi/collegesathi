@extends('admin.layouts.default')
@section('content')


<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                      {{ trans("messages.$modelName.reply") }}
                    </h2>
                </div>
				<div class="body">
					<div class="mws-form-message info">
						{{ trans("messages.$modelName.message_will_be_attached_in_email") }}
					</div>	
					 {{ Form::open(['role' => 'form','url'=>route("$modelName.reply","$modelId"),'class' => 'mws-form']) }}
						<div class="mt-20">		 	
							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('body', trans("messages.$modelName.message").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
											{{ Form::textarea("message",'', ['id' => 'body','rows' => 5,'cols'=>80,'class'=>'form-control contactHeight']) }}
										</div>
										<span class="error help-inline">
												{{ $errors->first('message') }}
										</span>
									</div>
								</div>
							</div>	
							<div>	
								  <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i>{{ trans("messages.$modelName.reply") }}</button>

									<a href="{{Request::url()}}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
							</div>							
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
    </div>
</div>	
@stop
