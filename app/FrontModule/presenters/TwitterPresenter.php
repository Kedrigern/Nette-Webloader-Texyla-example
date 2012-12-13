<?php namespace FrontModule;
/**
 * @author Ondřej Profant, 2012
 */

class TwitterPresenter extends BasePresenter
{
    protected function createComponentTwitterFeed( $name ) {

        return new \Smasty\Components\Twitter\Control(array(
                'screenName' => 'ondrej_profant',
                'tweetCount' => 10
            ));
    }
}
