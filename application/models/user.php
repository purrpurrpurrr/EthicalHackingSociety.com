<?php

class User extends Eloquent
{
	public function meetings()
	{
		return $this->has_many_and_belongs_to('Meeting');
	}
	public function groups()
	{
		return $this->has_many_and_belongs_to('Group');
	}
	public function articles()
	{
		return $this->has_many('Article');
	}
	public function verification()
	{
		return $this->has_many('Verification');
	}
	public function pwresets()
	{
		return $this->has_many('PwReset');
	}
	public function avatar()
	{
		return $this->has_one('Avatar');
	}
}