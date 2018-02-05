<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 3. 2. 2018
 * Time: 20:21
 */

namespace App\Model\Dao;


use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;

class MemberPurposeDAO implements IMemberPurposeDAO
{

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose|NULL
	 */
	public function find(Member $member, Purpose $purpose) {
		return MemberPurpose::where('MemberID', $member->getId())
			->where('PurposeID', $purpose->getId())->first();
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return MemberPurpose
	 */
	public function create(Member $member, Purpose $purpose) {
		$mp = new MemberPurpose();
		$mp->setMember($member);
		$mp->setPurpose($purpose);
		$mp->save();
		return $mp;
	}

	/**
	 * @param Member $member
	 * @param Purpose $purpose
	 * @return void
	 */
	public function delete(Member $member, Purpose $purpose) {
		$mps = MemberPurpose::where('MemberID', $member->getId())
			->where('PurposeID', $purpose->getId())->get();

		if ($mps) {
			foreach ($mps as $mp) {
				$mp->delete();
			}
		}
	}
}