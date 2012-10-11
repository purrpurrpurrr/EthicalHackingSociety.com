<?php

class Meeting extends Eloquent
{
	public function members()
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
	public function resources()
	{
		return $this->has_many('Resource');
	}
}