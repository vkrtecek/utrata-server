<?php
/**
 * Created by PhpStorm.
 * User: Krtek
 * Date: 10.9.2018
 * Time: 11:09
 */

namespace App\Http;


use App\Model\Exception\BadParameterException;
use App\Model\Filter\AbstractFilter;
use Illuminate\Http\Request;

class Pagination
{
    /**
     * @param Request $request
     * @param string $filterType
     * @return AbstractFilter type of filter by given $filterType
     * @throws BadParameterException
     */
    public static function create(Request $request, string $filterType): AbstractFilter {
        $data = $request->all();

        $class = 'App\\Model\\Filter\\' . ucfirst($filterType) . 'Filter';
        if (!class_exists($class))
            throw new BadParameterException('Exception.ClassExists', 'This class not exists');
        return $class::create($data);
    }
}
