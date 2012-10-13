@layout('dev-master')

@if(Session::has('errors'))
@section('docready')
@parent
$(document).ready(function(){
	var errors = '{{Session::get('errors')}}';
	$('#ajax-output').prepend(errors);
});
@endsection
@endif

@section('page_content')
{{Form::horizontal_open(action('member@signup'),null,array('id'=>'signupForm'))}}
{{Form::control_group(Form::label('email','Email'),Form::xlarge_text('email',Input::old('email'),array('placeholder'=>'Email')),'',Form::block_help('If you are a student, use your Abertay email.'))}}
{{Form::control_group(Form::label('password','Password'),Form::password('password',array('placeholder'=>'Password')),'',Form::block_help('At least 6 characters please.'))}}
{{Form::actions(array(Buttons::primary_submit('Sign up')))}}
{{Form::close()}}
@endsection