<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="defaultModalLabel" style="display: contents;">{{ trans("messages.$modelName.table_heading_edit") }}</h4>
			<button type="button" class="close" data-dismiss="modal" style="color: #000 !important;">&times;</button>
		</div>
		<div class="modal-body">
			<div class="body table-responsive">
				<table class="table table-bordered table-striped table-hover ">
					<tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.name") }}</th>
						<td data-th='{{ trans("messages.$modelName.name") }}'>{{ ucfirst($model->name) }}</td>
					</tr>
					<tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.email") }}</th>
						<td data-th='{{ trans("messages.$modelName.email") }}'>{{ $model->email }}</td>
					</tr>

					<tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.phone") }}</th>
						<td data-th='{{ trans("messages.$modelName.phone") }}'>{{ $model->phone_number_with_dial_code }}</td>
					</tr>

                    <tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.university_id") }}</th>
						<td data-th='{{ trans("messages.$modelName.university_id") }}'>{{ isset($model->university_id) ? CustomHelper::getUniversiryNameById($model->university_id) : "N/A"}}</td>
					</tr>

                    <tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.course_type") }}</th>
						<td data-th='{{ trans("messages.$modelName.course_type") }}'>
                            <?php
                        $course_type = $model->course_type;
                        if(!empty( $course_type )){
                        echo CustomHelper::getConfigValue('COURSE_TYPE.'.$course_type);
                        }else{
                            echo "N/A";
                        }

                         ?>
                        </td>
					</tr>


                    <tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.state") }}</th>
						<td data-th='{{ trans("messages.$modelName.state") }}'>

                            <?php
                            if(!empty($model->state)){
                             echo  $state = CustomHelper::get_state_name($model->state);

                            }
                            else{
                               echo "N/A";
                            }
                           ?>
                        </td>
					</tr>
                    <tr>
						<th width="30%" class="text-right">{{ trans("messages.$modelName.city") }}</th>
						<td data-th='{{ trans("messages.$modelName.city") }}'>

                            <?php

                            if(!empty($model->city)){
                                echo $city = CustomHelper::get_city_name($model->city);

                            }
                            else{
                               echo "N/A";
                            }
                           ?>
                        </td>
					</tr>


					<tr>
						<th width="30%" valign="top" class="text-right white-space-pre">{{ trans("messages.$modelName.message") }}</th>
						<td data-th='{{ trans("messages.$modelName.message") }}'  class="white-space-pre"> {{ $model->message }}</td>
					</tr>
					<tr>
						<th width="30%" class="text-right">{{ trans("messages.global.Submitted_at") }}</th>
						<td data-th='{{ trans("messages.global.created") }}'>{{ CustomHelper::displayDate($model->created_at) }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
