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
 * Class Property
 * @package Vegas\Hydrator
 */
class Property extends HydratorAbstract
{

    /**
     * @param $object
     * @return array
     */
    public function extract($object)
    {
        $reflection = new \ReflectionObject($object);
        $properties = [];
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $propertyName = $this->namingStrategy
                ? $this->namingStrategy->convert($property->getName()) : $property->getName();

            $properties[$propertyName] = $property->getValue($object);
        }

        return $properties;
    }

    /**
     * @param array $data
     * @param $object
     * @return mixed
     */
    public function hydrate(array $data, $object)
    {
        $reflection = new \ReflectionObject($object);
        foreach ($data as $name => $value) {
            $propertyName = $this->namingStrategy
                ? $this->namingStrategy->convert($name) : $name;

            if ($reflection->hasProperty($propertyName)) {
                $property = $reflection->getProperty($propertyName);
                if ($property->isPublic()) {
                    $property->setValue($object, $value);
                }
            }
        }

        return $object;
    }
}