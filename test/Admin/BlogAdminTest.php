<?php

namespace Test\Admin;

use Hiccup\SuluBlogBundle\Admin\BlogAdmin;
use Sulu\Bundle\AdminBundle\Admin\Admin;

class BlogAdminTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var BlogAdmin
     */
    private $admin;

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testInstance()
    {
        $this->assertInstanceOf(Admin::class, $this->admin);
    }

    /**
     * @group unit
     */
    public function testGetJsBundleName()
    {
        $this->assertEquals('hiccupsulublog', $this->admin->getJsBundleName());
    }

    #----------------------------------------------------------------------------------------------
    # Protected methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->admin = new BlogAdmin('title');
    }
}
