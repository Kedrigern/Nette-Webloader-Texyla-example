<?php

namespace WebLoader\Nette;

use WebLoader\Compiler;
use WebLoader\FileCollection;

/**
 * Web loader
 *
 * @author Jan Marek
 * @license MIT
 */
abstract class WebLoader extends \Nette\Application\UI\Control
{

	/** @var \WebLoader\Compiler */
	private $compiler;

	/** @var string */
	private $tempPath;

	public function __construct(Compiler $compiler, $tempPath)
	{
		parent::__construct();
		$this->compiler = $compiler;
		$this->tempPath = $tempPath;
	}

	/**
	 * Get html element including generated content
	 * @param string $source
	 * @return \Nette\Utils\Html
	 */
	abstract public function getElement($source);

	/**
	 * Generate compiled file(s) and render link(s)
	 */
	public function render()
	{
		$hasArgs = func_num_args() > 0;

		if ($hasArgs) {
			$backup = $this->compiler->getFileCollection();
			$newFiles = new FileCollection($backup->getRoot());
			$newFiles->addFiles(func_get_args());
			$this->compiler->setFileCollection($newFiles);
		}

		// remote files
		foreach ($this->compiler->getFileCollection()->getRemoteFiles() as $file) {
			echo $this->getElement($file);
		}

		foreach ($this->compiler->generate() as $file) {
			echo $this->getElement($this->tempPath . '/' . $file->file . '?' . $file->lastModified);
		}

		if ($hasArgs) {
			$this->compiler->setFileCollection($backup);
		}
	}

	public function addFilter($filter){
		$this->compiler->addFilter($filter);
	}

	public function getCompiler(){
		return $this->compiler;
	}

}
