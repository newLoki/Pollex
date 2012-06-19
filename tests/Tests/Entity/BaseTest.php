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
        $this->assertEquals(1, $this->_entity->getid());
    }

    public function testType()
    {
        $this->assertEquals('fake', $this->_entity->getType());
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

    public function testGetDeepUrlParts()
    {
        $this->markTestIncomplete();
        $poll = new Entity\Poll();
        $poll->setId(1);
        $question = new Entity\Poll\Question();
        $question->setId(2);
        $poll->addQuestion($question);
        $urlParts = $question->getUrlParts();
        $expected = array(
            'polls',
            1,
            'questions',
            2
        );

        $this->assertEquals($expected, $urlParts);
    }
}

/** This exists only to test abstract class */
class Fake extends \Pollex\Entity\Base {
}