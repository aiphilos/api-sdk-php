<?php
namespace Aiphilos\Api\Semantics;

use Aiphilos\Api\Sdk;
use Aiphilos\Api\AbstractClient;

/**
 * Default aiPhilos semantics client implementation
 */
class Client extends AbstractClient implements ClientInterface
{
    /** @var string */
    const NLP_MODE_AUTO = 'auto';
    
    /** @var string */
    const NLP_MODE_ON = 'on';
    
    /** @var string */
    const NLP_MODE_OFF = 'off';
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\ClientInterface::parseString()
     */
    public function parseString($string, $language = null, $nlp_mode = self::NLP_MODE_AUTO)
    {
        $return = false;
        if (!in_array($nlp_mode, array(self::NLP_MODE_AUTO, self::NLP_MODE_ON, self::NLP_MODE_OFF))) {
            throw new \UnexpectedValueException('Unknown or invalid $nlp_mode: '.$nlp_mode);
        }
        $resp = $this->exec('semantics/parse', $language, array(
            CURLOPT_POSTFIELDS => json_encode(array('query' => $string, 'nlp_mode' => $nlp_mode)),
        ));
        $return = $this->buildResult($resp);
        return $return;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Semantics\ClientInterface::parseStrings()
     */
    public function parseStrings(array $strings, $language = null, $batch = true)
    {
        $return = array();
        if (!$batch) {
            foreach ($strings as $index => $string) {
                $return[$index] = $this->parseString($string);
            }
        } else {
            $queries = array();
            foreach ($strings as $index => $string) {
                $queries[] = array('id'=>(string)$index, 'query'=>$string);
            }
            $resp = $this->exec('semantics/parsebatch', $language, array(
                CURLOPT_POSTFIELDS => json_encode(array('queries' => $queries)),
            ));
            foreach ($resp['results'] as $result) {
                $return[$result['id']] = $this->buildResult($result);
            }
        }
        return $return;
    }
    
    /**
     * Builds a global api return
     * 
     * @param array $structure
     * 
     * @return array
     */
    private function buildResult(array $structure = array())
    {
        $return = array();
        foreach (array('objects', 'modifiers') as $field) {
            $return[$field] = array();
            foreach ($structure[$field] as $lex) {
                $return[$field][] = LexemeFactory::factory($lex);
            }
        }
        return $return;
    }
}
