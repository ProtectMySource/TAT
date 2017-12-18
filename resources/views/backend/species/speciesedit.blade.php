@extends('backend.layout.master')
@extends('backend.layout.sidebar')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Chỉnh sửa thể loại</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content">
                        <form class="form" action="{{route('species.up',['specy'=>$specy->id])}}" method="POST">
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
                                  <input type="text" class="form-control" name="name" value="{{$specy->name}}">
                                @endif
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('name'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('name')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>

                        <button type="submit" class="btn btn-primary pull-right btnsub">Sửa</button>
                        <a class="btn btn-primary pull-right" href="{{route('species.index')}}">Hủy</a>
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
