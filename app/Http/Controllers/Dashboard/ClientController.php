<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $Clients = Client::all();
        return view('Dashboard.Client',compact('Clients'));
    }
    public function store(Request $request)
    {
        $rules=[
            'name_en'=>['required' , 'string'],
            'name'=>['required' , 'string'],
        ];
        $request->validate($rules);
      try{  
       $clients = new Client();
       $clients->name = $request->name;
       $clients->name_en = $request->name_en;
       $clients->save();
      return redirect()->back()->with('add','Client Added Successfully');
     } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
public function update(Request $request)
{
    $rules=[
        'name_en'=>['required' , 'string'],
        'name'=>['required' , 'string'],
    ];
    $request->validate($rules);
try{
    $clients = Client::findOrFail($request->id);
    $clients->update([
        'name' => $request->name,
        'name_en' => $request->name_en,
    ]);

    return redirect()->back()->with('edit','Client Has been Modified');
}  
catch (\Exception $e) {
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}

}

public function destroy(Request $request)
{
try{
    $clients = Client::findOrFail($request->id);
    Client::destroy($request->id);
    return redirect()->back()->with('delete','Client Has been Deleted');

}catch (\Exception $e) {
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
  }
}
