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

    public function danhsach(){

    }
    public function theloai(){

    }
    public function show(){

    }
}
