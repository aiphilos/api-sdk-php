<?php
namespace Aiphilos\Api\Items;

use Aiphilos\Api\ClientInterface as GeneralClientInterface;

/**
 * search client interface
 * @todo write documentation
 */
interface ClientInterface extends GeneralClientInterface
{
    /**
     * Search products
     *
     * @param string $db_name
     * @param string $string
     * @param string $language
     *
     * @return false|array
     */
    public function searchItems($string, $language = null);
    
    public function __construct($db_name = null);
    
    //Item Handling
    public function addItem($id, array $item);
    public function updateItem($id, array $item);
    public function getItem($id);
    public function deleteItem($id);
    public function batchItems(array $items);
    
    //database
    public function setName($name);
    public function getName();
    public function getDetails();
    public function setScheme(array $scheme);
    public function delete();
    
    //@todo list all databases
}
