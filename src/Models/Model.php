<?php

namespace RemCom\KauflandPhpClient\Models;

use RemCom\KauflandPhpClient\connection;

/**
 * Class Model
 * @package RemCom\KauflandPhpClient\Models
 */
abstract class Model
{

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var array The model's attributes
     */
    protected $attributes = [];

    /**
     * @var array The model's fillable attributes
     */
    protected $fillable = [];

    /**
     * @var string The URL endpoint of this model
     */
    protected $url = '';

    /**
     * @var string Name of the primary key for this model
     */
    protected $primaryKey = 'id';

    /**
     * @var array Defines the single and plural names for this model as used in API
     */
    protected $namespaces = [
        'singular' => '',
        'plural' => ''
    ];

    /**
     * Model constructor.
     * @param connection $connection
     * @param array $attributes
     */
    public function __construct(Connection $connection, array $attributes = [], bool $api_result = false)
    {
        $this->connection = $connection;
        $this->fill($attributes, $api_result);
    }

    /**
     * Get the connection instance
     *
     * @return Connection
     */
    public function connection()
    {
        return $this->connection;
    }

    /**
     * Get the model's attributes
     *
     * @return array
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * Fill the entity from an array
     *
     * @param array $attributes
     */
    protected function fill(array $attributes, bool $api_result)
    {
        if ($api_result) {
            foreach ($attributes as $key => $value) {
                $this->setAttribute($key, $value);
            }
        } else {
            foreach ($this->fillableFromArray($attributes) as $key => $value) {
                if ($this->isFillable($key)) {
                    $this->setAttribute($key, $value);
                }
            }
        }
    }

    /**
     * Get the fillable attributes of an array
     *
     * @param array $attributes
     * @return array
     */
    protected function fillableFromArray(array $attributes)
    {
        if (count($this->fillable) > 0) {
            return array_intersect_key($attributes, array_flip($this->fillable));
        }

        return $attributes;
    }

    /**
     * @param $key
     * @return bool
     */
    protected function isFillable($key)
    {
        return in_array($key, $this->fillable);
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        if ($this->isFillable($key)) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * @return bool
     */
    public function exists()
    {
        if (isset($this->attributes[$this->primaryKey])) {
            if (is_numeric($this->attributes[$this->primaryKey])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return false|string
     */
    public function json()
    {
        $json = [
            $this->attributes
        ];

        return json_encode(array_filter($this->attributes));
    }

    /**
     * Make var_dump and print_r look pretty
     *
     * @return array
     */
    public function __debugInfo()
    {
        $result = [];
        foreach ($this->attributes() as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }
}