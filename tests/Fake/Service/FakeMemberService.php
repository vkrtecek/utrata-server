<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 23:56
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Member;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use App\Model\Service\IMemberService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\Fake\Dao\FakeMemberDAO;

class FakeMemberService implements IMemberService
{
	/**
	 * @return Member[]
	 * @throws NotFoundException
	 */
	public function getMembers()
	{
	}

	/**
	 * @param string $login
	 * @return Member
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getMember($login)
	{
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
		return $member;
	}

	/**
	 * @param string $token
	 * @return Member
	 * @throws NotFoundException
	 */
	public function getByToken($token) {
	}

	/**
	 * @param string $column
	 * @param mixed $login
	 * @return Member|NULL
	 * @throws NotFoundException
	 */
	public function getMemberByColumn($column, $login) {
		return $this->getMember($login);
	}

	/**
	 * @param $data
	 * @return Member
	 * @throws AlreadyExistException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 * @throws AlreadyExistException
	 */
	public function createMember($data)
	{
	}

	/**
	 * @param string $login
	 * @param $data
	 * @return Member
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 * @throws AlreadyExistException for e-mails
	 * @throws AuthenticationException
	 */
	public function updateMember($login, $data)
	{
	}

	/**
	 * @param string $login
	 * @return string
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteMember($login)
	{
	}

	/**
	 * logs in or creates new account to user
	 * @param $data
	 * @return Member
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 */
	public function interactWithFacebook($data)
	{
	}

	/**
	 * creates token and returns member in new state
	 * @param string $login
	 * @param string $password
	 * @return Member
	 * @throws SecurityException
	 */
	public function login($login, $password)
	{
	}

	/**
	 * @param $login
	 * @return Member
	 */
	public function loginByFacebook($login)
	{
	}

	/**
	 * @param Member $member
	 * @return Member
	 */
	public function logout(Member $member)
	{
	}

	/**
	 * @param Member $member
	 * @return array
	 */
	public function format(Member $member)
	{
	}

	/**
	 * @param Member[] $members
	 * @return array
	 */
	public function formatEntities($members)
	{
	}
}