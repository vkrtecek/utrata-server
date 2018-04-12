<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 2. 2018
 * Time: 23:36
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\IMemberDAO;
use App\Model\Entity\Currency;
use App\Model\Entity\Item;
use App\Model\Entity\Language;
use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use App\Model\Entity\Wallet;
use App\Model\Exception\IntegrityException;
use Tests\Fake\Service\FakeItemService;
use Tests\Fake\Service\FakeMemberPurposeService;
use Tests\Fake\Service\FakePurposeService;
use Tests\Fake\Service\FakeWalletService;

class FakeMemberDAO implements IMemberDAO
{
	/** @var Member */
	private $member;
	/** @var Member */
	private $member2;

	public function __construct() {
		$l = new Language(); $l->setCode('CZK');
		$c = new Currency(); $c->setId(1)->setValue('Kč');

		$this->member = new Member();
		$this->member->setFirstName('Štěpán')->setLastName('Krteček')
			->setLogin('vojta')->setSendMonthly(FALSE)
			->setMyMail('example123@mail.com')->setLogged(1)->setToken('some token')
			->setPassword('$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua')
			->setExpiration((new \DateTime('+ 14 days')))->setAccess(new \DateTime('2018-03-29 12:07:23'))
			->setCreated((new \DateTime()))->setLanguage($l)->setCurrency($c)->setId(1);

		$this->member2 = new Member();
		$this->member2->setFirstName('John')->setLastName('Doe')
			->setLogin('example_login')->setSendMonthly(FALSE)
			->setMyMail('example123@mail.com')->setLogged(1)->setToken('some token')
			->setPassword('$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua')
			->setExpiration((new \DateTime('+ 14 days')))->setAccess(new \DateTime('2018-03-29 12:07:23'))
			->setCreated((new \DateTime()))->setLanguage($l)->setCurrency($c)->setId(2);
	}

	/**
	 * @return Member[]|NULL
	 */
	public function findAll() {
		return [ $this->member, $this->member2 ];
	}

	/**
	 * @param string $login
	 * @return Member|NULL
	 */
	public function findOne($login) {
		$logins = [ 'vojta' ];
		if (in_array($login, $logins)) {
			$this->member->setLogin($login);
			return $this->member;
		}

		$logins = [ 'krtek', 'example', '123456789' ];

		if (in_array($login, $logins)) {
			$this->member2->setLogin($login);
			return $this->member2;
		}
		return NULL;
	}



	/**
	 * @param Member $member
	 * @return MemberPurpose[]
	 */
	public function getMemberPurposes(Member $member) {
		return (new FakeMemberPurposeService())->getMemberPurposes($member);
	}

	/**
	 * @param Member $member
	 * @return Purpose[]
	 */
	public function getPurposes(Member $member) {
		return (new FakePurposeService())->getUserPurposes($member);
	}

	/**
	 * @param Member $member
	 * @return Wallet[]
	 */
	public function getWallets(Member $member) {
		return (new FakeWalletService())->getWallets($member->getLogin());
	}

	/**
	 * @param Member $member
	 * @return Item[]
	 */
	public function getItems(Member $member) {
		return (new FakeItemService())->getWalletItems(1, $member, NULL, NULL, NULL, NULL, NULL, 'price', 'DESC', NULL);
	}

	/**
	 * @param Member $member
	 * @return Member
	 */
	public function create(Member $member) {
		$member->setCreated(new \DateTime());
		return $member;
	}

	/**
	 * @param Member $member
	 * @return Member
	 */
	public function update(Member $member) {
		return $member;
	}

	/**
	 * @param Member $member
	 * @return void
	 * @throws IntegrityException
	 */
	public function delete(Member $member) {}

	/**
	 * @param $key
	 * @param $val
	 * @return Member|NULL
	 */
	public function findOneByColumn($key, $val) {
		if ($key == 'login')
			return $this->findOne($val);

		return $this->member;
	}

	/**
	 * @param string $login
	 * @return bool
	 *
	 */
	public function uniqueLogin($login) {
		return TRUE;
	}

	/**
	 * @param string $mail
	 * @return bool
	 */
	public function uniqueMail($mail) {
		return TRUE;
	}
}