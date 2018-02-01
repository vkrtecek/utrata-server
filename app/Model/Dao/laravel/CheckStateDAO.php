<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 15. 11. 2017
 * Time: 22:01
 */

namespace App\Model\Dao;


use App\Model\Entity\CheckState;

class CheckStateDAO implements ICheckStateDAO
{
    /**
     * @return CheckState[]
     */
    public function findAll() {
    	return CheckState::all();
    }

    /**
     * @param int $id
     * @return CheckState
     */
    public function findOne($id) {
        return CheckState::find($id);
    }

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return CheckState|NULL
	 */
	public function findLastByColumn($key, $val) {
		return CheckState::where($key, $val)
			->orderBy('CheckStateID', 'DESC')
			->first();
	}

    /**
     * @param CheckState $checkState
     * @return CheckState
     */
    public function create(CheckState $checkState) {
    	$checkState->setChecked(new \DateTime());
		$checkState->save();
        return $checkState;
    }

	/**
	 * @param CheckState $checkState
	 * @return CheckState
	 */
	public function update(CheckState $checkState) {
		$checkState->setChecked(new \DateTime());
		$checkState->save();
		return $checkState;
	}
}