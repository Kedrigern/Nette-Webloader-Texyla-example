<?php namespace MyForms;
/** @author Ondřej Profant, 2012 */

use Nette\Forms\Container,
    Nette\Application\UI\Form;

class userContainer extends BaseContainer
{
    protected  function configure()
    {
        $this->addText('nick', 'Nickname')
            ->addRule( Form::FILLED, '')
            ->addRule( Form::MAX_LENGTH, '', 25);
        $this->addText('mail', 'Mail')
            ->addRule( Form::EMAIL, '')
            ->addRule( Form::MAX_LENGTH, '', 25);
    }
}

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
    private $countries = array(
        'Europe' => array(
            'CZ' => 'Česká Republika',
            'SK' => 'Slovensko',
            'GE' => 'Německo',
            'GB' => 'Velká Británie',
            ),
        'America' => array (
            'CA' => 'Kanada',
            'US' => 'USA',
            ),
        '?' => 'jiná',
    );

    protected function configure()
    {
        $this->addCheckbox('optional', 'bez adresy')
            ->setDefaultValue(false)
            ->setAttribute("onchange", "hideAddress()");
        $this->addText('street', 'Ulice')
            ->setAttribute('class', 'address-to-hide');
        $this->addText('snumber', 'Číslo orientační')
            ->setType('number')
            ->setAttribute('class', 'address-to-hide')
            ->addConditionOn($this['optional'], Form::EQUAL, false)
            ->addRule(Form::FILLED)
            ->addRule(Form::INTEGER)
            ->elseCondition()
            ->endCondition();
        $this->addText('city', 'Město')
            ->setAttribute('class', 'address-to-hide');
        $this->addText('psc', 'PSČ')
            ->setType('number')
            ->setAttribute('class', 'address-to-hide')
            ->addConditionOn($this['optional'], Form::EQUAL, false)
            ->addRule(Form::INTEGER)
            ->addRule(Form::MIN_LENGTH, 'Minimální délka PSČ je %d.', 5)
            ->elseCondition()
            ->endCondition();
        $this->addSelect('country', 'Země', $this->countries)
            ->setDefaultValue('CZ')
            ->setAttribute('class', 'address-to-hide');
    }
}




























