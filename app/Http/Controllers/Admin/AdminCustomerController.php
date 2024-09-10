<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFormRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('is_deleted', 0)->get();
        
        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customer.create');  
    }

    public function store(CustomerFormRequest $request)
    {
        $validated = $request->validated();

        $is_blocked = Customer::getCustomerBlockedBinary($request->is_blocked);

        $customer = Customer::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],

            'is_blocked' => $is_blocked,
        ]);

        return redirect()->route('admin.customer.index')->with('success', 'Customer created successfully!');
    
    }

    public function edit(Customer $customer) 
    {
        return view('admin.customer.edit', compact('customer'));   
    }


    public function update(CustomerFormRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        $is_blocked = Customer::getCustomerBlockedBinary($request->is_blocked);

        Customer::where('id',$customer->id)->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],

            'is_blocked' => $is_blocked,
        ]);
        
        return redirect()->back()->with('success', 'Customer updated successfully!');
    }


    public function destroy(Customer $customer)
    {
        Customer::where('id',$customer->id)->update([
            'is_deleted' => 1,
        ]);
        
        return redirect()->route('admin.customer.index')->with('success', 'customer deleted successfully!');
    }
}
