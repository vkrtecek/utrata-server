<?php

/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 1. 2018
 * Time: 23:20
 */

namespace App\Model\Filter;

use App\Model\Entity\Member;
use App\Model\Enum\ItemState;
use App\Model\Exception\BadParameterException;

class ItemFilter extends AbstractFilter
{
	const WORD_SEPARATOR = '  ';

	const DEFAULT_YEAR = NULL;
    const DEFAULT_MONTH = '';
    const DEFAULT_NOTES = [];
    const DEFAULT_WALLET_ID = NULL;

	/** @var int */
	private $state = ItemState::UNCHECKED;

	/** @var string */
	private $month;

	/** @var string[] */
	private $notes;

	/** @var Member */
	private $member = NULL;

	/** @var int */
	private $year;

	/** @var int $wallet */
	private $walletId;

	/** @var bool */
	private $vyber = NULL;

	/** @var bool */
	private $active = TRUE;

	/** @var bool */
	private $income = FALSE;


	/**
	 * ItemFilter constructor.
	 */
	public function __construct() {
	    parent::__construct();
    }

	/**
     * @inheritdoc
     * @throws BadParameterException
     */
	public static function create(array $data): ItemFilter {
        if (self::$instance === null)
            self::$instance = new self;
        parent::create($data);

//        self::$instance->setDateFrom(isset($data['main_time_from']) ? new \DateTime($data['main_time_from']) : self::DEFAULT_DATE_FROM); // todo default date from env()?
//        self::$instance->setDateTo(isset($data['main_time_to']) ? new \DateTime($data['main_time_to']) : self::DEFAULT_DATE_TO);


        self::$instance->setState($data['state'] ?? ItemState::UNCHECKED);
        self::$instance->setWalletId($data['walletId'] ?? self::DEFAULT_WALLET_ID);
        self::$instance->setMonth($data['month'] ?? self::DEFAULT_MONTH);
        self::$instance->setNotes($data['notes'] ?? self::DEFAULT_NOTES);
        self::$instance->setYear($data['year'] ?? self::DEFAULT_YEAR);

        switch (self::$instance->getState()) {
            case ItemState::UNCHECKED:
                self::$instance->setActive(TRUE)->setVyber(FALSE)->setIncome(FALSE);
                break;
            case ItemState::CHECKED:
                self::$instance->setActive(FALSE)->setVyber(FALSE)->setIncome(FALSE);
                break;
            case ItemState::INCOMES:
                self::$instance->setIncome(TRUE);//->setVyber(FALSE);
                break;
            case ItemState::ALL:
                self::$instance->setVyber(FALSE);
                break;
            default:
                throw new BadParameterException('ItemService: Bad ItemState.');
        }
        return self::$instance;
    }

	/**
	 * @return bool
	 */
	public function hasFilter(): bool {
		return $this->getMonth() != ""
			|| count($this->getNotes())
			|| $this->getYear() != ""
			|| $this->getPattern() != "";
	}


	/** @return string */
	public function getMonth(): ?string {
		return $this->month;
	}
	/**
	 * @param string $month
	 * @return ItemFilter
	 */
	public function setMonth(?string $month): ItemFilter {
		$this->month = $month;
		return $this;
	}


	/** @return string[] */
	public function getNotes(): ?array {
		return $this->notes;
	}
	/**
	 * @param string $notes
	 * @return ItemFilter
	 */
	public function setNotes($notes): ItemFilter {
	    if ($notes === null)
	        return $this;
		$notes = is_array($notes) ? $notes : explode(',', $notes);
		foreach ($notes as $key => $note)
			if ($note == "")
				unset($notes[$key]);
		$this->notes = $notes;
		return $this;
	}


	/** @return int */
	public function getYear(): ?int {
		return $this->year;
	}
	/**
	 * @param int $year
	 * @return ItemFilter
	 */
	public function setYear(?int $year): ItemFilter {
		$this->year = $year;
		if ($year == "null") $this->year = "";
		return $this;
	}


	/** @return int */
	public function getWalletId(): ?int {
		return $this->walletId;
	}
	/**
	 * @param int $walletId
	 * @return ItemFilter
	 */
	public function setWalletId(?int $walletId): ItemFilter {
		$this->walletId = $walletId;
		return $this;
	}


	/** @return boolean */
	public function isVyber(): ?bool {
		return $this->vyber;
	}
	/**
	 * @param bool $vyber
	 * @return ItemFilter
	 */
	public function setVyber(bool $vyber): ItemFilter {
		$this->vyber = $vyber;
		return $this;
	}


	/** @return bool */
	public function isActive(): bool {
		return $this->active;
	}
	/**
	 * @param bool $active
	 * @return ItemFilter
	 */
	public function setActive(bool $active): ItemFilter {
		$this->active = $active;
		return $this;
	}


	/** @return bool */
	public function isIncome(): bool {
		return $this->income;
	}
	/**
	 * @param boolean $income
	 * @return ItemFilter
	 */
	public function setIncome(bool $income): ItemFilter {
		$this->income = $income;
		return $this;
	}


	/** @return Member */
	public function getMember(): ?Member {
		return $this->member;
	}
	/**
	 * @param Member $member
	 * @return ItemFilter
	 */
	public function setMember($member): ItemFilter {
		$this->member = $member;
		return $this;
	}


	/** @return int */
	public function getState(): int {
	    return $this->state;
    }
    /**
     * @param int $state
     * @return ItemFilter
     * @throws BadParameterException
     */
    public function setState(int $state): ItemFilter {
	    $this->state = $state;
        switch ($state) {
            case ItemState::UNCHECKED:
                $this->setActive(TRUE)->setVyber(FALSE)->setIncome(FALSE);
                break;
            case ItemState::CHECKED:
                $this->setActive(FALSE)->setVyber(FALSE)->setIncome(FALSE);
                break;
            case ItemState::INCOMES:
                $this->setIncome(TRUE);//->setVyber(FALSE);
                break;
            case ItemState::ALL:
                $this->setVyber(FALSE);
                break;
            default:
                throw new BadParameterException('ItemService: Bad ItemState.');
        }
	    return $this;
    }


}
