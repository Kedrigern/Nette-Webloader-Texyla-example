<?php


abstract class BasePresenter extends \Nette\Application\UI\Presenter
{

	/**
	 * Texyla loader factory
	 * @return TexylaLoader
	 */
	protected function createComponentTexyla()
	{
		$control = $this->context->createBackendJs();
		
		$control->addFilter(new \WebLoader\Filter\VariablesFilter(array(
			"baseUri" => $this->template->baseUrl,
			"previewPath" => $this->link("preview"),
		)));
		
		$control->addFiles(array(
			
			"texyla/js/texyla.js",
			"texyla/js/selection.js",
			"texyla/js/texy.js",
			"texyla/js/buttons.js",
			"texyla/js/dom.js",
			"texyla/js/view.js",
			"texyla/js/window.js",

				// languages
			"texyla/languages/cs.js",

			// plugins
			"texyla/plugins/keys/keys.js",
			"texyla/plugins/resizableTextarea/resizableTextarea.js",
			"texyla/plugins/table/table.js",
			"texyla/plugins/link/link.js",
			"texyla/plugins/emoticon/emoticon.js",
			"texyla/plugins/symbol/symbol.js",
			"texyla/plugins/color/color.js",
			"texyla/plugins/textTransform/textTransform.js",
			
			"js/texyla-init.js",
		));

		return $control;		
	}
	
	public function createComponentCss()
	{
		return $this->context->createBackendCss();
	}

	public function createComponentJs()
	{
		return $this->context->createBackendJs();
	}
	public function actionPreview()
	{
		$post = $this->context->getService("httpRequest")->getPost("texy");
		$html = \Nette\Utils\Strings::trim($this->context->texy->process($post));
		$response = new \Nette\Application\Responses\TextResponse($html);
		$this->sendResponse($response);
  }
}
