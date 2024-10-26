<div class="modal fade" id="reviewRatingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal_applynow">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ trans('front_messages.global.review_and_raiting') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="apply_now_modal_box">
                    <div class="bg-white details_box_main">
                        {{ Form::open(['role' => 'form', 'files' => true, 'class' => 'mws-form', 'files' => true, 'id' => 'reviewSubmitForm']) }}
                        {{ Form::hidden('university_id', isset($result->id) && !empty($result->id) ? $result->id : '', ['class' => 'form-control', 'id' => 'university_id']) }}

                        @php
                        if (Auth::check()) {
							$user_id = Auth::user()->id;
                        } 
						else {
							$user_id = '';
                        } 
                        @endphp
                        {{ Form::hidden('user_id', isset($user_id) && !empty($user_id) ? $user_id : '', ['class' => 'form-control', 'id' => 'slug']) }}
                        <div class="form_col_12">
                            {{ Form::label('rating', trans('front_messages.global.rating') . ' <span class="required"> * </span>', ['class' => 'control-label'], false) }}

                            <div data-score="0" class="raty reviews" id="raty"></div>
                            <span id="Rating_error" class="has-error error error-message"></span>
                            <span class="error help-inline score error-message">
                                {{ $errors->first('score') }}
                            </span>

                        </div>

                        <div class="form_col_12 mt-3">
                            {{ Form::label('messages', trans('front_messages.global.messages') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                            {{ Form::textarea('review_message', isset($result->reviewRating->review_message) ? $result->reviewRating->review_message : '', ['class' => 'form-control ta10em reviews', 'id' => 'textarea', 'maxlength' => REVIEW_RATING_MAX_LENGTH]) }}

                            <span><b id="rchars">{{ REVIEW_RATING_MAX_LENGTH }}</b>
                                {{ trans('front_messages.global.character_remaining') }}</span>
                            <br>
                            <span class="error help-block help-inline review_message error-message">
                                {{ $errors->first('review_message') }}
                            </span>
                        </div>
                        <div class="contact_btn mt-5">
                            <button type="submit" class="btn btn-primary submitReview">{{ trans('front_messages.global.submit') }}
                            </button>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>