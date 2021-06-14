<?php

namespace RemCom\KauflandPhpClient\Traits;

/**
 * Trait FindAll
 *
 * @method Connection connection()
 *
 * @package RemCom\KauflandPhpClient\Traits
 */
trait FindAll
{

    /**
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \RemCom\KauflandPhpClient\Exceptions\KauflandException
     */
    public function all($params = [])
    {
        $result = $this->connection()->get($this->url, $params);

        return $this->collectionFromResult($result);
    }

    /**
     * @param $result
     * @return array
     */
    public function collectionFromResult($result)
    {
        $collection = [];

        foreach ($result as $r) {
            $collection[] = new self($this->connection(), $r, true);
        }

        return $collection;
    }
}