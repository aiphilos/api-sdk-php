<?php
namespace Aiphilos\Api\Items;

use Aiphilos\Api\ClientInterface as GeneralClientInterface;
use Aiphilos\Api\ContentTypesEnum;

/**
 * search client interface
 * @todo write documentation
 */
interface ClientInterface extends GeneralClientInterface
{
    /**
     * Constructor
     * 
     * @param string $db_name
     */
    public function __construct($db_name = null);
    
    /**
     * Set the name
     * 
     * @param string $name
     */
    public function setName($name);
    
    /**
     * Return the name
     * 
     * @return string|null
     */
    public function getName();
    
    /**
     * Return the Database-Details
     * 
     * @return array
     */
    public function getDetails();
    
    /**
     * Sets the scheme
     * 
     * @param array $scheme key -> value pairs @see ContentTypesEnum
     */
    public function setScheme(array $scheme);
    
    /**
     * Deletes the database
     */
    public function delete();
    
    /**
     * Adds an item
     * 
     * @param string|int $id
     * @param array $item
     */
    public function addItem($id, array $item);
    
    /**
     * Updates an item
     * 
     * @param string|int $id
     * @param array $item
     */
    public function updateItem($id, array $item);
    
    /**
     * Returns an item
     * 
     * @param string|int $id
     */
    public function getItem($id);
    
    /**
     * Deletes an item
     * 
     * @param string|int $id
     */
    public function deleteItem($id);
    
    /**
     * insert/update/delete items
     * @param array $items
     */
    public function batchItems(array $items);
    
    /**
     * Search items
     *
     * @param string $string
     * @param string $language
     *
     * @return false|array
     */
    public function searchItems($string, $language = null);
    
    //@todo list all databases
}
