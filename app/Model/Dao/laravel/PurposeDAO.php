<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 1:57
 */

namespace App\Model\Dao;


use App\Model\Entity\Item;
use App\Model\Entity\Purpose;
use App\Model\Exception\IntegrityException;

class PurposeDAO extends AbstractDAO implements IPurposeDAO
{

    /** @inheritdoc */
    public function findAll(): array {
        return $this->convertToArray(Purpose::all());
    }

    /** @inheritdoc */
    public function findByColumn(string $key, string $val): array {
		return $this->convertToArray(Purpose::where($key, $val)->get());
	}

    /** @inheritdoc */
    public function findOne(int $id): ?Purpose {
        return Purpose::find($id);
    }

    /** @inheritdoc */
    public function findItems(Purpose $purpose): array {
		return $this->convertToArray(Item::where('PurposeID', $purpose->getId())->get());
	}

    /** @inheritdoc */
    public function create(Purpose $purpose): Purpose {
        $purpose->save();
        return $purpose;
    }

    /** @inheritdoc */
    public function update(Purpose $purpose): Purpose {
        $purpose->save();
        return $purpose;
    }

    /** @inheritdoc */
    public function delete(Purpose $purpose) {
        try {
            $purpose->delete();
        } catch (\Exception $ex) {
            throw new IntegrityException('Exception.Integrity', 'Cannot remove cause of FK.', 0, $ex);
        }
    }
}
