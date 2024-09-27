grecaptcha.ready(function() {
    grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
        document.getElementById('g-recaptcha-response-survey').value = token;
    });
});


getState(country, "state", "city", "enquiry_state_div", "enquiry_city_div", "enquireNowForm", "", "form-select");
  



phoneNumValidate('phoneNumberCustomerEnquiry', 'UserPhoneCustomer_enquiry_error', 'phoneCustomerEnquiry', 'stu_dial_codeCustomer_enquiry',
    'not_valid_mobile_customer_enquiry');
$(document).ready(function() {
    var dateOfBirth = 'date_of_birth';
    showDateInPast(dateOfBirth, calDateFormat);



    $(document).on('blur', '.contactnoEnquiry', function() {
        SendOTP(mobileTextClassEnquiry);
    });
});