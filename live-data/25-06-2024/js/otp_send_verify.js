function SendOTP(MobileClass) {
    var Mobile = $('.' + MobileClass).val();
    // alert(Mobile);
    if (Mobile != "" && Mobile.length == 10) {
        $.ajax({
            url: veryfyotp,
            data: {
                Mobile: Mobile
            },
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            dataType: 'json', 
            success: function(result) {
                console.log(result.response.type);
                if (result.response.type == "success") {
                    $("#OTPCode").val(result.response.OTP);
                    sweetAlert("We have sent 4 digits verification code to your given mobile.", "", "success").then(function() {
                        $("#OTPCode").val();
                        // $(".txtotp"+MobileClass).removeAttr("disabled");
                        // $('.txtotp'+MobileClass).focus();
                    });
                }
            },
            error: function() {
                swal("Error  : otp not sent");
            }
        });
    }
}

function VerifyOTP(MobileClass) { 
    // alert(MobileClass);
    var txtbxotp = $(".txtotp"+MobileClass).val();
    if (txtbxotp == "" || txtbxotp == undefined)
    {
        swal("Please Enter OTP Code.");
    }
    else
    {
        var UEntry = $(".txtotp"+MobileClass).val();
        var Real = $("#OTPCode").val();
        if (UEntry == Real) {
            Success = 1;
            $("#btnVerify"+MobileClass).hide();
            $("#btnResend"+MobileClass).hide();
            $("#btnVerifySuccess"+MobileClass).show();
            $("#otp_veryfy").val('verified');

            $('#surveyForm').formValidation('addField', 'otp_veryfy');
            $('#applyUniversityForm').formValidation('addField', 'otp_veryfy');
        }
        else {  
            Success = 0;
            swal("Please Enter Valid OTP Code.");
        }
    }
}

function ResendCode(MobileClass) {
    SendOTP(MobileClass);
}