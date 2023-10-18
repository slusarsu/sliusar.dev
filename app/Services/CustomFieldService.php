<?php

namespace App\Services;

class CustomFieldService
{
    private static array $customFields;

    /**
     * @param string $typeName
     * @param array $typeFields
     * @return void
     */
    public static function setCustomFields(string $typeName, array $typeFields): void
    {
        self::$customFields[$typeName] = $typeFields;
    }

    public static function fields(string $key)
    {
        return static::$customFields[$key] ?? [];
    }
}
