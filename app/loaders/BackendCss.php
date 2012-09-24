<?php

namespace BackendModule;

class BackendCss extends \JSU\WebLoader\CssLoader
{

	protected function getFiles()
	{
		return array(
			"bootstrap/css/bootstrap.css",

			"css/ui-lightness/jquery-ui-1.8.20.custom.css",
			"texyla/css/style.css",
			"themes/default/theme.css",

		);
	}

}