<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 22:35
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
	protected $table = 'utrata_translations';

	public $primaryKey = [ 'TranslationCode', 'LanguageCode' ];

	public $timestamps = false;

	public $incrementing = false;


	/** @var Language */
	private $language = NULL;


	/**
	 * @return string
	 */
	public function getCode() {
		return $this->TranslationCode;
	}

	/**
	 * @param string $code
     * @return Translation
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
     * @return Translation
	 */
	public function setValue($value) {
		$this->value = $value;
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
     * @return Translation
	 */
	public function setLanguage(Language $language) {
		$this->LanguageCode = $language->getCode();
		$this->language = $language;
        return $this;
	}

}
