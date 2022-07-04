<?php
namespace App\Entity;

class PropertySearch {

    /**
     * Undocumented variable
     *
     * @var [string]
     */
    private string $listlesson;

    /**
     * Undocumented variable
     *
     * @var [string]
     */
    private string $finishlesson;

    /**
     * Undocumented variable
     *
     * @var [string]
     */
    private string $notfinishlesson;


    /**
     * Get undocumented variable
     *
     * @return  [string]
     */ 
    public function getListlesson():?string
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
    public function getFinishlesson():?string
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

    /**
     * Get undocumented variable
     *
     * @return  [string]
     */ 
    public function getNotfinishlesson(): ?string
    {
        return $this->notfinishlesson;
    }

    /**
     * Set undocumented variable
     *
     * @param  [string]  $notfinishlesson  Undocumented variable
     *
     * @return  self
     */ 
    public function setNotfinishlesson(string $notfinishlesson)
    {
        $this->notfinishlesson = $notfinishlesson;

        return $this;
    }

    /**
 * {@inheritdoc}
 */
public function getBlockPrefix():string
{
	return 'App_avis';
}
}