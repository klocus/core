<?php

namespace TypeRocket\Http;

use TypeRocket\Utility\Validator;

class Fields extends \ArrayObject
{

    public $fillable = [];
    public $fieldsArray = [];

    /**
     * Load commands
     */
    public function __construct( $fields = [] ) {
        $this->fieldsArray = $fields;
        $this->exchangeArray( $fields );
    }

    /**
     * Get fillable
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * Set fillable
     *
     * @param array $fillable
     */
    public function setFillable(array $fillable)
    {
        $this->fillable = $fillable;
    }

    /**
     * Validate fields
     *
     * @param array $options
     * @param $modelClass
     *
     * @return \TypeRocket\Utility\Validator
     */
    public function validate($options, $modelClass = null)
    {
        return new Validator($options, $this, $modelClass);
    }

    /**
     * Run php array methods
     *
     * @param $func
     * @param $argv
     *
     * @return mixed
     */
    public function __call($func, $argv)
    {
        if (!is_callable($func) || substr($func, 0, 6) !== 'array_')
        {
            throw new \BadMethodCallException(__CLASS__.'->'.$func);
        }
        return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
    }

}