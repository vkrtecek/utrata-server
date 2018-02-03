<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 3. 2. 2018
 * Time: 20:20
 */

namespace App\Model\Dao;


use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;

interface IMemberPurposeDAO
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

}