<?php

class Article extends Eloquent
{
	// public static $table = 'users_table';
	// public static $timestamps = false;
	
	public function author()
	{
		return $this->belongs_to('Member');
	}
	public function tags()
	{
		return $this->has_many_and_belongs_to('Tag');
	}
	public function comments()
	{
		return $this->has_many('Comment');
	}
}