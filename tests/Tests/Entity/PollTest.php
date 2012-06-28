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
        parent::setUp();
        $this->_poll = new Entity\Poll();
    }

    public function testGetUrl()
    {
        $this->_poll->setId(1);
        $this->assertEquals('/polls/1', $this->_poll->getUrl());
    }

    public function testType()
    {
        $this->assertEquals('poll', $this->_poll->getEntityType());
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

    public function testOutputObject()
    {
        $user = new Entity\User();
        $user->setId(1);
        $user->setSurname('John');
        $user->setLastname('Doe');
        $birthDate = \DateTime::createFromFormat('Y-m-d', '1982-07-05');
        $user->setBirthdate($birthDate);
        $group = new Entity\Group();
        $group->setId(1);
        $group->setName('admin');
        $user->addGroup($group);

        $this->_poll->setId(1);
        $this->_poll->setAuthor($user);
        $this->_poll->setName('foo');
        $this->_poll->setDescription('Long description');
        $this->_poll->setAuthor($user);

        $questions = new Entity\Poll\Question();
        $questions->setPoll($this->_poll);

        $this->_poll->addQuestion($questions);

        $expected = new \stdClass();
        $expected->id = 1;
        $expected->url = '/polls/1';
        $expected->name = 'foo';
        $expected->author = new \stdClass();
        $expected->author->id = 1;
        $expected->author->surname = 'John';
        $expected->author->lastname = 'Doe';
        $expected->author->birthdate = '1982-07-05';
        $expected->author->url = "/users/1";
        $expected->author->created = $user->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->author->updated = $user->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);

        $expectedGroup = new \stdClass();
        $expectedGroup->id = 1;
        $expectedGroup->url = "/groups/1";
        $expectedGroup->name = "admin";
        $expectedGroup->created = $group->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expectedGroup->updated = $group->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);

        $expected->author->groups = array($expectedGroup);

        $expected->created = $this->_poll->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->updated = $this->_poll->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->description = "Long description";
        $expected->questions = new \stdClass();
        $expected->questions->url = '/polls/1/questions/'; //makes no sense to have a question id here, this will link to a question
        $expected->questions->data = array();

        $this->assertEquals($expected, $this->_poll->getOutputObject());
    }
}