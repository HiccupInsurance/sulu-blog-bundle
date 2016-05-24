<?php

namespace Test;

use Hiccup\SuluBlogBundle\HiccupSuluBlogBundle;

class HiccupSuluBlogBundleTest extends \PHPUnit_Framework_TestCase
{
    
    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var HiccupSuluBlogBundle
     */
    private $bundle;

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testInstance()
    {
        $this->assertInstanceOf(HiccupSuluBlogBundle::class, $this->bundle);
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

        $this->bundle = new HiccupSuluBlogBundle();
    }
}
