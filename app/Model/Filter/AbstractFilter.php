<?php
/**
 * Created by PhpStorm.
 * User: Krtek
 * Date: 10.9.2018
 * Time: 11:07
 */

namespace App\Model\Filter;


abstract class AbstractFilter
{
    /** @var AbstractFilter */
    protected static $instance = NULL;

    const ORDER_ASCENDANT = 'ASC';
    const ORDER_DESCENDANT = 'DESC';

    const DEFAULT_ORDER = self::ORDER_DESCENDANT;
    const DEFAULT_ORDER_BY = 'date';
    const DEFAULT_LIMIT = 15;
    const DEFAULT_PATTERN = '';
    const DEFAULT_PAGE = 1;

    /** @var string */
    protected $orderBy = self::DEFAULT_ORDER_BY;

    /** @var string */
    protected $order = self::DEFAULT_ORDER;

    /** @var int */
    protected $limit = self::DEFAULT_LIMIT;

    /** @var string */
    protected $pattern = self::DEFAULT_PATTERN;

    /** @var int */
    protected $page = self::DEFAULT_PAGE;



    /** AbstractFilter constructor.*/
    protected function __construct() {
        $this->limit = env('FILTERING_LIST_LIMIT', self::DEFAULT_LIMIT);
    }


    public static function create(array $data) {
        $limit = isset($data['limit']) && $data['limit'] > 0 ? $data['limit'] : self::$instance->getLimit();
        self::$instance->setLimit($limit);
        self::$instance->setPage($data['page'] ?? self::DEFAULT_PAGE);
        self::$instance->setOrderBy($data['orderBy'] ?? self::DEFAULT_ORDER_BY);
        self::$instance->setOrderHow($data['orderHow'] ?? self::DEFAULT_ORDER);
        self::$instance->setPattern($data['pattern'] ?? self::DEFAULT_PATTERN);
    }



    /** @return string */
    public function getPattern(): string {
        return $this->pattern;
    }
    /**
     * @param string $pattern
     * @return AbstractFilter
     */
    public function setPattern(string $pattern): AbstractFilter {
        $this->pattern = $pattern;
        return $this;
    }


    /** @return string */
    public function getOrderBy(): string {
        return $this->orderBy;
    }
    /**
     * @param string $orderBy
     * @return AbstractFilter
     */
    public function setOrderBy(string $orderBy): AbstractFilter {
        if ($orderBy != "") $this->orderBy = $orderBy;
        return $this;
    }


    /** @return string */
    public function getOrderHow(): string {
        return $this->order;
    }
    /**
     * @param string $order
     * @return AbstractFilter
     */
    public function setOrderHow(string $order): AbstractFilter {
        if ($order != "") $this->order = $order;
        return $this;
    }


    /** @return int */
    public function getLimit(): int {
        return $this->limit;
    }
    /**
     * @param int $limit
     * @return AbstractFilter
     */
    public function setLimit(int $limit): AbstractFilter {
        if ($limit > 0)
            $this->limit = $limit;
        return $this;
    }


    /** @return int */
    public function getPage(): int {
        return $this->page;
    }
    /**
     * @param int $page
     * @return AbstractFilter
     */
    public function setPage(int $page): AbstractFilter {
        if ($page > 0)
            $this->page = $page;
        return $this;
    }


    /**
     * Switch style of sorting between descendant and ascendant
     */
    public function switchOrder() {
        $this->order = $this->order === self::ORDER_ASCENDANT ? self::ORDER_DESCENDANT : self::ORDER_ASCENDANT;
    }
}
