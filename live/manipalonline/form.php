<div class="form-group">
	
	<input type="text" name="name" class="form-control name" placeholder="Enter Your Name">
	<div class="errormsg frm_name_error">Please enter full name.</div>
	<div class="errormsg frm_name_error2">Please enter a valid name.</div>
</div>
<div class="form-group">
	
	<input type="text" name="email" class="form-control email" placeholder="Enter Your Email">
	<div id="" class="errormsg frm_email_error">Please enter your email.</div>
	<div id="" class="errormsg frm_email_error2">Please enter your valid email.</div>
</div>

<div class="form-group">
	<div class="form-group">	
		<input type="text" name="contactno" class="form-control contactno <?php echo $mobileTextClass; ?>"
			id="txtContact<?php echo $mobileTextClass; ?>" onchange="SendOTP('<?php echo $mobileTextClass; ?>')"
			onpaste="return false;" oncopy="return false;" maxlength="10" placeholder="Mobile Number*"
			onkeypress="return isNum(event)" style="border-radius: 0;" />
		<div class="errormsg frm_contactno_error">Please enter your mobile number.</div>
		<div class="errormsg frm_contactno_error2">Mobile number should be 10 digit.</div>
		<div class="errormsg frm_contactno_error3">Please enter valid mobile number.</div>
	</div>
	<div class="form-group" id="dvotp">
		<div class="position-relative">
			<div class="otp-container" style="width: 100%; max-width: 400px;">
				<input type="text" id="txtotpmobile01" maxlength="6" class="form-control txtotp txtotpmobile01"
					placeholder="Enter OTP" aria-required="true"
					style="width: 100%; padding: 5px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-size: 16px;"
					autocomplete="off">

				<div class="button-group" style="display: flex; justify-content: space-between; gap: 10px;">
					<input id="btnVerifymobile01" class="btnVerify form-control" onclick="VerifyOTP('mobile01');"
						type="button" value="Verify"
						style="flex: 1; background: #4a90e2; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer;"
						autocomplete="off">

					<input id="btnResendmobile01" class="btnResend form-control" onclick="ResendCode('mobile01');"
						type="button" value="Resend"
						style="flex: 1; background: #4a90e2; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer;"
						autocomplete="off">

					<input id="btnVerifySuccessmobile01" class="btnVerifySuccess form-control" type="button"
						value="Verified"
						style="flex: 1; background: #4a90e2; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: not-allowed; display:none;"
						autocomplete="off">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	
	<select name="course" class="form-select course" aria-label="Default select example">
		<option value="" selected="selected">Select Your Course</option>
		<option value="BBA">BBA</option>
		<option value="BCOM">BCOM</option>
		<option value="BCA">BCA</option>
		<option value="MBA">MBA</option>
		<option value="MCOM">MCOM</option>
		<option value="MCA">MCA</option>
		<option value="MAJMC">MAJMC</option>
	</select>
	<div id="" class="errormsg frm_course_error">Please select course.</div>
</div>

<div class="form-group">
	
	<select name="state" class="form-select state" aria-label="Default select example">
		<option value="" selected="selected">Select Your State</option>
		<option value="Andhra Pradesh">Andhra Pradesh</option>
		<option value="Arunachal Pradesh">Arunachal Pradesh</option>
		<option value="Assam">Assam</option>
		<option value="Bihar">Bihar</option>
		<option value="Chhattisgarh">Chhattisgarh</option>
		<option value="Delhi">Delhi</option>
		<option value="Goa">Goa</option>
		<option value="Gujarat">Gujarat</option>
		<option value="Haryana">Haryana</option>
		<option value="Himachal Pradesh">Himachal Pradesh</option>
		<option value="Jharkhand">Jharkhand</option>
		<option value="Karnataka">Karnataka</option>
		<option value="Kerala">Kerala</option>
		<option value="Madhya Pradesh">Madhya Pradesh</option>
		<option value="Maharashtra">Maharashtra</option>
		<option value="Manipur">Manipur</option>
		<option value="Meghalaya">Meghalaya</option>
		<option value="Mizoram">Mizoram</option>
		<option value="Nagaland">Nagaland</option>
		<option value="Odisha">Odisha</option>
		<option value="Punjab">Punjab</option>
		<option value="Rajasthan">Rajasthan</option>
		<option value="Sikkim">Sikkim</option>
		<option value="Tamil Nadu">Tamil Nadu</option>
		<option value="Telangana">Telangana</option>
		<option value="Tripura">Tripura</option>
		<option value="Uttar Pradesh">Uttar Pradesh</option>
		<option value="Uttarakhand">Uttarakhand</option>
		<option value="West Bengal">West Bengal</option>
	</select>
	<div id="" class="errormsg frm_state_error">Please select state.</div>
</div>
<div class="btn-submit">
	<button type="submit" class="btn btn-primary inputID online-mba-submit"><b>Submit</b></button>

	<input type="button" name="submitting_form" value="Submitting form..."
		class="btn btn-primary submitting_form inputID" style="margin-top: 15px;" />

</div>