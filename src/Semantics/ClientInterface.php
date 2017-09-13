<?php
namespace Aiphilos\Api\Semantics;

use Aiphilos\Api\ClientInterface as GeneralClientInterface;

/**
 * semantics client interface
 */
interface ClientInterface extends GeneralClientInterface
{
    /**
     * Parses multiple strings
     *
     * @param string[] $strings
     * @param string $language
     * @param boolean $batch
     *
     * @return array
     */
    public function parseStrings(array $strings, $language = null, $batch = true);
    
    /**
     * Parses a single string
     *
     * @param string $string
     * @param string $language
     * @param string $nlp_mode valid values: "auto", "on", "off"
     *
     * @return false|array
     */
    public function parseString($string, $language = null, $nlp_mode = 'auto');
}
