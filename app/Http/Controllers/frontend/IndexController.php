<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customers;
use App\Books;
use App\Categories;
use App\Species;
use App\Chaps;
use App\Subs;
use App\Comments;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
      $categories = Categories::all();
      $species = Species::all();
      $books = Books::all();
      $books_qc = Books::where('adv','QC')->get();
      $books_decu = DB::table('books')->orderBy('recommend', 'desc')->take(10)->get();
      $books_up = DB::table('books')->orderBy('created_at', 'desc')->take(10)->get();
      $books_hot = DB::table('books')->whereNotNull('content')->orderBy('view', 'desc')->take(10)->get();
      $books_st_hot = DB::table('books')->whereNull('content')->orderBy('view', 'desc')->take(10)->get();
      $books_like = DB::table('books')->orderBy('like', 'desc')->take(10)->get();
      return view('frontend.index',['categories'=>$categories
          ,'species'=>$species,'books'=>$books,'books_decu'=>$books_decu
            ,'books_qc'=>$books_qc,'books_up'=>$books_up,'books_hot'=>$books_hot,
              'books_st_hot'=>$books_st_hot,'books_like'=>$books_like]);
    }

    public function danhsach(Request $request){
      $categories = Categories::all();
      $species = Species::all();
      $c = Categories::where('id',$request->category)->first();
      $books = Books::where('categories_id',$c->id)->orderBy('created_at','desc')->paginate(20);
          $books_top = Books::where('categories_id',$c->id)->orderBy('view','desc')->take(5)->get();
          return view('frontend.list',['categories'=>$categories
              ,'species'=>$species,'books'=>$books,'books_top'=>$books_top,'danhsach'=>$c->name]);
    }
    public function theloai(Request $request){
      $categories = Categories::all();
      $species = Species::all();
      $c = Species::where('id',$request->specy)->first();
      $cates = Categories::all();
          $books = Books::where('species','like','%'.$c->name.'%')->orderBy('created_at','desc')->paginate(20);
          $books_top = Books::where('species','like','%'.$c->name.'%')->orderBy('view','desc')->take(5)->get();
      return view('frontend.list',['categories'=>$categories
          ,'species'=>$species,'books'=>$books,'books_top'=>$books_top,'danhsach'=>$c->name]);
    }
    public function show(Request $request){
      $categories = Categories::all();
      $species = Species::all();
      $books = Books::all();
      $book = Books::where('id',$request->id)->first();
      return view('frontend.show',['categories'=>$categories
          ,'species'=>$species,'books'=>$books,'book'=>$book]);
    }
    public function search(Request $request){
      $categories = Categories::all();
      $species = Species::all();
      $search = $request->txtKeyword;
      $books = Books::where('name','like','%'.$search.'%')->paginate(15);
      return view('frontend.search',['books'=>$books,'categories'=>$categories
          ,'species'=>$species,'danhsach'=>'Tìm kiếm']);
    }
}
