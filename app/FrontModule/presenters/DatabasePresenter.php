<?php namespace FrontModule;
/** @author Ondřej Profant, 2012 */

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
    
    protected function createComponentArticleGrid()
    {
        return new \ArticleGrid($this->articles->findAll());
    }
}