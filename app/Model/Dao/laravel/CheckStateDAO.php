<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 15. 11. 2017
 * Time: 22:01
 */

namespace App\Model\Dao;


use App\Model\Entity\CheckState;
use App\Model\Exception\IntegrityException;

class CheckStateDAO extends AbstractDAO implements ICheckStateDAO
{
    /** @inheritdoc */
    public function findAll(): array {
    	return $this->convertToArray(CheckState::all());
    }

    /** @inheritdoc */
    public function findOne(int $id): CheckState {
        return CheckState::find($id);
    }

    /** @inheritdoc */
    public function findByColumn(string $key, string $val): array {
		return $this->convertToArray(CheckState::where($key, $val)->get());
	}

    /** @inheritdoc */
    public function findLastByColumn(string $key, string $val): ?CheckState {
		return CheckState::where($key, $val)
			->orderBy('CheckStateID', 'DESC')
			->first();
	}

    /** @inheritdoc */
    public function create(CheckState $checkState): CheckState {
    	$checkState->setChecked(new \DateTime());
		$checkState->save();
        return $checkState;
    }

    /** @inheritdoc */
    public function update(CheckState $checkState): CheckState {
		$checkState->setChecked(new \DateTime());
		$checkState->save();
		return $checkState;
	}

    /** @inheritdoc */
    public function delete(CheckState $cs) {
		try {
            $cs->delete();
        } catch (\Exception $ex) {
		    throw new IntegrityException('Exception.Integrity', 'Cannot remove cause of FK', 0, $ex);
        }
	}
}
