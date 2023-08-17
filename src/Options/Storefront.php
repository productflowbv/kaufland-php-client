<?php

namespace ProductFlow\KauflandPhpClient\Options;

use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Storefront
{
    public const DE = 'de';

    public const CZ = 'cz';

    public const SK = 'SK';

    protected $current;

    public function __construct()
    {
        $this->current = self::DE;
    }

    public function __toString()
    {
        return $this->current;
    }

    public function set(string $storefront): self
    {
        if (!$this->inList($storefront)) {
            throw new KauflandException($storefront . ' is not available in storefronts list');
        }

        $this->current = $storefront;

        return $this;
    }

    public function inList(string $storefront)
    {
        return in_array(
            $storefront,
            [
                self::DE,
                self::CZ,
                self::SK
            ]
        );
    }

    public static function getQueryParameterName(): string
    {
        return 'storefront';
    }
}
