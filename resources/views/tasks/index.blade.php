@extends('layouts.app')
@section('extraHeader')
body {
    margin-top: 20px;
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

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-white">
                <div class="card-body">
                    <form action="javascript:void(0);">
                        <div class="add-items d-flex"> <input type="text" class="form-control todo-list-input" placeholder="New Task">
                            <input style="width: 200px" type='datetime-local' class="form-control" />
                            <button class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button> </div>
                    </form>
                    <ul class="nav nav-pills todo-nav">
                        <li role="presentation" class="nav-item all-task active"><a href="#" class="nav-link">Completed</a></li>
                        <li role="presentation" class="nav-item active-task"><a href="#" class="nav-link">Not completed</a></li>
                        <li role="presentation" class="nav-item completed-task"><a href="#" class="nav-link">Out of date</a></li>
                    </ul>
                    <div class="todo-list">
                        <div class="todo-item">
                            <div class="checker"><span class=""><input type="checkbox"></span></div>
                            <span>Create theme</span>
                            <a href="javascript:void(0);" class="float-right remove-todo-item"><i class="icon-close"></i></a>
                        </div>
                        <div class="todo-item">
                            <div class="checker"><span class=""><input type="checkbox"></span></div>
                            <span>Work on wordpress</span>
                            <a href="javascript:void(0);" class="float-right remove-todo-item"><i class="icon-close"></i></a>
                        </div>
                        
                        <div class="todo-item">
                            <div class="checker"><span class=""><input type="checkbox"></span></div>
                            <span>Organize office main department</span>
                            <a href="javascript:void(0);" class="float-right remove-todo-item"><i class="icon-close"></i></a>
                        </div>
                        <div class="todo-item">
                            <div class="checker"><span><input type="checkbox"></span></div>
                            <span>Error solve in HTML template</span>
                            <a href="javascript:void(0);" class="float-right remove-todo-item"><i class="icon-close"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
