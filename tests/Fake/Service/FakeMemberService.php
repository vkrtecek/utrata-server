<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 23:56
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Member;
use App\Model\Service\IMemberService;
use Tests\Fake\Dao\FakeMemberDAO;

class FakeMemberService implements IMemberService
{
    /** @inheritdoc */
    public function getMembers(): array {
        return [];
	}

    /**
     * @inheritdoc
     * @throws \App\Model\Exception\BadParameterException
     */
    public function getMember(string $login): Member {
		$member = new Member();
		if ($login == 'vojta') {
			$member->setId(1);
			$member->setFirstName('Štěpán');
			$member->setLastName('Krteček');
		} else {
			$member->setId(2);
			$member->setFirstName('Jožka');
			$member->setLastName('Konvička');
		}
		$member->setLogin($login);
		$member->setLanguage((new FakeLanguageService())->getLanguage('CZK'));
		$member->setCurrency((new FakeCurrencyService())->getCurrency(1));
		$member->setAccess(new \DateTime('2017-08-26 22:23:38'));
		return $member;
	}

    /** @inheritdoc */
    public function getByToken(string $token): Member {
        return (new FakeMemberDAO())->findOneByColumn('token', $token);
	}

    /** @inheritdoc */
    public function getMemberByColumn(string $column, string $login): Member {
		return $this->getMember($login);
	}

    /** @inheritdoc */
    public function createMember(array $data): Member {
        return (new FakeMemberDAO())->findOne('jožka');
	}

    /** @inheritdoc */
    public function updateMember(string $login, array $data): Member {
        return (new FakeMemberDAO())->findOne('jožka');
	}

    /** @inheritdoc */
    public function deleteMember(string $login)	{}

    /** @inheritdoc */
    public function interactWithFacebook(array $data): Member {
        return (new FakeMemberDAO())->findOne('jožka');
	}

    /** @inheritdoc */
    public function login(string $login, string $password): Member {
        return (new FakeMemberDAO())->findOne('jožka');
	}

    /** @inheritdoc */
    public function loginByFacebook(string $login): Member	{
        return (new FakeMemberDAO())->findOne('jožka');
	}

    /** @inheritdoc */
    public function logout(Member $member): Member {
        return (new FakeMemberDAO())->findOne('jožka');
	}

    /** @inheritdoc */
    public function format(Member $member): array {
        return [];
	}

    /** @inheritdoc */
    public function formatEntities(array $members): array {
        return [];
	}
}
