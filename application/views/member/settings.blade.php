@layout('dev-master')
@section('page_content')
{{Form::horizontal_open(action('member@settings'),null,array('id'=>'settingsForm'))}}
{{Form::control_group(Form::label('name','Full name'),Form::xlarge_text('name',Auth::user()->name,array('placeholder'=>'Put something here!')),'')}}
{{Form::control_group(Form::label('student_id','Student ID'),Form::xlarge_text('student_id',Auth::user()->student_id,array('placeholder'=>'Put something here!')),'')}}
{{Form::actions(array(Buttons::primary_submit('Save')))}}
{{Form::close()}}
<div id="output"></div>
<script type="text/javascript">
	// AJAX code
	$('#settingsForm').live('submit', function(e){
		// Don't go the the submission page
		e.preventDefault();
		// Extract form data (there is probably a much neater way of doing this)
		var name = $('#name').val();
		var student_id = $('#student_id').val();
		// Send AJAX-post request
		$.post($(this).attr('action'), { name: name, student_id: student_id },
			function(data){
				// Display the response (we will use alert boxes) TODO
				$('#output').html(data);
			});
	}); 
</script>
@endsection