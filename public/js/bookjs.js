jQuery(document).ready(function() {
  $('#display_image_book')
  .width(200)
  .height(300);
});
function readURL_addNewImg(input) {
  var avatar_display = $('#display_image_book');
  uploadImage(input, avatar_display, '200', '300');
}
function readURL_updateNewImg(input) {
  var avatar_display = $('#display_image_book');
  uploadeditImage(input, avatar_display, '200', '300');
}

function uploadImage(input, tag_name_display, width_size, height_size){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var type_image = input.files[0].type;

    reader.onload = function (e) {
      var image = new Image();
      //Set the Base64 string return from FileReader as source.
      image.src = e.target.result;
      image.onload = function(){
        if((width_size=='all')&&(height_size)=='all'){
          switch (type_image){
            case "image/bmp":
            case "image/jpeg":
            case "image/jpg":
            case "image/png":
            case "image/gif":
            case "image/svg":
            tag_name_display
            .attr('src', e.target.result);
            break;
            default:
            tag_name_display
            .attr('src', "../../../backend/image/input_image.jpg");
            break;
          }
        }
        else {
          var height = this.height;
          var width = this.width;
          if((width==width_size)&&(height==height_size)){
            switch (type_image){
              case "image/bmp":
              case "image/jpeg":
              case "image/jpg":
              case "image/png":
              case "image/gif":
              case "image/svg":
              tag_name_display
              .attr('src', e.target.result)
              .width(width_size)
              .height(height_size);
              break;
              default:
              tag_name_display
              .attr('src', "../../backend/image/input_image.jpg")
              .width(width_size)
              .height(height_size);
              // $("#"+input.id).val('');
              break;
            }
          }
          else{
            tag_name_display
            .attr('src', "../../backend/image/input_image.jpg")
            .width(width_size)
            .height(height_size);
            $("#"+input.id).val('');
            alert('Kích thước hình 200 x 300');
          }
        }

      };
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function uploadeditImage(input, tag_name_display, width_size, height_size){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var type_image = input.files[0].type;

    reader.onload = function (e) {
      var image = new Image();
      //Set the Base64 string return from FileReader as source.
      image.src = e.target.result;
      image.onload = function(){
        if((width_size=='all')&&(height_size)=='all'){
          switch (type_image){
            case "image/bmp":
            case "image/jpeg":
            case "image/jpg":
            case "image/png":
            case "image/gif":
            case "image/svg":
            tag_name_display
            .attr('src', e.target.result);
            break;
            default:
            tag_name_display
            .attr('src', "../../backend/image/input_image.jpg");
            break;
          }
        }
        else {
          var height = this.height;
          var width = this.width;
          if((width==width_size)&&(height==height_size)){
            switch (type_image){
              case "image/bmp":
              case "image/jpeg":
              case "image/jpg":
              case "image/png":
              case "image/gif":
              case "image/svg":
              tag_name_display
              .attr('src', e.target.result)
              .width(width_size)
              .height(height_size);
              break;
              default:
              tag_name_display
              .attr('src', "../../backend/image/input_image.jpg")
              .width(width_size)
              .height(height_size);
              // $("#"+input.id).val('');
              break;
            }
          }
          else{
            tag_name_display
            .attr('src', "../../../backend/image/input_image.jpg")
            .width(width_size)
            .height(height_size);
            $("#"+input.id).val('');
            alert('Kích thước hình 200 x 300');
          }
        }

      };
    };
    reader.readAsDataURL(input.files[0]);
  }
}
