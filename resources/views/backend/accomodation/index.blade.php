@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Accomodations</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accomodations as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td class="text-right">
                                    <a href="{{ route('tour-category.edit',$item->id) }}"
                                        class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger delete" data-id={{$item->id}}><i
                                            class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'accomodation.store', 'method' =>'POST'] ) !!}

                    <div class="col-12">
                        {{ Form::label('name', 'Name:')}}
                        {{ Form::text('name', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::submit('Add', ['class'=> 'btn btn-success btn-block mt-3'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.delete').click(function() {
                let id = $(this).data('id');      
                console.log(id);
                
                $.ajax({
                    
                    type: "POST",
                    url: '/manage/accomodation/' + id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        "_method": 'DELETE'
                    },
                    success: function (data) {
                        $('.item' + id).remove();
                    }
                });
            });
</script>
@endsection