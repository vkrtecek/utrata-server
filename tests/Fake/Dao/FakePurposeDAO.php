<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 0:04
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\IPurposeDAO;
use App\Model\Entity\Item;
use App\Model\Entity\Language;
use App\Model\Entity\Purpose;
use App\Model\Exception\IntegrityException;
use Tests\Fake\Service\FakeMemberService;

class FakePurposeDAO implements IPurposeDAO
{
	/** @var Purpose */
	protected $p1;
	/** @var Purpose */
	protected $p2;
	/** @var Purpose */
	protected $p3;

	public function __construct() {
		$p1 = new Purpose();
		$p1->setCode('jidlo');
		$p1->setValue('Jídlo');
		$p1->setBase(TRUE);
		$p1->setLanguage((new Language())->setCode('CZK'));
		$p2 = new Purpose();
		$p2->setCode('transport');
		$p2->setValue('Transport');
		$p2->setBase(FALSE);
		$p2->setLanguage((new Language())->setCode('CZK'));
		$p2->setCreator((new FakeMemberService())->getMember('vojta'));
		$p3 = new Purpose();
		$p3->setCode('food');
		$p3->setValue('Food');
		$p3->setBase(TRUE);
		$p3->setLanguage((new Language())->setCode('ENG'));

		$this->p1 = $p1;
		$this->p2 = $p2;
		$this->p3 = $p3;
	}

	/**
	 * @return Purpose[]|NULL
	 */
	public function findAll() {
		return [ $this->p1, $this->p2, $this->p3 ];
	}

	/**
	 * @param int $id
	 * @return Purpose|NULL
	 */
	public function findOne($id) {
		return $this->findAll()[$id % 3];
	}

	/**
	 * @param Purpose $purpose
	 * @return Item[]|NULL
	 */
	public function findItems(Purpose $purpose) {
		return [];
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Purpose[]|NULL
	 */
	public function findByColumn($key, $val) {
		if ($key == 'LanguageCode') {
			$ret = [];
			foreach ($this->findAll() as $purpose)
				if ($purpose->getLanguage()->getCode() == $val)
					$ret[] = $purpose;
			return $ret;
		}
		$ret = [];
		foreach ($this->findAll() as $purpose)
			if ($purpose->{"get$key"}() == $val)
			$ret[] = $purpose;
		return $ret;
	}

	/**
	 * @param Purpose $purpose
	 * @return Purpose
	 */
	public function create(Purpose $purpose) {
		return $purpose;
	}

	/**
	 * @param Purpose $purpose
	 * @return Purpose
	 */
	public function update(Purpose $purpose) {
		return $purpose;
	}

	/**
	 * @param Purpose $purpose
	 * @throws IntegrityException
	 */
	public function delete(Purpose $purpose) {}
}