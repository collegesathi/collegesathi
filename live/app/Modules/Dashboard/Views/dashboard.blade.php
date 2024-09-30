@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('dashboard') }}
@stop

@section('content')
	<div class="row clearfix">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="{{route('User.index')}}"class="info-box-link" >
			<div class="info-box bg-purple hover-expand-effect">
				<div class="icon">
					<i class="material-icons">person_add</i>
				</div>
				<div class="content">
					<div class="text">{{trans("messages.global.total_active_customer")}}</div>
					<div class="number count-to" data-from="0" data-to="<?php echo isset($totalActiveCustomers) ? $totalActiveCustomers : 0; ?>" data-speed="1000" data-fresh-interval="20">
						<?php echo isset($totalActiveCustomers) ? $totalActiveCustomers : INACTIVE; ?>
					</div>
				</div>
			</div>
			</a>
		</div>


		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="{{route('Career.job_requests',[LIST_TYPE])}}"class="info-box-link" >
			<div class="info-box bg-orange hover-expand-effect">
				<div class="icon">
					<i class="material-icons">work</i>
				</div>
				<div class="content">
					<div class="text">{{trans("messages.global.total_job_apply_requests")}}</div>
					<div class="number count-to" data-from="0" data-to="<?php echo isset($totalJobApplies) ? $totalJobApplies : 0; ?>" data-speed="1000" data-fresh-interval="20">
						<?php echo isset($totalJobApplies) ? $totalJobApplies : INACTIVE; ?>
					</div>
				</div>
			</div>
			</a>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="{{route('Scholarship.index',LIST_TYPE)}}"class="info-box-link" >
			<div class="info-box bg-red hover-expand-effect">
				<div class="icon">
					<i class="material-icons">school</i>
				</div>
				<div class="content">
					<div class="text">{{trans("messages.global.total_scholarship_requests")}}</div>
					<div class="number count-to" data-from="0" data-to="<?php echo isset($totalScholarshipRequests) ? $totalScholarshipRequests : 0; ?>" data-speed="1000" data-fresh-interval="20">
						<?php echo isset($totalScholarshipRequests) ? $totalScholarshipRequests : INACTIVE; ?>
					</div>
				</div>
			</div>
			</a>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="{{route('Referral.index',LIST_TYPE)}}"class="info-box-link" >
			<div class="info-box bg-blue hover-expand-effect">
				<div class="icon">
					<i class="material-icons">room_preferences</i>
				</div>
				<div class="content">
					<div class="text">{{trans("messages.global.total_referrals")}}</div>
					<div class="number count-to" data-from="0" data-to="<?php echo isset($totalReferrals) ? $totalReferrals : 0; ?>" data-speed="1000" data-fresh-interval="20">
						<?php echo isset($totalReferrals) ? $totalReferrals : INACTIVE; ?>
					</div>
				</div>
			</div>
			</a>
		</div>
	</div>
@stop