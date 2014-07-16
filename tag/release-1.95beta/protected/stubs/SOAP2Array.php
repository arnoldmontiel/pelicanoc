<?php

class SOAP2Array
{
	public function toArray()
	{
		return json_decode(json_encode($this), true);
	}
}
