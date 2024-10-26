@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('emailTemplate-add') }}
@stop

@section('content')
<!--- ckeditor js start  here -->
<!-- Ckeditor -->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<!--- ckeditor js end  here -->

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
					 <div class="mt-20">		 	
							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('name', trans("messages.$modelName.name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::text('name', null, ['class' => 'form-control']) }}
										</div>
										<span class="error help-inline">
											<?php echo $errors->first('name'); ?>
										</span>
									</div>
								</div>
							 </div>
							 <div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('subject', trans("messages.$modelName.subject").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::text('subject', null, ['class' => 'form-control']) }}
										</div>
										<span class="error help-inline">
											<?php echo $errors->first('subject'); ?>
										</span>
									</div>
								</div>
							 </div>
							  <div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('action', trans("messages.$modelName.action").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::select('action', $Action_options,'', ['class' => 'form-control','onchange'=>'constant()','data-live-search'=>"true"]) }}
										</div>
										<span class="error help-inline">
											<?php echo $errors->first('action'); ?>
										</span>
									</div>
								</div>
							 </div>
							   <div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('constants', trans("messages.global.constants").'<span class="required"></span>', ['class' => 'control-label'],false) }}
												{{ Form::select('constants', array(),'', ['empty' => 'Select one','class' => 'form-control','data-live-search'=>"true"]) }}
												
										</div>
										<span class="error help-inline">
											<?php echo $errors->first('constants'); ?>
										</span>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group set_insert_button">
											<a href="javascript:void(0);" onclick = "return InsertHTML();" class="text-decoration-none"><button type="button" class="btn btn-success btn-sm waves-effect no-ajax">{{  trans("messages.global.insert_variable") }} </button></a>
									</div>
								</div>		
							 </div>
							 <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="body" class="control-label">
                                                    {{  Form::label('body', trans("messages.$modelName.description").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	


                                                </label>
                                                {{ Form::textarea("body",'', ['class' => 'form-control ','id' => 'body']) }}
                                                <script>
                                                   $(function () {
                                                        CKEDITOR.replace('body', {
                                                            
															filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
															filebrowserImageWindowWidth : '640',
															filebrowserImageWindowHeight : '480',
															enterMode : CKEDITOR.ENTER_BR
															
                                                        });

                                                    });
                                                </script>


                                            </div>

                                           <span class="error help-inline">
											<?php echo $errors->first('body'); ?>
										</span>

                                        </div>
                                    </div>
                                </div>
					 </div>
					  <div>	
                            <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>

                            <a href="{{ route($modelName.'.add')}}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>

                            
                        </div>
					{{ Form::close() }}
				</div>
			</div>
		</div>	
	</div>
</div>	


<?php  $constant = ''; ?>
<script type='text/javascript'>
	var myText = '<?php  echo $constant; ?>';
	var csrf_token	=	'{{ csrf_token() }}';
	$(document).ready(function(){
		setTimeout(function(){
			constant();
		},500);
	});
	/* this function used for  insert contant, when we click on  insert variable button */
    function InsertHTML() {
		
		var strUser = document.getElementById("constants").value;
		
		if(strUser != ''){
			var newStr = '{'+strUser+'}';
			var oEditor = CKEDITOR.instances["body"] ;
			oEditor.insertHtml(newStr) ;	
		}
    }
	/* this function used for get constant,define in email template*/
	function constant() {
		$('#constants').selectpicker('destroy');
		var constant = document.getElementById("action").value;
			$.ajax({
				url: '<?php echo route("$modelName.get_constant")?>',
				type: "POST",
				data: { constant: constant},
				headers: {
					'X-CSRF-TOKEN': csrf_token
				},
				dataType: 'json',
				success: function(r){		
					$('#constants').empty();
					$('#constants').append( '<option value="">-- Select One --</option>' );
					$.each(r, function(val, text) {
						var sel ='';
						if(myText == text)
						 {
						   sel ='selected="selected"';
						 }
						 
						$('#constants').append( '<option value="'+text+'" '+sel+'>'+text+'</option>');
						
					});	
						$('#constants').selectpicker();
			   }
			});
		return false; 
	}	
</script>

@stop
