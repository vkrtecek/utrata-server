<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:48
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Member;
use App\Model\Entity\Purpose;
use App\Model\Service\IPurposeService;
use Tests\Fake\Dao\FakePurposeDAO;

class FakePurposeService implements IPurposeService
{
	/** @var FakePurposeDAO */
	protected $purposeDao;

	/** @var Purpose */
	protected $purpose;

    /**
     * FakePurposeService constructor.
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function __construct() {
		$this->purposeDao = new FakePurposeDAO();
		$this->purpose = (new Purpose)->setValue('Jídlo')->setCode('jidlo')->setBase(true);
	}

    /** @inheritdoc */
    public function getPurposes(): array {
        return [];
    }

    /** @inheritdoc */
    public function getLanguagePurposes(string $code): array {
        return [];
    }

    /** @inheritdoc */
    public function getLanguageBasePurposes(string $languageCode): array {
		return [];
	}

    /** @inheritdoc */
    public function getUserLanguagePurposes(Member $member, string $languageCode): array {
        return [];
    }

    /** @inheritdoc */
    public function getUserPurposes(Member $member): array {
        return [];
    }

    /** @inheritdoc */
    public function getPurposesCreatedByUser(Member $member): array {
        return [];
    }

    /** @inheritdoc */
    public function getPurpose(int $id): Purpose {
		return $this->purposeDao->findOne($id);
	}

    /** @inheritdoc */
    public function createPurpose(Member $member, array $data): Purpose {
        return $this->purpose;
    }

    /** @inheritdoc */
    public function updatePurpose(int $id, array $data): Purpose {
        return $this->purpose;
    }

    /** @inheritdoc */
    public function deletePurpose(int $id, Member $member) {}

    /** @inheritdoc */
    public function format(Purpose $purpose, Member $member): array {
        return [];
    }

    /** @inheritdoc */
    public function formatEntities(array $purposes, Member $member): array {
        return [];
    }
}
