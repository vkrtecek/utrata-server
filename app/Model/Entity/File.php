<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 29. 1. 2018
 * Time: 5:42
 */

namespace App\Model\Entity;


use App\Model\Exception\EOFException;

class File
{
	/** @var string[] */
	private $content = [];
	/** @var int */
	private $line = 0;
	/** @var string */
	private $separator = PHP_EOL;

	/**
	 * File constructor.
	 * @param string $content
	 */
	public function __construct($content = NULL) {
		if ($content) {
			$this->content = explode($this->separator, $content);
		}
	}

	/**
	 * @param string $str
	 */
	public function appendLine($str) {
		$this->content[] = $str;
	}

	/**
	 * @return string
	 * @throws EOFException
	 */
	public function getLine() {
		if ($this->line >= count($this->content))
			throw new EOFException('No such line in that file');
		return $this->content[$this->line++];
	}

	/**
	 * @return string
	 */
	public function getContent() {
		$ret = '';
		foreach ($this->content as $line)
			$ret .= $line . $this->separator;
		return $ret;
	}
}