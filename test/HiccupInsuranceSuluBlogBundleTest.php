<?php

namespace Test;

use HiccupInsurance\SuluBlogBundle\HiccupInsuranceSuluBlogBundle;

class HiccupInsuranceSuluBlogBundleTest extends \PHPUnit_Framework_TestCase
{
    
    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var HiccupInsuranceSuluBlogBundle
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
        $this->assertInstanceOf(HiccupInsuranceSuluBlogBundle::class, $this->bundle);
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

        $this->bundle = new HiccupInsuranceSuluBlogBundle();
    }
}
