<?php

namespace Tests\Entity;

use Pollex\Entity as Entity;
use Tests as Base;

class GroupTest extends \Tests\TestCase
{
    /** @var \Pollex\Entity\Group */
    protected $_group;

    public function setUp()
    {
        $this->_group = new Entity\Group();
    }

    public function testShouldInstanciaeteUsers()
    {
        $this->assertInstanceOf(
            'Doctrine\Common\Collections\ArrayCollection',
            $this->_group->getUsers()
        );
    }

    public function testName()
    {
        $this->_group->setName('foo');

        $this->assertEquals('foo', $this->_group->getName());
    }

    public function testAddUser()
    {
        $user = new Entity\User();
        $user->setSurname('foo');

        $this->_group->addUser($user);

        /** @var $users \Pollex\Entity\User[] */
        $users = $this->_group->getUsers();
        $this->assertEquals(1, count($users));
        $this->assertEquals('foo', $users[0]->getSurname());
    }

    public function testUrl()
    {
        $this->_group->setId(1);
        $this->assertEquals('/groups/1', $this->_group->getUrl());
    }

    public function testType()
    {
        $this->assertEquals('group', $this->_group->getEntityType());
    }

    public function testOutputObject()
    {
        $this->_group->setName('admin');
        $this->_group->setId(1);
        $this->_group->createUpdateDateTime();

        $expectedGroup = new \stdClass();
        $expectedGroup->id = 1;
        $expectedGroup-> url = "/groups/1";
        $expectedGroup->name = "admin";
        $expectedGroup->created = $this->_group->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expectedGroup->updated = $this->_group->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);

        $this->assertEquals($expectedGroup, $this->_group->getOutputObject());
    }
}