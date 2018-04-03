<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 11. 2017
 * Time: 11:47
 */

namespace App\Model\Exception;


class AlreadyExistException extends \Exception
{
	private $reason = '';
    /**
     * BadParameterException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception $previous
	 * @return AlreadyExistException
     */
    public function __construct($message = "", $code = 0, \Exception $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
		return $this;
    }

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