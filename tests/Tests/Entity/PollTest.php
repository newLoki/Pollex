<?php

namespace Tests\Entity;

use Pollex\Entity as Entity;
use Tests as Base;

class PollTest extends \Tests\TestCase
{
    /**
     * @var \Pollex\Entity\Poll
     */
    protected $_poll;

    public function setUp()
    {
        $this->_poll = new Entity\Poll();
    }

    public function testGetUrl()
    {
        $this->_poll->setId(1);
        $this->assertEquals('/polls/1', $this->_poll->getUrl());
    }

    public function testType()
    {
        $this->assertEquals('poll', $this->_poll->getType());
    }

    public function testName()
    {
        $this->_poll->setName('foo');
        $this->assertEquals('foo', $this->_poll->getName());
    }

    /**
     * Also test with stdClass and thrown exception
     */
    public function testAuthor()
    {
        $author = new Entity\User();
        $author->setSurname('foo');
        $this->_poll->setAuthor($author);
        $this->assertInstanceOf(
            'Pollex\Entity\User',
            $this->_poll->getAuthor()
        );
        $this->assertEquals('foo', $this->_poll->getAuthor()->getSurname());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testWrongAuthor()
    {
        $author = new \stdClass();
        $this->_poll->setAuthor($author);
    }

    public function testDescription()
    {
        //$this->markTestIncomplete();
        $this->_poll->setDescription('lorem ipsum');
        $this->assertEquals('lorem ipsum', $this->_poll->getDescription());
    }


    public function testAddQuestion()
    {
        $question = new Entity\Poll\Question();
        $question->setId(1);
        $this->_poll->addQuestion($question);

    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testAddWrongQuestions()
    {
        $question = new \stdClass();
        $this->_poll->addQuestion($question);
    }

    public function testGetQuestions()
    {
        $question = new Entity\Poll\Question();
        $question->setId(1);

        $this->_poll->addQuestion($question);
        $questions = $this->_poll->getQuestions();
        foreach ($questions as $question) {
            $this->assertInstanceOf(
                'Pollex\Entity\Poll\Question',
                $question
            );
        }

    }
}