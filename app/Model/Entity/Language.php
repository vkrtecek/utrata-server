<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:58
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	protected $table = 'utrata_languages';

	public $primaryKey = 'LanguageCode';

	public $timestamps = false;

	public $incrementing = false;



	/**
	 * @return string
	 */
	public function getCode() {
		return $this->LanguageCode;
	}

	/**
	 * @param string $code
	 * @return Language
	 */
	public function setCode($code) {
		$this->LanguageCode = $code;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Language
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLocale() {
		return $this->locale;
	}
	/**
	 * @param string $locale
	 * @return Language
	 */
	public function setLocale($locale) {
		$this->locale = $locale;
		return $this;
	}

}