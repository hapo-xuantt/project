<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::SearchByName($request)->SearchByPhone($request)->paginate(config('app.pagination'));
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
        if(Auth::user()->is_admin == 1)
        return view('customers.create');
        return view('customers.index')->with('message', __('messages.permission'));
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
        $data['image'] = $imageName;
        Customer::create($data);
        return redirect()->route('customers.index')->with('success', __('messages.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->is_admin == 1) {
            $data = [
                'customer' => Customer::findOrFail($id),
            ];
            return view('customers.edit', $data);
        }
        return view('customers.index')->with('message', __('messages.permission'));
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
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/images', $imageName);
            $imageName = 'storage/images/' . $imageName;
            $data['image'] = $imageName;
        }
        Customer::findOrFail($id)->update($data);
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
        if (Auth::user()->is_admin == 1) {
            $customer->delete();
            return redirect()->route('customers.index')->with('success', __('messages.destroy'));
        }
        return view('customers.index')->with('message', __('messages.permission'));
    }
}
