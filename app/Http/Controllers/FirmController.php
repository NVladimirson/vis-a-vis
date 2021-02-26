<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FirmModel;
use App\Models\PhoneModel;
use Illuminate\Support\Facades\Redirect;

class FirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privilages = $request->session()->get('crud');
        $firms = FirmModel::orderByDesc('updated_at')->paginate(25);
        return view('firm.index', compact('firms','privilages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if($request->session()->get('crud')){
            return view('firm.create');
        }
        else{
            return Redirect::back()->withErrors(['Недостаточно прав']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        FirmModel::create([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        return redirect()->route('firms.index')
            ->with('success', 'Новая компания добавлена в БД.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->session()->get('crud')){
            $firm = FirmModel::find($id);
            return view('firm.show', compact('firm'));
        }
        else{
            return Redirect::back()->withErrors(['Недостаточно прав']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $privilages = $request->session()->get('crud');
        
        if($privilages){
            $firm = FirmModel::find($id);
            return view('firm.edit', compact('firm'));
        }else{
            return Redirect::back()->withErrors(['Недостаточно прав']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->name);
        $request->validate([
            'name' => 'required'
        ]);
        $firm = FirmModel::find($id);
        $oldname = $firm->name;
        $firm->update([
            'name' => $request->name,
            'updated_at' => now()
            ]);

        return redirect()->route('firms.index')
            ->with('success', 'Компания сменила название '.$oldname. ' на '.$firm->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = PhoneModel::where('firm_id', $id)->get()->count();
        $related_phones = PhoneModel::where('firm_id', $id)->delete();
        $firm = FirmModel::find($id);
        $name = $firm->name;
        $firm->delete();

        // return redirect()->route('firms.index')
        // ->with('success', 'Компания '.$name. ' удалена.');
        return response()->json([
            'name' => $firm->name,
            'phones' => $count,
        ]);
    }
}
