<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 22:33
 */

namespace App\Model\Entity;


use Illuminate\Database\Eloquent\Model;

class MemberPurpose extends Model
{
	protected $table = 'utrata_memberpurposes';

	public $primaryKey = 'MemberPurposeID';

	public $timestamps = false;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->MemberPurposeID;
	}

	/**
	 * @return Purpose
	 */
	public function getPurpose() {
		return Purpose::find($this->PurposeID);
	}

	/**
	 * @param Purpose $purpose
	 */
	public function setPurpose(Purpose $purpose) {
		$this->PurposeID = $purpose->getId();
	}

	/**
	 * @return Member
	 */
	public function getMember() {
		return Member::find($this->MemberID);
	}

	/**
	 * @param Member $member
	 */
	public function setMember(Member $member) {
		$this->MemberID = $member->getId();
	}

}