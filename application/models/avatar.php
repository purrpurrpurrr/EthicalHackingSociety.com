<?php

class Avatar extends Eloquent
{
	public function member()
	{
		return $this->belong_to('Member');
	}
}