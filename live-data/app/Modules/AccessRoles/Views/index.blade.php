@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('access-roles') }}
@stop

@section('content')
<!-- Hover Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ trans("messages.$modelName.table_heading_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm">
                       
                        <li>
                            <a href='{{route("$modelName.add")}}' >
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">add</i> {{ trans("messages.$modelName.add_new") }} 
                                </button>
                            </a>
                        </li>
                        
                    </ul>
                </h2>
            </div>
			<div class="body table-responsive">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="dataTables_length" id="DataTables_Table_0_length">
                            @include('admin.elements.admin_paging_dropdown')
                        </div>
                    </div> 
                </div>
                <table class="table table-bordered table-striped table-hover "  >
                    <thead>
                        <tr>
                    <th>{{ trans("messages.$modelName.role") }}</th>
                    <th>
                        {{ trans("messages.$modelName.access_create_at") }}
                    </th>
                    <th width="10%">{{ trans("messages.global.action") }}</th>
                </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if(!$result->isEmpty())
							@foreach($result as $record)
                         <tr class="items-inner">
                            <td data-th='{{ trans("messages.$modelName.role") }}'>{{ $record->role }}</td>
                            <td data-th='{{ trans("messages.$modelName.access_create_at") }}'>
								{{  CustomHelper::displayDate($record->created_at) }}</td>
                            <td data-th='{{ trans("messages.global.action") }}'>
                                <a href='{{route("$modelName.edit",$record->id)}}' class="btn btn-info btn-small"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }} </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td align="center" width="100%" colspan="5">  {{ trans("messages.global.no_record_found_message") }} </td>
						</tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    @include('pagination.default', ['paginator' => $result,'searchVariable'=>$searchVariable])
                </div>

            </div>
		</div>
	</div>
</div>
@stop
