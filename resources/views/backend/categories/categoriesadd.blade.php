@extends('backend.layout.master')
@extends('backend.layout.sidebar')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thêm mới danh mục</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content">
                        <form class="form" action="{{route('categories.store')}}" method="POST">
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

                        <button type="submit" class="btn btn-primary pull-right btnsub">Tạo mới</button>
                        <a class="btn btn-primary pull-right" href="{{route('categories.index')}}">Hủy</a>
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
