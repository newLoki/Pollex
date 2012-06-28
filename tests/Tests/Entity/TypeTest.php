<?php

namespace Tests\Entity;

use Pollex\Entity as Entity;
use Tests as Base;

class TypeTest extends \Tests\TestCase
{
    /**
     * - url (parts) => /types/1
     * - name
     */

    /** @var \Pollex\Entity\Type */
    protected $_type;

    public function setUp()
    {
        parent::setUp();
        $this->_type = new Entity\Type();
    }

    public function testUrlParts()
    {
        $this->_type->setId(1);
        $expected = array(
            'types',
            1
        );

        $this->assertEquals($expected, $this->_type->getUrlParts());
    }

    public function testUrl()
    {
        $expected = "/types/1";
        $this->_type->setId(1);
        $this->assertEquals($expected, $this->_type->getUrl());
    }

    public function testName()
    {
        $this->_type->setName("rating");

        $this->assertEquals("rating", $this->_type->getName());
    }

    public function testGetOutputObject()
    {
        /**
         * type: {
                         id: 2,
                         name: 'rating',
                         url: '/types/2'
                     }
         */
        $this->_type->setId(1);
        $this->_type->setName('rating');
        $this->_type->createUpdateDateTime();

        $expected = new \stdClass();
        $expected->id = 1;
        $expected->name = "rating";
        $expected->url = "/types/1";
        $expected->created = $this->_type->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->updated = $this->_type->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);

        $this->assertEquals($expected, $this->_type->getOutputObject());
    }
}