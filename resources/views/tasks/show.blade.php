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
                            <h1>Task view</h1>
                        </div>
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
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
                                                    class="form-control"
                                                    value="{{ date('Y-m-d\TH:i', strtotime($task->fecha_due)) }}"
                                                    min="{{ date('Y-m-d\TH:i', strtotime(now())) }}" />
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
                            @if ($task->finished) Completed
                            @elseif ($currentTime->lt($task->fecha_due)) Not completed
                            @else Out of date @endif
                        </p>
                        @if ($task->finished)
                            <small class="text-muted">Completed At</small>
                            <p>
                                {{ $task->updated_at }}
                            </p>
                        @endif
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
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal">Delete Task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <small class="text-muted">Question</small>
                                            <p>Are you sure you want to delete the task?</p>
                                            <small class="text-muted">Yes</small>
                                            <p>If you are press Delete Task button.</p>
                                            <small class="text-muted">No</small>
                                            <p>If you aren't, press X or Close button.</p>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete Task</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!$task->finished)
                            <button style="width: 1020px" class=" btn btn-primary" data-toggle="modal"
                                data-target="#editModal" data-whatever="@mdo">Edit Task</button><br><br>
                        @endif
                        <form action="{{ route('task.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if ($task->finished)
                                <input type="hidden" name="finished" value="0">
                                <input type="submit" style="width: 1020px" class="btn btn-warning" value="Un Completed">
                            @else
                                <input type="hidden" name="finished" value="1">
                                <input type="submit" style="width: 1020px" class="btn btn-success" value="Completed">
                            @endif
                        </form>
                        <br>
                        <button style="width: 1020px" class=" btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                            data-whatever="@mdo">Delete Task</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
