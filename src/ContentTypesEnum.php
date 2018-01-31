<?php
namespace Aiphilos\Api;

class ContentTypesEnum
{
    const GENERAL_AUTO = 'general.auto';
    const GENERAL_RAW = 'general.raw';
    const GENERAL_OFF = 'general.off';
    const PRODUCT_NUMBER = 'product.number';
    const PRODUCT_NAME = 'product.name';
    const PRODUCT_DESCRIPTION = 'product.description';
    const PRODUCT_PRICE = 'product.price';
    const PRODUCT_GTIN = 'product.gtin';
    const PRODUCT_SUPPLIER = 'product.supplier';
    const PRODUCT_SUPPLIER_NUMBER = 'product.supplier_number';
    const PRODUCT_MANUFACTURER = 'product.manufacturer';
    const PRODUCT_MANUFACTURER_NUMBER = 'product.manufacturer_number';
    const PRODUCT_RATING = 'product.rating';
    const PRODUCT_STATE = 'product.state'; //[new,used,refurbished]
    const PRODUCT_CATEGORY = 'product.category';
    const PRODUCT_MODIFIER = 'product.modifier';
    const PRODUCT_OBJECT = 'product.object';
    const PRODUCT_STOCK = 'product.stock';
    const ORDER_FREQUENCY = 'order.frequency';
    
    /**
     * Lists all types
     * 
     * @return string[]
     */
    public static function getAll() {
        return array(
            self::GENERAL_AUTO,
            self::GENERAL_RAW,
            self::GENERAL_OFF,
            self::PRODUCT_NUMBER,
            self::PRODUCT_NAME,
            self::PRODUCT_DESCRIPTION,
            self::PRODUCT_PRICE,
            self::PRODUCT_GTIN,
            self::PRODUCT_SUPPLIER,
            self::PRODUCT_SUPPLIER_NUMBER,
            self::PRODUCT_MANUFACTURER,
            self::PRODUCT_MANUFACTURER_NUMBER,
            self::PRODUCT_RATING,
            self::PRODUCT_STATE,
            self::PRODUCT_CATEGORY,
            self::PRODUCT_MODIFIER,
            self::PRODUCT_OBJECT,
            self::PRODUCT_STOCK,
            self::ORDER_FREQUENCY,
        );
    }
}