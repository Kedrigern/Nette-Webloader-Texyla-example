<?php namespace FrontModule;
/** @author Ondřej Profant, 2012  */

use \Nette\Application\UI\Form;

class HomepagePresenter extends BasePresenter
{
    private $data = array(
        "pozdrav" => array(
            'ahoj', 'nazdar', 'cau', 'ahojda', 'nazdarecek', 'caues', 'salut', 'pozdravy', 'zdar', 'zdary'
        ),
        "city" => array(
            'Praha', 'Brno', 'Ostrava', 'Plzeň', 'Liberec', 'Olomouc', 'Ústí nad Labem', 'Hradec Králové',
            'České Budějovice', 'Pardubice', 'Havířov', 'Zlín', 'Kladno', 'Most', 'Karviná', 'Opava',
            'Frýdek-Místek', 'Karlovy Vary', 'Jihlava', 'Teplice', 'Děčín', 'Chomutov', 'Přerov',
            'Jablonec nad Nisou', 'Mladá Boleslav', 'Prostějov',
        )
    );

    protected function startup()
    {
        parent::startup();
    }

    protected function createComponentEditForm(){
        $form = new \Nette\Application\UI\Form;
        $form->getElementPrototype()->class('ajax');
        $form->addTextarea('description_texy', 'Popis:', 100, 8)->getControlPrototype()->class("texyla span9");
        return $form;
    }

    protected function createComponentMyForm()
    {
        $form = new Form();
        $form->addText('pozdrav', 'Czech greetings: ')
            ->setOption('description', 'For example: Ahoj, Ahojda, Zdar, Zdary');
        $form->addText('city', 'Czech cities: ');
        $form->addSubmit('save', 'Save');
        $form->onSuccess[] = callback($this, 'submitted');
        return $form;
    }

    public function submitted(Form $form)
    {
        $values = $form->getValues(true);
        $this->flashMessage( "Result: ".$values['pozdrav'], 'success');
        $this->redirect('this');
    }

    public function actionAutocomplete($whichData, $typedText ='')
    {
        $matches = preg_grep("/$typedText/i", $this->data[$whichData] );
        $this->sendResponse(new \Nette\Application\Responses\JsonResponse($matches));
    }
}