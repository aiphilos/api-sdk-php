<?php
namespace Aiphilos\Api;

/**
 * Generic solutions for the default factories
 */
abstract class AbstractFactory
{
    /**
     * Sets the default class name
     * 
     * @param string $class_name
     */
    public static function setDefaultClass($class_name)
    {
        if (self::checkClassName($class_name)) {
          static::$default_class = $class_name;
        }
    }
    
    /**
     * Returns the default class name
     * @return NULL|string
     */
    public static function getDefaultClass()
    {
        return isset(static::$default_class) ? static::$default_class : null;
    }
    
    /**
     * Checks the given class name
     * 
     * @param string $class_name
     * 
     * @throws \InvalidArgumentException
     * @throws \DomainException
     * 
     * @return boolean
     */
    protected static function checkClassName($class_name)
    {
        if (empty($class_name)) {
            throw new \InvalidArgumentException('$class_name must be given.');
        }
        if (!is_string($class_name)) {
            throw new \InvalidArgumentException('$class_name must be a string. '.gettype($class_name).' is given.');
        }
        if (!class_exists($class_name)) {
            throw new \DomainException('$class_name doesn\'t exist.');
        }
        return true;
    }
}
