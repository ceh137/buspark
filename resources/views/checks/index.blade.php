
@extends('layouts.app')

@section('content')
    @foreach($checks as $btn)
        <a href="{{ route('checks.questions', ['id' => $btn->id]) }}" class="btn btn-primary text-center main-btn @if($btn->color) main-btn-{{$btn->color}} @endif">
            @php
                if (count(explode(" ", $btn->text_btn)) > 1) {
                    for ($i =  0; $i < count(explode( " ", $btn->text_btn)); $i++) {
                        echo explode(" ", $btn->text_btn)[$i]."<br>";
                    }
                } else {
                    echo $btn->text_btn;
                }
            @endphp
        </a>
    @endforeach
@endsection
