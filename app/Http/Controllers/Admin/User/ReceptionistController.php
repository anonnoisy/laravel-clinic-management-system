<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\User\Receptionist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $receptionists = DB::transaction(function () {
            return Receptionist::paginate(20);
        }, 5);

        return view('admin.user.receptionist.index', [
            'receptionists' => $receptionists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.receptionist.create');
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
            'mobile_phone' => 'required|numeric|unique:receptionists,mobile_phone'
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:receptionists,home_phone';
        }
        $this->validate($request, $rules);

        DB::transaction(function () use ($request) {
            $request['name'] = "{$request->first_name} {$request->last_name}";
            $user = User::create($request->all());

            $imageUrl = NULL;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/receptionists', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            $request['user_id'] = $user->id;
            return Receptionist::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::receptionist::index'))->with('success_message', 'Successfully create new receptionist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Receptionist  $receptionist
     * @return \Illuminate\Http\Response
     */
    public function show(receptionist $receptionist)
    {
        return view('admin.user.receptionist.show', [
            'receptionist' => $receptionist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Receptionist  $receptionist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(User $user, receptionist $receptionist)
    {
        return view('admin.user.receptionist.edit', [
            'user' => $user,
            'receptionist' => $receptionist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\Models\User\Receptionist  $receptionist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(Request $request, User $user, receptionist $receptionist)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_phone' => 'required|numeric|unique:receptionists,mobile_phone,' . $receptionist->id
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:receptionists,home_phone,' . $receptionist->id;
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request, $user, $receptionist) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                if ($request->has('email') || $request->has('password')) {
                    $user->update($request->all());
                }

                $imageUrl = $receptionist->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/receptionists', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                $request['user_id'] = $user->id;
                return $receptionist->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::receptionist::index'))->with('success_message', 'Successfully updated receptionist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Receptionist  $receptionist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(User $user, receptionist $receptionist)
    {
        try {
            DB::transaction(function () use ($receptionist, $user) {
                $receptionist->delete();
                $user->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect()->back()->with('success_message', 'Successfully deleted receptionist');
    }
}
