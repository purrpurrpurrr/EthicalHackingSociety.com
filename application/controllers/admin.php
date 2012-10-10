<?php

class Admin_Controller extends Base_Controller
{
	public $restful = true;
	// Admin panel will be managed through here! E.g. drop paid statuses in the beginning of new academic year
	public function get_addmeeting()
	{
		$view = View::make('admin.form-addmeeting');
		return $view;
	}
	/**
	 * Force add meeting straight to approved ones
	 * @return Redirect to meeting details
	 */
	public function post_addmeeting()
	{
		$rules =
		array(
			'title' => 'required',
			'body'  => 'required',
			'room'  => 'required',
			'when'  => 'required'
			);
		$messages = array('required' => 'The :attribute is required!');
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validations errors';
		$meeting =
		new Meeting(
			array(
				'title'  => Input::get('title'),
				'body'   => Input::get('body'),
				'room'   => Input::get('room'),
				'when'   => Input::get('when'),
				'status' => 1
				));
		Auth::user()->meetings()->save($meeting);
		return Redirect::to_action('meetings@details', array($meeting->id));
	}
}