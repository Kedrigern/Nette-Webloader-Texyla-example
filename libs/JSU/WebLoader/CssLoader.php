<?php

namespace JSU\WebLoader;

use WebLoader;

abstract class CssLoader extends WebLoader\Nette\CssLoader
{

	public function __construct($wwwDir, $url)
	{

		$basePath = $url->getBasePath();
		
	    // FileCollection v konstruktoru může dostat výchozí adresář, pak není potřeba psát absolutní cesty
		$files = new \WebLoader\FileCollection($wwwDir);

		// Předáme pole s soubory
		$files->addFiles($this->getFiles());

		// kompilátoru seznam předáme a určíme adresář, kam má kompilovat
		$compiler = \WebLoader\Compiler::createCssCompiler($files, $wwwDir . '/temp');

		// filters
		$compiler->addFileFilter(new \WebLoader\Filter\LessFilter);
		$compiler->addFileFilter(new \WebLoader\Filter\CssUrlsFilter($wwwDir, $basePath));

//		$compiler->setJoinFiles(FALSE);

		parent::__construct($compiler, $basePath . "temp");
	}

	abstract protected function getFiles();
}