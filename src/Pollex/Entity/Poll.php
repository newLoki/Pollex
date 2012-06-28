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
     * @Column(type="int", name="author_id")
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     * @var \Pollex\Entity\User
     */
    protected $author;

    /**
     * @Column(type="text")
     * @var string
     */
    protected $description;

    /**
     * @ManyToOne(targetEntity="Question")
     * @var \Pollex\Entity\Poll\Question
     */
    protected $questions;

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

    /**
     * Setter for poll description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Getter for poll description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add a new question
     *
     * @param \Pollex\Entity\Poll\Question $question
     */
    public function addQuestion(\Pollex\Entity\Poll\Question $question)
    {
        $this->questions[] = $question;
    }

    /**
     * Return all questions, related to this poll
     *
     * @return Poll\Question
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /** @inheritdoc */
    public function getOutputObject()
    {
        $baseObject = parent::getOutputObject();
        $baseObject->name = $this->getName();
        $baseObject->author = $this->getAuthor()->getOutputObject();
        $baseObject->description = $this->getDescription();
        $baseObject->questions = new \stdClass();
        $questions = $this->getQuestions();
        $baseObject->questions->url = $questions[0]->getUrl();
        $baseObject->questions->data = array();

        return $baseObject;
    }
}