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
        $mockPoll = $this->getMockBuilder('\Pollex\Entity\Poll')
            ->disableOriginalConstructor()
            ->getMock();
        $mockPoll->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())
            ->method('getId')
            ->will(new \PHPUnit_Framework_MockObject_Stub_Return($id));
        $mockPoll->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())
             ->method('getEntityType')
             ->will(new \PHPUnit_Framework_MockObject_Stub_Return('poll'));

        return $mockPoll;
    }

    protected function getMockType($id)
    {
        $mockType = $this->getMockBuilder('\Pollex\Entity\Poll\Question\Type')
                         ->disableOriginalConstructor()
                         ->getMock();
        $mockType->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())
                 ->method('getId')
                 ->will(new \PHPUnit_Framework_MockObject_Stub_Return($id));
        $mockType->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())
                 ->method('getEntityType')
                 ->will(new \PHPUnit_Framework_MockObject_Stub_Return('type'));
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

    /**
     * - type (like poll)
     */

}