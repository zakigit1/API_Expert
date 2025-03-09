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
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomerFilters();

        $queryItems = $filter->transform($request);//[[column, operator, value], [column, operator, value]]

        $includeInvoices = $request->query('includeInvoices');


        $customers = Customer::where($queryItems);
        
        if($includeInvoices == 'true'){
            $customers =$customers->with('invoices');
        }
        

        $customers= $customers->paginate()->appends($request->query());

        //* append method is necessary to filter usable in all pages
        return new CustomerCollection($customers);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');

        if($includeInvoices == 'true'){

            // $customer->load('invoices'); //This one is less efficient and pessimistic

            //This one is more efficient and opetimistic than the above one
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);

        return response()->json(['message' => 'Customer deleted successfully'], Response::HTTP_OK);
    }
}
