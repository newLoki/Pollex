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
        parent::setUp();
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
        $questions->setPoll($this->_mockContainer->getPoll(2));

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
        $this->_question->setPoll($this->_mockContainer->getPoll(2));

        $poll = $this->_question->getPoll();
        $this->assertEquals(2, $poll->getId());

    }

    public function testUrl()
    {
        $this->_question->setPoll($this->_mockContainer->getPoll(2));
        $this->_question->setId(1);
        $this->assertEquals('/polls/2/questions/1', $this->_question->getUrl());
    }

    public function testValue()
    {
        $this->_question->setValue('fooobarbaz');
        $this->assertEquals('fooobarbaz', $this->_question->getValue());
    }

    public function testType()
    {
        $mockType = $this->_mockContainer->getType(1337);
        $this->_question->setType($mockType);
        $this->assertEquals('type', $this->_question->getType()->getEntityType());
        $this->assertEquals(1337, $this->_question->getType()->getId());
    }

    public function testOneAnswer()
    {
        $this->assertTrue((0 == count($this->_question->getAnswers())));
        $mockAnswer = $this->_mockContainer->getAnswer(1);

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
        $mockAnswer = $this->_mockContainer->getAnswer(1);
        $mockAnswer2 = $this->_mockContainer->getAnswer(2);
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

    public function testOutputObject()
    {


        $this->_question->setId(1);
        $poll = new \Pollex\Entity\Poll();
        $poll->setId(1337);
        $this->_question->setPoll($poll);
        $type = new \Pollex\Entity\Type();
        $type->setId(2);
        $type->setName('free');
        $this->_question->setType($type);
        $this->_question->setTitle('fooo');
        $this->_question->setValue('lorem ipsum');


        $expected = new \stdClass();
        $expected->id = 1;
        $expected->poll = 1337;
        $expected->url = '/polls/1337/questions/1';
        $expectedType = new \stdClass();
        $expectedType->id = 2;
        $expectedType->name = "free";
        $expectedType->url = "/types/2";
        $expectedType->created = $type->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expectedType->updated = $type->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->type = $expectedType;
        $expected->created = $this->_question->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->updated = $this->_question->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->title = "fooo";
        $expected->value = 'lorem ipsum';
        $expectedAnswers = new \stdClass();
        $expectedAnswers->url = '/polls/1337/questions/1/answers';
        $expectedAnswers->data = array();
        $expected->answers = $expectedAnswers;

        $this->assertEquals($expected, $this->_question->getOutputObject());
    }
}