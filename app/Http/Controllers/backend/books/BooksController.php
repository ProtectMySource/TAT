<?php

namespace App\Http\Controllers\backend\books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Customers;
use App\Books;
use App\Categories;
use App\Species;

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
    public function create(Request $request)
    {
        if(!$request->session()->has('_old_input')){
          // Delete old pdf (temporary image)
          Storage::disk('pdf_upload')->delete($request->session()->get('pdf_book'));
          $request->session()->forget('pdf_book');
          $request->session()->forget('pdf_name');
        }
        $customers = Customers::all();
        $categories = Categories::all();
        $species = Species::all();
        $cate='-1';
        foreach($categories as $cus){
          if($cus->name=='Truyện tự sáng tác'){
            $cate = $cus->id;
          }
        }
        return view('backend.books.booksadd',['categories'=>$categories,'species'=>$species,'customers'=>$customers,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->hasFile('content'))
      {
        $file = $request->file('content');
        $extension_of_icon = strtolower($file->getClientOriginalExtension());

        //If countinute input File
        if($request->session()->has('pdf_book')){
          //Delete old icon in uploads/images/
          Storage::disk('pdf_upload')->delete($request->session()->get('pdf_book'));
          //Delete old session
          $request->session()->forget('pdf_book');
          $request->session()->forget('pdf_name');
        }
        //If input image
        if(in_array($extension_of_icon,['pdf'])){
          //generate new name
          $name_of_icon = uniqid().'_'.$file->getClientOriginalName();
          //save pickes image to uploads/images
          Storage::disk('pdf_upload')->put($name_of_icon, File::get($file));
          //put new session
          $request->session()->put('pdf_book',$name_of_icon);
          $request->session()->put('pdf_name',$file->getClientOriginalName());
        }
      }
      if($request['intro']=='<p>&nbsp;</p>'){
        $request['intro']='';
      }
      $valid=[
        'name'=>'required',
        'author'=>'required',
        'categories'=>'required',
        'species'=>'required',
        'intro'=>'required',
        'content'=>'mimes:application/pdf,pdf|max:50000',
        'date'=>'required|date',
        'view'=>'required|numeric',
        'like'=>'required|numeric',
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
        'date'=>'Yêu cầu nhập ngày',
        'notIn'=>'Yâu cầu nhập',
        'mimes'=>'Yêu cầu chọn file pdf'
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);

      //setup data
      $species = $request->species;
      $spe='';
      foreach ($species as $s) {
        $spe = $spe.' '.$s.',';
      }
      $count = strlen($spe);
      $spe = substr($spe,0,$count-1);
      //save data
      $book = new Books;
      $book->name = $request->name;
      $book->author = $request->author;
      $book->preview = $request->intro;
      $book->date = $request->date;
      $book->view = $request->view;
      $book->like = $request->like;
      $book->species = $spe;
      $book->categories_id = $request->categories;
      $book->content = Session::get('pdf_name');

      $book->save();

      //delete session
      $request->session()->forget('pdf_book');
      $request->session()->forget('pdf_name');

      //back to table page
      return redirect()->route('books.index')->with('status','Thêm mới thành công!');

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

    public function tusangtac_store(Request $request)
    {
      if($request['intro']=='<p>&nbsp;</p>'){
        $request['intro']='';
      }
      $valid=[
        'name'=>'required',
        'author2'=>'required',
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

      //setup data
      $species = $request->species;
      $spe='';
      foreach ($species as $s) {
        $spe = $spe.' '.$s.',';
      }
      $count = strlen($spe);
      $spe = substr($spe,0,$count-1);
      //save data
      $book = new Books;
      $book->name = $request->name;
      $book->user_id = $request->author2;
      $book->preview = $request->intro;
      $book->date = $request->date;
      $book->view = $request->view;
      $book->like = $request->like;
      $book->species = $spe;
      $book->categories_id = $request->categories;

      $book->save();
      return redirect()->route('books.index')->with('status','Thêm mới thành công!');
    }

}
