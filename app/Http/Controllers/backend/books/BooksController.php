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
use App\Chaps;
use App\Subs;
use App\Comments;

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
          // Delete old pdf
          Storage::disk('pdf_upload')->delete($request->session()->get('pdf_book'));
          Storage::disk('image_upload')->delete($request->session()->get('image_book'));
          $request->session()->forget('pdf_book');
          $request->session()->forget('pdf_name');
          $request->session()->forget('image_book');
        }
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
      if($request->hasFile('image'))
      {
        $file = $request->file('image');
        $extension_of_icon = strtolower($file->getClientOriginalExtension());

        //If countinute input File
        if($request->session()->has('image_book')){
          //Delete old icon in uploads/images/
          Storage::disk('image_upload')->delete($request->session()->get('image_book'));
          //Delete old session
          $request->session()->forget('image_book');
        }
        //If input image
        if(in_array($extension_of_icon,['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp'])){
          //generate new name
          $name_of_icon = uniqid().'_'.$file->getClientOriginalName();
          //save pickes image to uploads/images
          Storage::disk('image_upload')->put($name_of_icon, File::get($file));
          //put new session
          $request->session()->put('image_book',$name_of_icon);
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
        'like'=>'required|numeric'
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
        'date'=>'Yêu cầu nhập ngày',
        'notIn'=>'Yâu cầu nhập',
        'mimes'=>'Yêu cầu chọn file pdf'
      ];
      //validte request by validate option

      if(!$request->session()->has('pdf_book')){
        $valid['content'] = 'required';
      }
      if(!$request->session()->has('image_book')){
        $valid['image'] = 'required';
      }
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
      $book->recommend = 0;
      $book->species = $spe;
      $book->categories_id = $request->categories;
      $book->content = Session::get('pdf_book');
      $book->image = Session::get('image_book');

      $book->save();

      //delete session
      $request->session()->forget('pdf_book');
      $request->session()->forget('pdf_name');
      $request->session()->forget('image_book');

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
      // if(!$request->session()->has('_old_input')){
      //   // Delete old pdf (temporary image)
      //   Storage::disk('pdf_upload')->delete($request->session()->get('pdf_book'));
      //   $request->session()->forget('pdf_book');
      //   $request->session()->forget('pdf_name');
      // }
      $edit = Books::where('id',$id)->first();
      $customers = Customers::all();
      $categories = Categories::all();
      $species = Species::all();
      $cate='-1';
      foreach($categories as $cus){
        if($cus->name=='Truyện tự sáng tác'){
          $cate = $cus->id;
        }
      }
      return view('backend.books.booksedit',['categories'=>$categories,'species'=>$species,'customers'=>$customers,'cate'=>$cate,'edit'=>$edit]);
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
      if($request->hasFile('image'))
      {
        $file = $request->file('image');
        $extension_of_icon = strtolower($file->getClientOriginalExtension());

        //If countinute input File
        if($request->session()->has('image_book')){
          //Delete old icon in uploads/images/
          Storage::disk('image_upload')->delete($request->session()->get('image_book'));
          //Delete old session
          $request->session()->forget('image_book');
        }
        //If input image
        if(in_array($extension_of_icon,['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp'])){
          //generate new name
          $name_of_icon = uniqid().'_'.$file->getClientOriginalName();
          //save pickes image to uploads/images
          Storage::disk('image_upload')->put($name_of_icon, File::get($file));
          //put new session
          $request->session()->put('image_book',$name_of_icon);
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
        'like'=>'required|numeric'
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

      $book = Books::where('id',$id)->first();
      Storage::disk('image_upload')->delete($book->image);
      $book->name = $request->name;
      $book->author = $request->author;
      $book->preview = $request->intro;
      $book->date = $request->date;
      $book->view = $request->view;
      $book->like = $request->like;
      $book->species = $spe;
      $book->categories_id = $request->categories;
      if(Session::get('pdf_name')){
        $book->content = Session::get('pdf_book');
      }
      if(Session::get('image_book')){
        $book->image = Session::get('image_book');
      }

      $book->save();

      //delete session
      $request->session()->forget('pdf_book');
      $request->session()->forget('pdf_name');
      $request->session()->forget('image_book');

      //back to table page
      return redirect()->route('books.index')->with('status','Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $book = Books::where('id',$id)->first();
      $book->delete();
      Storage::disk('pdf_upload')->delete($book->content);
      Storage::disk('image_upload')->delete($book->image);
      $books = Chaps::where('book_id',$id)->get();
      if($books){
        foreach ($books as $book) {
          $book->delete();
        }
      }
      $books = Subs::where('book_id',$id)->get();
      if($books){
        foreach ($books as $book) {
          $book->delete();
        }
      }
      $books = Comments::where('book_id',$id)->get();
      if($books){
        foreach ($books as $book) {
          $book->delete();
        }
      }

      return redirect()->route('books.index')->with('status','Đã xóa thành công!');
    }

    public function search(Request $request){
      $search = $request->search;
      $books = Books::where('id',$search)
                    ->orwhere('name','like','%'.$search.'%')
                    ->orwhere('author','like','%'.$search.'%')
                    ->orwhere('date','like','%'.$search.'%')
                      ->sortable()->paginate(5);
      return view('backend.books.bookstable',['books'=>$books]);
    }
}
