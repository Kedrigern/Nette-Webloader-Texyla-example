<?php namespace FrontModule;
/** @author Ondřej Profant, 2012  */

use \Nette\Application\UI\Form;

class HomepagePresenter extends BasePresenter
{
    private $data = array(
        "pozdrav" => array(
            'ahoj', 'nazdar', 'cau', 'ahojda', 'nazdarecek', 'caues', 'salut', 'pozdravy', 'zdar', 'zdary'
        ),
        "pozdrav2" => array(
            'example' => array(
                'example',
                'example item description'
            )
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
        $form->addText('city', 'Czech cities: ')
            ->setOption('description', 'For example: Praha, Brno, Ostrava, ...');
        $form->addText('pozdrav2', 'Example: ')
            ->setOption('description', 'Jiná položka v nabídce a jiná se vkládá.');
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

    public function actionComplete($whichData, $typedText ='')
    {
        $this->sendResponse(new \Nette\Application\Responses\JsonResponse ($this->data['pozdrav2'] ));
    }

/*    private function one_level($ancestor, $menu)
    {
          $sql="SELECT c.*
                FROM category AS c
                JOIN category_closure cc ON (c.id = cc.descendant)
                WhERE cc.ancestor = $ancestor AND depth = 1";
          $level = $this->context->sql->sql($sql);
          foreach($table as $row) {
              array_push($menu, $row);
              array_push($menu, $this->one_level($row, $menu));
          }
    }

    public function renderMenu()
    {
        $sql = 'SELECT c.*
                FROM category AS c
                JOIN category_closure cc ON (c.id = cc.descendant)
                WhERE cc.ancestor = 1 AND depth = 1';
        $table = $this->context->sql->sql($sql);
        $menu = array();
        foreach($table as $row) {
            array_push($menu, $row);
            $sql="SELECT c.*
                FROM category AS c
                JOIN category_closure cc ON (c.id = cc.descendant)
                WhERE cc.ancestor = $row->id AND depth = 1";
            $subtable = $this->context->sql->sql($sql);
            array_push($menu, );
        }
        echo("<hr />");
        print_r($menu);
        die();

        //$this->template->menu = $this->context->sql->sql($sql);
    }*/
}