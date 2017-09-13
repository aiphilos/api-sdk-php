<?php
namespace Aiphilos\Api\Semantics;

use Aiphilos\Api\AbstractFactory;

/**
 * Factory pattern for lexemes
 */
class LexemeFactory extends AbstractFactory
{
    /** @var string */
    protected static $default_class = 'Aiphilos\Api\Semantics\Lexeme';
    
    /**
     * Builds a lexeme
     * 
     * @param array $data
     * @param string $class_name
     * @param string $synset_class_name
     * 
     * @return LexemeInterface
     */
    public static function factory(array $data = array(), $class_name = null, $synset_class_name = null)
    {
        if ($class_name === null) {
            $class_name = self::getDefaultClass();
        }
        self::checkClassName($class_name);
        /* @var $lexeme LexemeInterface */
        $lexeme = new $class_name;
        if (!$lexeme instanceof LexemeInterface) {
          throw new \DomainException('$class_name must be an instance of LexemeInterface');
        }
        if (isset($data['lexeme'])) {
            $lexeme->setValue($data['lexeme']);
        }
        if (isset($data['lemma'])) {
            $lexeme->setLemma($data['lemma']);
        }
        if (isset($data['head'])) {
            $lexeme->setHead($data['head']);
        }
        if (isset($data['synsets']) && is_array($data['synsets'])) {
            foreach ($data['synsets'] as $s) {
                $lexeme->addSynset(SynsetFactory::factory($s, $synset_class_name));
            }
        }
        if (isset($data['modifiers']) && is_array($data['modifiers'])) {
            foreach ($data['modifiers'] as $m) {
                $lexeme->addModifier(self::factory($m, $class_name, $synset_class_name));
            }
        }
        return $lexeme;
    }
}
