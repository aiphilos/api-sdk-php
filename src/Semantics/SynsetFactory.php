<?php
namespace Aiphilos\Api\Semantics;

use Aiphilos\Api\AbstractFactory;

/**
 * Factory pattern for Synsets
 */
class SynsetFactory extends AbstractFactory
{
    /** @var string */
    protected static $default_class = 'Aiphilos\Api\Semantics\Synset';
    
    /**
     * Builds a Synset
     * 
     * @param array $data
     * @param string $class_name
     * 
     * @return SynsetInterface
     */
    public static function factory(array $data = array(), $class_name = null)
    {
        if ($class_name === null) {
            $class_name = self::getDefaultClass();
        }
        self::checkClassName($class_name);
        /* @var $synset SynsetInterface */
        $synset = new $class_name;
        if (!$synset instanceof SynsetInterface) {
            throw new \DomainException('$class_name must be an instance of SynsetInterface');
        }
        if (isset($data['synset_id'])) {
            $synset->setId($data['synset_id']);
        }
        if (isset($data['word_category'])) {
            $synset->setWordCategory($data['word_category']);
        }
        if (isset($data['word_class'])) {
            $synset->setWordClass($data['word_class']);
        }
        if (isset($data['named_entity_type'])) {
            $synset->setNamedEntityType($data['named_entity_type']);
        }
        foreach (array('hypernyms', 'hyponyms', 'synonyms') as $field) {
            if (isset($data[$field])) {
                $synset->{'set'.ucfirst($field)}($data[$field]);
            }
        }
        return $synset;
    }
}
