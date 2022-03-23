@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('inputs.save', ['id' => $btn_id]) }}" method="post">
            @csrf
        @foreach($inputs as $inp)
            @if($inp->type === 'select' && $inp->options)
                <div class="custom-selector">
                    <select class="custom-selector" name="{{$inp->name}}" id="car{{$loop->index}}">
                        <option value="">{{$inp->label}}</option>
                        @foreach($inp->options as $opt)
                            <option value="{{$opt->value}}">{{$opt->text}}</option>
                        @endforeach
                    </select>
                </div>
            @elseif($inp->type === 'number' || $inp->type === 'text')
                <input class="input" name="{{$inp->name}}" type="{{$inp->type}}" placeholder="{{$inp->label}}">
            @elseif($inp->type === 'textarea')
                <textarea class="input" name="{{$inp->name}}" style="height: 15vh; font-size: 30px" placeholder="{{$inp->label}}"></textarea>
            @elseif($inp->type == 'checkbox')
                <div class="checkbox-container">
                    <article class="feature1">
                        <input type="checkbox" name="{{$inp->name}}" id="feature1"/>
                        <div class='checkbox'>
                              <span>
                                <h5 class="check-text">{{$inp->label}}</h5>

                              </span>
                        </div>
                    </article>
                </div>
            @endif
                @error($inp->name)
                    <div class="alert alert-danger"><storng>Это поле обязательно</storng></div>
                @enderror

        @endforeach

        <input type="submit" class="btn btn-primary text-center main-btn main-btn-green" value="ОТПРАВИТЬ">

        </form>


    </div>

@endsection

@push('custom-script')

@endpush

