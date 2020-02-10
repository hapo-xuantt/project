<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMember;
use App\Http\Requests\UpdateMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'members' => Member::paginate(5),
        ];
        // dd($data);
        return view('members.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function show()
    {

    }

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
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $imageName = 'storage/images/' . $imageName;
        $member = [
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'account' => $data['account'],
            'image' => $imageName,
            'email' => $data['email'],
            'is_admin' => $data['is_admin'],
        ];
        $member = Member::Create($member);
        return redirect()->route('members.index')->with('success', __('messages.create'));
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
    public function update(UpdateMember $request, $id)
    {
        $data = $request->all();
        $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
        request()->image->storeAs('public/images', $imageName);
        $imageName = 'storage/images/' . $imageName;
        $member = [
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'account'  => $data['account'],
            'image' => $imageName,
            'email' => $data['email'],
            'is_admin' => $data['is_admin'],
        ];
        $member = Member::findOrFail($id)->update($member);
        return redirect()->route('members.index')->with('success', __('messages.update'));
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
        return redirect()->route('members.index')->with('success', __('messages.destroy'));
    }
}
