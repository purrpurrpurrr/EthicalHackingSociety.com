<?php

class Meeting_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		$meetings = Meeting::past_or_today_approved();
		$view = View::make('meetings.index', array('meetings'=>$meetings));
		return $view;
	}
	public function get_upcoming()
	{
		$meetings = Meeting::upcoming_approved();
		$view = View::make('meetings.upcoming', array('meetings'=>$meetings));
		return $view;
	}
	public function get_suggested()
	{
		$meetings = Meeting::suggested();
		$view = View::make('meetings.suggested', array('meetings'=>$meetings));
		return $view;
	}
	public function get_details($id)
	{
		$meeting = Meeting::find($id);
		$view = View::make('meetings.details', array('meeting'=>$meeting));
		return $view;
	}
	public function get_add()
	{
		// TODO: add code
	}
	public function post_add()
	{
		// TODO: add code
	}
	public function get_edit($id)
	{
		// TODO: edit code
	}
	public function post_edit()
	{
		// TODO: edit code
	}
	public function get_approve($id)
	{
		# code...
	}
	public function post_approve()
	{
		# code...
	}
	/* AJAX FUNCTIONS */
	public function get_remove($id)
	{
		# code...
	}
	public function get_hide($id)
	{
		# code...
	}
	public function get_show($id)
	{
		# code...
	}
	public function get_upvote($id)
	{
		# code...
	}
	public function get_downvote($id)
	{
		# code...
	}
}