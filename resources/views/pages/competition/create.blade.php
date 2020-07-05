@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-header">Competition > Create</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{route('createCompetition')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title_post">Название</label>
                                    <input type="text" class="form-control" id="title_post" placeholder="Concurs №1" name="title_post">
                                </div>
                                <div class="form-group">
                                    <label for="post_content">Текст конкурса</label>
                                    <textarea class="form-control" id="post_content" rows="3" name="post_content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="finish_post_content">Текст финиша</label>
                                    <textarea class="form-control" id="finish_post_content" rows="3" name="finish_post_content"></textarea>
                                </div>
{{--                                <div class="custom-control custom-switch">--}}
{{--                                    <input type="checkbox" class="custom-control-input" id="users_link" name="users_link">--}}
{{--                                    <label class="custom-control-label" for="users_link">Добавить условие "Пригласить друга"</label>--}}
{{--                                </div>--}}
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="users_count" name="users_count">
                                    <label class="custom-control-label" for="users_count">Отображать количество участников</label>
                                </div>
                                <div class="form-group">
                                    <label for="winners_count">Количество победителей</label>
                                    <input type="text" class="form-control" id="winners_count" placeholder="555" name="winners_count">
                                </div>

                                <div class="form-row mt-2">
                                    <div class="col-md-6">
                                        <label for="post_start">Дата и время старта</label>
                                        <input type="datetime-local" class="form-control" id="post_start" placeholder="27.06.2020 10:20:00" name="post_start">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="post_end">Дата и время окончания</label>
                                        <input type="datetime-local" class="form-control" id="post_end" placeholder="28.06.2020 10:20:00" name="post_end">
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-md-6">
                                        <label>Каналы для рассылки:</label>
                                        <div class="line-compe" style="margin-bottom: 7px;">
                                            <input type="text" class="form-control post_channel" name="post_channels[]" placeholder="@channel_username" style="margin-bottom: 5px;">
                                        </div>
                                        <div>
                                            <button id="add_post_channel" type="button" class="btn btn-success btn-sm" style="width: 100%; margin-bottom: 6px;">+ Добавить канал</button>
                                            <button id="remove_post_channel" type="button" class="btn btn-danger btn-sm" style="width: 100%;">- Удалить канал</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Каналы для подписки:</label>
                                        <div class="line-compe-sub" style="margin-bottom: 7px;">
                                            <input type="text" class="form-control subscribe_channel" name="subscribe_channels[]" placeholder="@channel_username" style="margin-bottom: 5px;">
                                        </div>
                                        <div>
                                            <button id="add_subscribe_channel" type="button" class="btn btn-success btn-sm" style="width: 100%; margin-bottom: 6px;">+ Добавить канал</button>
                                            <button id="remove_subscribe_channel" type="button" class="btn btn-danger btn-sm" style="width: 100%;">- Удалить канал</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-success" style="width: 100%;">Создать</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('competition-create')
        <script>
            $(document).ready(function () {
                $('#add_post_channel').click(function () {
                    var oldHtml = $('.line-compe').html();
                    $('.line-compe').html(oldHtml + '<input type="text" class="form-control post_channel" name="post_channels[]" placeholder="@channel_username" style="margin-bottom: 5px;">');
                });

                $('#remove_post_channel').click(function () {
                    $('.line-compe input')[$('.line-compe input').length - 1].remove()
                });

                $('#add_subscribe_channel').click(function () {
                    var oldHtml = $('.line-compe-sub').html();
                    $('.line-compe-sub').html(oldHtml + '<input type="text" class="form-control" name="subscribe_channels[]" placeholder="@channel_username" style="margin-bottom: 5px;">');
                });

                $('#remove_subscribe_channel').click(function () {
                    $('.line-compe-sub input')[$('.line-compe-sub input').length - 1].remove()
                });

            });
        </script>
    @endpush
@endsection
