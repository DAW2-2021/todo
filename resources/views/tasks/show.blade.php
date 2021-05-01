@extends('layouts.app')
@section('extraHeader')
    <style>
        body {
            background: #f8f8f8;
        }

        .todo-nav {
            margin-top: 10px;
        }

        .todo-list {
            margin: 10px 0;
        }

        .todo-list .todo-item {
            padding: 15px;
            margin: 5px 0;
            border-radius: 0;
            background: #f7f7f7;
        }

        .todo-list.only-active .todo-item.complete {
            display: none;
        }

        .todo-list.only-active .todo-item:not(.complete) {
            display: block;
        }

        .todo-list.only-complete .todo-item:not(.complete) {
            display: none;
        }

        .todo-list.only-complete .todo-item.complete {
            display: block;
        }

        .todo-list .todo-item.complete span {
            text-decoration: line-through;
        }

        .remove-todo-item {
            color: #ccc;
            visibility: hidden;
        }

        .remove-todo-item:hover {
            color: #5f5f5f;
        }

        .todo-item:hover .remove-todo-item {
            visibility: visible;
        }

        div.checker {
            width: 18px;
            height: 18px;
        }

        div.checker input,
        div.checker span {
            width: 18px;
            height: 18px;
        }

        div.checker span {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            text-align: center;
            background-position: 0 -260px;
        }

        div.checker,
        div.checker input,
        div.checker span {
            width: 19px;
            height: 19px;
        }

        div.checker,
        div.radio,
        div.uploader {
            position: relative;
        }

        div.button,
        div.button *,
        div.checker,
        div.checker *,
        div.radio,
        div.radio *,
        div.selector,
        div.selector *,
        div.uploader,
        div.uploader * {
            margin: 0;
            padding: 0;
        }

        div.button,
        div.checker,
        div.radio,
        div.selector,
        div.uploader {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            vertical-align: middle;
        }

        .card {
            padding: 25px;
            margin-bottom: 20px;
            border: initial;
            background: #fff;
            border-radius: calc(0.15rem - 1px);
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.04), 0 1px 6px rgba(0, 0, 0, 0.04);
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-white">
                    <div class="card-body">
                        <div>
                            <h1>Show task view</h1>
                        </div>
                        <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('task.update', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="add-items d-flex"> <input type="text" name="title"
                                                    class="form-control todo-list-input" value="{{ $task->title }}">
                                                <input style="width: 200px" name="fecha_due" type='datetime-local'
                                                    class="form-control" value="{{ $task->fecha_due }}" />
                                            </div>
                                            <br>
                                            <textarea class="form-control" name="description" cols="140"
                                                rows="5">{{ $task->description }}</textarea>

                                            <br>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button class="add btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Ttitle</small>
                        <h2>{{ $task->title }}</h2>
                        <small class="text-muted">Description</small>
                        <p>{{ $task->description }}</p>
                        <small class="text-muted">Date_due</small>
                        <p>{{ $task->fecha_due }}</p>
                        <small class="text-muted">Status</small>
                        <p>
                            @if ($task->finished == 0)
                                Not completed
                            @else
                                Completed
                            @endif
                        </p>
                        @if (request()->get('success'))
                            <br>
                            <div style="margin:auto; text-align:center;"
                                class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 alert alert-success" role="alert">
                                Se ha actualizado correctamente.
                            </div>
                        @endif
                        @if ($errors->any())
                            <br>
                            <div style="margin:auto;"
                                class="d-flex justify-content-center align-items-center col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 alert alert-danger"
                                role="alert">
                                <ul>
                                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                                </ul>
                            </div><br>
                        @endif
                        <button style="width: 1020px" class=" btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal" data-whatever="@mdo">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
