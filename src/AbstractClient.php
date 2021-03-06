<?php
namespace Aiphilos\Api;

/**
 * Solutions for the default clients
 */
abstract class AbstractClient implements ClientInterface
{
    /** @var string */
    protected $auth_name = null;
    
    /** @var string */
    protected $auth_pass = null;
    
    /** @var string */
    protected $ref_id = null;
    
    /** @var string */
    protected $default_language = null;
    
    /** @var string[] */
    private $languages = null;
    
    /** @var array */
    protected $default_options = array();
    
    /** @var string */
    protected $base_url = Sdk::BASE_URL;
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\ClientInterface::setAuthCredentials()
     */
    public function setAuthCredentials($name, $pass, $ref_id = null)
    {
        $this->auth_name = $name;
        $this->auth_pass = $pass;
        $this->ref_id = $ref_id;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\ClientInterface::setBaseUrl()
     */
    public function setBaseUrl($url)
    {
        $this->base_url = $url;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\ClientInterface::setDefaultOptions()
     */
    public function setDefaultOptions(array $options = array())
    {
        $this->default_options = $options;
    }
    
    /**
     * @todo documentation
     * @param string $path
     * @param string|null|false $language
     * @param array $options
     * @throws \UnexpectedValueException
     * @throws \DomainException
     * @return mixed
     */
    protected function exec($path = '', $language = null, array $options = array())
    {
        $url_parts = array($this->base_url.Sdk::API_VERSION);
        if ($language !== false) {
            $language = !empty($language) ? $language : $this->getDefaultLanguage();
            if (!in_array($language, $this->getLanguages())) {
                throw new \UnexpectedValueException('Unknown or invalid $language: '.$language.'. See getLanguages()');
            }
            $url_parts[] = $language;
        }
        $url_parts[] = $path;
        $default_options = array(
            CURLOPT_URL => implode('/', $url_parts),
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->auth_name.':'.$this->auth_pass,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array_merge(
                array('Content-Type: application/json'),
                !empty($this->ref_id) ? array('X-AIPHILOS-REF: '.$this->ref_id) : array()
            ),
        );
        $ch = curl_init();
        curl_setopt_array($ch, array_replace($default_options, $this->default_options, $options));
        $response = json_decode(curl_exec($ch), true);
        $response_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        //handle generell api error
        if ($response === null || isset($response['messagecode']) && $response['messagecode'] !== 0 || $response_http_code < 200 || $response_http_code > 299) {
            $message = !empty($response['message']) ? $response['message'] : '';
            $message_code = isset($response['messagecode']) ? $response['messagecode'] : $response_http_code;
            switch ($message_code) {
                case 307: $message = 'Temporary Redirect'; break;
                case 401: $message = 'Unauthorized'; break;
                case 403: $message = 'Forbidden'; break;
                case 405: $message = 'Method Not Allowed'; break;
                case 502: $message = 'Bad Gateway'; break;
                case 504: $message = 'Gateway Timeout'; break;
            }
            if(empty($message)) {
                $message = 'Unknown';
            }
            throw new \DomainException($message, $message_code);
        }
        return $response;
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Aiphilos\Api\ClientInterface::getLanguages()
     */
    public function getLanguages()
    {
        if ($this->languages === null) {
          $this->languages = $this->exec('languages', false, array(CURLOPT_POST => false));
        }
        return $this->languages;
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Aiphilos\Api\ClientInterface::setDefaultLanguage()
     *
     * @throws \UnexpectedValueException
     */
    public function setDefaultLanguage($language)
    {
        if (!in_array($language, $this->getLanguages())) {
            throw new \UnexpectedValueException('$language is not a valid language. See getLanguages()');
        }
        $this->default_language = $language;
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Aiphilos\Api\ClientInterface::getDefaultLanguage()
     */
    public function getDefaultLanguage()
    {
        return $this->default_language;
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Aiphilos\Api\ClientInterface::addRating()
     */
    public function addRating($uuid, $score, $comment = '')
    {
        $this->exec('ratings', false, array(CURLOPT_POSTFIELDS => json_encode(array('uuid'=>$uuid, 'score'=>$score, 'comment'=>$comment))));
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\ClientInterface::getHealth()
     */
    public function getHealth()
    {
        return $this->exec('health', false, array(CURLOPT_POST => false));
    }
}
