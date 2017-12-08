<?php
namespace Aiphilos\Api\Items;

use Aiphilos\Api\Sdk;
use Aiphilos\Api\AbstractClient;
use Aiphilos\Api\ContentTypesEnum;

/**
 * Default aiPhilos items/database client implementation
 */
class Client extends AbstractClient implements ClientInterface
{
    /** @var string */
    private $name = null;
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::__construct()
     */
    public function __construct($name = null)
    {
        if ($name !== null) {
            $this->setName($name);
        }
    }
    
    /**
     * @see {parent::exec}
     * @param bool $require_name
     * @return mixed
     */
    protected function exec($path='', $language = null, array $options = array(), $require_name = false)
    {
        if ($require_name && empty($this->name)) {
            throw new \UnexpectedValueException('No $name ist given');
        }
        return parent::exec($path, $language, $options);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::setName()
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::getDatabases()
     */
    public function getDatabases()
    {
        return $this->exec('items', null, array(CURLOPT_POST => false));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::getName()
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::getDetails()
     */
    public function getDetails()
    {
        return $this->exec('items/'.$this->getName(), null, array(CURLOPT_POST => false, CURLOPT_CUSTOMREQUEST => 'HEAD'), true);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::setScheme()
     */
    public function setScheme(array $scheme)
    {
        if (empty($scheme)) {
            throw new \UnexpectedValueException('$scheme could not be empty');
        }
        foreach ($scheme as $name => $type) {
            if (empty($type)) {
                $type = ContentTypesEnum::GENERAL_AUTO;
            }
            if (!in_array($type, ContentTypesEnum::getAll())) {
                throw new \UnexpectedValueException('Unknown or invalid $type: '.$type);
            }
        }
        $this->exec('items/'.$this->getName().'/scheme', null, array(
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($scheme),
        ), true);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::getScheme()
     */
    public function getScheme()
    {
        return $this->exec('items/'.$this->getName().'/scheme', null, array(CURLOPT_POST => false), true);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::delete()
     */
    public function delete()
    {
        return $this->exec('items/'.$this->getName(), null, array(CURLOPT_POST => false, CURLOPT_CUSTOMREQUEST => 'DELETE'), true);
    }
    
    /**
     * 
     * @param mixed $id
     * @param bool|array $item
     * @param string $action
     * @throws \UnexpectedValueException
     * @return mixed
     */
    private function handleItem($id, $item, $action)
    {
        if (empty($id)) {
            throw new \UnexpectedValueException('$id could not be empty');
        }
        if ($item !== false && empty($item)) {
            throw new \UnexpectedValueException('$item could not be empty');
        }
        $options = array();
        if (is_array($item)) {
            $item_data = array();
            foreach ($item as $key => $value) {
              if(substr($key, 0, 1) === '_') { continue; }
              $item_data[$key] = $value;
            }
            $options[CURLOPT_POSTFIELDS] = json_encode($item_data);
        }
        switch ($action) {
            case 'read':
                $options[CURLOPT_POST] = false;
                break;
            case 'update':
                $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                break;
            case 'delete':
                $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                break;
        }
        return $this->exec('items/'.$this->getName().'/'.$id, null, $options, true);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::addItem()
     */
    public function addItem($id, array $item)
    {
        $this->handleItem($id, $item, 'create');
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::updateItem()
     */
    public function updateItem($id, array $item)
    {
        $this->handleItem($id, $item, 'update');
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::deleteItem()
     */
    public function deleteItem($id)
    {
        $this->handleItem($id, false, 'delete');
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::getItem()
     */
    public function getItem($id)
    {
        return $this->handleItem($id, false, 'read');
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::getItems()
     */
    public function getItems(array $config = array())
    {
        $fields = $config;
        return $this->exec('items/'.$this->getName().'?'.http_build_query($fields), null, array(CURLOPT_POST => false), true);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::batchItems()
     */
    public function batchItems(array $items)
    {
        //@todo tausch gegen die API
        foreach ($items as $item) {
            switch (strtoupper($item['_action'])) {
                case 'POST':
                case 'CREATE':
                case 'ADD':
                    $this->addItem($item['_id'], $item);
                    break;
                case 'EDIT':
                case 'UPDATE':
                case 'PUT':
                    $this->updateItem($item['_id'], $item);
                    break;
                case 'DELETE':
                    $this->deleteItem($item['_id']);
                    break;
            }
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::searchItems()
     */
    public function searchItems($string, $language = null, array $config = array())
    {
        return $this->exec('items/'.$this->getName().'/search', $language, array(CURLOPT_POSTFIELDS => json_encode(array_merge(array('query'=>$string), $config))), true);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Aiphilos\Api\Items\ClientInterface::existsDatabase()
     */
    public function checkDatabaseExists()
    {
        //@todo switch to endpoint after dev for head-handling with no body
        try {
            $dbs = $this->getDatabases();
        } catch (\Exception $e) {
          //skip
        }
        return in_array($this->getName(), isset($dbs['results']) ? $dbs['results'] : array());
    }
}