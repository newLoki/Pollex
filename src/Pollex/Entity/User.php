<?php
namespace Pollex\Entity;

/**
 * @Entity
 * @Table(name="users")
 */
class User extends Base
{
    /** Date format for user birthdate */
    const DATE_BIRTH = 'Y-m-d';

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $surname;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $lastname;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $birthdate;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $password;

    /**
     * @ManyToMany(targetEntity="Group", mappedBy="users")
     */
    protected $groups;

    /**
     * Set created date to now, if a new object is constructed
     * (this is not called on hydration)
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * set birthdate for user
     *
     * @param \DateTime $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * get the birthdate for this user
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set users email address
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get users email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Get user id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastname for user
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname of user
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * set password for user
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get user password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Setter for surname
     *
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * Getter for surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add group membership to user
     *
     * @param Group $group
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    /**
     * Get all groups, where user is member of
     *
     * @return \Pollex\Entity\Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /** @inheritdoc */
    public function getOutputObject()
    {
        $baseObject = parent::getOutputObject();
        $baseObject->surname = $this->getSurname();
        $baseObject->lastname = $this->getLastname();
        $baseObject->birthdate = $this->getBirthdate()->format(self::DATE_BIRTH);
        $baseObject->groups = array();
        foreach ($this->getGroups() as $group) {
            $baseObject->groups[] = $group->getOutputObject();
        }

        return $baseObject;
    }
}