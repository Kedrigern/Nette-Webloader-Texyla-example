<?php namespace MyForms;
/** @author Ondřej Profant, 2012 */

use Nette\Forms\Container,
    Nette\Application\UI\Form;

class nameContainer extends BaseContainer
{
    protected function configure()
    {
        $this->addText('name', 'Jméno')
            ->addRule( Form::FILLED , '%label musí být vyplněno.')
            ->addRule( Form::MAX_LENGTH, '"%label nesmí být delší než %d.', 20);
        $this->addText('surname', 'Přijmení')
            ->addRule( Form::FILLED , '%label musí být vyplněno.' )
            ->addRule( Form::MAX_LENGTH, '%label nesmí být delší než %d.', 20);
    }
}

class addressContainer extends BaseContainer
{
    protected function configure()
    {
        $this->addCheckbox('optional', 'adresa')
            ->setDefaultValue(false);
        $this->addText('street', 'Ulice:')
            ->setDisabled();
        $this->addText('snumber', 'Číslo orientační:')
            ->setType('number')
            ->addConditionOn($this['optional'], Form::EQUAL, false)
                ->addRule(Form::FILLED)
                ->addRule(Form::INTEGER)
            ->elseCondition()
            ->endCondition();
        $this->addText('city', 'Město:');

        $this->addText('psc', 'PSČ:')
            ->setType('number')
            ->addConditionOn($this['optional'], Form::EQUAL, false)
                ->addRule(Form::INTEGER)
                ->addRule(Form::MIN_LENGTH, 'Minimální délka PSČ je %d.', 5)
            ->elseCondition()
            ->endCondition();
    }
}




























