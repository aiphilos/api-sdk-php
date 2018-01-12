<?php
namespace Aiphilos\Api;

/**
 * Default client interface
 */
interface ClientInterface
{
    /**
     * set the auth credentials for the api calls
     *
     * @param string $name
     * @param string $pass
     * @param string $ref_id
     *
     * @return void
     */
    public function setAuthCredentials($name, $pass, $ref_id = null);
    
    /**
     * Lists all supported languages
     *
     * @return String[]
     */
    public function getLanguages();

    /**
     * Sets the default language
     *
     * @param string $language
     */
    public function setDefaultLanguage($language);

    /**
     * @return string
     */
    public function getDefaultLanguage();

    /**
     * Rates the quality of a certain response
     * 
     * @param string $uuid
     * @param float $sore
     * @param string $comment
     */
    public function addRating($uuid, $sore, $comment = '');
}
