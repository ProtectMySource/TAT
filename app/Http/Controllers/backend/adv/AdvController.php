<?php

namespace App\Http\Controllers\backend\adv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Books;

class AdvController extends Controller
{
    public function index(){
      $books = Books::all();
      $books_btv = Books::where('adv','BTV')->get();
      $books_qc = Books::where('adv','QC')->get();
      return view('backend.adv.advtable',['books_all'=>$books,'books_btv'=>$books_btv,'books_qc'=>$books_qc]);
    }
    public function delete(){

    }
    public function update_btv(Request $request){
      $valid=[
        'books_btv'=>'required',
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);

      $pre  = Books::where('adv','BTV')->get();
      foreach ($pre as $b) {
        $b->adv = '';
        $b->save();
      }
      $books = $request->books_btv;
      foreach ($books as $b) {
        $find = Books::where('id',$b)->first();
        $find->adv = 'BTV';
        $find->save();
      }
      return redirect(route('adv.index')) ;
    }
    public function update_qc(Request $request){
      $valid=[
        'books_qc'=>'required',
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
      ];
      //validte request by validate option
      $this->validate($request, $valid,$messages);
      $pre  = Books::where('adv','QC')->get();
      foreach ($pre as $b) {
        $b->adv = '';
        $b->save();
      }
      $books = $request->books_qc;
      foreach ($books as $b) {
        $find = Books::where('id',$b)->first();
        $find->adv = 'QC';
        $find->save();
      }
      return redirect(route('adv.index')) ;
    }
}
