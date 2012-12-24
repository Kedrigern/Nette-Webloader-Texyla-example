<?php

class ArticleGrid extends \NiftyGrid\Grid {

    protected $articles;

    public function __construct($articles)
    {
        parent::__construct();
        $this->articles = $articles;
    }

    protected function configure($presenter)
    {
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\NDataSource($this->articles->select('article.id, article.name, article.insert_datetime AS insert, article.keywords'));
        //Předáme zdroj
        $this->setDataSource($source);
        
        $this->setWidth("100%");
        $this->setDefaultOrder("article.id DESC");
        $this->setPerPageValues(array(2, 5, 10));

	    $this->addColumn('id', 'Id')
            ->setTextFilter();
        
	    $this->addColumn('name', 'Name')
            ->setTextEditable()
            ->setTextFilter()
            ->setAutocomplete(5);
            
        $this->addColumn('insert', 'Přidáno')
            ->setTextFilter();
            
        $this->addColumn('keywords', 'Keywords')
            ->setTextFilter();        
    }
}