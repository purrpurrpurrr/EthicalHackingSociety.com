<?php

class Comment extends Eloquent
{
	public function meeting()
	{
		return $this->belongs_to('Meeting');
	}
	public function article()
	{
		return $this->belongs_to('Article');
	}
}