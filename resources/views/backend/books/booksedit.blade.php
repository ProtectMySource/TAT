@extends('backend.layout.master')
@extends('backend.layout.sidebar')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Thêm mới sách</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content">
                        <form id="formedit" class="form" action="{{route('books.up',['book'=>$edit->id])}}" method="POST" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="row">
                             <div class="col-md-2 form-label">
                               <label for="" class="{{ $errors->has('image') ? 'has-error' : '' }}">Ảnh đại diện<span class="required"> * </span></label>
                             </div>
                             <div class="col-md-6">
                               <div class="form-group label-floating">
                                 <label for="new_img">
                                   <img id="display_image_book"
                                   @if (Session::has('image_book'))
                                   src="{{ URL::to('/uploads/images') . '/' . Session::get('image_book') }}"
                                   @else
                                   src="{{ URL::to('/uploads/images').'/' .$edit->image }}" height="300" width="200"
                                   @endif>
                                   <input id="new_img" type="file" name="image" onchange="readURL_updateNewImg(this)"/>
                                 </label>
                               </div>
                             </div>
                             <div class="col-md-2">
                               @if ($errors->has('image'))
                                 <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('image')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                               @endif
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-2 form-label">
                               <label for="" class="{{ $errors->has('categories') ? 'has-error' : '' }}">Danh mục<span class="required"> * </span></label>
                             </div>
                             <div class="col-md-6">
                               <div class="form-group label-floating">
                                 <select id="categoryselect" onchange="CategoriesChange(this.value)" class="js-example-basic-single" name="categories" style="width: 100%">
                                   @foreach($categories as $category)
                                   @if(old('categories'))
                                   <option value="{{$category->id}}" {{old('categories')==$category->id?'selected':''}}>{{$category->name}}</option>
                                   @else
                                   <option value="{{$category->id}}" {{$edit->categories_id==$category->id?'selected':''}}>{{$category->name}}</option>
                                   @endif
                                   @endphp
                                   @endforeach
                                 </select>
                               </div>
                             </div>

                             <div class="col-md-2">
                               @if ($errors->has('categories'))
                                 <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('categories')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                               @endif
                             </div>
                           </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('name') ? 'has-error' : '' }}">Tên <span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                  <input type="text" class="form-control" name="name" value="{{old('name')?old('name'):$edit->name}}">
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
                              <label for="" class="{{ $errors->has('author') ? 'has-error' : '' }}">Tác giả<span class="required"> * </span></label>
                            </div>
                            <!-- <div class="col-md-6" id="authorselect">
                              <div class="form-group label-floating">
                                <select  class="js-example-basic-single" name="author2" style="width: 100%">
                                  <option disabled selected value>Chọn người dùng</option>
                                  @foreach($customers as $customer)
                                  @if(old('author2'))
                                  <option value="{{$customer->id}}" {{old('author2') == $customer->id?'selected':''}}>{{$customer->name}}</option>
                                  @else
                                  <option value="{{$customer->id}}" {{$edit->customer_id == $customer->id?'selected':''}}>{{$customer->name}}</option>
                                  @endif
                                  @endforeach
                                </select>
                              </div>
                            </div> -->
                            <div class="col-md-6" id="authorinput">
                              <div class="form-group label-floating">
                                <input  type="text" class="form-control" name="author" value="{{old('author')?old('author'):$edit->author}}">
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('author'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('author')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                              @if ($errors->has('author2'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('author2')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('species') ? 'has-error' : '' }}">Thể loại<span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                <select class="js-example-basic-multiple" name="species[]" multiple="multiple" style="width: 100%">
                                  @if(old('species'))
                                  @foreach($species as $specy)
                                  <option value="{{$specy->name}}" {{in_array($specy->name,old('species'))?'selected':''}}>{{$specy->name}}</option>
                                  @endforeach
                                  @else
                                  @foreach($species as $specy)
                                  <option value="{{$specy->name}}" {{in_array(' '.$specy->name,explode(',',$edit->species))?'selected':''}}>{{$specy->name}}</option>
                                  @endforeach
                                  @endif
                              </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('species'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('species')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row" id="inputfile">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('content') ? 'has-error' : '' }}">File sách<span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                <input id="selectfile" type="file" name="content" value="" accept="application/pdf">
                                <label id="lbfile" class="lbfile" for="" style="color:black">{{Session::has('pdf_name')?Session::get('pdf_name'):$edit->content}}</label> <span><button class="btnfile"><i class="fa fa-file fa-lg fa-white"></i></button></span>
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('content'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('content')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('date') ? 'has-error' : '' }}">Ngày xuất bản <span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group">
                                  <input id="dobp" type="text" class="form-control docs-date" name="date" placeholder="Chọn ngày" value="{{old('date')?old('date'):$edit->date}}">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btndt" disabled>
                                    <i class="fa fa-calendar"></i>
                                  </button>
                                </span>
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('date'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('date')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('view') ? 'has-error' : '' }}">Lượt xem<span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                  <input type="number" class="form-control" name="view" value="{{old('view')?old('view'):$edit->view}}" min="0">
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('view'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('view')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('like') ? 'has-error' : '' }}">Lượt thích<span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                  <input type="number" class="form-control" name="like" value="{{old('like')?old('like'):$edit->like}}" min="0">
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('like'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('like')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2 form-label">
                              <label for="" class="{{ $errors->has('intro') ? 'has-error' : '' }}">Giới thiệu<span class="required"> * </span></label>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                <textarea name="intro" id="editor1">{{old('intro')?old('intro'):$edit->preview}}</textarea>
                              </div>
                            </div>
                            <div class="col-md-2">
                              @if ($errors->has('intro'))
                                <button type="button" class="btn-error" data-toggle="tooltip" data-placement="right"  title="{{$errors->first('intro')}}"><i class="fa fa-exclamation-circle fa-lg"></i></button>
                              @endif
                            </div>
                          </div>
                        <button type="submit" class="btn btn-primary pull-right btnsub">Sửa</button>
                        <a class="btn btn-primary pull-right" href="{{route('books.index')}}">Hủy</a>
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
