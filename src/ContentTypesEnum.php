<?php
namespace Aiphilos\Api;

class ContentTypesEnum
{
    const GENERAL_AUTO = 'general.auto';
    const PRODUCT_NUMBER = 'product.number';
    const PRODUCT_NAME = 'product.name';
    const PRODUCT_DESCRIPTION = 'product.description';
    const PRODUCT_PRICE = 'product.price';
    const PRODUCT_GTIN = 'product.gtin';
    const PRODUCT_MANUFACTURER = 'product.manufacturer';
    const PRODUCT_RATING = 'product.rating';
    const PRODUCT_STATE = 'product.state'; //[new,used,refurbished]
    const ORDER_FREQUENCY = 'order.frequency';
    
    /**
     * Lists all types
     * 
     * @return string[]
     */
    public static function getAll() {
        return array(
            self::GENERAL_AUTO,
            self::PRODUCT_NUMBER,
            self::PRODUCT_NAME,
            self::PRODUCT_DESCRIPTION,
            self::PRODUCT_PRICE,
            self::PRODUCT_GTIN,
            self::PRODUCT_MANUFACTURER,
            self::PRODUCT_RATING,
            self::PRODUCT_STATE,
            self::ORDER_FREQUENCY,
        );
    }
}