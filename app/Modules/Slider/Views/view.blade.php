@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('slider-page-view') }}
@stop

<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_index") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            @if($universitySlider)
                                <a href='{{ route("UniversitySlider.index",$uni_id)}}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{
                                        trans('messages.global.back') }}</button>
                                </a>
                            @else
                                <a href='{{ route("$modelName.index") }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{
                                        trans('messages.global.back') }}</button>
                                </a>
                            @endif

                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th class="text-right" width="30%">{{ trans("messages.$modelName.image") }}</th>
                            <td>
                                @if ($result->slider_image != '' && File::exists(SLIDER_ROOT_PATH . $result->slider_image))
                                    <a class="items-image" data-lightbox="roadtrip<?php echo $result->slider_image; ?>"
                                        href="<?php echo SLIDER_URL . $result->slider_image; ?>">
                                        {!! CustomHelper::showImage(SLIDER_ROOT_PATH, SLIDER_URL, $result->slider_image, '', ['alt' => $result->slider_image, 'height' => '70', 'width' => '200', 'zc' => 1]) !!}
                                    </a>
                                @else
                                    {{ 'No Image' }}
                                @endif

                            </td>
                        </tr>


                        <tr>
                            <th class="text-right">{{ trans("messages.$modelName.order") }}</th>
                            <td>
                                {{ isset($result->slider_order) ? strip_tags($result->slider_order) : 'N/A' }}
                            </td>
                        </tr>

                         <tr>
                            <th class="text-right">{{ trans("messages.$modelName.slider_url") }}</th>
                            <td>
                                    {{ isset($result->slider_url) ? strip_tags($result->slider_url) : 'N/A' }}
                            </td>
                        </tr>

                        <tr>
                            <table class="row-border hover table table-bordered" cellspacing="0" width="100%">
                                @if(count($languages) > 1)
                                    <tr>
                                        <th class="text-right"></th>

                                        @foreach($languages as $langCode => $title)
                                            <th class="text-right">{{ $title }}</th>
                                        @endforeach
                                    </tr>
                                @endif
                                <tr>
                                    <th class="text-right">{{ trans("messages.$modelName.slider_title") }}</th>

                                    @foreach($languages as $langCode => $title)
                                        <td>
                                            {{ isset($multiLanguage[$langCode]['slider_title']) ? $multiLanguage[$langCode]['slider_title'] : 'N/A' }}
                                        </td>
                                    @endforeach

                                </tr>
                                <tr>
                                    <th class="text-right" width="30%">
                                        {{ trans("messages.$modelName.slider_description") }}
                                    </th>

                                    @foreach($languages as $langCode => $title)
                                        <td>
                                            {!! isset($multiLanguage[$langCode]['slider_text']) ? $multiLanguage[$langCode]['slider_text'] : 'N/A' !!}
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
