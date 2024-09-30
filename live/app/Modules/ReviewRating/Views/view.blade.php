@extends('admin.layouts.default')
@section('content')

    <!-- start rating js-->
    {{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'jquery.raty.css') }}
    {{ HTML::script(WEBSITE_ADMIN_JS_URL . 'jquery.raty.js') }}

    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans("messages.$modelName.table_heading_view") }}
                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            <li>
                                <a href='{{ route("$modelName.index", $type) }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover ">

                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.global.user") }}</th>
                                <td>{{ isset($result->getUserDetails->full_name) ? ucwords($result->getUserDetails->full_name) : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.global.university") }}</th>
                                <td>{{ isset($result->getUniversityDetails->title) ? ucwords($result->getUniversityDetails->title) : 'N/A' }}
                                </td>
                            </tr>
                            
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.global.rating") }}</th>
                                <td> <span class="rating" data-score='{{ $result->rating }}'></span> </td>
                            </tr>

                            <tr>
                                <th class="text-right" width="30%">{{ trans('messages.global.message') }}</th>
                                <td>
                                    {!! $result->review_message !!}</td>
                            </tr>

                            
                            <tr>
                                <th class="text-right" width="30%">{{ trans('messages.global.created') }}</th>
                                <td data-th='{{ trans('messages.global.created_on') }}'>
                                    {{ $result->created_at }}</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--View user detail div end here -->
    <!-- start rating script-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.rating').raty({
                path: '{{ WEBSITE_IMG_URL }}',
                targetKeep: true,
                readOnly: true,
                score: function() {
                    return $(this).attr('data-score');
                }
            });
        });

    </script>
    <!-- end rating script-->
@stop
