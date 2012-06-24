<?php

namespace Tests\Entity\Poll;

use Pollex\Entity as Entity;
use Tests as Base;

class QuestionTest extends \Tests\TestCase
{
    /** @var \Pollex\Entity\Poll\Question */
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
        $questions = new Entity\Poll\Question();
        $questions->setId(1);
        $questions->setPoll($this->getMockPoll(2));

        $expected = array(
            'polls',
            2,
            'questions',
            1
        );

        $this->assertEquals($expected, $questions->getUrlParts());
    }

    public function testPoll()
    {
        $this->_question->setPoll($this->getMockPoll(2));

        $poll = $this->_question->getPoll();
        $this->assertEquals(2, $poll->getId());

    }

    public function testUrl()
    {
        $this->_question->setPoll($this->getMockPoll(2));
        $this->_question->setId(1);
        $this->assertEquals('/polls/2/questions/1', $this->_question->getUrl());
    }

    protected function getMockPoll($id)
    {
        $mockPoll = $this->getMock('\Pollex\Entity\Poll');
        $mockPoll->expects($this->any())
                 ->method('getId')
                 ->will($this->returnValue($id));
        $mockPoll->expects($this->any())
                 ->method('getEntityType')
                 ->will($this->returnValue('poll'));

        return $mockPoll;
    }

    protected function getMockType($id)
    {
        $mockType = $this->getMock('\Pollex\Entity\Type');
        $mockType->expects($this->any())
                 ->method('getEntityType')
                 ->will($this->returnValue('type'));
        $mockType->expects($this->any())
                 ->method('getId')
                 ->will($this->returnValue($id));
        return $mockType;
    }

    public function testValue()
    {
        $this->_question->setValue('fooobarbaz');
        $this->assertEquals('fooobarbaz', $this->_question->getValue());
    }

    public function testType()
    {
        $mockType = $this->getMockType(1337);
        $this->_question->setType($mockType);
        $this->assertEquals('type', $this->_question->getType()->getEntityType());
        $this->assertEquals(1337, $this->_question->getType()->getId());
    }

    public function testOneAnswer()
    {
        $this->assertTrue((0 == count($this->_question->getAnswers())));

        $mockAnswer = $this->getMockAnswer(1);
        $this->_question->addAnswer($mockAnswer);
        $answers = $this->_question->getAnswers();
        $this->assertTrue((1 == count($answers)));
        $this->assertEquals(1, $answers[0]->getId());
        $this->assertInstanceOf(
            '\Pollex\Entity\Poll\Question\Answer',
            $answers[0]
        );



    }

    public function testMoreAnswers()
    {
        $mockAnswer = $this->getMockAnswer(1);
        $mockAnswer2 = $this->getMockAnswer(2);
        $this->_question->addAnswer($mockAnswer);
        $this->_question->addAnswer($mockAnswer2);

        /** @var $answers \Pollex\Entity\Poll\Question\Answer */
        $answers = $this->_question->getAnswers();
        $this->assertTrue((2 == count($answers)));

        foreach ($answers as $answer) {
            $this->assertInstanceOf(
                '\Pollex\Entity\Poll\Question\Answer',
                $answer
            );
        }

        $this->assertEquals(1, $answers[0]->getId());
        $this->assertEquals(2, $answers[1]->getId());
    }

    protected function getMockAnswer($id)
    {
        $mockAnswer = $this->getMock('\Pollex\Entity\Poll\Question\Answer');
        $mockAnswer->expects($this->any())
            ->method('getEntityType')
            ->will($this->returnValue('question'));
        $mockAnswer->expects($this->any())
            ->method('getId')
            ->will($this->returnValue($id));
        return $mockAnswer;
    }
}