<?php

namespace Pollex\Entity\Poll;

/**
 * @Entity
 * @Table(name="questions")
 */
class Question extends \Pollex\Entity\Base
{
    /**
     * @Column(type="string")
     * @var string
     */
    protected $title;

    /**
     * @Column(type="string", name="poll_id")
     * @ManyToOne
     * @JoinColumn(name="poll_id", referencedColumnName="id")
     * @var \Pollex\Entity\Poll
     */
    protected $poll;

    /**
     * @Column(type="text")
     * @var string
     */
    protected $value;

    /**
     * @Column(type="string")
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Return all parts they are needed to build the url
     *
     * @return array
     */
    public function getUrlParts()
    {
        /** @var $poll \Pollex\Entity\Poll */
        $poll = $this->getPoll();

        return array(
            $this->_pluralizeForUrl($poll->getType()),
            $poll->getId(),
            $this->_pluralizeForUrl($this->getType()),
            $this->getid()
        );
    }

    /**
     * Set the poll who is related to this question
     *
     * @param \Pollex\Entity\Poll $poll
     */
    public function setPoll(\Pollex\Entity\Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * Get the poll who is related to this question
     *
     * @return \Pollex\Entity\Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Set the value of the question
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get question value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}