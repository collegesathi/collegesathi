<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="defaultModalLabel">Email Detail </h4>
		</div>
		<div class="modal-body">
		 <table class="table table-bordered">
          <thead>
          </thead>
          <tbody>
              <?php 
					if(!empty($model)){  
						foreach($model as $result){ ?>
						<tr>
							<th><?php echo trans("messages.$modelName.email_to"); ?></th>
							<td data-th='<?php echo trans("messages.$modelName.email_to"); ?>'> <?php echo $result->email_to;  ?></td>
						</tr>
						<tr>
							<th><?php echo trans("messages.$modelName.email_from"); ?></th>
							<td data-th='<?php echo trans("messages.$modelName.email_from"); ?>'><?php  echo $result->email_from; ?></td>
						</tr>
						<tr>
							<th><?php echo trans("messages.$modelName.subject"); ?></th>
							<td data-th='<?php echo trans("messages.$modelName.subject"); ?>'><?php echo  $result->subject; ?></td>
						</tr>
						<tr>
							<th valign='top'><?php echo trans("messages.$modelName.message"); ?></th>
							<td data-th='<?php echo trans("messages.$modelName.message"); ?>'><?php  echo  $result->message; ?></td>
						</tr>
					<?php }	} ?>
          </tbody>
      </table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
		</div>
	</div>
</div>

