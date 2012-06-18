<?php
namespace Pollex\Entity;

class Group extends Base
{
    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @ManyToMany(targetEntity="User", inversedBy="groups")
     * @JoinTable(name="users_groups")
     **/
    protected $users;

    /**
     * Set created date to now, if a new object is constructed
     * (this is not called on hydration)
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Setter for groupname
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter for groupname
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add given user to group
     *
     * @param User $user
     */
    public function addUser(User $user)
    {
        $user->addGroup($this);
        $this->users[] = $user;
    }

    /**
     * Get all users for this group
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }
}