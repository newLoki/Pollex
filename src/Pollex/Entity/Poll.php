<?php
namespace Pollex\Entity;

/**
 * @Entity
 * @Table(name="polls")
 */
class Poll extends Base
{
    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @OneToOne(targetEntity="User")
     * @var \Pollex\Entity\User
     */
    protected $author;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author for this poll
     *
     * @param \Pollex\Entity\User $_author
     */
    public function setAuthor(\Pollex\Entity\User $_author)
    {
        $this->author = $_author;
    }

    /**
     * Getter for author of this poll
     *
     * @return \Pollex\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}