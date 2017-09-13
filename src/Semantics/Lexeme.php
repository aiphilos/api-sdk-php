<?php
namespace Aiphilos\Api\Semantics;

/**
 * A default Lexeme implementation
 */
class Lexeme implements LexemeInterface
{
    /** @var string */
    private $value = null;
    
    /** @var string */
    private $lemma = null;
    
    /** @var string */
    private $head = null;
    
    /** @var Synset[] */
    private $synsets = array();
    
    /** @var Lexeme[] */
    public $modifiers = array();
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::setValue()
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::setLemma()
     */
    public function setLemma($lemma)
    {
        $this->lemma = $lemma;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::getLemma()
     */
    public function getLemma()
    {
        return $this->lemma;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::setHead()
     */
    public function setHead($head)
    {
        $this->head = $head;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::getHead()
     */
    public function getHead()
    {
        return $this->head;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::addSynset()
     */
    public function addSynset(SynsetInterface $synset)
    {
        $this->synsets[] = $synset;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::getSynsets()
     */
    public function getSynsets()
    {
        return $this->synsets;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::addModifier()
     */
    public function addModifier(LexemeInterface $modifier)
    {
        $this->modifiers[] = $modifier;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\LexemeInterface::getModifiers()
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }
}