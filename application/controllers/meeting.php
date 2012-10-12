<?php

class Meeting_Controller extends Base_Controller
{
	public $restful = true;

	// This needs to be discussed together:
	// Maybe there should be branching for users with admin rights when making views?
	// Maybe there should be branching for users with admin rights inside templates? (may get cluttered)
	public function get_index()
	{
		$meetings = Meeting::past_or_today_approved();
		$view = View::make('meeting.index', array('meetings'=>$meetings));
		return $view;
	}
	public function get_upcoming()
	{
		$meetings = Meeting::upcoming_approved();
		$view = View::make('meeting.index', array('meetings'=>$meetings));
		return $view;
	}
	public function get_suggested()
	{
		$meetings = Meeting::suggested();
		$view = View::make('meeting.index', array('meetings'=>$meetings));
		return $view;
	}
	public function get_details($id)
	{
		$meeting = Meeting::find($id);
		$view = View::make('meeting.details', array('meeting'=>$meeting));
		return $view;
	}
	public function get_suggest()
	{
		$view = View::make('meeting.form-suggest');
		return $view;
	}
	public function post_suggest()
	{
		// Validation rules
		$rules = 
		array(
			'title' => 'required',
			'body'  => 'required'
			);
		// Error messages
		$messages = array('required' => 'The :attribute is required!');
		// Try validating
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validation errors';
		// Create new meeting
		$meeting = 
		new Meeting(
			array(
				'title' => Input::get('title'),
				'body'  => Input::get('body')
				));
		// Save it to the database
		Auth::user()->meetings()->save($meeting);
		// Redirect user to the resulting page
		return Redirect::to_action('meeting@details', array($meeting->id));
	}
	public function get_edit($id)
	{
		$meeting = Meeting::find($id);
		$view = View::make('meeting.form-edit', array('meeting'=>$meeting));
		return $view;
	}
	public function post_edit()
	{
		$rules = 
		array(
			'id'    => 'required',
			'title' => 'required',
			'body'  => 'required'
			);
		$messages = array('required' => 'The :attribute is required!');
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validations errors';
		$meeting = Meeting::find(Input::get('id'));
		$meeting->title = Input::get('title');
		$meeting->body  = Input::get('body');
		$meeting->save();
		return Redirect::to_action('meeting@details', array($meeting->id));
	}
	public function get_approve($id)
	{
		$meeting = Meeting::find($id);
		$view = View::make('meeting.form-approve', array('meeting'=>$meeting));
		return $view;
	}
	public function post_approve()
	{
		$rules = 
		array(
			'id'    => 'required',
			'title' => 'required',
			'body'  => 'required',
			'room'  => 'required',
			'when'  => 'required'
			);
		$messages = array('required' => 'The :attribute is required!');
		$validation = Validator::make(Input::all(), $rules, $messages);
		if($validation->fails()) return 'TODO: validations errors';
		$meeting = Meeting::find(Input::get('id'));
		$meeting->title  = Input::get('title');
		$meeting->room   = Input::get('room');
		$meeting->when   = Input::get('when');
		$meeting->body   = Input::get('body');
		$meeting->status = 1;
		$meeting->save();
		return Redirect::to_action('meeting@details', array($meeting->id));
	}
	/* AJAX FUNCTIONS */
	public function get_preview()
	{
		# Parse BBCodes and stuff if we are going to be using those. Return JSON output to use with jQuery.
	}
	public function get_remove($id)
	{
		Meeting::find($id)->delete();
		return 'TODO: Success alert for AJAX';
	}
	public function get_hide($id)
	{
		$meeting = Meeting::find($id);
		$meeting->status = 2;
		return 'TODO: Success alert for AJAX';
	}
	public function get_show($id)
	{
		$meeting = Meeting::find($id);
		$meetings->status = 1;
		$meeting->save();
		return 'TODO: Success alert for AJAX';
	}
	public function get_upvote($id)
	{
		$meeting = Meeting::find($id);
		$meeting->votes++;
		$meeting->save();
		return 'TODO: Success alert for AJAX';
	}
	public function get_downvote($id)
	{
		$meeting = Meeting::find($id);
		$meeting->votes--;
		$meeting->save();
		return 'TODO: Success alert for AJAX';
	}
}