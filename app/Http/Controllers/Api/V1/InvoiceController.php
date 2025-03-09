<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Http\Requests\V1\UpdateInvoiceRequest;
use App\Filters\V1\InvoiceFilters;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new InvoiceFilters();

        $queryItems = $filter->transform($request);//[[column, operator, value], [column, operator, value]]

        $customer = Invoice::where($queryItems)->paginate();

        //* append method is necessary to filter usable in all pages
        return new InvoiceCollection($customer->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
