@extends('backend.layout.master')
@extends('backend.layout.sidebar')
@section('content')
<div class="content">
  <div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif
        <ul class="nav nav-tabs" role="tablist">
       <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">BTV đề cử</a></li>
       <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Quảng cáo</a></li>
     </ul>

     <!-- Tab panes -->
     <div class="tab-content">
       <div role="tabpanel" class="tab-pane active" id="home">
         <div class="row">
           <div class="col-md-12">
             <div class="card card-plain">
                 <div class="col-md-8">
                   <form class="navbar-form search" action="{{route('adv.update_btv')}}" method="post">
                     {{ csrf_field() }}
                     <div class="row">
                       <div class="col-md-2 form-label">
                         <label for="" class="{{ $errors->has('books_btv') ? 'has-error' : '' }}">Sách<span class="required"> * </span></label>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group label-floating">
                           <select class="js-example-basic-multiple-adv-btv" name="books_btv[]" multiple="multiple" style="width: 500px" >
                             @foreach($books_all as $specy)
                             @if($specy->adv != 'QC')
                             <option value="{{$specy->id}}">{{$specy->name}}</option>
                             @endif
                             @endforeach
                         </select>
                         </div>
                       </div>
                     </div>

                 </div>
                 <div class="col-md-4">
                   <button class="btn btn-primary pull-right btn-btv" type="submit">Cập nhật</i></a>
                 </div>
                 </form>
               <div class="card-content table-responsive">
                 <table class="table table-hover">
                   <thead>
                     <th>ID</th>
                     <th>Tên sách</th>
                     <th>Tác giả</th>

                   </thead>
                   <tbody>
                     @if($books_btv)
                     @foreach($books_btv as $book)
                     <tr>
                       <td>{{$book->id}}</td>
                       <td>{{$book->name}}</td>
                       <td>{{$book->author}}</td>
                     </tr>
                     @endforeach
                     @endif
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div role="tabpanel" class="tab-pane" id="profile">
         <div class="row">
           <div class="col-md-12">
             <div class="card card-plain">
                 <div class="col-md-8">
                   <form class="navbar-form search" role="search" action="{{route('adv.update_qc')}}" method="post">
                     {{ csrf_field() }}
                     <div class="row">
                       <div class="col-md-2 form-label">
                         <label for="" class="{{ $errors->has('books_qc') ? 'has-error' : '' }}">Sách<span class="required"> * </span></label>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group label-floating">
                           <select class="js-example-basic-multiple-adv-qc" name="books_qc[]" multiple="multiple" style="width: 500px" >
                             @foreach($books_all as $specy)
                             @if($specy->adv != 'BTV')
                             <option value="{{$specy->id}}">{{$specy->name}}</option>
                             @endif
                             @endforeach
                         </select>
                         </div>
                       </div>
                     </div>

                 </div>
                 <div class="col-md-4">
                   <button class="btn btn-primary pull-right btn-qc" type="submit">Cập nhật</a>
                 </div>
                 </form>
               <div class="card-content table-responsive">
                 <table class="table table-hover">
                   <thead>
                     <th>ID</th>
                     <th>Tên sách</th>
                     <th>Tác giả</th>

                   </thead>
                   <tbody>
                     @if($books_qc)
                     @foreach($books_qc as $book)
                     <tr>
                       <td>{{$book->id}}</td>
                       <td>{{$book->name}}</td>
                       <td>{{$book->author}}</td>

                     </tr>
                     @endforeach
                     @endif
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>


  </div>
</div>
  <!-- Modal -->
@endsection
