<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Di\Injector\Exception;

/**
 * Class InvalidServiceException
 * @package Vegas\Di\Injector\Exception
 */
class InvalidServiceException extends \Exception
{
    protected $message = 'Invalid service';
}