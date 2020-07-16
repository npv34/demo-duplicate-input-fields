$(document).ready(function () {
    let countDuplicate = 0;
    $("#duplicate-user").click(function(){
        //xoá hết nội dung thẻ div hiển thị message lỗi
        $('.content-error').html('').parent().find('input').removeClass('is-invalid');
        countDuplicate++;
        let newHtml = $(".item-info-user").eq(0).clone();
        newHtml.find('input').each(function() {
            this.name= this.name.replace('[0]', '['+countDuplicate+']');
            this.id= this.id.replace('0', countDuplicate);
        });
        $('#info-user').append(newHtml);
    });


    $('#submit-form-user').click(function () {
        //lấy domain mặc định
        let origin = location.origin;

        //lấy dữ liệu từ form #form-user
        let data = $('#form-user').serialize();

        //xử lý gửi dữ liệu qua ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: origin + '/add',
            type:'POST',
            data: data,
            success:function(data){
                console.log(data);
            },
            error: function (error) {
                //xoá hết nội dung thẻ div hiển thị message lỗi
                $('.content-error').html('');

                // lấy tất cả messages khi có lỗi avlidation
                let messagesError = error.responseJSON.errors;

                // for tất cả các lỗi, messagesError là một mảng liên kết
                $.each(messagesError, function (index, message) {
                    let idInputError = index.toString().replace('.','_')

                    let divMessage = '<div class="text-danger content-error">' + message + '</div>';
                    $("#" + idInputError).addClass('is-invalid').parent().append(divMessage)
                })
            }
        })

        //endable button clear message
        $('#clear-message').removeAttr('disabled')
    })

    //remove all message error
    $('#clear-message').click(function () {
        $('.content-error').html('').parent().find('input').removeClass('is-invalid');
        $(this).attr('disabled', true)
    })
})
