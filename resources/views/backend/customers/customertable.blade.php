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
    <div class="row">
      <div class="col-md-8">
        <form class="navbar-form search" role="search" action="{{route('customers.search')}}">
          <div class="form-group  is-empty">
            <input name="search" type="text" class="form-control" placeholder="Tìm" style="width:250px;" value="{{Request::input('search')}}">
            <span class="material-input"></span>
            <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
      <div class="col-md-4">
        <a class="btn btn-primary pull-right" href="{{route('customers.create')}}"><i class="material-icons">add</i></a>
      </div>
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-content table-responsive">
            <table class="table table-hover">
              <thead>
                <th>ID</th>
                <th>@sortablelink('name', 'Tên')</th>
                <th>@sortablelink('email', 'Email')</th>
                <th>@sortablelink('dob', 'Ngày sinh')</th>
                <th>Tùy chọn</th>
              </thead>
              <tbody>
                @if($customers)
                @foreach($customers as $customer)
                <tr>
                  <td>{{$customer->id}}</td>
                  <td>{{$customer->name}}</td>
                  <td>{{$customer->email}}</td>
                  <td>{{date('d-m-Y', strtotime(str_replace('-', '/', $customer->dob)))}}</td>
                  <td class="td-actions text-right">
                    <a href="{{route('customers.edit',['customer'=>$customer->id])}}" type="button" rel="tooltip" title="Sửa"
                      class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="button" rel="tooltip" title="Xóa"
                      class="btn btn-danger btn-simple btn-xs" data-toggle="modal"
                          data-target="#myModal" data-whatever="{{$customer->id}}">
                        <i class="fa fa-times"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            <div class="text-center">
               {!! $customers->appends(\Request::except('page'))->render() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cảnh báo</h4>
      </div>
      <div class="modal-body">
        Bạn có muốn xóa đối tượng này không?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <a type="button" class="btn btn-primary btn-yes-modal">Xóa</a>
      </div>
    </div>
  </div>
</div>
@endsection
