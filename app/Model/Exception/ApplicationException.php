<?php
/**
 * Created by PhpStorm.
 * User: Krtek
 * Date: 11.9.2018
 * Time: 22:45
 */

namespace App\Model\Exception;


use Throwable;

abstract class ApplicationException extends \Exception
{
    /** @var string */
    protected $default;
    /** @var array */
    protected $bind = [];

    /**
     * ApplicationException constructor.
     * @param string $message
     * @param string $default
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", string $default = "", int $code = 0, Throwable $previous = null){
        parent::__construct($message, $code, $previous);
        $this->default = $default;
    }


    /** @return string */
    public function getDefault() {
        return $this->default;
    }


    /**
     * @param array $bind
     * @return $this
     */
    public function setBind(array $bind) {
        $this->bind = $bind;
        return $this;
    }
    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getBind(string $key, string $default = ""): string {
        return $this->bind[$key] ?? $default;
    }
    /** @return array */
    public function getBinds(): array {
        return $this->bind;
    }
    /** @return bool */
    public function hasBind(): bool {
        return $this->bind !== [];
    }


    /**
     * @param string $message
     * @return string
     */
    public function bind(string $message): string {
        foreach ($this->bind as $bind => $val) {
            $message = str_replace(':' . $bind, $val, $message);
        }
        return $message;
    }
}
