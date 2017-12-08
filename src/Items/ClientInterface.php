<?php
namespace Aiphilos\Api\Items;

use Aiphilos\Api\ClientInterface as GeneralClientInterface;
use Aiphilos\Api\ContentTypesEnum;

/**
 * Items client interface
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
     * Returns the scheme
     *
     * @return array key -> value pairs @see ContentTypesEnum
     */
    public function getScheme();
    
    /**
     * Deletes the database
     */
    public function delete();
    
    /**
     * Returns all databases
     * 
     * @return string[]
     */
    public function getDatabases();
    
    /**
     * Checks if a database exists
     * 
     * @return bool
     */
    public function checkDatabaseExists();
    
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
     * Returns all Items in a database
     *
     * @throws \UnexpectedValueException
     *
     * @param array $config Array with key value options
     * int from
     * int size
     * string sort
     * string order asc|desc
     * boolean unsorted
     *
     * @return array
     */
    public function getItems(array $config = array());
    
    /**
     * Deletes an item
     * 
     * @param string|int $id
     */
    public function deleteItem($id);
    
    /**
     * insert/update/delete items
     * 
     * @param array $items
     */
    public function batchItems(array $items);
    
    /**
     * Search items
     *
     * @param string $string
     * @param string $language
     * @param array $config Array with key value options
     * int from
     * int size
     * string sort
     * string order asc|desc
     * boolean unsorted
     *
     * @return false|array
     */
    public function searchItems($string, $language = null, array $config = array());
}
