<?php

namespace App\Filters\V1;

use App\Filters\BaseFilter;
use Illuminate\Http\Request;



class CustomerFilters extends BaseFilter
{
    protected $safeParams = [
        "name" => ['eq', 'neq'],
        "type" => ['eq', 'neq'],
        "email" => ['eq', 'neq'],
        "address" => ['eq', 'neq'],
        "city" => ['eq', 'neq'],
        "state" => ['eq', 'neq'],
        "postalCode" => ['eq', 'neq', 'gte', 'lte', 'gt', 'lt'],

    ];
    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    // protected $operatorMap = [
        // "eq" => "=",
        // "neq" => "!=",
        // "gt" => ">",
        // "gte" => ">=",
        // "lt" => "<",
        // "lte" => "<=",
    // ];


}
