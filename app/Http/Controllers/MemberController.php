<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMember;
use App\Http\Requests\UpdateMember;
use Illuminate\Support\Facades\Hash;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = Member::Where(function($query) use ($request)
        {
            if(!empty($request->searchName)){
                $query->Where('name', 'like', '%' . $request->searchName . '%');
            }
            if(isset($request->searchPermission)){
                $query->Where('is_admin', $request->searchPermission );
            }
            if(!empty($request->searchEmail)){
                $query->Where('email', 'like', '%' . $request->searchEmail . '%');
            }
       })->paginate(config('app.pagination'));
        $data = [
            'members' => $members,
        ];
        if(count($members) > 0)
            return view('members.index', $data);
        else
            return view("members.index")->with('message', __('messages.search'));
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
        if(Auth::user()->is_admin == 1);
           return view('members.create');
        return view('members.index')->with('message', __('messages.permission'));;
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
        Member::findOrFail($id);
        if(Auth::user()->is_admin ==  1) {
            $data = [
                'member' => Member::findOrFail($id),
            ];
            return view('members.edit', $data);
        }
        return view('members.index')->with('message', __('messages.permission'));;
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
        if($request->hasFile('image')){
            $imageName = uniqid() . '.' . request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/images', $imageName);
            $imageName = 'storage/images/' . $imageName;
            $data['image'] = $imageName;
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        Member::findOrFail($id)->update($data);
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
        if(Auth::user()->is_admin == 1) {
            $member->delete();
            return redirect()->route('members.index')->with('success', __('messages.destroy'));
        }
        return view('members.index')->with('message', __('messages.permission'));;
    }
}
