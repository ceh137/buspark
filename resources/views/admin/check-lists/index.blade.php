@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{route('admin.check-list.create')}}" class="btn btn-success btn-lg mb-2">Новый Чек-Лист</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Цвет</th>
            <th scope="col">Создано</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $ls)
            <tr>
                <th scope="row">{{$ls->id}}</th>
                <td>{{$ls->text_btn}}</td>
                <td>{{$ls->color}}</td>
                <td>{{$ls->created_at}}</td>
                <td>
                    <form action="{{route('admin.check-list.destroy',$ls)}}" method="post">
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

