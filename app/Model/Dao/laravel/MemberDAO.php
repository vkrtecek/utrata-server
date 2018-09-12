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

class MemberDAO extends AbstractDAO implements IMemberDAO
{
    /** @inheritdoc */
    public function findAll(): array {
        return $this->convertToArray(Member::all());
    }

    /** @inheritdoc */
    public function findOne(string $login): ?Member {
    	return Member::where('login', $login)->first();
    }

    /** @inheritdoc */
    public function findOneByColumn(string $key, string $val): ?Member {
        return Member::where($key, $val)->first();
    }

    /** @inheritdoc */
    public function create(Member $member): Member {
		$member->setCreated(new \DateTime());
		if ($member->save())
        	return $this->findOne($member->getLogin());
		else
			return NULL;
    }

    /** @inheritdoc */
    public function update(Member $member): Member {
		$member->save();
        return $member;
    }

    /** @inheritdoc */
    public function delete(Member $member) {
        try {
        	$member->delete();
        } catch (\Exception $ex) {
            throw new IntegrityException('Exception.Integrity', 'Cannot remove cause of FK.', 0, $ex);
        }
    }

}
