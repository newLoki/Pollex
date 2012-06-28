<?php

namespace Tests\Entity;

use Pollex\Entity as Entity;
use Tests as Base;

class BaseTest extends \Tests\TestCase
{
    /** @var Fake */
    protected $_entity;

    public function setUp()
    {
        $this->_entity = new Fake();
    }

    public function testCreatedTime()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->_entity->getCreated()
        );
    }

    public function testUpdatesTime()
    {
        $this->_entity->createUpdateDateTime();
        $this->assertInstanceOf(
            'DateTime',
            $this->_entity->getUpdated()
        );
    }

    public function testId()
    {
        $this->_entity->setId(1);
        $this->assertEquals(1, $this->_entity->getId());
    }

    public function testType()
    {
        $this->assertEquals('fake', $this->_entity->getEntityType());
    }

    public function testUrl()
    {
        $this->_entity->setId(1);
        $this->assertEquals('/fakes/1', $this->_entity->getUrl());
    }

    public function testGetUrlParts()
    {
        $this->_entity->setId(1);
        $this->assertEquals(array('fakes', 1), $this->_entity->getUrlParts());
    }

    public function testGetOutputObject()
    {
        $this->_entity->createUpdateDateTime();
        $this->_entity->setId(1);

        $expected = new \stdClass();
        $expected->id = 1;
        $expected->url = '/fakes/1';
        $expected->created = $this->_entity->getCreated()->format(Entity\Base::DATE_FORMAT);
        $expected->updated = $this->_entity->getUpdated()->format(Entity\Base::DATE_FORMAT);

        $this->assertEquals($expected, $this->_entity->getOutputObject());
    }
}

/** This exists only to test abstract class */
class Fake extends \Pollex\Entity\Base {
}