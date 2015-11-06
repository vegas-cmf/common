<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas;

/**
 * Class Env
 * @package Vegas
 */
class Env extends Enum
{
    const PRODUCTION = 'production';

    const DEVELOPMENT = 'development';

    const TEST = 'test';
}