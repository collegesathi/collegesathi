<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <input type="text" name="fname" id="fname" class="form-control" placeholder="first Name">
         <div id="form_fname_error" class="errormsg">Please enter first name.</div>
         <div id="form_fname_error2" class="errormsg">Please enter a valid name.</div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
         <div id="form_lname_error" class="errormsg">Please enter last name.</div>
         <div id="form_lname_error2" class="errormsg">Please enter a valid name.</div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <input type="text" name="fotemail" id="email" class="form-control" placeholder="Email Address">
         <div id="form_email_error" class="errormsg">Please enter your email.</div>
         <div id="form_email_error2" class="errormsg">Please enter your valid email.</div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <input type="text" name="fotmobile" id="contactno" class="form-control" placeholder="mobile Number" maxlength="10">
         <div id="form_contactno_error" class="errormsg">Please enter your mobile number.</div>
         <div id="form_contactno_error2" class="errormsg">Mobile number should be 10 digit.</div>
         <div id="form_contactno_error3" class="errormsg">Please enter valid mobile number.</div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
   <div class="form-group">      
      <select class="form-select mx_University_Name" name="mx_University_Name" id="mx_University_Name" aria-label="Default select example">    
         <option value="" selected>Select University</option>
         <?php foreach($universityNames as $universityName){ ?> 
			<option value="<?php echo $universityName; ?>"><?php echo $universityName; ?></option>
		<?php } ?>
      </select>
      <div id="form_university_error" class="errormsg form_university_error">Please select university.</div>
   </div>
   </div>
</div>



<?php if ($from_fb) {?>
      <input type="hidden" id="from_fb" name="from_fb" value="<?php echo $from_fb; ?>">
   <?php }?>
   <?php if ($source) {?>
      <input type="hidden" id="source" name="source" value="<?php echo $source; ?>">
   <?php }?>
   <?php if ($source_campaign) {?>
      <input type="hidden" id="source_campaign" name="source_campaign" value="<?php echo $source_campaign; ?>">
   <?php }?>
   <?php if ($source_medium) {?>
      <input type="hidden" id="source_medium" name="source_medium" value="<?php echo $source_medium; ?>">
   <?php }?>


<div class="row">
   <div class="col-md-12">
      <div class="btn-submit">
         <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary inputID online-counsel-submit">
         <input type="button" name="submitting_form" value="Submitting form..." class="btn btn-primary online-counsel-submiting-form inputID">
      </div>
   </div>
</div>