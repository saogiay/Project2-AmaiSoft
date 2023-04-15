$(document).ready(function() {
    $('.product-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = response.redirect;
                }
            },
            error: function(response) {
                // Xử lý lỗi
                var errors = response.responseJSON.errors;
                $.each(errors, function (key, value) {
                    var errorMessage = '<div class="error">' + value[0] + '</div>';
                    $('#' + key).addClass('is-invalid');
                    $('#' + key).next('.error-message').html(errorMessage);
                    $('#' + key).next('.error-message').show();
                });
            }
        });
    });
});

// = = = = = = = = = = = = = = = = changeImg = = = = = = = = = = = = = = = =
function changeImg(input) {
    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        //Sự kiện file đã được load vào website
        reader.onload = function (e) {
            //Thay đổi đường dẫn ảnh
            $(input).siblings('.thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
//Khi click #thumbnail thì cũng gọi sự kiện click #image
$(document).ready(function () {
    $('.thumbnail').click(function () {
        $(this).siblings('.image').click();
    });
});
//thay đổi ảnh show
$(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
