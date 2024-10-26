@extends('layouts.default')
@section('content')
	@section('title',$pageTitle)


	<main class="main-container">
		<div class="my-account-wrap">
			<div class="container">
				<div class="my-account-row">


					<div class="my-account-right-content">
						<div class="account_right">

                       

                    <div class="dashboard_form tutor_dashboard">

                        <div class="basic_info basic_infoview ">
                            <div class="title_row">
                                <h2>{{ trans('front_messages.global.my_profile') }}</h2>
                            </div>



                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.$modelName.first_name") }}</label>
                                        <p>{{ isset($userDetails->first_name) ? $userDetails->first_name : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.$modelName.last_name") }}</label>
                                        <p>{{ isset($userDetails->last_name) ? $userDetails->last_name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.global.mobile_number") }}</label>
                                        <p>{{ isset($userDetails->phone) ? $userDetails->phone : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.global.email_address") }}</label>
                                        <p>{{ isset($userDetails->email) ? $userDetails->email : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.global.country") }}</label>
                                        <p>{{ isset($userDetails->countryName->country_name) ? $userDetails->countryName->country_name : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.global.state") }}</label>
                                        <p>{{ isset($userDetails->stateName->state_name) ? $userDetails->stateName->state_name : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.global.city") }}</label>
                                        <p>{{ isset($userDetails->cityName->city_name) ? $userDetails->cityName->city_name : 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ trans("front_messages.$modelName.address") }}</label>
                                        <p>
                                            {{ isset($userDetails->address_one) ? $userDetails->address_one : 'N/A' }}
                                        </p>
                                    </div>
                                </div>


                        </div>
                        <div class="save-btn">
                            <a href="{{ route('User.editProfile') }}">
                                <button class="btn btn-primary"
                                    type="submit">{{ trans('front_messages.global.edit') }}</button>
                            </a>
                        </div>

                    </div>
                 </div>
            </div>
		</div>
	</main>


@stop
