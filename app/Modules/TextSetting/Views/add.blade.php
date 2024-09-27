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
                            <a href='{{route("$modelName.index",$type)}}' >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
				<div class="body">
					{{ Form::open(['role' => 'form','url' =>route("$modelName.save",$type),'class' => 'mws-form', 'files' => true]) }}
					<!-- multilanguage tab button -->
					@include('admin.elements.multilanguage_tab')
					<div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
										{{  Form::label('Key', trans("messages.$modelName.key").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                       {{ Form::text('key', null, ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
                                      <?php echo $errors->first('key'); ?>
                                    </span>
								</div>
                            </div>
                        </div>
						<div class="tab-content">
						 @foreach($languages as $langCode => $title)
						 
						  <?php	
						  $i = $langCode; ?> 
							<div role="tabpanel" class="tab-pane animated {{ ($i ==  $language_code ) ? 'active':'' }} " id="{{ $i }}_div">
								<div class="row clearfix">
									<div class="col-sm-12">
										<div class="form-group">
											<div class="form-line">
												{{  Form::label('value', trans("messages.$modelName.value").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
												{{ Form::text("data[$langCode]",null, ['class' => 'form-control']) }}
											</div>
											 <span class="error help-inline">
												<?php echo ($i ==  $language_code ) ? $errors->first('value') : ''; ?>
											</span>
										</div>
									</div>	
								</div>	
							</div>
						@endforeach
						</div>	
						<div>	
                            <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>

                            <a href='{{route("$modelName.add",$type)}}'  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>

                          
                        </div>
					</div>	
					{{ Form::close() }}
				</div>
			</div>	
		</div>
	</div>
</div>	
@stop
