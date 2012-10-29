<?php
/**
 * Texyla loader
 *
 * @author Jan Marek
 */
class TexylaLoader extends WebLoader\Nette\JavaScriptLoader
{
	/** @var string */
	private $tempUri;
	/**
	 * Construct
	 * @param IContainer parent
	 * @param string name
	 */
	public function __construct($filter, $tempUri) {
		
		$files = new \WebLoader\FileCollection( WWW_DIR . "/texyla/");
		$files->addFiles(array(
			// core
			"js/texyla.js",
			"js/selection.js",
			"js/texy.js",
			"js/buttons.js",
			"js/dom.js",
			"js/view.js",
			"js/ajaxupload.js",
			"js/window.js",

			// languages
			"languages/cs.js",

			// plugins
			"plugins/keys/keys.js",
			"plugins/resizableTextarea/resizableTextarea.js",
			"plugins/table/table.js",
			"plugins/link/link.js",
			"plugins/emoticon/emoticon.js",
			"plugins/symbol/symbol.js",
			"plugins/color/color.js",
			"plugins/textTransform/textTransform.js",
			
			"../../www/js/texyla-init.js",
		));

		$compiler = \WebLoader\Compiler::createJsCompiler($files, WWW_DIR . "/webtemp");

		// setup filter
		$compiler->addFilter($filter);

		// minifying JS
//		$compiler->addFilter("JSMin::minify");

		parent::__construct($compiler, $tempUri);
	}

}
