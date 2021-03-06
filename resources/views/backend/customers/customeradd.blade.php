@extends('backend.layout.master')
@extends('backend.layout.sidebar')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thêm mới người dùng</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content">
                        <form class="form" action="{{route('customers.store')}}" method="POST">
                           {{ csrf_field() }}
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('name') ? 'has-error' : '' }}">Tên <span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                @if(old('name'))
                                  <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                @else
                                  <input type="text" class="form-control" name="name">
                                @endif
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('name'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('name')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('email') ? 'has-error' : '' }}">Email <span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                @if(old('email'))
                                  <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                @else
                                  <input type="text" class="form-control" name="email">
                                @endif
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('email'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('email')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('password1') ? 'has-error' : '' }}">Mật khẩu 1 <span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                @if(old('password1'))
                                  <input type="password" class="form-control" name="password1" value="{{old('password1')}}">
                                @else
                                  <input type="password" class="form-control" name="password1">
                                @endif
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('password1'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('password1')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('password2') ? 'has-error' : '' }}">Mật khẩu 2 <span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                @if(old('password2'))
                                  <input type="password" class="form-control" name="password2" value="{{old('password2')}}">
                                @else
                                  <input type="password" class="form-control" name="password2">
                                @endif
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('password2'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('password2')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>                        
                        <button type="submit" class="btn btn-primary pull-right btnsub">Tạo mới</button>
                        <a class="btn btn-primary pull-right" href="{{route('customers.index')}}">Hủy</a>
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
