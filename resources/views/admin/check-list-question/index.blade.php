@extends('layouts.admin')



@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Вопрос</th>
            <th scope="col">Чек-Лист</th>
            <th scope="col">Варианты Ответа</th>
            <th scope="col">Создано</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $ls)
            <tr>
                <th scope="row">{{$ls->id}}</th>
                <td>{{$ls->question}}</td>
                <td>{{$ls->check_list->text_btn}}</td>
                <td class="flex-column">
                    @foreach($ls->answers as $answer)
                        <div class="">
                        {{$answer->text}}
                        </div>
                    @endforeach
                </td>
                <td>{{$ls->created_at}}</td>

                <td>
                    <form action="{{route('admin.check-list-question.destroy',$ls)}}" method="post">
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



