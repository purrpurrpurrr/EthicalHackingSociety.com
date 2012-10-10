<?php

class Tag extends Eloquent
{
	public function articles()
	{
		return $this->has_many_and_belongs_to('Article');
	}
	public function meetings()
	{
		return $this->has_many_and_belongs_to('Meeting');
	}
}