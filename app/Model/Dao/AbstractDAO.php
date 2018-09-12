<?php
/**
 * Created by PhpStorm.
 * User: Krtek
 * Date: 10.9.2018
 * Time: 13:27
 */

namespace App\Model\Dao;


abstract class AbstractDAO
{
    /**
     * convert collection of items to array
     * @param iterable $items
     * @return array
     */
    public function convertToArray(iterable $items): array {
        $ret = [];
        foreach ($items as $item)
            $ret[] = $item;
        return $ret;
    }
}
