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
use App\Model\Entity\Language;
use App\Model\Entity\Member;
use App\Model\Exception\IntegrityException;

class FakeMemberDAO implements IMemberDAO
{
	/**
	 * @return Member[]|NULL
	 */
	public function findAll() {
		$l = new Language(); $l->setCode('CZK');
		$c = new Currency(); $c->setId(1)->setValue('Kč');
		$member = new Member();
		$member->setFirstName('John')->setLastName('Doe')
			->setLogin('example_login')->setSendMonthly(FALSE)->setMotherMail('example12@mail.com')
			->setMyMail('example123@mail.com')->setLogged(1)->setToken('some token')
			->setPassword('$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua')
			->setExpiration((new \DateTime('+ 14 days')))
			->setCreated((new \DateTime()))->setLanguage($l)->setCurrency($c);
		return [ $member ];
	}

	/**
	 * @param string $login
	 * @return Member|NULL
	 */
	public function findOne($login) {
		$logins = [ 'krtek', 'example', '123456789' ];

		if (in_array($login, $logins)) {
			$l = new Language();
			$l->setCode('CZK');
			$c = new Currency();
			$c->setId(1)->setValue('Kč');
			$member = new Member();
			$member->setFirstName('John')->setLastName('Doe')
				->setLogin($login)->setSendMonthly(FALSE)->setMotherMail('example12@mail.com')
				->setMyMail('example123@mail.com')->setLogged(1)->setToken('some token')
				->setPassword('$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua')
				->setExpiration((new \DateTime('+ 14 days')))
				->setCreated((new \DateTime()))->setLanguage($l)->setCurrency($c);
			return $member;
		}
		return NULL;
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

		$l = new Language(); $l->setCode('CZK');
		$c = new Currency(); $c->setId(1)->setValue('Kč');
		$member = new Member();
		$member->setFirstName('John')->setLastName('Doe')
			->setLogin('example_login')->setSendMonthly(FALSE)->setMotherMail('example12@mail.com')
			->setMyMail('example123@mail.com')->setLogged(1)->setToken('some token')
			->setPassword('$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua')
			->setExpiration((new \DateTime('+ 14 days')))
			->setCreated((new \DateTime()))->setLanguage($l)->setCurrency($c);
		return $member;
	}

	/**
	 * @param string $login
	 * @return bool
	 *
	 */
	public function uniqueLogin($login) {
		return TRUE;
	}
}