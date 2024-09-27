$(document).ready(function () {
    AutoCompleteTextBox('txtCity', 'hfCity', '', '../../index.aspx/SearchCity', '::', 'CitySelected');
    DisplayPrograms();

    $.event.special.inputchange = {
        setup: function () {
            var self = this, val;
            $.data(this, 'timer', window.setInterval(function () {
                val = self.value;
                if ($.data(self, 'cache') != val) {
                    $.data(self, 'cache', val);
                    $(self).trigger('inputchange');
                }
            }, 20));
        },
        teardown: function () {
            window.clearInterval($.data(this, 'timer'));
        },
        add: function () {
            $.data(this, 'cache', this.value);
        }
    };

    var timer;
    var delay = 400; // 0.4 seconds delay after last input

    $('#txtEmailID').bind('input', function () {
        $('#imgLoading_Email').show();
        $('#imgLoading_Email_Ok').hide();
        $('#p_Error').hide();
        $('#p_Error').text('');
        window.clearTimeout(timer);
        timer = window.setTimeout(function () {
            //insert delayed input change action/event here
            var EmailID = $('#txtEmailID').val();
            var Source = $('#hfSource').val();
            CheckEmailMobile(EmailID, 'e', Source, 'imgLoading_Email');

        }, delay);
    });

    $('#txtMobileNo').bind('input', function () {
        $('#imgLoading_Mobile').show();
        $('#imgLoading_Mobile_Ok').hide();
        $('#p_Error').hide();
        $('#p_Error').text('');
        window.clearTimeout(timer);
        timer = window.setTimeout(function () {
            //insert delayed input change action/event here
            var MobileNo = $('#txtMobileNo').val();
            var Source = $('#hfSource').val();
            CheckEmailMobile(MobileNo, 'm', Source, 'imgLoading_Mobile');

        }, delay);
    });

    


    $('#txtCity').keyup(function () {
        $('#hfCity').val('');
    });

    //$('#txtCity').keydown(function () {
    //    $('#hfCity').val('');
    //});
  
    $('#btnRegisterNow').click(function () {
        // CheckValidators();
        var valName = ($('#rfvStudentName').attr('style').indexOf('hidden') != -1 ? '1' : '0');

        var valEmail = ($('#rfvEmailId').attr('style').indexOf('hidden') != -1 ? '1' : '0');
        var valEmailValid = ($('#rfvEmailId1').attr('style').indexOf('hidden') != -1 ? '1' : '0');
        var valMobile = ($('#rfvMobileNo').attr('style').indexOf('hidden') != -1 ? '1' : '0');
        var valMobile1 = ($('#rfvMobileNo1').attr('style').indexOf('hidden') != -1 ? '1' : '0');
        var valProgram = ($('#rfvProgram').attr('style').indexOf('hidden') != -1 ? '1' : '0');

        var valDay = ($('#ddlDate').val() == "" || $('#ddlDate').val() == "0" ? '0' : '1');
        var valMonth = ($('#ddlMnt').val() == "" || $('#ddlMnt').val() == "0" ? '0' : '1');
        var valYear = ($('#ddlyear').val() == "" || $('#ddlyear').val() == "0" ? '0' : '1');

        if (valName == '1' && valEmail == '1' && valEmailValid == '1' && valMobile == '1' && valMobile1 == '1' && valProgram == '1' && valDay == '1' && valMonth == '1' && valYear == '1') {
            if ($('#p_Error').text() == '') {
               var CityId = $('#hfCity').val();

                if (CityId != '') {
                var Name = $('#txtStudentName').val();
                var EmailId = $('#txtEmailID').val();
                var MobileNo = $('#txtMobileNo').val();
                var ProgramCode = $('#ddlProgram').val();
                var CityId = $('#hfCity').val();
                /*var CityId = '0';*/
                var Day = $('#ddlDay').val();
                var Month = $('#ddlMnt').val();
                var Year = $('#ddlyear').val();
                var Source = $('#hfSource').val();
                    var IsMobile = 'pc';
                    
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i['test'](navigator['userAgent'])) {
                    IsMobile = 'mobile'
                    }

                    var MobileOTP = $('#txtMobileOTP').val();

                var PreviousPageURL = $('#hfPreviousPageUrl').val();
                    var RegFormType = $('#hfRegFormType').val();

                    var OTPRequired = $('#hfOTPRequired').val();
                    if (OTPRequired == '0') {

                        IDOLRegistrationWithoutOTP(Name, Day, Month, Year, EmailId, MobileNo, ProgramCode, Source, CityId, IsMobile, PreviousPageURL);
                    } else {
                        IDOLRegistration(Name, Day, Month, Year, EmailId, MobileNo, ProgramCode, Source, CityId, IsMobile, PreviousPageURL, MobileOTP);

                    }

                }
                else {
                    $('#txtCity').addClass('required-field');
                    swal('ERROR', 'City not valid, please type your City & select from list', 'error');
                }
            }
            else {
                swal('ERROR', 'Some details are invalid, check below message', 'error');
            }
        }
        return false;
    });

    $("#btn_already_registered, #btnLogin").click(function () {
        $('#div_regform').hide();
        $('#div_loginform').show();

        return false;
    });
    

    $('#btn_register_now, #btnApplyNow, .btnApply').click(function () {

        $('#div_regform').show();
        $('#div_loginform').hide();

        return false;
    }); 



    $('#txtPassword').keypress(function (e) {
        if (e.keyCode == 13)
        { $('#btnSignIn').click(); return false; }
    });

    $('#txtUserId').keypress(function (e) {
        if (e.keyCode == 13)
        { $('#btnSignIn').click(); return false; }
    });

    $('#btnSignIn').click(function () {
        // CheckLoginValidators();
        SignIn();
        return false;
    });

});

function SignIn() {

    var userid = $('#txtUserId').val();
    var password = $('#txtPassword').val();

    if (userid == '') {
        $('#txtUserId').addClass('required-field');
    }

    if (password == '') {
        $('#txtPassword').addClass('required-field');
    }

    if (userid != '' && password != '') {
        ValidateUser(userid, password)
    }
    return false
}

function ValidateUser(userid, password) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        url: 'index.aspx/ValidateUser',
        data: '{userid:"' + userid + '",password:"' + password + '"}',
        success: function (msg) {
            var data = msg.d;
            var response_data = data.split('**')[0];
            var response = response_data.split(':')[0];
            var message = response_data.split(':')[1];
            var redirecturl = data.split('**')[1];

            if (response == 'success') {
                if (redirecturl != '') {
                    window.location.href = redirecturl;
                }
                else {
                    $('#p_LoginError').text(message);
                }
            }
            else {
                $('#p_LoginError').text(message);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    })
}


function CheckEmailMobile(data, type, Source, target) {
    $('#' + target + '_Ok').attr('title', '');
    $.ajax({
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        url: 'index.aspx/CheckEmailMobile',
        data: '{data:"' + data + '",type:"' + type + '",Source:"' + Source + '"}',
        success: function (msg) {
            $('#' + target).hide();

            $('#' + target + '_Ok').show();
            if (msg.d == 'ok') {
                if (type == 'e') {

                    setTimeout(function () {
                        if (!validateEmail(data)) {
                            $('#' + target + '_Ok').attr('src', 'assets/images/cross-tick.png');
                        }
                        else {
                            $('#' + target + '_Ok').attr('src', 'assets/images/green-tick.png');
                        }
                    }, 500);


                }
                else if (type == 'm') {
                    if (data.length == 10) {
                        $('#' + target + '_Ok').attr('src', 'assets/images/green-tick.png');
                    }
                    else {
                        $('#' + target + '_Ok').attr('src', 'assets/images/cross-tick.png');
                    }
                }


            }
            else {
                if (data != '') {
                    $('#p_Error').text(msg.d);
                    $('#p_Error').show();
                    $('#' + target + '_Ok').attr('title', msg.d);
                    $('#' + target + '_Ok').attr('src', 'assets/images/cross-tick.png');
                }
                else {
                    $('#p_Error').text('');
                    $('#p_Error').hide();
                    $('#' + target + '_Ok').attr('title', '');
                    $('#' + target + '_Ok').hide();
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}



function IDOLRegistration(Name, Day, Month, Year, EmailId, Mobile, ProgramCode, source, City, isMobile, PreviousUrl, MobileOTP) {
    $('#btnRegisterNow').prop('disabled', 'disabled');
    var CountryCode = $('.selected-dial-code').text();
    $.ajax({
        type: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        url: "index.aspx/Registration",
        data: "{Name:'" + Name + "',Day:'" + Day + "',Month:'" + Month +
            "',Year:'" + Year + "',EmailId:'" + EmailId + "',Mobile:'" + Mobile + "',ProgramCode:'" + ProgramCode + "',source:'" + source + "',City:'" + City + "',isMobile:'" + isMobile + "',CountryCode:'" + CountryCode + "',MobileOTP:'" + MobileOTP + "'}",
        success: function (msg) {
            var data = msg.d;
            var val = data.split('@@@@')[0];
            var message = data.split('@@@@')[1];
            if (val == '1' || val == '0') {
                if (val == '1') {
                    //Clear();
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: 'Registration successful, please check your Email for userid and password',
                        timer: 2000
                    });
                    setTimeout(function () {
                        window.location.href = 'thanks.html'
                    }, 2000)
                } else {
                    swal('Error!', message, 'error');
                    $('#btnRegisterNow').prop('disabled', '');
                }
            } else {
                swal('Error!', message, 'error');
                $('#btnRegisterNow').prop('disabled', '');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
}

function IDOLRegistrationWithoutOTP(Name, Day, Month, Year, EmailId, Mobile, ProgramCode, source, City, isMobile, PreviousUrl) {
    $('#btnRegisterNow').prop('disabled', 'disabled');
    var CountryCode = $('.selected-dial-code').text();
    $.ajax({
        type: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        url: "index.aspx/RegistrationWithoutOTP",
        data: "{Name:'" + Name + "',Day:'" + Day + "',Month:'" + Month +
            "',Year:'" + Year + "',EmailId:'" + EmailId + "',Mobile:'" + Mobile + "',ProgramCode:'" + ProgramCode + "',source:'" + source + "',City:'" + City + "',isMobile:'" + isMobile + "',CountryCode:'" + CountryCode + "'}",
        success: function (msg) {
            var data = msg.d;
            var val = data.split('@@@@')[0];
            var message = data.split('@@@@')[1];
            if (val == '1' || val == '0') {
                if (val == '1') {
                    //Clear();
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: 'Registration successful, please check your Email for userid and password',
                        timer: 2000
                    });
                    setTimeout(function () {
                        window.location.href = 'thanks.html'
                    }, 2000)
                } else {
                    swal('Error!', message, 'error');
                    $('#btnRegisterNow').prop('disabled', '');
                }
            } else {
                swal('Error!', message, 'error');
                $('#btnRegisterNow').prop('disabled', '');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
}

function DisplayPrograms() {
    $('#ddlProgram').html('<option>Loading Programs</option>');
    $.ajax({
        type: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        url: "index.aspx/DisplayPrograms",
        data: "{Source:'" + $('#hfSource').val() + "'}",
        success: function (msg) {
            $('#ddlProgram').html(msg.d);
        }
        ,
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
}

$("#ddlProgram").on('change', function () {
    if ($(this).val() == "0") {
        $(this).addClass("chgColor");
    }
    else {
        $(this).removeClass("chgColor");
    }
});

$("#ddlDay").on('change', function () {
    if ($(this).val() == "0") {
        $(this).addClass("chgColor");
    }
    else {
        $(this).removeClass("chgColor");
    }
});

$("#ddlMnt").on('change', function () {
    if ($(this).val() == "0") {
        $(this).addClass("chgColor");
    }
    else {
        $(this).removeClass("chgColor");
    }
});

$("#ddlyear").on('change', function () {
    if ($(this).val() == "0") {
        $(this).addClass("chgColor");
    }
    else {
        $(this).removeClass("chgColor");
    }
});

function CitySelected() {
    try {
        var CityIdFull = $('#hfCity').val();

        $('#hfCity').val(CityIdFull.split(':')[0]);
    } catch (e) {

    }

}