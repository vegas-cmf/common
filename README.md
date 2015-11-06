Vegas CMF Common
================


`Vegas\Di\InjectionAwareTrait`

Helper trait for \Phalcon\Di\InjectionAwareInterface

```php
class Foo implements \Phalcon\Di\InjectionAwareInterface
{
    use \Vegas\Di\InjectionAwareTrait;
}
```

`Vegas\Http\Method`

List of Http methods

`Vegas\Hydrator`

Simple component to provide mechanisms both for hydrating objects, as well as extracting data sets from them.

- `Vegas\Hydrator\Method`
Hydrates object with given array using setter methods. Extracts data from object using getter methods.

```php
class Foo
{
    protected $bar;

    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    public function getBar()
    {
        return $this->bar;
    }
}

$array = ['bar' => 'test'];

$foo = new Foo();
(new \Vegas\Hydrator\Method())->hydrate($array, $foo);

echo $foo->getBar(); // 'test'

print_r((new \Vegas\Hydrator\Method())->extract($foo)); // ['bar' => 'test'];
```

- `Vegas\Hydrator\Property`
Hydrates object with given array using accessible class properties. Extracts data from object using accessible class properties.

```php
class Foo
{
    public $bar;
}

$array = ['bar' => 'test'];

$foo = new Foo();
(new \Vegas\Hydrator\Property())->hydrate($array, $foo);

echo $foo->bar; // 'test'

print_r((new \Vegas\Hydrator\Property())->extract($foo)); // ['bar' => 'test'];
```

- Naming strategy
Converts underscore to camelCase notation and vice versa.
Allows to fill object with methods/properties in camel case notation using array with underscore keys and vice versa.

* `UnderscoreToCamelCase`

```php
class Foo
{
    protected $camelCase;

    public function setCamelCase($val)
    {
        $this->camelCase = $val;
    }

    public function getCamelCase()
    {
        return $this->camelCase;
    }
}

$array = ['camel_case' => 'test'];

$foo = new Foo();
(new \Vegas\Hydrator\Method(new \Vegas\Hydrator\NamingStrategy\UnderscoreToCamelCase()))->hydrate($array, $foo);

echo $foo->getCamelCase(); // 'test'
```

* `CamelCaseToUnderscore`

```php
class Foo
{
    protected $camel_case;

    public function set_camel_case($val)
    {
        $this->camel_case = $val;
    }

    public function get_camel_case()
    {
        return $this->camel_case;
    }
}

$array = ['camelCase' => 'test'];

$foo = new Foo();
(new \Vegas\Hydrator\Method(new \Vegas\Hydrator\NamingStrategy\CamelCaseToUnderscore()))->hydrate($array, $foo);

echo $foo->get_camel_case(); // 'test'
```

`Vegas\Stdlib`

Set of components that implements general purpose utility class for different scopes:

- Array
- DateTime
- File
- String
