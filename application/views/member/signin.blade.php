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
{{Form::horizontal_open(action('member@signin'),null,array('id'=>'signinForm'))}}
{{Form::control_group(Form::label('email','Email'),Form::xlarge_text('email',Input::old('email'),array('placeholder'=>'Email')),'')}}
{{Form::control_group(Form::label('password','Password'),Form::password('password',array('placeholder'=>'Password')),'')}}
{{Form::actions(array(Buttons::primary_submit('Sign in')))}}
{{Form::close()}}
@endsection