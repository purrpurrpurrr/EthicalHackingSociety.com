<?php

class Verification extends Eloquent
{
	public function member()
	{
		return $this->belongs_to('Member');
	}
}