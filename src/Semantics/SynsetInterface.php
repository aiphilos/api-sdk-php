<?php
namespace Aiphilos\Api\Semantics;

/**
 * SynsetInterface
 */
interface SynsetInterface
{
    /**
     * Returns the Id
     * 
     * @return int
     */
    public function getId();
    
    /**
     * Sets the ID
     * 
     * @param int $id
     */
    public function setId($id);
    
    /**
     * Sets the word category
     * 
     * @param string $word_category
     */
    public function setWordCategory($word_category);
    
    /**
     * Returns the word category
     * 
     * @return string
     */
    public function getWordCategory();
    
    /**
     * Sets the word class
     * 
     * @param string $word_class
     */
    public function setWordClass($word_class);
    
    /**
     * Returns the word class
     *
     * @return string
     */
    public function getWordClass();
    
    /**
     * Sets the named entity type
     * 
     * @param string $named_entity_type
     */
    public function setNamedEntityType($named_entity_type);
    
    /**
     * Returns the named entity type
     *
     * @return string
     */
    public function getNamedEntityType();
    
    /**
     * Returns the hypernyms
     *
     * @return string[]
     */
    public function getHypernyms();
    
    /**
     * Sets the hypernyms
     * 
     * @param string[] $hypernyms
     */
    public function setHypernyms(array $hypernyms);
    
    /**
     * Returns the hyponyms
     *
     * @return string[]
     */
    public function getHyponyms();
    
    /**
     * Sets the hyponyms
     * 
     * @param string[] $hyponyms
     */
    public function setHyponyms(array $hyponyms);
    
    /**
     * Returns the synonyms
     *
     * @return string[]
     */
    public function getSynonyms();
    
    /**
     * Sets the Synonyms
     * 
     * @param string[] $synonyms
     */
    public function setSynonyms(array $synonyms);
}
