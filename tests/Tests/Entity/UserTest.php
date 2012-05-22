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

    public function testCreatedTime()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->_user->getCreated()
        );
    }

    public function testUpdatesTime()
    {
        $this->_user->createUpdateDateTime();
        $this->assertInstanceOf(
            'DateTime',
            $this->_user->getUpdated()
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

    //@todo tests for groups
}