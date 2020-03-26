<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\Laboratorist;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaboratoristController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $laboratorists = DB::transaction(function () {
            return Laboratorist::paginate(20);
        }, 5);

        return view('admin.user.laboratorist.index', [
            'laboratorists' => $laboratorists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function create()
    {
        return view('admin.user.laboratorist.create');
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
            'mobile_phone' => 'required|numeric|unique:laboratorists,mobile_phone'
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:laboratorists,home_phone';
        }
        $this->validate($request, $rules);

        DB::transaction(function () use ($request) {
            $request['name'] = "{$request->first_name} {$request->last_name}";
            $user = User::create($request->all());

            $imageUrl = NULL;
            if ($request->hasFile('image')) {
                $imageUrl = Storage::put('file/laboratorists', $request->file('image'));
            }

            $request['image_url'] = $imageUrl;
            $request['user_id'] = $user->id;
            return Laboratorist::create($request->all());
        }, 5);
        try {
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::laboratorist::index'))->with('success_message', 'Successfully create new laboratorist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Laboratorist  $laboratorist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show($id)
    {
        return view('admin.user.laboratorist.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Laboratorist  $laboratorist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(User $user, Laboratorist $laboratorist)
    {
        return view('admin.user.laboratorist.edit', [
            'user' => $user,
            'laboratorist' => $laboratorist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\Models\User\Laboratorist  $laboratorist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(Request $request, User $user, Laboratorist $laboratorist)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_phone' => 'required|numeric|unique:laboratorists,mobile_phone,' . $laboratorist->id
        ];

        if ($request->has('home_phone')) {
            $rules['home_phone'] = 'required|numeric|unique:laboratorists,home_phone,' . $laboratorist->id;
        }
        $this->validate($request, $rules);

        try {
            DB::transaction(function () use ($request, $user, $laboratorist) {
                $request['name'] = "{$request->first_name} {$request->last_name}";
                if ($request->has('email') || $request->has('password')) {
                    $user->update($request->all());
                }

                $imageUrl = $laboratorist->image_url;
                if ($request->hasFile('image')) {
                    $imageUrl = Storage::put('file/laboratorists', $request->file('image'));
                }

                $request['image_url'] = $imageUrl;
                $request['user_id'] = $user->id;
                return $laboratorist->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::user::laboratorist::index'))->with('success_message', 'Successfully updated laboratorist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User\Laboratorist  $laboratorist
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(User $user, Laboratorist $laboratorist)
    {
        try {
            DB::transaction(function () use ($laboratorist, $user) {
                $laboratorist->delete();
                $user->delete();
            }, 5);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect()->back()->with('success_message', 'Successfully deleted laboratorist');
    }
}
