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

class ArticleForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->addText('id', 'Id')
            ->setDisabled();
        $this->addText('name', 'Name')
            ->addRule(Form::FILLED, '%label is required.');
        $this->addSelect('user_id', 'Author');
        $this->addText('keywords', 'Keywords')
            ->setAttribute('class', 'input-xxlarge')
            ->setOption('description', 'Keywords separate by space.');
        $this->addTextArea('content_texy', 'Text')
            ->setAttribute('class', 'texyla span10');
    }
}