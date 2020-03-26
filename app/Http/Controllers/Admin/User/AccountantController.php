<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\User\Accountant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AccountantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $accountants = DB::transaction(function () {
            return Accountant::paginate(20);
        }, 5);

        return view('admin.user.accountant.index', [
            'accountants' => $accountants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.accountant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'required|numeric|unique:accountants,mobile_phone'
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:accountants,home_phone';
        }
        $this->validate($request, $rules);

        DB::transaction(function () use ($request) {
            $request['name'] = "{$request->first_name} {$request->last_name}";
            $user = User::create($request->all());

            $imageUrl = NULL;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/accountants', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            $request['user_id'] = $user->id;
            return Accountant::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::accountant::index'))->with('success_message', 'Successfully create new accountant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Accountant $accountant)
    {
        return view('admin.user.accountant.show', [
            'accountant' => $accountant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Accountant  $accountant
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(User $user, Accountant $accountant)
    {
        return view('admin.user.accountant.edit', [
            'user' => $user,
            'accountant' => $accountant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\Models\User\Accountant  $accountant
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(Request $request, User $user, Accountant $accountant)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_phone' => 'required|numeric|unique:accountants,mobile_phone,' . $accountant->id
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:accountants,home_phone,' . $accountant->id;
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request, $user, $accountant) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                if ($request->has('email') || $request->has('password')) {
                    $user->update($request->all());
                }

                $imageUrl = $accountant->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/accountants', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                $request['user_id'] = $user->id;
                return $accountant->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::accountant::index'))->with('success_message', 'Successfully updated accountant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Accountant  $accountant
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(User $user, Accountant $accountant)
    {
        try {
            DB::transaction(function () use ($accountant, $user) {
                $accountant->delete();
                $user->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect()->back()->with('success_message', 'Successfully deleted accountant');
    }
}
