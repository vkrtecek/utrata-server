<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 18:21
 */

namespace App\Model\Exception;

class EOFException extends ApplicationException {

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
