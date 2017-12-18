<?php

namespace App\Http\Controllers\backend\customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Customers;
use App\Books;
use App\Subs;
use App\Comments;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::sortable()->paginate(5);
        return view('backend.customers.customertable',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customers.customeradd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valid option
        $valid=[
          'name'=>'required',
          'email'=>'required|email|unique:customers,email',
          'password1'=>'required',
          'password2'=>'required',
          'dob'=>'required|date'
        ];
        $messages = [
          'required' => 'Yêu cầu nhập',
          'email'=>'Yêu cầu nhập email',
          'date'=>'Yêu cầu nhập ngày'
        ];
        //validte request by validate option
        $this->validate($request, $valid,$messages);

        //save
        $customer = new Customers;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password1);
        $customer->password2 = Hash::make($request->password2);
        $customer->dob = $request->dob;

        $customer->save();

        return redirect()->route('customers.index')->with('status','Thêm mới thành công!');

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
        $customer = Customers::find($id);
        return view('backend.customers.customeredit',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $data = $request->all();
      $valid=[
        'name'=>'required',
        'email'=> Rule::unique('customers')->ignore($id),
        'password1'=>'required',
        'password2'=>'required',
        'dob'=>'required|date'
      ];
      $valid2=[
        'email'=>'required|email'
      ];
      $messages = [
        'required' => 'Yêu cầu nhập',
        'email'=>'Yêu cầu nhập email',
        'date'=>'Yêu cầu nhập ngày',
        'email.unique'=>"Email đã có người sử dụng"
      ];

      //validte request by validate option
      $this->validate($request, $valid, $messages);
      $this->validate($request, $valid2, $messages);

      $customer = Customers::find($id);

      $customer->name = $request->name;
      $customer->email = $request->email;
      $customer->password = Hash::make($request->password1);
      $customer->password2 = Hash::make($request->password2);
      $customer->dob = $request->dob;

      $customer->save();
      return redirect()->route('customers.index')->with('status','Chỉnh sữa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customers::where('id',$id)->first();
        $customer->delete();
        $books = Books::all();
        foreach ($books as $book) {
          if($book->customer_id==$id){
            $book->delete();
          }
        }
        $comments = Comments::all();
        foreach ($comments as $comment) {
          if($comment->customer_id==$id){
            $comment->delete();
          }
        }
        $subs = Subs::all();
        foreach ($subs as $sub) {
          if($sub->customer_id==$id){
            $sub->delete();
          }
        }
        return redirect()->route('customers.index')->with('status','Đã xóa thành công!');
    }

    public function search(Request $request){
      $search = $request->search;
      $customers = Customers::where('id',$search)
                    ->orwhere('name','like','%'.$search.'%')
                      ->orwhere('email','like','%'.$search.'%')
                        ->orwhere('dob',$search)->sortable()->paginate(5);
      return view('backend.customers.customertable',['customers'=>$customers]);
    }
}
