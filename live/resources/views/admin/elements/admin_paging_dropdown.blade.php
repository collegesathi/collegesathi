<?php

$recordPerPageAction = Config::get('Reading.records_per_pag_action');

$queryStringArray = Request::query();

unset($queryStringArray['records_per_page']);
unset($queryStringArray['page']);

?>

<form class="form-horizontal" method="get">

	@if(!empty($queryStringArray))
		@foreach($queryStringArray as $key => $rowList)

		{{ Form::hidden($key,$rowList) }}

		@endforeach
	@endif

	<label>Show
		<select class="lstfld60" style="width:85px;" name="records_per_page" onchange="this.form.submit();">
			<?php
				if ($recordPerPageAction != '') {
					$recordPerPageActionArray = explode(',', $recordPerPageAction);
				}
			?>

			<option value="{{ Config::get('Reading.records_per_page')}}" selected="selected">Default</option>
			@if(!empty($recordPerPageActionArray))
				@foreach($recordPerPageActionArray as $value)
					<option @if(Request::get('records_per_page')==$value) selected="selected" @endif >{{ $value }} </option>
				@endforeach
			@endif
		</select>
	</label>
</form>
