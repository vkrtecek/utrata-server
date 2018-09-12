<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 11. 2017
 * Time: 11:47
 */

namespace App\Model\Exception;


class AlreadyExistException extends ApplicationException
{
	private $reason = '';

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

    /** @return string */
	public function getReason() {
		return $this->reason;
	}

	/**
	 * @param $reason
	 * @return AlreadyExistException
	 */
	public function setReason($reason) {
		$this->reason = $reason;
		return $this;
	}

}
