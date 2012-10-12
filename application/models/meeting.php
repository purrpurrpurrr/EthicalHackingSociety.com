<?php

class Meeting extends Eloquent
{
	const PERPAGE = 5;
	public function speakers()
	{
		return $this->has_many_and_belongs_to('User');
	}
	public function tags()
	{
		return $this->has_many_and_belongs_to('Tag');
	}
	public function comments()
	{
		return $this->has_many('Comment');
	}
	public function get_f_when()
	{
		return date('H:m \o\n l jS F',strtotime($this->get_attribute('when')));
	}
	public static function past_or_today_approved()
	{
		$date = new \DateTime;
		return self::where('when','<=',$date)->where('approved','=',true)->paginate(self::PERPAGE);
	}
	public static function upcoming_approved()
	{
		$date = new \DateTime;
		return self::where('when','>',$date)->where('approved','=',true)->paginate(self::PERPAGE);
	}
	public static function suggested()
	{
		return self::where('approved','=',false)->paginate(self::PERPAGE);
	}
}