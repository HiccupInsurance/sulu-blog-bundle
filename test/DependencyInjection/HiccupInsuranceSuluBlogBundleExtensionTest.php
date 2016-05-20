<?php

namespace Test\DependencyInjection;

use HiccupInsurance\SuluBlogBundle\DependencyInjection\HiccupInsuranceSuluBlogExtension;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class HiccupInsuranceSuluBlogBundleExtensionTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var HiccupInsuranceSuluBlogExtension
     */
    private $extension;

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testInstance()
    {
        $this->assertInstanceOf(Extension::class, $this->extension);
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

        $this->extension = new HiccupInsuranceSuluBlogExtension();
    }
}
