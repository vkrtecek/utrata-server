<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 3. 2018
 * Time: 0:00
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\ICheckStateDAO;
use App\Model\Entity\CheckState;

class FakeCheckStateDAO implements ICheckStateDAO
{
    /** @inheritdoc */
    public function findAll(): array {
        return [];
    }

    /** @inheritdoc */
    public function findOne(int $id): ?CheckState {
        return null;
    }

	/** @inheritdoc */
	public function findByColumn(string $key, string $val): array {
	    return [];
    }

    /** @inheritdoc */
    public function findLastByColumn(string $key, string $val): ?CheckState {
        return null;
    }

    /** @inheritdoc */
    public function create(CheckState $checkState): CheckState {
        return $checkState;
    }

    /** @inheritdoc */
    public function update(CheckState $checkState): CheckState {
        return $checkState;
    }

    /** @inheritdoc */
    public function delete(CheckState $cs) {}
}
