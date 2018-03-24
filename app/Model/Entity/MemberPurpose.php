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

	/** @var Purpose */
	private $purpose = NULL;

	/** @var Member */
	private $member = NULL;


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
		if (!$this->purpose)
			$this->purpose = Purpose::find($this->PurposeID);
		return $this->purpose;
	}

	/**
	 * @param Purpose $purpose
	 */
	public function setPurpose(Purpose $purpose) {
		$this->PurposeID = $purpose->getId();
		$this->purpose = $purpose;
	}

	/**
	 * @return Member
	 */
	public function getMember() {
		if (!$this->member)
			$this->member = Member::find($this->MemberID);
		return $this->member;
	}

	/**
	 * @param Member $member
	 */
	public function setMember(Member $member) {
		$this->MemberID = $member->getId();
		$this->member = $member;
	}

}