<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head>
<body>
<div class="container">
{{--    @if($errors->all())--}}
{{--        <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--            @foreach($errors->all() as $error)--}}
{{--            <strong>Error!</strong> {{ $error }}--}}
{{--            @endforeach--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                <span aria-hidden="true">&times;</span>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    @endif--}}
    <fieldset class="border pt-2">
        <legend class="ml-2" style="width: auto">List users</legend>
        <div class="row">
            <div class="col-12" align="right">
                <button id="duplicate-user" class="btn btn-success mr-5" type="button">+</button>
            </div>
            <div class="col-12">
                <form method="post" id="form-user">
                    @csrf
                    <div class="row m-2" id="info-user">
                        <div class="row col-12 mt-2 item-info-user">
                            <div class="col-4">
                                <input type="text" id="first_name_0" name="first_name[0]" class="form-control" placeholder="First name">
                            </div>
                            <div class="col-4">
                                <input type="text" id="last_name_0" name="last_name[0]" class="form-control" placeholder="Last name">
                            </div>
                            <div class="col-4">
                                <input type="text" id="address_0" name="address[0]" class="form-control" placeholder="Address">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="submit-form-user" class="btn btn-primary m-4">Submit</button>

                </form>
            </div>

        </div>

    </fieldset>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
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
        })
    })



</script>
</body>
</html>
