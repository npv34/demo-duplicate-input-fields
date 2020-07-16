<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head>
<body>
<div class="container">
    @if($errors->all())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
            <strong>Error!</strong> {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <fieldset class="border pt-2">
        <legend class="ml-2" style="width: auto">List users</legend>
        <div class="row">
            <div class="col-12" align="right">
                <button id="duplicate-user" class="btn btn-success mr-5" type="button">+</button>
            </div>
            <div class="col-12">
                <form action="{{ route('add-user') }}" method="post">
                    @csrf
                    <div class="row m-2" id="info-user">
                        <div class="row col-12 mt-2 item-info-user">
                            <div class="col-4">
                                <input type="text" name="first_name[0]" class="form-control" placeholder="First name">
                            </div>
                            <div class="col-4">
                                <input type="text" name="last_name[0]" class="form-control" placeholder="Last name">
                            </div>
                            <div class="col-4">
                                <input type="text" name="address[0]" class="form-control" placeholder="Address">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-4">Submit</button>

                </form>
            </div>

        </div>

    </fieldset>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('js/my.js') }}"></script>
<script>
    $(document).ready(function () {
        let countDuplicate = 0;
        $("#duplicate-user").click(function(){
            countDuplicate++;
            let newHtml = $(".item-info-user").eq(0).clone();
            newHtml.find('input').each(function() {
                this.name= this.name.replace('[0]', '['+countDuplicate+']');
            });
            $('#info-user').append(newHtml);
        });
    })
</script>
</body>
</html>
