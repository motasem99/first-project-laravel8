@extends('layouts.app')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                @if(isset($shifts))
                <h3 class="box-title">اضافة خبر</h3>
                  @else
                  <h3 class="box-title">تعديل خبر</h3>
                  @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="saveNews" >
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @csrf
                    <div class="alert alert-success" id="alert" style="display: none">
                    </div>
                  <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الخبر</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter name" value="{{ isset($user)? old('name', $user->name) : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">تفاصيل الخبر</label>
                    <input type="text" name="description" class="form-control @error('name') is-invalid @enderror" id="description" placeholder="enter name" value="{{ isset($user)? old('description', $user->description) : old('description') }}">
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">التصنيف</label>
                      <select name="shift_id" class="form-control @error('shift_id') is-invalid @enderror" id="shift_id" placeholder="choose" >
                      <option value=""></option>
                        @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}" @if(isset($user) && $user->shift_id==$shift->id) selected @endif>{{ $shift->name }}</option>
                        @endforeach
                      </select>
                      @error('shift_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                  </div>
                </form>
        </div>
    </div>
</section>

@endsection


@push('jquery')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){
            $.validator.setDefaults({
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlightL: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'error-block',
                errorPlacement: function (error, element) {
                    if(element.parent('.input-group').lenght) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#saveNews').validate({
                rules: {
                    name: {required: true},
                    description: {required: true},
                    shift_id: {required: true},
                },
                messages: {
                    name: {required: 'هذا الحقل مطلوب'},
                    description: {required: 'هذا الحقل مطلوب'},
                    shift_id: {required: 'هذا الحقل مطلوب'},
                },

                submitHandler: function (form) {
                    var news = new FormData();
                    news.append('_token', '{{ csrf_token() }}');
                    news.append('name', $('#name').val());
                    news.append('description', $('#description').val());
                    news.append('shift_id', $('#shift_id').val());

                    $('input').attr('disabled', 'disabled');
                    $('button').attr('disabled', 'disabled');

                    $.ajax({
                        url: "{{ url('dashboard/news/save') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: news,
                        async: false,
                        cache: false,

                        success: function (response) {
                            $('input').removeAttr('disabled');
                            $('button').removeAttr('disabled');
                            $('#alert').show();
                            $('#alert').html(response.message);
                            $('#alert').fadeOut(10000);

                            $('#name').val('');
                            setTimeout(() => {
                                window.location="{{ url('dashboard/news') }}"
                            }, 3000);
                        },
                        error: function (response) {
                            $('input').removeAttr('disabled');
                            $('button').removeAttr('disabled');
                            $('#faild_send').show();
                            $('#faild_send').fadeOut(10000);
                        },
                        contentType: false,
                        processData: false,
                    });
                }
            });
        });
    </script>
@endpush

