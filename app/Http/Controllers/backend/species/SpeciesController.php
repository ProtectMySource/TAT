<?php

namespace App\Http\Controllers\backend\species;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Species;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $species = Species::sortable()->paginate(5);
      return view('backend.species.speciestable',['species'=>$species]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.species.speciesadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $valid=[
        'name'=>'required|unique:species,name'
      ];
      $messages = [
        'required' => 'Yêu cầu nhập'
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);

      $species = new Species;
      $species->name = $request->name;

      $species->save();

      return redirect()->route('species.index')->with('status','Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $specy = Species::find($id);
      return view('backend.species.speciesedit',['specy'=>$specy]);
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
      $valid1=[
        'name'=> Rule::unique('species')->ignore($id),
      ];
      $valid2=[
        'name'=>'required',
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
        'unique'=> 'Thể loại này đã tồn tại'
      ];
      //validte request by validate option
      $this->validate($request, $valid1,$messages);
      $this->validate($request, $valid2,$messages);

      $specy = Species::find($id);

      $specy->name = $request->name;

      $specy->save();
      return redirect()->route('species.index')->with('status','Chỉnh sữa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $specy = Species::where('id',$id)->first();
      $specy->delete();
      return redirect()->route('species.index')->with('status','Đã xóa thành công!');
    }

    public function search(Request $request){
      $search = $request->search;
      $species = Species::where('id',$search)
                    ->orwhere('name','like','%'.$search.'%')
                      ->sortable()->paginate(5);
      return view('backend.species.speciestable',['species'=>$species]);
    }
}
