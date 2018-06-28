<?php

namespace Yeelight\Generators\Migrations;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class RulesParser
 *
 * @category Yeelight
 *
 * @package Yeelight\Generators\Migrations
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class RulesParser implements Arrayable
{
    /**
     * The set of rules.
     *
     * @var string
     */
    protected $rules;

    /**
     * Create new instance.
     *
     * @param string|null $rules Rules
     */
    public function __construct($rules = null)
    {
        $this->rules = $rules;
    }

    /**
     * Convert string migration to array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->parse($this->rules);
    }

    /**
     * Parse a string to array of formatted rules.
     *
     * @param string $rules Rules
     *
     * @return array
     */
    public function parse($rules)
    {
        $this->rules = $rules;
        $parsed = [];
        foreach ($this->getRules() as $rulesArray) {
            $column = $this->getColumn($rulesArray);
            $attributes = $this->getAttributes($column, $rulesArray);
            $parsed[$column] = $attributes;
        }

        return $parsed;
    }

    /**
     * Get array of rules.
     *
     * @return array
     */
    public function getRules()
    {
        if (is_null($this->rules)) {
            return [];
        }

        return explode(',', str_replace(' ', '', $this->rules));
    }

    /**
     * Get column name from rules.
     *
     * @param string $rules Rules
     *
     * @return string
     */
    public function getColumn($rules)
    {
        return array_first(
            explode('=>', $rules),
            function ($key/*, $value*/) {
                return $key;
            }
        );
    }

    /**
     * Get column attributes.
     *
     * @param string $column column
     * @param string $rules rules
     *
     * @return array
     */
    public function getAttributes($column, $rules)
    {
        return str_replace($column.'=>', '', $rules);
    }
}
