<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::Where(function($query) use ($request)
        {
            if(!empty($request->searchName)){
                $query->Where('name', 'like', '%' . $request->searchName . '%');
            }
            if(!empty($request->searchPhone)){
                $query->Where('phone', 'like', '%' . $request->searchPhone . '%');
            }
        })->paginate(config('app.pagination'));
        $data = [
            'customers' => $customers,
        ];
        if(count($customers) > 0)
            return view('customers.index', $data);
        else
            return view("customers.index")->with('message', __('messages.search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        $data = $request->all();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $imageName = 'storage/images/' . $imageName;
        $customer = [
            'name' => $data['name'],
            'manager' => $data['manager'],
            'image' => $imageName,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];
        $customer = Customer::Create($customer);
        return redirect()->route('customers.index')->with('success', __('messages.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'customer' => Customer::findOrFail($id),
        ];
        return view('customers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer $request, $id)
    {
        $data = $request->all();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $imageName = 'storage/images/' . $imageName;
        $customer = [
            'name' => $data['name'],
            'manager' => $data['manager'],
            'image' => $imageName,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];
        $customer = Customer::findOrFail($id)->update($customer);
        return redirect()->route('customers.index')->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', __('messages.destroy'));
    }
}
