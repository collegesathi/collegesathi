@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
	{{ Breadcrumbs::render('cms-page-view') }}
@stop

<div class="container-fluid" id="main-container">
<div class="row clearfix" >
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					{{ trans("messages.$modelName.table_heading_view") }}
				</h2>
				<ul class="header-dropdown m-r--5 btn-right-top-margin">
					<li>
						<a href='{{ route("$modelName.index")}}' >
							<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
						</a>

					</li>
				</ul>
			</div>
			<div class="body table-responsive">
				<table class="table table-bordered table-striped table-hover ">
  @php  /*
                    <tr>
                        <th class="text-center" width="30%">{{ trans("messages.$modelName.featured_image") }}</th>
                        <td>
                            @if ($result->featured_image != '' && File::exists(CMS_IMAGE_ROOT_PATH . $result->featured_image))
                                <a class="items-image" data-lightbox="roadtrip<?php echo $result->featured_image; ?>"
                                    href="<?php echo CMS_IMAGE_URL . $result->featured_image; ?>">
                                    {!! CustomHelper::showImage(CMS_IMAGE_ROOT_PATH, CMS_IMAGE_URL, $result->featured_image, '', ['alt' => $result->featured_image, 'height' => '70', 'width' => '200', 'zc' => 1]) !!}
                                </a>
                            @else
                                {{ 'No Image' }}
                            @endif

                        </td>
                    </tr>
*/
 @endphp
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.$modelName.page_name") }}</th>
					<td><p class="description_maintain" > {{ isset($result->name) ? strip_tags($result->name) : 'N/A' }}</p></td>
				</tr>
				<!-- <tr>
					<th class="text-center" width="30%">{{ trans("messages.$modelName.slug") }}</th>
					<td><p class="description_maintain" > {{ isset($result->slug) ? strip_tags($result->slug) : 'N/A' }}</p></td>
				</tr> -->
				<tr>
					<th class="text-center" width="30%">{{  trans("messages.$modelName.meta_title") }}</th>
					<td><p class="description_maintain" > {{ isset($result->meta_title) ? strip_tags($result->meta_title) : 'N/A' }}</p></td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.$modelName.meta_description") }}</th>
					<td><p class="description_maintain" > {{ isset($result->meta_description) ? strip_tags($result->meta_description) : 'N/A' }}</p></td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.$modelName.meta_keyword") }}</th>
					<td><p class="description_maintain" > {{ isset($result->meta_keywords) ? strip_tags($result->meta_keywords) : 'N/A' }}</p></td>
				</tr>

				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.status") }}</th>
					<td>
						@if($result->is_active	== ACTIVE)
							<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
						@else
							<span class="label label-warning" >{{ trans("messages.global.inactive") }}</span>
						@endif
					</td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.created_on") }}</th>
					<td><p class="description_maintain" >{{ isset($result->created_at) ?  CustomHelper::displayDate($result->created_at) : 'N/A' }}</p></td>
				</tr>

				<tr>
					<table class="row-border hover table table-bordered" cellspacing="0" width="100%">
						@if(count($languages) > 1)
							<tr>
								<th colspan="" class="text-center"></th>

								@foreach($languages as $langCode => $title)
									<th colspan="" class="text-center">{{ $title }}</th>
								@endforeach
							</tr>
						@endif
						<tr>
							<th  class="text-right">{{ trans("messages.$modelName.page_title") }}</th>

							@foreach($languages as $langCode => $title)

							<td>
								{{ isset($multiLanguage[$langCode]['title']) ? $multiLanguage[$langCode]['title'] : 'N/A' }}
							</td>

							@endforeach

						</tr>
						<tr>
							<th  class="text-right">{{ trans("messages.$modelName.page_description") }}</th>

							@foreach($languages as $langCode => $title)

							<td>
								{!! isset($multiLanguage[$langCode]['description']) ? $multiLanguage[$langCode]['description'] : 'N/A' !!}
							</td>

							@endforeach

						</tr>
					</table>
				</tr>


				</table>
			</div>
		</div>






	</div>
</div>
</div>
@stop
