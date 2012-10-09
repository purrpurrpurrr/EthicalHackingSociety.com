<?php

class Static_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		// Welcome page
		return View::make("static.index");
	}
	public function get_community()
	{
		return View::make("static.community");
	}
}