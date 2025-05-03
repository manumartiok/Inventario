<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\So;
use App\Models\Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;

class Devices extends Controller
{
  public function index()
  {
    $devices=Device::all();
    return view('content.pages.devices',['devices'=>$devices]);
  }

  public function create()
  {
    $sos=So::where('active', true)->get(); //nos devolvera todos los sistemas y tipos que esten activados
    $types=Type::where('active', true)->get();
    return view('content.pages.devices-create', ['sos'=>$sos, 'types'=>$types]);
  }

  public function store (Request $request) {
     $validator = $request->validate([
       'name' => 'required',
  ]); 
  $devices = new Device();
  $devices->name = $request->name;
  $devices->description= $request->description;
  $devices->sos_id = $request->sos_id;
  $devices->type_id = $request->type_id;
  $devices->serial_number = $request->serial_number ?? null; // el "??" asigna que si es nulo, se de el valor a la derecha, en este caso "null"
  $devices->mac_address = $request->mac_address ?? null;
  $devices->ip_address = $request->ip_address ?? null;
  $devices->model = $request->model ?? null;
  $devices->manufacturer = $request->manufacturer ?? null; 
  $devices->firmware = $request->firmware ?? null;
  $devices->stock = $request->stock ?? null;
  $devices->hdd = $request->hdd ?? null;
  $devices->ram = $request->ram ?? null;
  $devices->stock = $request->stock ?? 1;
  $devices->cpu= $request->cpu ?? null;
  $devices->gpu = $request->gpu ?? null;
  $devices->total_slots = $request->total_slots ?? null;
  $devices->history = $request->history ?? null;
  $devices->save();
  
  //mandar mail

  Mail::to('martimanuel912@gmail.com')->send(new ExampleMail());


  return redirect()->route('pages-devices');
}

  public function show($devices_id){
    $devices=Device::find($devices_id);
    $sos=So::where('active', true)->get(); 
    $types=Type::where('active', true)->get();
    return view('content.pages.devices-show' ,['devices'=>$devices,'sos'=>$sos, 'types'=>$types]);
  }

  public function update(Request $request){
       $validator = $request->validate([
       'name' => 'required',
  ]);

  $devices = Device::find($request->devices_id);
  if ($request->hasFile('fileLogo')) {
    $file = $request->file('fileLogo');
    $name = time() . '.' . $file->getClientOriginalName();
    $filePath = '/public/' . $name;
    Storage::put($filePath, file_get_contents($file));

    $url = Storage::url($filePath);
    $array = explode('/storage//public/', $url);

    $devices->image_url = '/storage/' . $array[1];
}
  $devices->name = $request->name;
  $devices->description= $request->description;
  $devices->sos_id = $request->sos_id;
  $devices->type_id = $request->type_id;
  $devices->serial_number = $request->serial_number ?? null; // el "??" asigna que si es nulo, se de el valor a la derecha, en este caso "null"
  $devices->mac_address = $request->mac_address ?? null;
  $devices->ip_address = $request->ip_address ?? null;
  $devices->model = $request->model ?? null;
  $devices->manufacturer = $request->manufacturer ?? null; 
  $devices->firmware = $request->firmware ?? null;
  $devices->stock = $request->stock ?? null;
  $devices->hdd = $request->hdd ?? null;
  $devices->ram = $request->ram ?? null;
  $devices->stock = $request->stock ?? 1;
  $devices->cpu= $request->cpu ?? null;
  $devices->gpu = $request->gpu ?? null;
  $devices->total_slots = $request->total_slots ?? null;
  $devices->history = $request->history ?? null;
  $devices->save();
  
  return redirect()->route('pages-devices');
  }

    public function destroy($devices_id){
    $devices= Device::find($devices_id);
    $devices->delete();
    return redirect()->route('pages-devices');
  }

  public function switch($devices_id){
    $devices=Device::find($devices_id);
    $devices->active= !$devices->active;
    $devices->save();
    return redirect()->route('pages-devices');
  }
}
