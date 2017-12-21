@section('sidebar')
<div class="sidebar" data-color="purple" data-image="{{asset('backend/img/sidebar-1.jpg')}}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
      <a href="" class="simple-text">
                  TA-BOOK
              </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="{{Request::is('admin/customers*')?'active':''}}">
              <a href="{{route('customers.index')}}">
                  <i class="material-icons">person</i>
                  <p>Người dùng</p>
              </a>
          </li>
          <li class="{{Request::is('admin/books*')?'active':''}}">
              <a href="{{route('books.index')}}">
                  <i class="material-icons">book</i>
                  <p>Sách</p>
              </a>
          </li>
          <li class="{{Request::is('admin/categories*')?'active':''}}">
              <a href="{{route('categories.index')}}">
                  <i class="material-icons">assignment</i>
                  <p>Danh mục</p>
              </a>
          </li>
          <li class="{{Request::is('admin/species*')?'active':''}}">
              <a href="{{route('species.index')}}">
                  <i class="material-icons">description</i>
                  <p>Thể loại</p>
              </a>
          </li>
          <li class="{{Request::is('admin/adv*')?'active':''}}">
              <a href="{{route('adv.index')}}">
                  <i class="material-icons">trending_up</i>
                  <p>Đề cử - Quảng cáo</p>
              </a>
          </li>
          <li class="active-pro">
              <a href="">
                  <p><script>
                      document.write(new Date().getFullYear())
                  </script>
                Creative Tim</p>
              </a>
          </li>
        </ul>
    </div>
</div>
@endsection
