<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Hydrator;

/**
 * Class Method
 * @package Vegas\Hydrator
 */
class Method extends HydratorAbstract
{
    const METHOD_GETTER = 'get';
    const METHOD_SETTER = 'set';

    /**
     * @param $name
     * @param $type
     * @return string
     */
    protected function getMethodName($name, $type)
    {
        $methodName = sprintf(
            '%s%s',
            $type,
            ucfirst($this->hasNamingStrategy() ? $this->namingStrategy->convert($name) : $name)
        );
        return $this->hasNamingStrategy() ? $this->namingStrategy->convert($methodName) : $methodName;
    }

    /**
     * @param $object
     * @return array
     */
    public function extract($object)
    {
        $reflection = new \ReflectionObject($object);
        $values = [];
        // filters static methods
        $staticMethods = array_map(function($method) {
            return $method->getName();
        }, $reflection->getMethods(\ReflectionMethod::IS_STATIC));

        foreach ($reflection->getMethods() as $method) {
            if (strpos($method->getName(), self::METHOD_GETTER) === 0 && !in_array($method->getName(), $staticMethods)) {
                $name = lcfirst(preg_replace('/' . self::METHOD_GETTER . '/', '', $method->getName(), 1));
                $name = $this->namingStrategy ? $this->namingStrategy->convert($name) : $name;

                $values[$name] = $method->invoke($object);
            }
        }

        return $values;
    }

    /**
     * @param array $data
     * @param $object
     */
    public function hydrate(array $data, $object)
    {
        $reflection = new \ReflectionObject($object);
        foreach ($data as $name => $value) {
            $methodName = $this->getMethodName($name, self::METHOD_SETTER);
            if ($reflection->hasMethod($methodName)) {
                $reflection->getMethod($methodName)->invoke($object, $value);
            }
        }
    }
}