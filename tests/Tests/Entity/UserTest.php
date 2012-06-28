<?php

namespace Tests\Entity;

use Pollex\Entity as Entity;
use Tests as Base;

class UserTest extends \Tests\TestCase
{
    /** @var \Pollex\Entity\User */
    protected $_user;

    public function setUp()
    {
        $this->_user = new Entity\User();
    }

    public function testShouldInstanciaeteGroups()
    {
        $this->assertInstanceOf(
            'Doctrine\Common\Collections\ArrayCollection',
            $this->_user->getGroups()
        );
    }



    public function testBirthdate()
    {
        $date = new \DateTime();
        $this->_user->setBirthdate($date);
        $this->assertInstanceOf(
            'DateTime',
            $this->_user->getBirthdate()
        );
        $this->assertEquals($date, $this->_user->getBirthdate());

    }

    public function testEmail()
    {
        $email = 'foo@bar.de';
        $this->_user->setEmail($email);
        $this->assertEquals($email, $this->_user->getEmail());
    }

    public function testLastname()
    {
        $lastname = 'doe';
        $this->_user->setLastname($lastname);
        $this->assertEquals($lastname, $this->_user->getLastname());
    }

    public function testSurname()
    {
        $surname = 'john';
        $this->_user->setSurname($surname);
        $this->assertEquals($surname, $this->_user->getSurname());
    }

    public function testPassword()
    {
        $password = md5('foobar');
        $this->_user->setPassword($password);
        $this->assertEquals($password, $this->_user->getPassword());
    }

    public function testUrl()
    {
        $this->_user->setId(1);
        $this->assertEquals('/users/1', $this->_user->getUrl());
    }

    public function testType()
    {
        $this->assertEquals('user', $this->_user->getEntityType());
    }

    public function testOutputObject()
    {
        $this->_user->createUpdateDateTime();
        $this->_user->setId(1);
        $this->_user->setSurname('John');
        $this->_user->setLastname('Doe');
        $birthDate = \DateTime::createFromFormat('Y-m-d', '1982-07-05');
        $this->_user->setBirthdate($birthDate);
        $group = new Entity\Group();
        $group->setId(1);
        $group->setName('admin');
        $group->createUpdateDateTime();
        $this->_user->addGroup($group);


        $expected = new \stdClass();
        $expected->id = 1;
        $expected->url = '/users/1';
        $expected->surname = 'John';
        $expected->lastname = 'Doe';
        $expected->birthdate = '1982-07-05';
        $expectedGroup = new \stdClass();
        $expectedGroup->id = 1;
        $expectedGroup-> url = "/groups/1";
        $expectedGroup->name = "admin";
        $expectedGroup->created = $group->getCreated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expectedGroup->updated = $group->getUpdated()->format(\Pollex\Entity\Base::DATE_FORMAT);
        $expected->groups = array($expectedGroup);
        $expected->created = $this->_user->getCreated()->format(Entity\Base::DATE_FORMAT);
        $expected->updated = $this->_user->getUpdated()->format(Entity\Base::DATE_FORMAT);

        $this->assertEquals($expected, $this->_user->getOutputObject());
    }
}