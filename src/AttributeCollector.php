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
     * @var ReflectionAttribute[] [$className => ReflectionAttribute]
     */
    protected static array $classAttributes = [];

    /**
     * 类方法注解反射库
     *
     * @var ReflectionAttribute[][] [$className => [$methodName => ReflectionAttribute]]
     */
    protected static array $methodAttributes = [];

    /**
     * 类属性注解反射库
     *
     * @var ReflectionAttribute[][] [$className => [$propertyName => ReflectionAttribute]]
     */
    protected static array $propertyAttributes = [];

    /**
     * 函数注解反射库
     *
     * @var ReflectionAttribute[] [$functionName => ReflectionAttribute]
     */
    protected static array $functionAttributes = [];

    /**
     * 类注解反射
     *
     * @param string $classname
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function class(string $classname): array
    {
        return self::$classAttributes[$classname] ??= ReflectionCollector::class($classname)->getAttributes();
    }

    /**
     * 类方法注解反射
     *
     * @param string $classname
     * @param string $methodName
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function method(string $classname, string $methodName): array
    {
        return self::$methodAttributes[$classname][$methodName] ??= ReflectionCollector::method($classname, $methodName)->getAttributes();
    }

    /**
     * 类属性注解反射
     *
     * @param string $classname
     * @param string $propertyName
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function property(string $classname, string $propertyName): array
    {
        return self::$propertyAttributes[$classname][$propertyName] ??= ReflectionCollector::property($classname, $propertyName)->getAttributes();
    }

    /**
     * 函数注解反射
     *
     * @param string $functionName
     * @return ReflectionAttribute[]
     * @throws ReflectedException
     */
    public static function function (string $functionName): array
    {
        return self::$functionAttributes[$functionName] ??= ReflectionCollector::function($functionName)->getAttributes();
    }
}
