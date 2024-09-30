<div class="modal fade beneficiary-popup change_password" id="changePasswordModal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePasswordModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="add-beneficiary">

                    <div class="login-box signup-box">
                        <div class="container">
                            <div class="main-box">

                                <div class="signup-form">
                                    <h3>{{ trans('front_messages.User.change_password') }}</h3>

                                    {{ Form::open(['role' => 'form', 'route' => 'User.change_password', 'id' => 'changePasswordForm']) }}

                                    <div class="signup-input">
                                        <div class="form-input">
                                            <div class="form-inner-section">
                                                <label
                                                    class="form-label">{{ trans('front_messages.User.old_password') }}
                                                    <span class="field-required"> *
                                                    </span></label>
                                                {{ Form::password('old_password', ['class' => 'userPassword form-control pwdOld oldPass', 'placeholder' => trans('front_messages.User.old_password')]) }}
                                            </div>
                                            <span class="error help-inline old_password user_edit_old_password_error">
                                                {{ $errors->first('old_password') }}
                                            </span>
                                        </div>
                                        <div class="form-input password">
                                            <div class="form-inner-section">
                                                <label
                                                    class="form-label">{{ trans('front_messages.User.new_password') }}
                                                    <span class="field-required"> *
                                                    </span></label>
                                                {{ Form::password('new_password', ['id' => 'formGroupExampleInput', 'class' => 'userPassword form-control pwd onlyRePass', 'placeholder' => trans('front_messages.User.new_password')]) }}

                                                <a href="javascript:void(0);" class="visibility-icon">
                                                    <img src="{{ WEBSITE_IMG_URL }}eye-closed-icon.svg"
                                                        alt="hide-password">
                                                </a>
                                            </div>
                                            <span class="error help-inline new_password user_edit_new_password_error">
                                                {{ $errors->first('new_password') }}
                                            </span>
                                        </div>
                                        <div class="form-input cpassword">
                                            <div class="form-inner-section">
                                                <label
                                                    class="form-label">{{ trans('front_messages.User.confirm_password') }}<span
                                                        class="field-required"> *
                                                    </span></label>
                                                {{ Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'userPassword form-control pwd onlyRePass', 'placeholder' => trans('front_messages.User.confirm_password')]) }}
                                                <a href="javascript:void(0);" class="visibility-cicon">
                                                    <img src="{{ WEBSITE_IMG_URL }}eye-closed-icon.svg"
                                                        alt="hide-password">
                                                </a>
                                            </div>
                                            <span
                                                class="error help-inline confirm_password user_edit_confirm_password_error">
                                                {{ $errors->first('confirm_password') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="login btn-primary">{{ trans('front_messages.User.change_password') }}</button>
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
    var change_password_url = '{{ route('User.change_password') }}';
</script>
