## 反射收集器

静态收集器，对外提供反射对象（无则自发创建并缓存），存储反射对象类型为：类、类方法、类属性、函数、注解。

### 运行环境

- PHP >= 8.0

### 安装

```
composer require 7csn/reflection-collector
```

### 应用说明

* 常规反射（php < 8）

    ```php
    use chaser\collector\RelectionCollector;
    use Closure;

    # 获取类反射
    ReflectionCollector::class(string $classname): ReflectionClass;
    
    # 获取类方法反射
    ReflectionCollector::method(string $classname, string $methodName): ReflectionMethod;
    
    # 获取类属性反射
    ReflectionCollector::property(string $classname, string $propertyName): ReflectionProperty;
    
    # 获取函数反射
    ReflectionCollector::function(Closure|string $functionOrName): ReflectionFunction;
    ```
* 注解反射（php >= 8)

    ```php
    use chaser\collector\AttributeCollector; 
    use Closure;
    
    # 获取类指定注解反射列表
    AttributeCollector::class(string $classname, string $attributeName): ReflectionAttribute[];
    
    # 获取类方法指定注解反射列表
    AttributeCollector::method(string $classname, string $methodName, string $attributeName): ReflectionAttribute[];
    
    # 获取类属性指定注解反射列表
    AttributeCollector::property(string $classname, string $propertyName, string $attributeName): ReflectionAttribute[];
    
    # 获取函数指定注解反射列表
    AttributeCollector::function(Closure|string $functionOrName, string $attributeName): ReflectionAttribute[];
    ```

* 可能抛出异常 chaser\collector\ReflectedException，错误码：
    * ReflectedException::CLASS_NOT_EXIST
    * ReflectedException::METHOD_NOT_EXIST
    * ReflectedException::PROPERTY_NOT_EXIST
    * ReflectedException::FUNCTION_NOT_EXIST
