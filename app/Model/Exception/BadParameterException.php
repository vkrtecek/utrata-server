<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 13. 10. 2017
 * Time: 16:08
 */

namespace App\Model\Exception;


class BadParameterException extends \Exception
{
    /** @var string */
    private $default;

    /**
     * BadParameterException constructor.
     * @param string $message
     * @param string $default
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = "", $default = "", $code = 0, \Exception $previous = NULL) {
        parent::__construct($message, $code, $previous);
        $this->default = $default;
    }

    /** @return string */
    public function getDefault() {
        return $this->default;
    }
}
