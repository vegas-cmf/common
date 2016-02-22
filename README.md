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
- Path

### Vegas Assets Management

To provide easiness of maintaining assets we prepared grunt and gulp tasks which allow you to download all dependencies from vendor directory. We have specified unique name - `vegas.json` - to store project's dependencies (and their overrides) in external libraries.

#### Example vegas.json

```json 
{
    "dependencies": {
        "bootstrap": "3.1.0"
    },
    "exportsOverride": {
        "bootstrap": {
            "js": [
                "dist/js/*.js",
                "dist/js/*.map"
            ],
            "css": [
                "dist/css/*.css",
                "dist/css/*.map"
            ],
            "fonts": "dist/fonts/*.*"
        }
    }

}
```

### Requirements

#### Grunt

```sh
$ npm install --global grunt-cli
```

#### Gulp

__If you have previously installed a version of gulp globally, please run `npm rm --global gulp`
to make sure your old version doesn't collide with gulp-cli.__

```sh
$ npm install --global gulp-cli
```

### Basic setup

Add the following script commands to your composer.json file

#### Grunt commands:

```shell
"scripts": {
    "post-install-cmd": [
        "cp vendor/vegas-cmf/common/Gruntfile.js .",
        "cp vendor/vegas-cmf/common/grunt_package.json ./package.json"
    ],
    "post-update-cmd": [
        "cp vendor/vegas-cmf/common/Gruntfile.js .",
        "cp vendor/vegas-cmf/common/grunt_package.json ./package.json"
    ]
}
```

#### Gulp commands:

```shell
"scripts": {
    "post-install-cmd": [
        "cp vendor/vegas-cmf/common/gulpfile.js .",
        "cp vendor/vegas-cmf/common/gulp_package.json ./package.json"
    ],
    "post-update-cmd": [
        "cp vendor/vegas-cmf/common/gulpfile.js .",
        "cp vendor/vegas-cmf/common/gulp_package.json ./package.json"
    ]
}
```

Run composer update or install command 

```shell
php composer.phar update
```

Install NPM packages

```shell
npm install
```
> Note: Use sudo in case of permission problems

### Run

Merge all assets to bower file and run bower install by a simple shell command

```shell
grunt
```

or:

```shell
gulp
```

#### Custom options

You can also run bower install or bower update task without merging assets from vendor. For grunt:

```shell
grunt bower:update // update

grunt bower:install // install
```

For gulp:

```shell
gulp bower
```
