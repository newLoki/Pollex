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

}