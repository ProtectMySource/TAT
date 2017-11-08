@section('js')
$(document).ready(function(){
  $value = $('#categoryselect').val();
  if({{$cate}}==$value){
    $('#authorinput').addClass('hide');
    $('#authorselect').removeClass('hide');
    $('#inputfile').addClass('hide');
    $("#form").attr('action','{{route('books.str')}}');
  }
  else{
    $('#authorinput').removeClass('hide');
    $('#authorselect').addClass('hide');
    $('#inputfile').removeClass('hide');
    $("#form").attr('action','{{route('books.store')}}');
  }
});
@endsection
