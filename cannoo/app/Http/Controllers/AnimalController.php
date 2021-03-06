<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ImageStorage;
use App\Animal;
use App\Certificate;

class AnimalController extends Controller {
    
    public function show() {
        $data = []; //to be sent to the view
        $data["title"] = "Ver Mascotas";
        $data["animal"] = Animal::all();
        return view('animal.show')->with("data",$data);
    }

    public function pet($id) {
        $data = []; //to be sent to the view
        $data["title"] = "Pet";
        $data["animal"] = Animal::findOrFail($id);
        return view('animal.pet')->with("data",$data);
    }


    public function create() {
        $data = []; //to be sent to the view
        $data["title"] = "Crear Mascota";
        return view('animal.create')->with("data",$data);
    }


    public function save(Request $request) {
        Animal::validate($request);
        $animal = Animal::create($request->only(["type","breed","birthDate","vaccinated","adopted"]));

        $storeInterface = app(ImageStorage::class);
        $storeInterface->store($request, "animal", $animal->getId());


        return back()->with('success','Item created successfully!');
    }

    public function addToSession(Request $request, $id){
        $animal= Animal::findOrFail($id);
        $request->session()->put('animals.'.$id, $animal);
        return redirect()->route('order.index');
    }

    
    public function deleteFromSession(Request $request, $id){
        $request->session()->forget('animals.'.$id);
        return redirect()->route('order.index');
    }

    public function erase($id) {
        Certificate::where('animal',$id)->delete();
        Animal::where('id', $id)->delete();
        return redirect('animal/show');
    }

    public function like($id){
        $likes = Animal::select('likes')->where('id', $id)->get();
        Animal::where('id',  $id)->update(['likes' => $likes[0]['likes']+1]);
        return redirect()->route('animal.show');
    }

}
?>
