<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Filters\V1\CustomerFilters;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomerFilters();

        $queryItems = $filter->transform($request);//[[column, operator, value], [column, operator, value]]

        $customer = Customer::where($queryItems)->paginate();

        //* append method is necessary to filter usable in all pages
        return new CustomerCollection($customer->appends($request->query()));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
