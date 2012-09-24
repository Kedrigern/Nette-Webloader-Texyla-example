<?php //netteCache[01]000377a:2:{s:4:"time";s:21:"0.14058600 1348483075";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:55:"/var/www/texyla/app/FrontModule/templates/@layout.latte";i:2;i:1348483070;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"f8aa369 released on 2012-08-30";}}}?><?php

// source file: /var/www/texyla/app/FrontModule/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '1xwc1wxqrt')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbd4e4819265_head')) { function _lbd4e4819265_head($_l, $_args) { extract($_args)
;
}}

//
// block _flash
//
if (!function_exists($_l->blocks['_flash'][] = '_lb3ec621aab6__flash')) { function _lb3ec621aab6__flash($_l, $_args) { extract($_args); $_control->validateControl('flash')
;$iterations = 0; foreach ($flashes as $flash): ?>      <div class="alert alert-<?php echo htmlSpecialChars($flash->type) ?>">
        <a class="close" data-dismiss="alert">×</a>
        <?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?>

      </div>
<?php $iterations++; endforeach ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
<?php if (isset($robots)): ?>    <meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

    <title></title>

<?php $_ctrl = $_control->getComponent("js"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("css"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;$_ctrl = $_control->getComponent("texyla"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

    <link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" type="image/x-icon" />

    <?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

  </head>

  <body style="margin-top: 60px;">

    <header class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:")) ?>">Web</a>

          <ul class="nav">
            <li <?php try { $_presenter->link("Dashboard:*"); } catch (Nette\Application\UI\InvalidLinkException $e) {}; if ($_presenter->getLastCreatedRequestFlag("current")): ?>
class="active"<?php endif ?>>
              <a href="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:")) ?>">Úvod</a>
            </li>
          </ul>

        </div>
      </div>
    </header>

    <div class="container main">
<div id="<?php echo $_control->getSnippetId('flash') ?>"><?php call_user_func(reset($_l->blocks['_flash']), $_l, $template->getParameters()) ?>
</div>
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
    </div>

    <footer>
    </footer>
  </body>
</html>
