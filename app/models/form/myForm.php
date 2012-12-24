<?php namespace MyForms;
/** @author Ondřej Profant, 2012 */

use Nette\Forms\Container,
    Nette\Application\UI\Form;

class MyForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->addGroup('User');
        $this['user'] = new userContainer();
        $this->addGroup('Personal');
        $this['name'] = new nameContainer();
        $this->addGroup('Address');
        $this['address'] = new addressContainer();
        $this->addGroup('');
        $this->addSubmit('submit', 'Odeslat')
            ->setAttribute('class', 'btn btn-large btn-primary');
    }
}