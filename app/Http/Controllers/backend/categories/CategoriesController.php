<?php

namespace App\Http\Controllers\backend\categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Customers;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Categories::sortable()->paginate(5);
      return view('backend.categories.categoriestable',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.categoriesadd');
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
        'name'=>'required'
      ];
      $messages = [
        'required' => 'Yêu cầu nhập'
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);

      $categories = new Categories;
      $categories->name = $request->name;

      $categories->save();

      return redirect()->route('categories.index')->with('status','Thêm mới thành công!');
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
      $category = Categories::find($id);
      return view('backend.categories.categoriesedit',['category'=>$category]);
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
      $valid=[
        'name'=>'required'
      ];
      $messages = [
        'required' => 'Yêu cầu nhập'
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);

      $category = Categories::find($id);

      $category->name = $request->name;

      $category->save();
      return redirect()->route('categories.index')->with('status','Chỉnh sữa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Categories::where('id',$id)->first();
      $category->delete();
      $books = Books::all();
      foreach ($books as $book) {
        if($book->categories_id==$id){
          $book->delete();
        }
      }
      return redirect()->route('categories.index')->with('status','Đã xóa thành công!');
    }

    public function search(Request $request){
      $search = $request->search;
      $categories = Categories::where('id',$search)
                    ->orwhere('name','like','%'.$search.'%')
                      ->sortable()->paginate(5);
      return view('backend.categories.categoriestable',['categories'=>$categories]);
    }
}
