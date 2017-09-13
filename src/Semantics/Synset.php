<?php
namespace Aiphilos\Api\Semantics;

/**
 * Default Synset implementation
 */
class Synset implements SynsetInterface
{
    /** @var int */
    private $id = null;
    
    /** @var string[] */
    private $hypernyms = array();
    
    /** @var string[] */
    private $hyponyms = array();
    
    /** @var string[] */
    private $synonyms = array();
    
    /** @var string */
    private $word_category = null;
    
    /** @var string */
    private $word_class = null;
    
    /** @var string */
    private $named_entity_type = null;
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setId()
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getId()
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setWordCategory()
     */
    public function setWordCategory($word_category)
    {
        $this->word_category = $word_category;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getWordCategory()
     */
    public function getWordCategory()
    {
        return $this->word_category;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setWordClass()
     */
    public function setWordClass($word_class)
    {
        $this->word_class = $word_class;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getWordClass()
     */
    public function getWordClass()
    {
        return $this->word_class;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setNamedEntityType()
     */
    public function setNamedEntityType($named_entity_type)
    {
        $this->named_entity_type = $named_entity_type;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getNamedEntityType()
     */
    public function getNamedEntityType()
    {
        return $this->named_entity_type;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getHypernyms()
     */
    public function getHypernyms()
    {
        return $this->hypernyms;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setHypernyms()
     */
    public function setHypernyms(array $hypernyms)
    {
        $this->hypernyms = $hypernyms;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setHyponyms()
     */
    public function setHyponyms(array $hyponyms)
    {
        $this->hyponyms = $hyponyms;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::setSynonyms()
     */
    public function setSynonyms(array $synonyms)
    {
        $this->synonyms = $synonyms;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getHyponyms()
     */
    public function getHyponyms()
    {
        return $this->hyponyms;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\SynsetInterface::getSynonyms()
     */
    public function getSynonyms()
    {
        return $this->synonyms;
    }
}
