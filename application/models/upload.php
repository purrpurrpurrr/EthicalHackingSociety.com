<?php

class Upload extends Eloquent
{
	public function meeting()
	{
		return $this->belongs_to('Meeting');
	}
	public function member()
	{
		return $this->belongs_to('User');
	}
}