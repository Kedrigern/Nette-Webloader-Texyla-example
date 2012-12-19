<?php namespace MyForms;
/** @author Ondřej Profant, 2012 */

use Nette\Forms\Container,
    Nette\Application\UI\Form;

/**
 *    BaseContainer which prepare modular hierarchy of form
 */
abstract class BaseContainer extends Container
{
    public function __construct()
    {
        parent::__construct();
        $this->monitor('Nette\Forms\Form');
    }

    protected function attached($obj)
    {
        parent::attached($obj);
        if ($obj instanceof \Nette\Forms\Form) {
            $this->currentGroup = $this->form->currentGroup;
            $this->configure();
        }
    }

    abstract protected function configure();
}