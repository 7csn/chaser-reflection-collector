<?php

declare(strict_types=1);

namespace chaser\collector;

use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionProperty;

/**
 * 反射收集器
 *
 * @package chaser\collector
 */
class ReflectionCollector
{
    /**
     * 类型反射库
     *
     * @var array [$className => ReflectionClass]
     */
    protected static array $classReflections = [];

    /**
     * 类方法反射库
     *
     * @var ReflectionMethod[][] [$className => [$methodName => ReflectionMethod]]
     */
    protected static array $methodReflections = [];

    /**
     * 类属性反射库
     *
     * @var ReflectionProperty[][] [$className => [$propertyName => ReflectionProperty]]
     */
    protected static array $propertyReflections = [];

    /**
     * 类反射
     *
     * @param string $classname
     * @return ReflectionClass
     * @throws ReflectedException
     */
    public static function class(string $classname): ReflectionClass
    {
        try {
            return self::$classReflections[$classname] ??= new ReflectionClass($classname);
        } catch (ReflectionException) {
            throw new ReflectedException($classname, ReflectedException::CLASS_NOT_EXIST);
        }
    }

    /**
     * 类方法反射
     *
     * @param string $classname
     * @param string $methodName
     * @return ReflectionMethod
     * @throws ReflectedException
     */
    public static function method(string $classname, string $methodName): ReflectionMethod
    {
        try {
            return self::$methodReflections[$classname][$methodName] ??= self::class($classname)->getMethod($methodName);
        } catch (ReflectionException) {
            throw new ReflectedException($classname . '::' . $methodName, ReflectedException::METHOD_NOT_EXIST);
        }
    }

    /**
     * 类属性反射
     *
     * @param string $classname
     * @param string $propertyName
     * @return ReflectionProperty
     * @throws ReflectedException
     */
    public static function property(string $classname, string $propertyName): ReflectionProperty
    {
        try {
            return self::$propertyReflections[$classname][$propertyName] ??= self::class($classname)->getProperty($propertyName);
        } catch (ReflectionException) {
            throw new ReflectedException($classname . '::' . $propertyName, ReflectedException::PROPERTY_NOT_EXIST);
        }
    }
}
