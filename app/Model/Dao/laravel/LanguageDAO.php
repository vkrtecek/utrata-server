<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 19. 10. 2017
 * Time: 19:18
 */

namespace App\Model\Dao;


use App\Model\Entity\Language;
use App\Model\Exception\IntegrityException;

class LanguageDAO extends AbstractDAO implements ILanguageDAO
{

    /** @inheritdoc */
    public function findAll(): array {
        return $this->convertToArray(Language::all());
    }

    /** @inheritdoc */
    public function findOne(string $code): ?Language {
    	return Language::find($code);
	}

    /** @inheritdoc */
    public function create(Language $language): Language {
        $language->save();
        return $language;
    }

    /** @inheritdoc */
    public function update(Language $language): Language {
        $language->save();
        return $language;
    }

    /** @inheritdoc */
    public function delete(Language $language) {
        try {
            $language->delete();
        } catch (\Exception $ex) {
            //FK key violation
            throw new IntegrityException('Exception.Integrity', 'Cannot remove cause of FK', 0, $ex);
        }
    }

}
