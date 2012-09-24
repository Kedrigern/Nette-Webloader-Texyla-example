<?php

namespace JSU\WebLoader;

abstract class JavaScriptLoader extends \WebLoader\Nette\JavaScriptLoader
{

	public function __construct($wwwDir, $url)
	{
		$basePath = $url->basePath;

		$files = new \WebLoader\FileCollection($wwwDir);
    	// můžeme načíst i externí js
    	$files->addFiles($this->getFiles());
    	//$files->addRemoteFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
    	//$files->addFiles(array('netteForms.js', 'colorbox.js', 'web.js'));

    	$compiler = \WebLoader\Compiler::createJsCompiler($files, $wwwDir . '/temp');
		$compiler->addFilter( function ($code) {
			return \JSMin::minify($code); 
		});

		parent::__construct($compiler, $basePath . "temp");
	}

	abstract protected function getFiles();

	public function addFiles(array $files){
		$this->getCompiler()->getFileCollection()->addFiles($files);
	}
}