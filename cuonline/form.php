
<div class="bg2">
	<div class="container-fluid section01">
		<div class="container">
			<div class="row">
				<div class="col-md-7 newone">
					<h2>Master of Business Administration</h2>
					<p id="newadmissionDate" style="font-weight: 600; color: #00305b;"></p>
					<p><img src="images/bottom-logo-panel.png" class="img-responsive"  alt="img" /></p>
					<h4 style="margin-bottom: 15px;">START YOUR US &amp; UK ACCREDITED ONLINE DEGREE.</h4>                        
					<form class="servicefrm" name="servicefrm">
<div class="row mr-bt-20">
	<div class="col-md-6">
		<input type="text" class="name" name="name" id="txtName" onpaste="return false;" oncopy="return false;" placeholder="Name" onkeypress="return  OnlyAlphaValidationWithSpace(event)" />
		<div class="errormsg frm_name_error">Please enter full name.</div>
		<div class="errormsg frm_name_error2">Please enter a valid name.</div>
	</div>
	<div class="col-md-6">
		<input id="txtEmail" name="email" class="email" onpaste="return false;" oncopy="return false;" placeholder="Email" type="text">
		<div id="" class="errormsg frm_email_error">Please enter your email.</div>
		<div id="" class="errormsg frm_email_error2">Please enter your valid email.</div>
	</div>
</div>
<div class="row mr-bt-20">
	<div class="col-md-6">                                
		<input type="text" name="contactno" class="form-control contactno <?php echo $mobileTextClass; ?>" id="txtContact<?php echo $mobileTextClass; ?>" onchange="SendOTP('<?php echo $mobileTextClass; ?>')" onpaste="return false;" oncopy="return false;" maxlength="10" placeholder="Mobile Number*" onkeypress="return isNum(event)" style="border-radius: 0;" /> 
		<div class="errormsg frm_contactno_error">Please enter your mobile number.</div>
		<div class="errormsg frm_contactno_error2">Mobile number should be 10 digit.</div>
		<div class="errormsg frm_contactno_error3">Please enter valid mobile number.</div>
	</div>
	<div id="dvotp" class="col-md-6 row-btm">
		<div class="colmyclass otpclassp" style="padding: 0;">
			<input type="text" id="txtotp<?php echo $mobileTextClass; ?>" maxlength="6" class="form-control txtotp txtotp<?php echo $mobileTextClass; ?>" placeholder="OTP" aria-required="true" style="border-radius: 0;">
			
			<input id="btnVerify<?php echo $mobileTextClass; ?>" class="btnVerify form-control" onclick="VerifyOTP('<?php echo $mobileTextClass; ?>');" type="button" value="Verify" style="background: #8fbeec none repeat scroll 0 0; color: #000; border-radius: 0;">
			<input id="btnResend<?php echo $mobileTextClass; ?>" class="btnResend form-control" onclick="ResendCode('<?php echo $mobileTextClass; ?>');" type="button" value="Resend" style="background: #8fbeec none repeat scroll 0 0; color: #000; border-radius: 0;">
			<input id="btnVerifySuccess<?php echo $mobileTextClass; ?>" class="btnVerifySuccess form-control" type="button" value="Verified" style="background: #8fbeec none repeat scroll 0 0; color: #000; display:none; border-radius: 0;">
		</div>
	</div>
</div>
<div class="row mr-bt-20">
	<div class="col-md-6">
		<select class="form-select form-control city" name="city" aria-label="Default select example">
         <option value="" selected>Select City *</option>
         <optgroup label="Metro Cities">
            <option value="New Delhi">New Delhi</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Chennai">Chennai</option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Kolkata">Kolkata</option>
            <option value="Pune">Pune</option>
            <option value="Ahmedabad">Ahmedabad</option>
            <option value="Jaipur">Jaipur</option>
         </optgroup>
         <optgroup label="Andaman Nicobar Islands">
            <option value="Andaman Island">Andaman Island</option>
            <option value="Nicobar Islands">Nicobar Islands</option>
            <option value="Other:Andaman">Other</option>
         </optgroup>
         <optgroup label="Arunachal Pradesh">
            <option value="Itanagar">Itanagar</option>
            <option value="Other:Arunachal">Other</option>
         </optgroup>
         <optgroup label="Andhra Pradesh">
            <option value="Hyderabad">Hyderabad</option>
            <option value="Tirupati">Tirupati</option>
            <option value="Vijayawada">Vijayawada</option>
            <option value="Visakhapatnam">Visakhapatnam</option>
            <option value="Warangal">Warangal</option>
            <option value="Other:AndhraPradesh">Other</option>
         </optgroup>
         <optgroup label="Assam">
            <option value="Guwahati">Guwahati</option>
            <option value="Dispur">Dispur</option>
            <option value="Tezpur">Tezpur</option>
            <option value="Other:Assam">Other</option>
         </optgroup>
         <optgroup label="Bihar">
            <option value="Gaya">Gaya</option>
            <option value="Nalanda">Nalanda</option>
            <option value="Patna">Patna</option>
            <option value="Rajgir">Rajgir</option>
            <option value="Vaishali">Vaishali</option>
            <option value="Other:Bihar">Other</option>
         </optgroup>
         <optgroup label="Chhattisgarh">
            <option value="Raipur">Raipur</option>
            <option value="Other:Chhattisgarh">Other</option>
         </optgroup>
         <optgroup label="Delhi">
            <option value="Faridabad">Faridabad</option>
            <option value="Ghaziabad">Ghaziabad</option>
            <option value="Greater Noida">Greater Noida</option>
            <option value="Gurgaon">Gurgaon</option>
            <option value="New Delhi">New Delhi</option>
            <option value="Noida">Noida</option>
            <option value="Other:Delhi">Other</option>
         </optgroup>
         <optgroup label="Goa">
            <option value="Canacona">Canacona</option>
            <option value="Mapusa">Mapusa</option>
            <option value="Margao">Margao</option>
            <option value="Old Goa">Old Goa</option>
            <option value="Panaji">Panaji</option>
            <option value="Ponda">Ponda</option>
            <option value="Vasco Da Gama">Vasco Da Gama</option>
            <option value="Other:Goa">Other</option>
         </optgroup>
         <optgroup label="Gujarat">
            <option value="Ahmedabad">Ahmedabad</option>
            <option value="Anand">Anand</option>
            <option value="Gandhinagar">Gandhinagar</option>
            <option value="Rajkot">Rajkot</option>
            <option value="Surat">Surat</option>
            <option value="Vadodara">Vadodara</option>
            <option value="Other:Gujarat">Other</option>
         </optgroup>
         <optgroup label="Haryana">
            <option value="Chandigarh">Chandigarh</option>
            <option value="Faridabad">Faridabad</option>
            <option value="Gurgaon">Gurgaon</option>
            <option value="Karnal">Karnal</option>
            <option value="Other:Haryana">Other</option>
         </optgroup>
         <optgroup label="Himachal Pradesh">
            <option value="Dharamsala">Dharamsala</option>
            <option value="Kullu">Kullu</option>
            <option value="Manali">Manali</option>
            <option value="Shimla">Shimla</option>
            <option value="Other:HimachalPradesh">Other</option>
         </optgroup>
         <optgroup label="Jammu and Kashmir">
            <option value="Gulmarg">Gulmarg</option>
            <option value="Jammu">Jammu</option>
            <option value="Ladakh">Ladakh</option>
            <option value="Leh">Leh</option>
            <option value="Pahalgam">Pahalgam</option>
            <option value="Srinagar">Srinagar</option>
            <option value="Other:JammuKashmir">Other</option>
         </optgroup>
         <optgroup label="Jharkhand">
            <option value="Dhanbad">Dhanbad</option>
            <option value="Jamshedpur">Jamshedpur</option>
            <option value="Ranchi">Ranchi</option>
            <option value="Other:Jharkhand">Other</option>
         </optgroup>
         <optgroup label="Karnataka">
            <option value="Bangalore">Bangalore</option>
            <option value="Davangere">Davangere</option>
            <option value="Hampi">Hampi</option>
            <option value="Hassan">Hassan</option>
            <option value="Hubli">Hubli</option>
            <option value="Mangalore">Mangalore</option>
            <option value="Mysore">Mysore</option>
            <option value="Udupi">Udupi</option>
            <option value="Other:Karnataka">Other</option>
         </optgroup>
         <optgroup label="Kerala">
            <option value="Alleppey">Alleppey</option>
            <option value="Cochin">Cochin</option>
            <option value="Kovalam">Kovalam</option>
            <option value="Kozhikode">Kozhikode</option>
            <option value="Kumarakom">Kumarakom</option>
            <option value="Munnar">Munnar</option>
            <option value="Quilon">Quilon</option>
            <option value="Thekkady">Thekkady</option>
            <option value="Trivandrum">Trivandrum</option>
            <option value="Other:Kerala">Other</option>
         </optgroup>
         <optgroup label="Lakshadweep">
            <option value="Lakshadweep">Lakshadweep</option>
            <option value="Other:Lakshadweep">Other</option>
         </optgroup>
         <optgroup label="Madhya Pradesh">
            <option value="Bhopal">Bhopal</option>
            <option value="Gwalior">Gwalior</option>
            <option value="Indore">Indore</option>
            <option value="Khajuraho">Khajuraho</option>
            <option value="Orchha">Orchha</option>
            <option value="Ujjain">Ujjain</option>
            <option value="Other:MadhyaPradesh">Other</option>
         </optgroup>
         <optgroup label="Maharashtra">
            <option value="Amravati">Amravati</option>
            <option value="Aurangabad">Aurangabad</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Nagpur">Nagpur</option>
            <option value="Nashik">Nashik</option>
            <option value="Navi Mumbai">Navi Mumbai</option>
            <option value="Pune">Pune</option>
            <option value="Thane">Thane</option>
            <option value="Other:Maharashtra">Other</option>
         </optgroup>
         <optgroup label="Manipur">
            <option value="Imphal">Imphal</option>
            <option value="Other:Manipur">Other</option>
         </optgroup>
         <optgroup label="Meghalaya">
            <option value="Shillong">Shillong</option>
            <option value="Other:Meghalaya">Other</option>
         </optgroup>
         <optgroup label="Mizoram">
            <option value="Aizawl">Aizawl</option>
            <option value="Other:Mizoram">Other</option>
         </optgroup>
         <optgroup label="Nagaland">
            <option value="Kohima">Kohima</option>
            <option value="Other:Nagaland">Other</option>
         </optgroup>
         <optgroup label="Odisha">
            <option value="Bhubaneswar">Bhubaneswar</option>
            <option value="Cuttack">Cuttack</option>
            <option value="Konark">Konark</option>
            <option value="Puri">Puri</option>
            <option value="Other:Odisha">Other</option>
         </optgroup>
         <optgroup label="Pondicherry">
            <option value="Pondicherry">Pondicherry</option>
            <option value="Other:Pondicherry">Other</option>
         </optgroup>
         <optgroup label="Punjab">
            <option value="Amritsar">Amritsar</option>
            <option value="Ludhiana">Ludhiana</option>
            <option value="Patiala">Patiala</option>
            <option value="Phagwara">Phagwara</option>
            <option value="Other:Punjab">Other</option>
         </optgroup>
         <optgroup label="Rajasthan">
            <option value="Ajmer">Ajmer</option>
            <option value="Alwar">Alwar</option>
            <option value="Bhilwara">Bhilwara</option>
            <option value="Bikaner">Bikaner</option>
            <option value="Bundi">Bundi</option>
            <option value="Jaisalmer">Jaisalmer</option>
            <option value="Jaipur">Jaipur</option>
            <option value="Jodhpur">Jodhpur</option>
            <option value="Kota">Kota</option>
            <option value="Ranakpur">Ranakpur</option>
            <option value="Shekhawati">Shekhawati</option>
            <option value="Udaipur">Udaipur</option>
            <option value="Other:Rajasthan">Other</option>
         </optgroup>
         <optgroup label="Sikkim">
            <option value="Gangtok">Gangtok</option>
            <option value="Other:Sikkim">Other</option>
         </optgroup>
         <optgroup label="Tamil Nadu">
            <option value="Chennai">Chennai</option>
            <option value="Coimbatore">Coimbatore</option>
            <option value="Kanyakumari">Kanyakumari</option>
            <option value="Kodaikanal">Kodaikanal</option>
            <option value="Madurai">Madurai</option>
            <option value="Ooty">Ooty</option>
            <option value="Rameshwaram">Rameshwaram</option>
            <option value="Thanjavur">Thanjavur</option>
            <option value="Trichy">Trichy</option>
            <option value="Other:TamilNadu">Other</option>
         </optgroup>
         <optgroup label="Tripura">
            <option value="Agartala">Agartala</option>
            <option value="Other:Tripura">Other</option>
         </optgroup>
         <optgroup label="Uttar Pradesh">
            <option value="Agra">Agra</option>
            <option value="Aligarh">Aligarh</option>
            <option value="Allahabad">Allahabad</option>
            <option value="kanpur">kanpur</option>
            <option value="Lucknow">Lucknow</option>
            <option value="Meerut">Meerut</option>
            <option value="Muzaffarnagar">Muzaffarnagar</option>
            <option value="Varanasi">Varanasi</option>
            <option value="Other:UttarPradesh">Other</option>
         </optgroup>
         <optgroup label="Uttarakhand/Uttaranchal">
            <option value="Dehradun">Dehradun</option>
            <option value="Haridwar">Haridwar</option>
            <option value="Nainital">Nainital</option>
            <option value="Rishikesh">Rishikesh</option>
            <option value="Roorkee">Roorkee</option>
            <option value="Other:Uttaranchal">Other</option>
         </optgroup>
         <optgroup label="West Bengal">
            <option value="Burdwan">Burdwan</option>
            <option value="Darjeeling">Darjeeling</option>
            <option value="Durgapur">Durgapur</option>
            <option value="Kolkata">Kolkata</option>
            <option value="Murshidabad">Murshidabad</option>
            <option value="Siliguri">Siliguri</option>
            <option value="Other:WestBengal">Other</option>
         </optgroup>
      </select>
	</div>
	<div id="" class="errormsg frm_city_error">Please select city.</div>
</div>
<div class="row">
	<div class="col-md-12">
		<input type="checkbox" id="chkbox" style="width: 15px;height: 15px;margin: 0;" />
		<span class="consentmsgdesclass" style="font-size: 12px; line-height: 21px; text-align: left;">I authorise Amity University Online and its associates to contact me with updates &amp; notifications via Email, SMS, WhatsApp, and Voice call as per the Privacy Policy. This consent will override any registration for DNC / NDNC.</span>
	
		<div id="" class="errormsg frm_chkbox_error">Please authorise us by click the checkbox.</div>
	</div>
</div>

<?php if($from_fb){ ?>
	<input type="hidden" id="from_fb" name="from_fb" value="<?php echo $from_fb;?>">
<?php } ?>
<?php if ($source) {?>
	<input type="hidden" id="source" name="source" value="<?php echo $source; ?>">
<?php }?>
<?php if ($source_campaign) {?>
	<input type="hidden" id="source_campaign" name="source_campaign" value="<?php echo $source_campaign; ?>">
<?php }?>
<?php if ($source_medium) {?>
	<input type="hidden" id="source_medium" name="source_medium" value="<?php echo $source_medium; ?>">
<?php }?>
 
<input id="btnSubmit" type="submit" name="submit" value="SUBMIT" class="btnsubmit inputID online-mba-submit" style="margin-top: 15px;" />
<input type="button" name="submitting_form" value="Submitting form..." class="btnsubmit online-mba-submiting-form inputID"style="margin-top: 15px;" />
					</form>                        
				</div>
			</div>
		</div>
	</div>
</div>