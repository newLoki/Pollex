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
}