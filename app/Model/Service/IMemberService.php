<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:23
 */

namespace App\Model\Service;


use App\Model\Entity\Member;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IMemberService
{
	/**
	 * @return Member[]
	 * @throws NotFoundException
	 */
	public function getMembers(): array;

	/**
	 * @param string $login
	 * @return Member
	 * @throws NotFoundException
	 */
	public function getMember(string $login): Member;

	/**
	 * @param string $token
	 * @return Member
	 * @throws NotFoundException
	 */
	public function getByToken(string $token): Member;

	/**
	 * @param $data
	 * @return Member
	 * @throws AlreadyExistException for login, email
	 * @throws BadRequestHttpException missing some value
	 * @throws BadParameterException
     * @throws NotFoundException
     * @throws AuthenticationException
	 */
	public function createMember(array $data): Member;

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
	public function updateMember(string $login, array $data): Member;

	/**
	 * @param string $login
	 * @return string
	 * @throws NotFoundException
	 * @throws IntegrityException
	 */
	public function deleteMember(string $login);

	/**
	 * logs in or creates new account to user
	 * @param $data
	 * @return Member
	 * @throws BadParameterException
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
     * @throws AuthenticationException
	 */
	public function interactWithFacebook(array $data): Member;

	/**
	 * @param string $column
	 * @param mixed $login
	 * @return Member
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getMemberByColumn(string $column, string $login): Member;

	/**
	 * creates token and returns member in new state
	 * @param string $login
	 * @param string $password
	 * @return Member
	 * @throws SecurityException
     * @throws BadParameterException
	 */
	public function login(string $login, string $password): Member;

	/**
	 * @param $login
	 * @return Member
     * @throws NotFoundException
     * @throws BadParameterException
	 */
	public function loginByFacebook(string $login): Member;

	/**
	 * @param Member $member
	 * @return Member
	 */
	public function logout(Member $member): Member;

	/**
	 * @param Member $member
	 * @return array
	 */
	public function format(Member $member): array;

	/**
	 * @param Member[] $members
	 * @return array
	 */
	public function formatEntities(array $members): array;
}
