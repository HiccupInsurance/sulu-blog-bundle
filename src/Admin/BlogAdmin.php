<?php

namespace HiccupInsurance\SuluBlogBundle\Admin;

use Sulu\Bundle\AdminBundle\Admin\Admin;
use Sulu\Bundle\AdminBundle\Navigation\Navigation;
use Sulu\Bundle\AdminBundle\Navigation\NavigationItem;

class BlogAdmin extends Admin
{

    /**
     * @param string $title
     */
    public function __construct($title)
    {
        $root = new NavigationItem($title);
        $section = new NavigationItem('navigation.webspaces');
        $blog = new NavigationItem('Blog', $section);

        $listPost = new NavigationItem('List posts', $blog);
        $listPost->setAction('blog/list');

        $root->addChild($section);
        $this->setNavigation(new Navigation($root));
    }

    /**
     * @return string
     */
    public function getJsBundleName()
    {
        return 'hiccupinsurancesulublog';
    }
}
