<?php

namespace App\Core;

class View
{
	public function generate($content_view, $template_view, $data = null)
	{
		include '../App/Views/'.$template_view;
	}
}


?>