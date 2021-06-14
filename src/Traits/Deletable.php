<?php

namespace RemCom\KauflandPhpClient\Traits;

use RemCom\KauflandPhpClient\connection;

/**
 * Trait Deletable
 *
 * @method Connection connection()
 *
 * @package RemCom\KauflandPhpClient\Traits
 */
trait Deletable
{

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \RemCom\KauflandPhpClient\Exceptions\KauflandException
     */
    public function delete()
    {
        return $this->connection()->delete($this->url . '/' . urlencode($this->{$this->primaryKey}));
    }
}