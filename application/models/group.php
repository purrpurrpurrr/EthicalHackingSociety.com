<?php

class Group extends Eloquent
{
	public function members()
	{
		return $this->has_many_and_belongs_to('Member');
	}
}