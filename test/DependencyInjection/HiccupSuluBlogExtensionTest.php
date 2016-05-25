<?php

namespace Test\DependencyInjection;

use Hiccup\SuluBlogBundle\DependencyInjection\HiccupSuluBlogExtension;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class HiccupSuluBlogExtensionTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var HiccupSuluBlogExtension
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
        $this->extension = new HiccupSuluBlogExtension();
    }
}
