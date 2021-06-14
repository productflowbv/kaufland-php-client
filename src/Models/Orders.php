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

    use FindOne, FindAll;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id_order',
    ];

    /**
     * @var string
     */
    protected $url = 'orders/seller/';

    /**
     * @var string
     */
    protected $primaryKey = 'id_order';

    /**
     * @var string[]
     */
    protected $namespaces = [
        'singular' => 'order',
        'plural' => 'orders'
    ];
}