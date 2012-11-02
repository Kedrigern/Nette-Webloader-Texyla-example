<?php
namespace FrontModule;

class DatabasePresenter extends BasePresenter
{
    private $articles;
    
    protected function startup()
    {
        parent::startup();
        $this->articles = $this->context->articleRepository;
    }
    
    
    public function renderDefault() 
    {
        $this->template->articles = $this->articles->findAll();
    }
}