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
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\SecurityException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IMemberService
{
	const FACEBOOK_LOGGED = 1;
	const FACEBOOK_SIGNED = 2;
	const FACEBOOK_ERROR = 0;
	/**
	 * @return Member[]
	 * @throws NotFoundException
	 */
	public function getMembers();

	/**
	 * @param string $login
	 * @return Member
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getMember($login);

	/**
	 * @param string $token
	 * @return Member
	 * @throws NotFoundException
	 */
	public function getByToken($token);

	/**
	 * @param $data
	 * @return Member
	 * @throws AlreadyExistException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function createMember($data);

	/**
	 * @param string $login
	 * @param $data
	 * @return Member
	 * @throws NotFoundException
	 * @throws BadRequestHttpException
	 * @throws BadParameterException
	 */
	public function updateMember($login, $data);

	/**
	 * @param string $login
	 * @return string
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteMember($login);

	/**
	 * logs in or creates new account to user
	 * @param $data
	 * @return int
	 * @throws BadParameterException
	 */
	public function interactWithFacebook($data);

	/**
	 * @param string $column
	 * @param mixed $login
	 * @return Member|NULL
	 * @throws NotFoundException
	 */
	public function getMemberByColumn($column, $login);

	/**
	 * creates token and returns member in new state
	 * @param string $login
	 * @param string $password
	 * @return Member
	 * @throws SecurityException
	 */
	public function login($login, $password);

	/**
	 * @param $login
	 * @return Member
	 */
	public function loginByFacebook($login);

	/**
	 * @param Member $member
	 * @return Member
	 */
	public function logout(Member $member);

	/**
	 * @param Member $member
	 * @return array
	 */
	public static function format(Member $member);

	/**
	 * @param Member[] $members
	 * @return array
	 */
	public static function formatEntites($members);
}