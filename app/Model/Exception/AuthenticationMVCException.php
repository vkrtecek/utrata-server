<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 1. 7. 2018
 * Time: 0:54
 */

namespace App\Model\Exception;

class AuthenticationMVCException extends AuthenticationException
{
    /**
     * BadParameterException constructor.
     * @param string $message
     * @param string $default
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct(string $message = "", string $default = "", int $code = 0, \Exception $previous = NULL)
    {
        parent::__construct($message, $default, $code, $previous);
    }
}
