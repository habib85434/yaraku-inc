<?php
namespace App\Libs\DTO;

use ReflectionClass;
use ReflectionProperty;

abstract class DataTransferObject
{
    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();

            if (!empty($parameters[$property])) {
                $this->{$property} = $parameters[$property];
            }
        }
    }
}
