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

	/**
	 * Css loader factory
	 * @return CssLoader
	 */
	public function createComponentCss()
	{
		return $this->context->createBackendCss();
	}

	/**
	 * Js loader factory
	 * @return JsLoader
	 */
	public function createComponentJs()
	{
		return $this->context->createBackendJs();
	}
	
	/**
	* Preview action for texyla. This generate preview. 
	*/
	public function actionPreview()
	{
		$post = $this->context->getService("httpRequest")->getPost("texy");
		$html = \Nette\Utils\Strings::trim($this->context->texy->process($post));
		$response = new \Nette\Application\Responses\TextResponse($html);
		$this->sendResponse($response);
	}
	
	/**
	* Handle sign out. Function is accesable in all web.
	*/
	public function handleSignout()
 	{
		$this->getUser()->logout();
		$this->flashMessage("Byl jste odhlášen.", "success");
		$this->redirect("Homepage:");
	}
}
