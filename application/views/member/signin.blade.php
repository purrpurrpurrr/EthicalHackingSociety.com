@layout('dev-master')

@section('page_content')
{{Form::horizontal_open(action('member@signin'))}}
{{Form::control_group(Form::label('email','Email'),Form::xlarge_text('email',null,array('placeholder'=>'Email')),'')}}
{{Form::control_group(Form::label('password','Password'),Form::password('password',array('placeholder'=>'Password')),'')}}
{{Form::actions(array(Buttons::primary_submit('Sign in')))}}
{{Form::close()}}
@endsection