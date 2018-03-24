<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 22:34
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Purpose extends Model
{
	protected $table = 'utrata_purposes';

	public $primaryKey = 'PurposeID';

	public $timestamps = false;

	/** @var Member */
	private $creator = NULL;

	/** @var Language */
	private $language = NULL;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->PurposeID;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param string $code
	 * @return Purpose
	 */
	public function setCode($code) {
		$this->code = $code;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param string $value
	 * @return Purpose
	 */
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isBase() {
		return $this->base == 1;
	}

	/**
	 * @param boolean $base
	 * @return Purpose
	 */
	public function setBase($base) {
		$this->base = $base;
		return $this;
	}

	/**
	 * @return Language
	 */
	public function getLanguage() {
		if (!$this->language)
			$this->language = Language::find($this->LanguageCode);
		return $this->language;
	}

	/**
	 * @param Language $language
	 * @return Purpose
	 */
	public function setLanguage(Language $language) {
		$this->LanguageCode = $language->getCode();
		$this->language = $language;
		return $this;
	}

	/**
	 * @return Member
	 */
	public function getCreator() {
		if (!$this->creator)
			$this->creator = Member::find($this->CreatorID);
		return $this->creator;
	}

	/**
	 * @param Member $creator
	 * @return Purpose
	 */
	public function setCreator(Member $creator) {
		$this->CreatorID = $creator->getId();
		$this->creator = $creator;
		return $this;
	}
}