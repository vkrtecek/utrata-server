<?php

/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 1. 2018
 * Time: 23:20
 */

namespace App\Model\Filter;

class ItemFilter
{
	/**
	 * @var string
	 */
	private $month;

	/**
	 * @var string[]
	 */
	private $notes;

	/**
	 * @var int
	 */
	private $year;

	/**
	 * @var string
	 */
	private $pattern;

	/**
	 * @var int $wallet
	 */
	private $walletId;

	/**
	 * @var string
	 */
	private $orderBy = 'date';

	/**
	 * @var string
	 */
	private $orderHow = 'desc';

	/**
	 * @var int
	 */
	private $limit;


	/**
	 * ItemFilter constructor.
	 */
	public function __construct() {
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasFilter() {
		return $this->getMonth() != ""
			|| count($this->getNotes())
			|| $this->getYear() != ""
			|| $this->getPattern() != "";
	}

	/**
	 * @return string
	 */
	public function getMonth()
	{
		return $this->month;
	}

	/**
	 * @param string $month
	 * @return ItemFilter
	 */
	public function setMonth($month)
	{
		$this->month = $month;
		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getNotes()
	{
		return $this->notes;
	}

	/**
	 * @param string[] $notes
	 * @return ItemFilter
	 */
	public function setNotes($notes)
	{
		$tmp = [];
		foreach ($notes as $note)
			if ($note != "")
				$tmp[] = $note;
		$this->notes = $tmp;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * @param int $year
	 * @return ItemFilter
	 */
	public function setYear($year)
	{
		$this->year = $year;
		if ($year == "null") $this->year = "";
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPattern()
	{
		return $this->pattern;
	}

	/**
	 * @param string $pattern
	 * @return ItemFilter
	 */
	public function setPattern($pattern)
	{
		$this->pattern = $pattern;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getWalletId()
	{
		return $this->walletId;
	}

	/**
	 * @param int $walletId
	 * @return ItemFilter
	 */
	public function setWalletId($walletId)
	{
		$this->walletId = $walletId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrderBy()
	{
		return $this->orderBy;
	}

	/**
	 * @param string $orderBy
	 * @return ItemFilter
	 */
	public function setOrderBy($orderBy)
	{
		if ($orderBy != "") $this->orderBy = $orderBy;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrderHow()
	{
		return $this->orderHow;
	}

	/**
	 * @param string $orderHow
	 * @return ItemFilter
	 */
	public function setOrderHow($orderHow)
	{
		if ($orderHow != "") $this->orderHow = $orderHow;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLimit()
	{
		return $this->limit;
	}

	/**
	 * @param int $limit
	 * @return ItemFilter
	 */
	public function setLimit($limit)
	{
		$this->limit = $limit;
		return $this;
	}


}