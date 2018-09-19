<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 0:04
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\IPurposeDAO;
use App\Model\Entity\Language;
use App\Model\Entity\Purpose;
use Tests\Fake\Service\FakeMemberService;

class FakePurposeDAO implements IPurposeDAO
{
	/** @var Purpose */
	protected $p1;
	/** @var Purpose */
	protected $p2;
	/** @var Purpose */
	protected $p3;

    /**
     * FakePurposeDAO constructor.
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function __construct() {
		$p1 = new Purpose();
		$p1->setId(1);
		$p1->setCode('jidlo');
		$p1->setValue('Jídlo');
		$p1->setBase(TRUE);
		$p1->setLanguage((new Language())->setCode('CZK'));
		$p2 = new Purpose();
        $p2->setId(2);
		$p2->setCode('transport');
		$p2->setValue('Transport');
		$p2->setBase(FALSE);
		$p2->setLanguage((new Language())->setCode('CZK'));
		$p2->setCreator((new FakeMemberService())->getMember('vojta'));
		$p3 = new Purpose();
        $p3->setId(6);
		$p3->setCode('food');
		$p3->setValue('Food');
		$p3->setBase(TRUE);
		$p3->setLanguage((new Language())->setCode('ENG'));

		$this->p1 = $p1;
		$this->p2 = $p2;
		$this->p3 = $p3;
	}

	/** @inheritdoc */
	public function findAll(): array {
		return [ $this->p1, $this->p2, $this->p3 ];
	}

    /** @inheritdoc */
    public function findOne(int $id): ?Purpose {
		return $this->findAll()[$id % 3];
	}

    /** @inheritdoc */
    public function findItems(Purpose $purpose): array {
		return [];
	}

    /** @inheritdoc */
    public function findByColumn(string $key, string $val): array {
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

    /** @inheritdoc */
    public function create(Purpose $purpose): Purpose {
		return $purpose;
	}

    /** @inheritdoc */
    public function update(Purpose $purpose): Purpose {
		return $purpose;
	}

    /** @inheritdoc */
    public function delete(Purpose $purpose) {}
}
