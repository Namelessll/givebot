@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-header">Competition > List</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                                @foreach($competitions as $item)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>#{{$item->id}}.</b></li>
                                    <li class="list-group-item">{{$item->title_post}}</li>
                                    <li class="list-group-item"><b>Дата начала:</b> {{$item->post_start}}</li>
                                    <li class="list-group-item"><b>Дата окончания:</b> {{$item->post_end}}</li>
                                    <li class="list-group-item"><b>Статус:</b> @if ($item->status == 1) В процессе @else Не активен @endif</li>
                                    <li class="list-group-item"><b>Участников:</b> 155</li>
                                </ul>
                                <hr style="background: #ffa500; border: none; height: 4px; width: 100%;">
                                @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
