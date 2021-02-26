<?php

namespace App\Http\Controllers;

use App\Models\FirmModel;
use App\Models\PhoneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privilages = $request->session()->get('crud');
        $phones = PhoneModel::with('firm')->orderByDesc('updated_at')->paginate(25);
        return view('phone.index', compact('phones','privilages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->session()->get('crud')){
            $firms = FirmModel::orderByDesc('updated_at')->get();
            return view('phone.create',compact('firms'));
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
            'phone' => 'required|regex:/^\+?[0-9]{3}-?[0-9]{6,12}$/',
            'firm_id' => 'required'
        ]);
        
        $firmname = FirmModel::find($request->firm_id)->name;
        PhoneModel::create([
            'phone' => $request->phone,
            'firm_id' => $request->firm_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('phones.index')
            ->with('success', 'Новый контакт (' . $request->phone . ') компании '.$firmname.' добавлен в БД.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        if($request->session()->get('crud')){
            $phone = PhoneModel::with('firm')->find($id);
            return view('phone.show', compact('phone'));
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
    public function edit(Request $request,$id)
    {
        if($request->session()->get('crud')){
            $phone = PhoneModel::with('firm')->find($id);
            $firms = FirmModel::orderByDesc('updated_at')->get();
            return view('phone.edit',compact('phone','firms'));
        }
        else{
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
        $request->validate([
            'phone' => 'required:regex:/^\+?[0-9]{3}-?[0-9]{6,12}$/',
            'firm_id' => 'required'
        ]);
        $phone = PhoneModel::find($id);
        $oldphone = $phone->phone;
        $firmname = FirmModel::find($request->firm_id)->name;
        $phone->update([
            'phone' => $request->phone,
            'firm_id' => $request->firm_id,
            'updated_at' => now()
            ]);
        $messsage = 'Компания '.$firmname. ' теперь имеет контакт '.$request->phone.'.';
        //'Компания сменила название '.$oldname. ' на '.$firm->name
        return redirect()->route('phones.index')
            ->with('success', $messsage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = PhoneModel::find($id);
        $deleted_phone = $phone->phone;
        $firm_name = FirmModel::find($phone->firm_id)->name;
        $phone->delete();
        return response()->json([
            'name' => $firm_name,
            'phone' => $deleted_phone
        ]);
    }
}
