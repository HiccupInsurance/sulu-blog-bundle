<?php

namespace HiccupInsurance\SuluBlogBundle\Admin;

use Sulu\Bundle\AdminBundle\Admin\Admin;
use Sulu\Bundle\AdminBundle\Navigation\Navigation;
use Sulu\Bundle\AdminBundle\Navigation\NavigationItem;

class BlogAdmin extends Admin
{

    public function __construct($title)
    {
        $rootNavigationItem = new NavigationItem($title);
        $section = new NavigationItem('navigation.webspaces');

        $global = new NavigationItem('navigation.global-content');
        $section->addChild($global);

        $news = new NavigationItem('navigation.news');
        $news->setAction('example/news');
        $section->addChild($news);

        $rootNavigationItem->addChild($section);

        $this->setNavigation(new Navigation($rootNavigationItem));
    }

    /**
     * @return string
     */
    public function getJsBundleName()
    {
        return 'hiccupinsurancesulublogbundle';
    }
}
