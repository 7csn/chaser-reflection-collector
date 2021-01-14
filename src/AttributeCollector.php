<?php

declare(strict_types=1);

namespace chaser\collector;

use ReflectionAttribute;

/**
 * 注解收集器
 *
 * @package chaser\collector
 */
class AttributeCollector
{
    /**
     * 类注解反射库
     *
     * @var ReflectionAttribute[][] [$className => [$attributeName => ReflectionAttribute]]
     */
    protected static array $classAttributes = [];

    /**
     * 类方法注解反射库
     *
     * @var ReflectionAttribute[][][] [$className => [$methodName => [$attributeName => ReflectionAttribute]]]
     */
    protected static array $methodAttributes = [];

    /**
     * 类属性注解反射库
     *
     * @var ReflectionAttribute[][][] [$className => [$propertyName => [$attributeName => ReflectionAttribute]]]
     */
    protected static array $propertyAttributes = [];

    /**
     * 类注解反射
     *
     * @param string $classname
     * @param string $attributeName
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function class(string $classname): array
    {
        return self::$classAttributes[$classname][$attributeName] ??= ReflectionCollector::class($classname)->getAttributes($attributeName);
    }

    /**
     * 类方法注解反射
     *
     * @param string $classname
     * @param string $methodName
     * @param string $attributeName
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function method(string $classname, string $methodName, string $attributeName): array
    {
        return self::$methodAttributes[$classname][$methodName][$attributeName] ??= ReflectionCollector::method($classname, $methodName)->getAttributes($attributeName);
    }

    /**
     * 类属性注解反射
     *
     * @param string $classname
     * @param string $propertyName
     * @param string $attributeName
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function property(string $classname, string $propertyName, string $attributeName): array
    {
        return self::$propertyAttributes[$classname][$propertyName][$attributeName] ??= ReflectionCollector::property($classname, $propertyName)->getAttributes($attributeName);
    }
}
