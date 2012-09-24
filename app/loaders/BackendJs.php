<?php

namespace BackendModule;

class BackendJs extends \JSU\WebLoader\JavaScriptLoader
{

	protected function getFiles()
	{
		return array(
			"js/jquery-1.7.2.min.js",
			"js/netteForms.js",
			"js/jquery.nette.js",
			"js/jquery-ui-1.8.19.custom.min.js",

			"bootstrap/js/bootstrap.js"			
		);
	}

}