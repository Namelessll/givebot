@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-header">Api</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{route('setApiDomain')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="domain_address">Домен для API бота</label>
                                <input type="text" class="form-control" name="domain_address" id="domain_address" aria-describedby="emailHelp" placeholder="https://localhost">
                                <small id="domain_addressHelp" class="form-text text-muted">Обязательным условием должно быть наличие https.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Webhooks</div>

                <div class="card-body" style="display: flex;">
                    <form action="{{route('setWebhook')}}" method="post" enctype="multipart/form-data" style="margin-right: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-success">Установить веб-хук</button>
                    </form>
                    <form action="{{route('removeWebhook')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-danger">Удалить веб-хук</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
