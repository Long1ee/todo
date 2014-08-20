<?php

class Model
{
	public function humanDate()
	{
		return date("Y.M.d", strtotime($this->createdAt));
	}
}