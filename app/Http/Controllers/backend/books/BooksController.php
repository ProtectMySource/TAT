<?php

namespace App\Http\Controllers\backend\books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Books;
use App\Categories;
use App\Species;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Customers;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $books = Books::sortable()->paginate(5);
      return view('backend.books.bookstable',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customers::all();
        $categories = Categories::all();
        $species = Species::all();
        return view('backend.books.booksadd',['categories'=>$categories,'species'=>$species,'customers'=>$customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request['intro']=='<p>&nbsp;</p>'){
        $request['intro']='';
      }
      $valid=[
        'name'=>'required',
        'author'=>'required',
        'categories'=>'required',
        'species'=>'required',
        'intro'=>'required',
        'date'=>'required|date',
        'view'=>'required|numeric',
        'like'=>'required|numeric',
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
        'date'=>'Yêu cầu nhập ngày',
        'notIn'=>'Yâu cầu nhập'
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
