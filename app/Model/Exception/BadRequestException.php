<?php
/**
 * Created by PhpStorm.
 * User: Krtek
 * Date: 12.9.2018
 * Time: 1:13
 */

namespace App\Model\Exception;


class BadRequestException extends ApplicationException
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
