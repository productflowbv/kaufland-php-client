<?php

namespace RemCom\KauflandPhpClient\Models;

use RemCom\KauflandPhpClient\Traits\FindAll;
use RemCom\KauflandPhpClient\Traits\FindOne;
use RemCom\KauflandPhpClient\Traits\Storable;

/**
 * Class Orders
 * @package RemCom\KauflandPhpClient\Models
 */
class Orders extends Model
{

    use FindOne, FindAll, Storable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'productnr',
    ];

    /**
     * @var string
     */
    protected $url = 'orders';

    /**
     * @var string
     */
    protected $primaryKey = 'productnr';

    /**
     * @var string[]
     */
    protected $namespaces = [
        'singular' => 'product',
        'plural' => 'products'
    ];
}