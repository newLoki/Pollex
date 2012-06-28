<?php

namespace Tests;

use Pollex\Entity as Entity;
use Tests as Base;

class MockContainer extends \PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        parent::setUp();
    }

    public function getPoll($id)
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

    public function getQuestion($id)
    {
        $mockQuestion = $this->getMock('\Pollex\Entity\Poll\Question');
        $mockQuestion->expects($this->any())
                     ->method('getId')
                     ->will($this->returnValue($id));
        $mockQuestion->expects($this->any())
                     ->method('getEntityType')
                     ->will($this->returnValue('question'));

        return $mockQuestion;
    }

    public function getAnswer($id)
    {
        $mockAnswer = $this->getMock('\Pollex\Entity\Poll\Question\Answer');
        $mockAnswer->expects($this->any())
                   ->method('getEntityType')
                   ->will($this->returnValue('answer'));
        $mockAnswer->expects($this->any())
                   ->method('getId')
                   ->will($this->returnValue($id));
        return $mockAnswer;
    }

    public function getType($id)
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

    public function getQuestionWithPoll($questionId, $pollId)
    {
        $mockQuestion = $this->getMock('\Pollex\Entity\Poll\Question');
        $mockQuestion->expects($this->any())
                     ->method("getUrlParts")
                     ->will($this->returnValue(array(
                         'polls',
                         $pollId,
                         'questions',
                         $questionId
                     )));

        return $mockQuestion;
    }

}