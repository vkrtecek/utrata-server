<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 9. 12. 2017
 * Time: 19:02
 */

namespace App\Model\Exception;


class SecurityException extends ApplicationException
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
