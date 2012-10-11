<?php

class Resource extends Eloquent
{
	public function member()
	{
		return $this->belongs_to('User');
	}
}