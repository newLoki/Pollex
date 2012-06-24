<?php

namespace Tests\Entity\Poll\Question;

use Pollex\Entity as Entity;
use Tests as Base;

class AnswerTest extends \Tests\TestCase
{
    /**
     * @var \Pollex\Entity\Poll\Question\Answer
     */
    protected $_answer;

    public function setUp()
    {
        $this->_answer = new Entity\Poll\Question\Answer();
    }

    public function testId()
    {
        $this->_answer->setId(1);
        $this->assertEquals(1, $this->_answer->getId());
    }
}