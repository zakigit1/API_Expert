<?php

namespace App\Filters\V1;

use App\Filters\BaseFilter;
;
use Illuminate\Http\Request;



class InvoiceFilters extends BaseFilter
{

    protected $safeParams = [
        "customerId" => ['eq', 'neq'],
        "amount" => ['eq', 'neq', 'gte', 'lte', 'gt', 'lt'],
        "status" => ['eq', 'neq'],
        "billedDate" => ['eq', 'neq', 'gte', 'lte', 'gt', 'lt'],
        "paidDate" => ['eq', 'neq', 'gte', 'lte', 'gt', 'lt'],
    ];
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];

    // protected $operatorMap = [
    //     "eq" => "=",
    //     "neq" => "!=",
    //     "gt" => ">",
    //     "gte" => ">=",
    //     "lt" => "<",
    //     "lte" => "<=",
    // ];


}
