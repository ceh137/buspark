@extends('layouts.admin')



@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Исполнитель</th>
            <th scope="col">Чек-Лист</th>
            <th scope="col">Информация</th>
            <th scope="col">Номер Автобуса</th>
            <th scope="col">Создано</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $ls)
            <tr>
                <th scope="row">{{$ls->id}}</th>
                <td>{{$ls->user->name}}</td>
                <td>{{$ls->check_list->text_btn}}</td>
                <td>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalLong{{$ls->id}}">Посмотреть</button>
                </td>
                <td>{{$ls->bus_number}}</td>
                <td>{{$ls->created_at}}</td>

                <td class="flex justify-content-around">
                    <form action="{{route('admin.check-list-answered.destroy',$ls)}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="bi bi-x-square"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@foreach($lists as $ls)
    <div class="modal fade" id="exampleModalLong{{$ls->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col"><i class="bi bi-gear"></i></th>
                            <th scope="col">Состояние</th>

                        </tr>
                        </thead>
                        <tbody>


                        @foreach($ls->qna as $qna)
                            <tr>
                                <th scope="row">{{$qna[0]['question']}}</th>
                                <td>
                                        @foreach($qna[1] as$q)
                                {{$q['text']}};
                                    @endforeach

                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
@push('script')
<script>

</script>
@endpush

