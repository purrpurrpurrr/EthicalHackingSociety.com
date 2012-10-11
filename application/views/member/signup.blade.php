@layout('dev-master')

@section('page_content')
{{Form::horizontal_open(action('member@signup'))}}
{{Form::control_group(Form::label('email','Email'),Form::xlarge_text('email',null,array('placeholder'=>'Email')),'',Form::block_help('Email hint'))}}
{{Form::control_group(Form::label('password','Password'),Form::password('password',array('placeholder'=>'Password')),'',Form::block_help('Password hint'))}}
{{Form::actions(array(Buttons::primary_submit('Sign up')))}}
{{Form::close()}}
@endsection