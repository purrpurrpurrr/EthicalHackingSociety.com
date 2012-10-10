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
			'email'    => 'required',
			'password' => 'required'
			);
		$messages = array('required'=> 'The :attribute is required!');
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validations errors';
		// TODO:
		// email checked against regexp
		// -> on success student id is compared to Duncan's list
		// -> on success all the additional fields are filled from Duncan's list
		// -> else redirected to settings page to fill in the details
		$user =
		User::create(
			array(
				'email'    => Input::get('email'),
				'password' => Hash::make(Input::get('password'))
				));
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
		$member->save()
		return 'AJAX success response';
	}
	public function post_avatar()
	{
		# code...
	}
	public function post_settings()
	{
		# code...
	}
	public function post_changepassword()
	{
		# code...
	}
}