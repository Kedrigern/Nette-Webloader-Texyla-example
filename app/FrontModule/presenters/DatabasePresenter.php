<?php namespace FrontModule;
/** @author Ondřej Profant, 2012 */

class DatabasePresenter extends BasePresenter
{
    private $articles;
     /** @persistent int */
    private $id;

    protected function startup()
    {
        parent::startup();
        $this->articles = $this->context->articleRepository;
        $this->id = 2;
    }
    
    public function renderDefault() 
    {
        $articles = $this->articles->findAll();
        $this['editation']->setDefaults( $articles->get( $this->id ) );
        $this->template->articles = $articles;
    }
    
    protected function createComponentArticleGrid()
    {
        return new \ArticleGrid($this->articles->findAll());
    }

    protected function createComponentEditation()
    {
        $form = new \MyForms\ArticleForm();
        $authors = $this->context->userRepository->findAuthors();
        $authors['null'] = 'anonym';
        $form['user_id']->setItems($authors);
        $form->addSubmit('save', 'Save changes');
        $form->onSuccess[] = callback($this, 'save');
        return $form;
    }

    public function save(\Nette\Application\UI\Form $form)
    {
        $values = $form->getValues(true);
        $values['content_html'] = $this->context->texy->process($values['content_texy']);

        $ret = $this->context->articleRepository->update($this->id, $values);
        if( $ret ) {
            $this->flashMessage('Data aktualizována', 'success');
        } else {
            $this->flashMessage('Operace se nezdařila', 'error');
        }
    }
}