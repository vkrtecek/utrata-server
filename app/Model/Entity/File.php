<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 5:42
 */

namespace App\Model\Entity;


class File
{
	private $content = '';

	/**
	 * @param string $str
	 */
	public function append($str) {
		$this->content .= $str . '
';
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}
}