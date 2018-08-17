<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 3. 2. 2018
 * Time: 20:55
 */

namespace App\Model\Service;


use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IMemberPurposeService
{
	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 * @throws AlreadyExistException
	 */
	public function create(Member $member, Purpose $purpose);

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return void
	 * @throws BadRequestHttpException
	 */
	public function delete(Member $member, Purpose $purpose);

	/**
	 * @param Member $member
	 * @return MemberPurpose[]
	 */
	public function getMemberPurposes(Member $member);

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose|NULL
	 */
	public function getMemberPurpose(Member $member, Purpose $purpose);

	/**
	 * @param Member $member
	 * @param string $ids ID of each purpose separated by comma
	 * @return void
	 * @throws NotFoundException
	 */
	public function setMemberPurposes(Member $member, $ids);

}