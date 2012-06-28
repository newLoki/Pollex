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
        parent::setUp();
        $this->_answer = new Entity\Poll\Question\Answer();
    }

    public function testId()
    {
        $this->_answer->setId(1);
        $this->assertEquals(1, $this->_answer->getId());
    }

    public function testQuestion()
    {
        $questionMock = $this->_mockContainer->getQuestion(1);
        $this->_answer->setQuestion($questionMock);
        $this->assertEquals($this->_answer->getQuestion()->getId(), 1);
    }

    public function testGetUrlParts()
    {
        //$this->markTestIncomplete('set|getQuestion should be implemented first');
        $mockQuestion = $this->_mockContainer->getQuestionWithPoll(2, 1);
        $this->_answer->setId(3);
        $this->_answer->setQuestion($mockQuestion);
        $expected = array(
            'polls',
            1,
            'questions',
            2,
            'answers',
            3
        );

        $this->assertEquals($expected, $this->_answer->getUrlParts());
    }

    public function testGetUrl()
    {
        $mockQuestion = $this->_mockContainer->getQuestionWithPoll(2, 1);

        $this->_answer->setId(3);
        $this->_answer->setQuestion($mockQuestion);

        $expected = '/polls/1/questions/2/answers/3';

        $this->assertEquals($expected, $this->_answer->getUrl());
    }
    /**
     * - url (urlParts)
     * - type
     *  - poll
     *  - question
     *  - value
     */
}