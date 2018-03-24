<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:57
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	protected $table = 'utrata_currencies';

	public $primaryKey = 'CurrencyID';

	public $timestamps = false;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->CurrencyID;
	}

	/**
	 * @param int $id
	 * @return $this
	 */
	public function setId($id) {
		$this->CurrencyID = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param string $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string$name
	 */
	public function setName($name) {
		$this->name = $name;
	}
}