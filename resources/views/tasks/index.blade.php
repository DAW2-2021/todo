@extends('layouts.app')
@section('extraHeader')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

        a {
            cursor: pointer;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-white">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Dashboard</h1>
                        </div>
                        <button style="width: 1020px" class=" btn btn-primary" data-toggle="modal" data-target="#addModal"
                            data-whatever="@mdo">New Task</button>
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">New Task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('task.store') }}" enctype="multipart/form-data"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="add-items d-flex"> <input type="text" name="title"
                                                    class="form-control todo-list-input" placeholder="Title">
                                                <input style="width: 200px" name="fecha_due" type='datetime-local'
                                                    class="form-control" min="{{ date('Y-m-d\TH:i', strtotime(now())) }}"
                                                    placeholder="{{ date('Y-m-d\TH:i', strtotime(now())) }}" />
                                            </div>
                                            <br>
                                            <textarea class="form-control" placeholder="Description" name="description"
                                                cols="140" rows="5"></textarea>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button class="add btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills todo-nav">
                            <li role="presentation" class="nav-item all-task active"><a class="nav-link">All</a>
                            </li>
                            <li role="presentation" class="nav-item completed-task"><a class="nav-link">Completed</a></li>
                            <li role="presentation" class="nav-item not-completed-task"><a class="nav-link">Not
                                    completed</a></li>
                            <li role="presentation" class="nav-item out-of-date-task"><a class="nav-link">Out of date</a>
                            </li>
                        </ul>
                        <div class="todo-list">
                            @foreach ($tasks as $task)
                                <div class="todo-item task-all @if ($task->finished) completed
                                @elseif ($currentTime->lt($task->fecha_due)) not-completed
                                @else out-of-date @endif ">
                                    <span><a href="{{ route('task.show', $task->id) }}">{{ $task->title }}</a> - <span
                                            class=" text-muted">
                                            @if ($task->finished) Completed
                                            @elseif ($currentTime->lt($task->fecha_due)) Not completed
                                            @else Out of date @endif
                                        </span>
                                        <span class="text-info float-right">
                                            @if ($task->finished)
                                                Date completed: {{ $task->updated_at }}
                                            @else
                                                Date Due: {{ $task->fecha_due }}
                                            @endif
                                        </span>
                                    </span>
                                    <a href="javascript:void(0);" class="float-right remove-todo-item"><i
                                            class="icon-close"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".all-task").on("click", function() {
                $(".completed").show();
                $(".not-completed").show();
                $(".out-of-date").show()
            });
            $(".completed-task").on("click", function() {
                $(".completed").show();
                $(".not-completed").hide();
                $(".out-of-date").hide()
            });
            $(".not-completed-task").on("click", function() {
                $(".completed").hide();
                $(".not-completed").show();
                $(".out-of-date").hide()
            });
            $(".out-of-date-task").on("click", function() {
                $(".completed").hide();
                $(".not-completed").hide();
                $(".out-of-date").show()
            });
        });

    </script>
@endsection
