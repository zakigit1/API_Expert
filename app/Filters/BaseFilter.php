<?php

namespace App\Filters;

use Illuminate\Http\Request;

class BaseFilter {

    protected $safeParams = [];
    protected $columnMap = [];

    protected $operatorMap = [
        "eq"=> "=",
        "neq"=> "<>",
        "gt"=> ">",
        "gte"=> ">=",
        "lt"=> "<",
        "lte"=> "<=",
        // "like"=> "like",
        // "nlike"=> "not like",
        // "in"=> "in",
        // "nin"=> "not in",
        // "btw"=> "between",
        // "nbtw"=> "not between",
        // "null"=> "is null",
        // "nnull"=> "is not null",
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];


        foreach ($this->safeParams as $col=> $opertorsAbbr) { //$col = Column , $opertorsAbbr = Operator Abbriviation eg. eq, neq, gt, gte, lt, lte
            $query = $request->query($col); // Example: If $col is 'status', this will retrieve the query parameter 'status' from the request. So if the request URL is '/api/v1/invoices?status=active', $query will be 'active'.

            // dd($query);
            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$col] ?? $col;

            foreach ($opertorsAbbr as $operatorAbbr) {
                if(isset($query[$operatorAbbr])){
                    // dd($query[$operatorAbbr]);
                    $eloQuery[] = [$column, $this->operatorMap[$operatorAbbr], $query[$operatorAbbr]];
                }
            }

        }

        return $eloQuery;
    }

}