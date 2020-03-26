<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\Pharmacist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PharmacistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacists = DB::transaction(function () {
            return Pharmacist::paginate(20);
        }, 5);

        return view('admin.user.pharmacist.index', [
            'pharmacists' => $pharmacists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.pharmacist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'required|numeric|unique:pharmacists,mobile_phone'
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:pharmacists,home_phone';
        }
        $this->validate($request, $rules);

        DB::transaction(function () use ($request) {
            $request['name'] = "{$request->first_name} {$request->last_name}";
            $user = User::create($request->all());

            $imageUrl = NULL;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/pharmacists', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            $request['user_id'] = $user->id;
            return Pharmacist::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::pharmacist::index'))->with('success_message', 'Successfully create new pharmacist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Pharmacist  $pharmacist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show(Pharmacist $pharmacist)
    {
        return view('admin.user.pharmacist.show', [
            'pharmacist' => $pharmacist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Pharmacist  $pharmacist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(User $user, Pharmacist $pharmacist)
    {
        return view('admin.user.pharmacist.edit', [
            'user' => $user,
            'pharmacist' => $pharmacist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\Models\User\Pharmacist  $pharmacist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(Request $request, User $user, Pharmacist $pharmacist)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_phone' => 'required|numeric|unique:pharmacists,mobile_phone,' . $pharmacist->id
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:pharmacists,home_phone,' . $pharmacist->id;
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request, $user, $pharmacist) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                if ($request->has('email') || $request->has('password')) {
                    $user->update($request->all());
                }

                $imageUrl = $pharmacist->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/pharmacists', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                $request['user_id'] = $user->id;
                return $pharmacist->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::pharmacist::index'))->with('success_message', 'Successfully updated pharmacist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Pharmacist  $pharmacist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(User $user, Pharmacist $pharmacist)
    {
        try {
            DB::transaction(function () use ($pharmacist, $user) {
                $pharmacist->delete();
                $user->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect()->back()->with('success_message', 'Successfully deleted pharmacist');
    }
}
