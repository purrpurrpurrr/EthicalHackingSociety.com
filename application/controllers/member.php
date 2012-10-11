<?php

class Member_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$members = User::all();
		$view = View::make('member.index', array('members'=>$members));
		return $view;
	}
	public function get_signup()
	{
		$view = View::make('member.signup');
		return $view;
	}
	public function post_signup()
	{
		$rules =
		array(
			'email'    => 'required|unique:users',
			'password' => 'required'
			);
		$messages = array('required'=> 'The :attribute is required!');
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validations errors';
		$member = new User;
		$member->email    = Input::get('email');
		$member->password = Hash::make(Input::get('password'));
		// Check if email is Abertay
		$pattern_abertay = '/\d{7}@live.abertay.ac.uk/';
		$regex = preg_match($pattern_abertay, $member->email);
		if($regex == 1)
		{
			// Autofill student id if it is
			$member->student_id = substr($member->email, 0, 7);
			// If Duncan allows us to, we could use current database to grab the name
			// $member->name = $name_from_current;
		}
		$member->save();
		Auth::login($member);
		return Redirect::to_action('member@settings');
		# TODO
		# send verification email
	}
	public function get_signin()
	{
		$view = View::make('member.signin');
		return $view;
	}
	public function post_signin()
	{
		if(Auth::attempt(array('username'=>Input::get('email'),'password'=>Input::get('password'))))
		{
			return Redirect::to_action('member@settings');
		}
		else
		{
			// Unsuccessful auth attempt
			return 'TODO: auth errors';
		}
	}
	public function get_signout()
	{
		Auth::logout();
		return Redirect::to_action('meeting');
	}
	public function get_verify($supplied_key = false)
	{
		if(!$supplied_key) return 'TODO: verification errors';
		// Keys _must_ be unique in the database, so using ->first() here is OK
		$stored_key = Verification::where('value','=',$supplied_key)->first();
		if($stored_key->value == $supplied_key)
		{
			$member = $stored_key->member()->get();
			$member->verified = true;
			$member->save();
			$stored_key->delete();
			return 'TODO: success message';
		}
		else
		{
			return 'TODO: error message';
		}
	}
	public function get_pwreset($supplied_key = false)
	{
		if(!$supplied_key) return 'TODO: pwreset errors';
		$stored_key = PwReset::where('value','=',$supplied_key)->first();
		if($stored_key->value == $supplied_key)
		{
			$member = $stored_key->member()->get();
			$newPassword = Str::random(14);
			$member->password = Hash::make($newPassword);
			$member->save();
			// TODO: send email with new password
		}
	}
	public function get_rpwreset()
	{
		$view = View::make('member.rpwreset');
		return $view;
	}
	public function post_rpwreset()
	{
		// TODO: generate and send key
	}
	public function get_profile($id)
	{
		$member = Member::find($id);
		$view = View::make('member.profile', array('member'=>$member));
		return $view;
	}
	public function get_settings()
	{
		$member = Auth::user();
		$view = View::make('member.settings', array('member'=>$member));
		return $view;
	}
	// AJAX
	public function get_paid($id)
	{
		$member = User::find($id);
		$member->paid = true;
		$member->save();
		return 'AJAX success response';
	}
	public function post_avatar()
	{
		# code...
	}
	public function post_settings()
	{
		$rules = 
		array(
			'name'       => 'required',
			'student_id' => 'required'
			);
		$messages = 
		array(
			'required' => 'The :attribute is required!'
			);
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validation errors';
		$member = Auth::user();
		$member->name       = Input::get('name');
		$member->student_id = Input::get('student_id');
		$member->save();
		return 'AJAX success response';
	}
	public function post_changepassword()
	{
		$rules = 
		array(
			'old_password' => 'required',
			'new_password' => 'required|confirmed'
			);
		$messages =
		array(
			'required'  => 'The :attribute is required!',
			'confirmed' => 'The :attribute must be confirmed!'
			);
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validation errors';
		$member = Auth::user();
		// This has to be moved to model!
		$old_password_in = Hash::make(Input::get('old_password'));
		if($old_password_in != $member->password) return 'TODO: validation errors';
		$member->password = Hash::make(Input::get('new_password'));
		return 'AJAX success response';
	}
}