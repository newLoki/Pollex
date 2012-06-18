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
        $this->markTestIncomplete();
    }
}