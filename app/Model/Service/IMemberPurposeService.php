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
use App\Model\Exception\NotFoundException;

interface IMemberPurposeService
{
	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 */
	public function create(Member $member, Purpose $purpose);

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return void
	 */
	public function delete(Member $member, Purpose $purpose);

	/**
	 * @param int $id
	 * @return Purpose
	 * @throws NotFoundException
	 */
	public function getPurpose($id);

	/**
	 * @param string $languageCode
	 * @return Purpose[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getLanguageBasePurposes($languageCode);
}