<?php
namespace Aiphilos\Api\Items;

use Aiphilos\Api\Sdk;
use Aiphilos\Api\AbstractClient;

/**
 * Default aiPhilos search client implementation
 */
class Client extends AbstractClient implements ClientInterface {
    /** @var string */
    private $name = null;
    
    public function __construct($name = null) {
        if ($name !== null) {
            $this->setName($name);
        }
    }
    
    //database
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
    public function getDetails() {}
    public function setScheme(array $scheme) {}
    public function delete() {}
    
    //Item Handling
    public function addItem($id, array $item) {}
    public function updateItem($id, array $item) {}
    public function getItem($id) {}
    public function deleteItem($id) {}
    public function batchItems(array $items) {}
    public function searchItems($string, $language = null) {}
}