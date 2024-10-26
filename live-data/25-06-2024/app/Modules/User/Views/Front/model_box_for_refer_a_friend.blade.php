<div class="modal fade beneficiary-popup refer_a_friend" id="openReferAFriendModal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="openReferAFriendModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="add-beneficiary refer_a_friend">
                    <div class="login-box signup-box">
                        <div class="container">
                            <div class="main-box">

                                <div class="signup-form">
                                    <h3>{{ trans('front_messages.User.refer_a_friend') }}</h3>

                                    {{ Form::open(['role' => 'form', 'route' => 'User.referPromocode', 'id' => 'referAFriendForm']) }}
                                    <div class="signup-input">
                                        <div class="form-input cpassword">
                                            <div class="form-inner-section">
                                                {{ Form::label('email', trans('messages.User.email') . '<span class="required"> * </span>', ['class' => 'form-label'], false) }}
                                                {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => trans('front_messages.User.enter_email')]) }}
                                            </div>
                                            <span class="error help-inline email user_Refer_email_error">
                                                {{ $errors->first('email') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="login btn-primary">{{ trans('front_messages.global.submit') }}</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var refer_promocode_url = '{{ route('User.referPromocode') }}';
</script>
