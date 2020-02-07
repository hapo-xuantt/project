<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMember;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'members' => Member::all(),
        ];
        return view('members.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMember $request)
    {
        $data = $request->all();
        $image_name = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $image_name);
        $image_name = 'storage/images/'.$image_name;
        $member = array(
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'account'  => $data['account'],
            'image' => $image_name,
            'email' => $data['email'],
            'is_admin' => $data['is_admin'],
        );
        $member = Member::Create($member);
        return redirect()->route('members.index')->with('success', 'Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'member' => Member::findOrFail($id),
        ];
        return view('members.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMember $request, $id)
    {
        $data = $request->all();
        $image_name = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $image_name);
        $image_name = 'storage/images/'.$image_name;
        $member = array(
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'account'  => $data['account'],
            'image' => $image_name,
            'email' => $data['email'],
            'is_admin' => $data['is_admin'],
        );
        $member=Member::findOrFail($id)->update($member);
        return redirect()->route('members.index')->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index');
    }
}
