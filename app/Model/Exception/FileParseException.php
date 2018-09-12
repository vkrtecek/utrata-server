<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 31. 1. 2018
 * Time: 1:07
 */

namespace App\Model\Exception;


class FileParseException extends ApplicationException {
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
