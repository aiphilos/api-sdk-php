<?php
namespace Aiphilos\Api\Semantics;

/**
 * LexemeInterface
 */
interface LexemeInterface
{
    /**
     * Returns the value
     *
     * @return string
     */
    public function getValue();
    
    /**
     * Sets the value
     * 
     * @param string $value
     */
    public function setValue($value);
    
    /**
     * Returns the lemma
     * 
     * @return string
     */
    public function getLemma();
    
    /**
     * Sets the lemma
     * 
     * @param string $lemma
     */
    public function setLemma($lemma);
    
    /**
     * Returns the head
     * 
     * @return string
     */
    public function getHead();
    
    /**
     * Sets the head
     * 
     * @param string $head
     */
    public function setHead($head);
    
    /**
     * Adds a Sysnet
     * 
     * @param SynsetInterface $synset
     */
    public function addSynset(SynsetInterface $synset);
    
    /**
     * Returns all Synsets
     * 
     * @return SynsetInterface[]
     */
    public function getSynsets();
    
    /**
     * Adds a Modifier
     * 
     * @param LexemeInterface $modifier
     */
    public function addModifier(LexemeInterface $modifier);
    
    /**
     * Returns all Modifiers
     * 
     * @return LexemeInterface[]
     */
    public function getModifiers();
}
