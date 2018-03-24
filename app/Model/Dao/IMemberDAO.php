<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 10. 2017
 * Time: 22:28
 */

namespace App\Model\Dao;


use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Entity\MemberPurpose;
use App\Model\Entity\Purpose;
use App\Model\Entity\Wallet;
use App\Model\Exception\IntegrityException;

interface IMemberDAO
{
    /**
     * @return Member[]|NULL
     */
    public function findAll();

    /**
     * @param string $name
     * @return Member|NULL
     */
    public function findOne($name);

	/**
	 * @param Member $member
	 * @return MemberPurpose[]
	 */
	public function getMemberPurposes(Member $member);

	/**
	 * @param Member $member
	 * @return Purpose[]
	 */
	public function getPurposes(Member $member);

	/**
	 * @param Member $member
	 * @return Wallet[]
	 */
	public function getWallets(Member $member);

	/**
	 * @param Member $member
	 * @return Item[]
	 */
	public function getItems(Member $member);

    /**
     * @param Member $member
     * @return Member
     */
    public function create(Member $member);

    /**
     * @param Member $member
     * @return Member
     */
    public function update(Member $member);

    /**
     * @param Member $member
     * @throws IntegrityException
     */
    public function delete(Member $member);

	/**
	 * @param $key
	 * @param $val
	 * @return Member|NULL
	 */
	public function findOneByColumn($key, $val);

	/**
	 * @param string $login
	 * @return bool
	 */
	public function uniqueLogin($login);

	/**
	 * @param string $mail
	 * @return bool
	 */
	public function uniqueMail($mail);
}