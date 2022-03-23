@extends('layouts.admin')



@section('content')
{{--    <div class="container">--}}
{{--        <a href="{{route('admin.input.create')}}" class="btn btn-success btn-lg mb-2">Новое Поле</a>--}}
{{--    </div>--}}
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Тип</th>
            <th scope="col">Надпись</th>
            <th scope="col">Имя поля (Должно быть уникальныи)</th>
            <th scope="col">Раздел</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $ls)
            <tr>
                <th scope="row">{{$ls->id}}</th>
                <td>{{$ls->type}}</td>
                <td>{{$ls->label}}</td>
                <td>{{$ls->name}}</td>
                <td>{{$ls->index_page->text_btn}}</td>

                <td>
                    <form action="{{route('admin.input.destroy',$ls)}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="bi bi-x-square"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection


