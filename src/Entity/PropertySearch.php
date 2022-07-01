<?php
namespace App\Entity;

class PropertySearch {

    /**
     * Undocumented variable
     *
     * @var [string]
     */
    private $listlesson;

    /**
     * Undocumented variable
     *
     * @var [string]
     */
    private $finishlesson;


    /**
     * Get undocumented variable
     *
     * @return  [string]
     */ 
    public function getListlesson()
    {
        return $this->listlesson;
    }

    /**
     * Set undocumented variable
     *
     * @param  [string]  $listlesson  Undocumented variable
     *
     * @return  self
     */ 
    public function setListlesson(string $listlesson): PropertySearch
    {
        $this->listlesson = $listlesson;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  [string]
     */ 
    public function getFinishlesson()
    {
        return $this->finishlesson;
    }

    /**
     * Set undocumented variable
     *
     * @param  [string]  $finishlesson  Undocumented variable
     *
     * @return  self
     */ 
    public function setFinishlesson(string $finishlesson): PropertySearch
    {
        $this->finishlesson = $finishlesson;

        return $this;
    }
}