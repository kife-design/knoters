@extends('templates.master')

@section('styles')
    <link rel="stylesheet" href="{{ elixir('css/editor.css') }}">
@stop


@section('content')
    <div class="container-fluid editor-content" id="editor">
        <div class="row header">
            <h3 class="title">
                <img src="/img/title.png"/>
            </h3>
        </div>
        <div class="row workspace">
            <aside class="sidebar col-lg-3 col-md-3">
                <div class="notes-header"><h6 class="pull-left">Notes</h6>
                    <i id="search-popover" v-on="click: showAdvancedSearch($event)" class="fa fa-search pull-right"></i>
                </div>
                <div class="form-group search">
                    <input type="text" v-model="searchText" class="form-control input-sm">
                </div>
                <div id="notes-container" class="notes-container col-lg-3 col-md-3">
                    <note v-repeat="note: notes | filterBy searchText in 'message'"></note>
                </div>
            </aside>
            <div class="content col-lg-9 col-md-9">
                <div id="errors-container" class="errors-container alert alert-danger hidden"></div>
                <div class="video-container">
                    <video style="display: block;" id="vid1" src="" class="video-js vjs-default-skin" controls
                           preload="auto" width="100%" height="500px"></video>
                    <div v-on="click: addNote($event)" class="note-workspace" id="note-workspace">
                        <pointer v-repeat="note: notes"></pointer>
                    </div>
                </div>
            </div>
            @include('editor.partials.advancedSearch')
        </div>
    </div>
@stop

@section('scripts')
    @include('editor.partials.scripts')
@stop
