<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 16. 11. 2017
 * Time: 1:57
 */

namespace App\Model\Dao;


use App\Model\Entity\Purpose;
use App\Model\Exception\IntegrityException;

class PurposeDAO implements IPurposeDAO
{

    /**
     * @return Purpose[]|NULL
     */
    public function findAll() {
        return Purpose::all();
    }

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Purpose[]|NULL
	 */
	public function findByColumn($key, $val) {
		return Purpose::where($key, $val)->get();
	}

    /**
     * @param int $id
     * @return Purpose|NULL
     */
    public function findOne($id) {
        return Purpose::find($id);
    }

    /**
     * @param Purpose $purpose
     * @return Purpose
     */
    public function create(Purpose $purpose) {
        $purpose->save();
        return $purpose;
    }

    /**
     * @param Purpose $purpose
     * @return Purpose
     */
    public function update(Purpose $purpose) {
        $purpose->save();
        return $purpose;
    }

    /**
     * @param Purpose $purpose
     * @throws IntegrityException
     */
    public function delete(Purpose $purpose) {
        try {
            $purpose->delete();
        } catch (\Exception $ex) {
            throw new IntegrityException('Cannot removed couse of FK. ' . $ex->getMessage(), 0, $ex);
        }
    }
}