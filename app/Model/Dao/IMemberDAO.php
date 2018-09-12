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
     * @return Member[]
     */
    public function findAll(): array;

    /**
     * @param string $name
     * @return Member|NULL
     */
    public function findOne(string $name): ?Member;

    /**
     * @param $key
     * @param $val
     * @return Member|NULL
     */
    public function findOneByColumn(string $key, string $val): ?Member;

    /**
     * @param Member $member
     * @return Member
     */
    public function create(Member $member): Member;

    /**
     * @param Member $member
     * @return Member
     */
    public function update(Member $member): Member;

    /**
     * @param Member $member
     * @throws IntegrityException
     */
    public function delete(Member $member);
}
