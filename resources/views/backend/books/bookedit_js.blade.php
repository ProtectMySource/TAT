@section('js')
$(document).ready(function(){
  $value = $('#categoryselect').val();
  if({{$cate}}==$value){
    $('#authorinput').addClass('hide');
    $('#authorselect').removeClass('hide');
    $('#inputfile').addClass('hide');
    $("#formedit").attr('action','{{route('books.2up',['book'=>$edit->id])}}');
  }
  else{
    $('#authorinput').removeClass('hide');
    $('#authorselect').addClass('hide');
    $('#inputfile').removeClass('hide');
    $("#formedit").attr('action','{{route('books.up',['book'=>$edit->id])}}');
  }
});
@endsection
