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
        $return = array(
          'name' => $this->getName(),
          'exists' => $this->checkDatabaseExists(),
          'count_items' => 0,
        );
        try {
            $tmp = $this->getItems(array('size'=>1));
            $return['count_items'] = $tmp['total'];
        } catch (\Exception $e) {
            //skip
        }
        return $return;
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
    public function batchItems(array $items, array $config = array())
    {
        $return = array();
        $limit = 10000;
        foreach ($items as &$item) {
            $action = 'POST';
            switch (strtoupper($item['_action'])) {
                default:
                    $action = strtoupper($item['_action']);
                    break;
                case 'CREATE':
                case 'ADD':
                    $action = 'POST';
                    break;
                case 'EDIT':
                case 'UPDATE':
                    $action = 'PUT';
                    break;
                case 'REMOVE':
                    $action = 'DELETE';
                    break;
            }
            $item['_id'] = (string)$item['_id'];
            $item['_action'] = $action;
        }
        foreach (array_chunk($items, $limit) as $package) {
            $return[] = $this->exec('items/'.$this->getName().'/batch', null, array(CURLOPT_POSTFIELDS => json_encode(array_merge(array('items'=>$package), $config))), true);
        }
        return $return;
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
        try {
            return $this->exec('items/'.$this->getName(), null, array(
                CURLOPT_POST => false,
                CURLOPT_CUSTOMREQUEST => 'HEAD',
                CURLOPT_NOBODY => true,
            ), true);
        } catch (\Exception $e) {
            return $e->getCode() === 200;
        }
        return false;
    }
}