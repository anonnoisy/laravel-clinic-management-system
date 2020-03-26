<?php

namespace App\Http\Controllers\Admin\Bed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bed\Type;
use Illuminate\Support\Facades\DB;

class BedTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function index()
    {
        $types = DB::transaction(function () {
            return Type::paginate(20);
        }, 5);

        return view('admin.bed.type.index', [
            'types' => $types
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
        return view('admin.bed.type.create');
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
        $this->validate($request, ['name' => 'required']);

        try {
            DB::transaction(function () use ($request) {
                return Type::create($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::bed::type::index'))->with('success_message', 'Successfully added new bed type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bed\Type  $type
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function show(Type $type)
    {
        return view('admin.bed.type.show', [
            'type' => $type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bed\Type  $type
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function edit(Type $type)
    {
        return view('admin.bed.type.edit', [
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed\Type  $type
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function update(Request $request, Type $type)
    {
        $this->validate($request, ['name' => 'required']);

        try {
            DB::transaction(function () use ($request, $type) {
                return $type->update($request->all());
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::bed::type::index'))->with('success_message', 'Successfully updated bed type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bed\Type  $type
     * @return \Illuminate\Http\Response
     * 
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function destroy(Type $type)
    {
        try {
            DB::transaction(function () use ($type) {
                return $type->delete();
            }, 5);
        } catch (\Exception $e) {
            return back()->with('error_message', 'Sorry, something went wrong, please try again!');
        }

        return redirect(route('admin::bed::type::index'))->with('success_message', 'Successfully deleted bed type');
    }
}
