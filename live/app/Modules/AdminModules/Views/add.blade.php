@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('admin-modules-add') }}
@stop

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
				{{ Form::open(['role' => 'form', 'class' => 'mws-form', 'route'=>"$modelName.add"]) }}
					<div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('parent', trans("messages.$modelName.parent"), ['class' => 'control-label'],false) }}
										   <select name="parent_id" id="parent" class="form-control"data-live-search="true">
											<option value>Select Parent</option>
											@if(count($parentList))
												@foreach($parentList as $parents)
													@if($parents['parentid'] == PARENT_ID)
															<option value="{{ $parents['id'] }}">{{$parents['title']}}</option>
														@else
															<option value="{{ $parents['id'] }}">_{{$parents['title']}}</option>
														@endif
												@endforeach
											@endif
											</select>
									</div>
                                   
								</div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('module_title', trans("messages.$modelName.module_title").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
									   {{ Form::text('title',null, ['class' => 'form-control']) }}
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
                                       {{  Form::label('module_path', trans("messages.$modelName.module_path").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
									   {{ Form::text('path',null, ['class' => 'form-control']) }}
									  
									</div>
									 <br><span>{{ trans("messages.$modelName.module_path_info") }}</span>
                                    <span class="error help-inline">
                                      <?php echo $errors->first('path'); ?>
                                    </span>
								</div>
                            </div>
                       </div>
					   <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('suffix', trans("messages.$modelName.module_suffix"), ['class' => 'control-label'],false) }}
									   {{ Form::text('suffix',null, ['class' => 'form-control']) }}
									  
									</div>
								
								</div>
                            </div>
                       </div>
					     <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('icon', trans("messages.$modelName.module_icon"), ['class' => 'control-label'],false) }}
									   {{ Form::text('icon',null, ['class' => 'form-control']) }}
									  
									</div>
								
								</div>
                            </div>
                       </div>
					     <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('module_order', trans("messages.$modelName.module_order").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
									   {{ Form::text('module_order',isset($maxOrder) ? $maxOrder : '', ['class' => 'form-control']) }}
									</div>
									<span class="error help-inline">
                                      <?php echo $errors->first('module_order'); ?>
                                    </span>
								</div>
                            </div>
                       </div>
					    
						<div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('route_prefixes', trans("Route Prefixes"), ['class' => 'control-label'],false) }}
									   {{ Form::text('route_prefixes',null, ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
                                      <?php echo $errors->first('route_prefixes'); ?>
                                    </span>
								</div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('required_params', trans("Required Params"), ['class' => 'control-label'],false) }}
									   {{ Form::text('required_params',null, ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
                                      <?php echo $errors->first('required_params'); ?>
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