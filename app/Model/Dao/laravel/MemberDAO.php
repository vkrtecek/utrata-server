<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 14. 10. 2017
 * Time: 22:29
 */

namespace App\Model\Dao;


use App\Model\Entity\Member;
use App\Model\Exception\IntegrityException;

class MemberDAO implements IMemberDAO
{
    /**
     * @return null|Member[]
     */
    public function findAll() {
        return Member::all();
    }

    /**
     * @param string $login
     * @return null|Member
     */
    public function findOne($login) {
    	return Member::where('login', $login)->first();
    }

    /**
     * @param Member $member
     * @return null|Member
     */
    public function create(Member $member) {
		$member->setCreated(new \DateTime());
		if ($member->save())
        	return $this->findOne($member->getLogin());
		else
			return NULL;
    }

    /**
     * @param Member $member
     * @return null|Member
     */
    public function update(Member $member) {
		$member->save();
        return $member;
    }

    /**
     * @param Member $member
     * @throws IntegrityException
     */
    public function delete(Member $member) {
        try {
        	$member->delete();
        } catch (\Exception $ex) {
            throw new IntegrityException('Cannot removed couse of FK. '.$ex->getMessage());
        }
    }

	/**
	 * @param $key
	 * @param $val
	 * @return Member|NULL
	 */
    public function findOneByColumn($key, $val) {
    	return Member::where($key, $val)->first();
	}

	/**
	 * @param string $login
	 * @return bool
	 */
	public function uniqueLogin($login) {
		return count(Member::where('login', $login)->get()) == 0;
	}

}