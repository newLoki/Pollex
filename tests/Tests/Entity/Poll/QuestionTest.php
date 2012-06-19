<?php

namespace Tests\Entity\Poll;

use Pollex\Entity as Entity;
use Tests as Base;

class QuestionTest extends \Tests\TestCase
{
    protected $_question;

    public function setUp()
    {
        $this->_question = new Entity\Poll\Question();
    }

    public function testTitle()
    {
        $this->_question->setTitle('foo');
        $this->assertEquals('foo', $this->_question->getTitle());
    }

    public function testGetUrlParts()
    {
        $this->markTestIncomplete('Should prove if reimplementation of this function work correct');

    }
}