@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
	{{ Breadcrumbs::render('blog-view') }}
@stop


<div class="container-fluid" id="main-container">
   <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
            <div class="header">
               <h2>
                {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_view") }}
               </h2>
               <ul class="header-dropdown m-r--5 btn-right-top-margin">
                  <li>

                    @if($universityBlog)

                    <a href='{{ route("UniversityBlog.index",$uni_id) }}'>
                        <button type="button" class="btn bg-indigo waves-effect"><i
                           class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                        </a>
                    @else
                    <a href='{{ route("$modelName.index") }}'>
                        <button type="button" class="btn bg-indigo waves-effect"><i
                        class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                        </a>
                    @endif

                  </li>
               </ul>
            </div>
            <div class="body table-responsive">
               <table class="table table-bordered table-striped table-hover ">
                  <tr>
                     <th class="" width="30%">{{ trans("messages.$modelName.image") }}</th>
                     <td data-th='{{ trans("messages.$modelName.profile_image") }}'>
                        @php
                        $root_path = BLOG_IMAGE_ROOT_PATH;
                        $http_path = BLOG_IMAGE_URL;
                        $attribute = [];
                        $types = '';
                        $attribute['alt'] = 'user-profile';
                        $attribute['class'] = 'userProfileImage circle-img';
                        $attribute['width'] = '75';
                        $attribute['height'] = '75';
                        $attribute['cropratio'] = '1:1';
                        $attribute['zc'] = '1';
                        $image_name = isset($result->image) ? $result->image : '';
                        $image = CustomHelper::showImageWithLightBox($root_path, $http_path, $image_name, $types, $attribute);
                        @endphp
                        {!! $image !!}
                     </td>
                     <th class="" width="30%">{{ trans("messages.$modelName.image") }}</th>
                     <td data-th='{{ trans("messages.$modelName.profile_image") }}'>
                        @php
                        $image_type = array($result->image_1);
                        $i = 1;
                        @endphp
                        @foreach($image_type as $rows)
                        @if(!empty($rows) && file_exists(BLOG_IMAGE_ROOT_PATH.$rows))
                        @php
                        $root_path = BLOG_IMAGE_ROOT_PATH;
                        $http_path = BLOG_IMAGE_URL;
                        $attribute = [];
                        $types = '';
                        $attribute['alt'] = 'user-profile';
                        $attribute['class'] = 'userProfileImage circle-img';
                        $attribute['width'] = '75';
                        $attribute['height'] = '75';
                        $attribute['cropratio'] = '1:1';
                        $attribute['zc'] = '1';
                        $image_name = isset($rows) ? $rows : '';
                        $image = CustomHelper::showImageWithLightBox($root_path, $http_path, $image_name, $types, $attribute);
                        @endphp
                        {!! $image !!}
                        @endif
                        @php $i++; @endphp
                        @endforeach
                     </td>
                  </tr>
                  <tr>
                     <th class="" width="10%">{{ trans('messages.global.status') }}</th>
                     <td>
                        @if ($result->is_active == ACTIVE)
                        <span class="label label-success">{{ trans('messages.global.activated') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('messages.global.inactive') }}</span>
                        @endif
                     </td>
                     <th class="" width="10%">{{ trans('messages.global.created_on') }}</th>
                     <td>
                        {{ isset($result->created_at) ? CustomHelper::displayDate($result->created_at) : 'N/A' }}
                     </td>
                  </tr>
                  <tr>
                     <th class="" width="10%">{{ trans("messages.$modelName.meta_title") }}</th>
                     <td>
                        {{ isset($result->meta_title) ? $result->meta_title : '' }}
                     </td>
                     <th class="" width="10%">{{ trans("messages.$modelName.meta_keyword") }}</th>
                     <td>
                        {{ isset($result->meta_keyword) ? $result->meta_keyword : '' }}
                     </td>
                  </tr>
                  <tr>

                     <th class=""  >{{ trans("messages.$modelName.meta_description") }}</th>
                     <td colspan="3" >
                        {{ isset($result->meta_description) ? $result->meta_description : '' }}
                     </td>
                  </tr>
                  <tr>
                     <table class="row-border hover table table-bordered" cellspacing="0" width="100%">
                        @if(count($languages) > 1)
                        <tr>
                           <th colspan="" class=""></th>
                           @foreach($languages as $langCode => $title)
                           <th colspan="" class="">{{ $title }}</th>
                           @endforeach
                        </tr>
                        @endif
                        <tr>
                           <th class="">{{ trans("messages.$modelName.title") }}</th>
                           @foreach($languages as $langCode => $title)
                           <td>
                              {{ isset($multiLanguage[$langCode]['title']) ? $multiLanguage[$langCode]['title'] : 'N/A' }}
                           </td>
                           @endforeach
                        </tr>
                        <tr>
                           <th class="">{{ trans("messages.$modelName.description") }}</th>
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
