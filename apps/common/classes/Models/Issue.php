<?php

namespace LIPARENT\Common\Models;

class Issue extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $issue_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $issue_description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $tenant_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $created_at;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field issue_title
     *
     * @param string $issue_title
     * @return $this
     */
    public function setIssueTitle($issue_title)
    {
        $this->issue_title = $issue_title;

        return $this;
    }

    /**
     * Method to set the value of field issue_description
     *
     * @param string $issue_description
     * @return $this
     */
    public function setIssueDescription($issue_description)
    {
        $this->issue_description = $issue_description;

        return $this;
    }

    /**
     * Method to set the value of field tenant_id
     *
     * @param integer $tenant_id
     * @return $this
     */
    public function setTenantId($tenant_id)
    {
        $this->tenant_id = $tenant_id;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field issue_title
     *
     * @return string
     */
    public function getIssueTitle()
    {
        return $this->issue_title;
    }

    /**
     * Returns the value of field issue_description
     *
     * @return string
     */
    public function getIssueDescription()
    {
        return $this->issue_description;
    }

    /**
     * Returns the value of field tenant_id
     *
     * @return integer
     */
    public function getTenantId()
    {
        return $this->tenant_id;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('tenant_id', 'LIPARENT\Common\Models\Tenant', 'id', ['alias' => 'Tenant']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Issue[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Issue
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'issue';
    }

}
