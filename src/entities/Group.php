<?php
namespace Pollex\Entity;

/**
 * @Entity @Table(name="group")
 * @HasLifecycleCallbacks
 */
class Group
{
    /**
     * @Id @Column(type="int") @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $created;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $updated;

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
        $this->created = new \DateTime();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set updated field to now()
     *
     * @PrePersist
     */
    public function createUpdateDateTime()
    {
        $this->updated = new \DateTime();
    }

    /**
     * Get when group was created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get object id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Setter when object was last updated
     *
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Getter when object was last time updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
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