@extends('templates.master')

@section('styles')
    <link rel="stylesheet" href="{{ elixir('css/home.css') }}">
@stop

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" method="POST" id="project-form" action="submit">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="emailInput" class="col-md-3 control-label">Your email</label>
                    <div class="col-md-9">
                        <input type="email" value="vincent@kifed.be" name="email" class="form-control" id="emailInput" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiversInput" class="col-md-3 control-label">Receivers</label>
                    <div class="col-md-9">
                        <input type="text" value="info@kifed.be;jullie@kifed.be,zij@kifed.be;wij@kifed.be" name="receivers" class="form-control" id="receiversInput" placeholder="Receivers">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sourceInput" class="col-md-3 control-label">Source</label>
                    <div class="col-md-9">
                        <select name="source_id" type="text" class="form-control" id="sourceInput">
                            @foreach($resources as $key => $resourceSection)
                                <optgroup label="{{ $key }}"></optgroup>
                                @foreach($resourceSection as $resource)
                                    <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pathInput" class="col-md-3 control-label">Url:</label>
                    <div class="col-md-9">
                       <!-- <input type="text" class="form-control" name="path" id="pathInput" value="https://www.youtube.com/watch?v=xg7sptEx0Ms" placeholder="Link to source:"> -->
                        <input type="text" class="form-control" name="path" id="pathInput" value="https://vimeo.com/81160524" placeholder="Link to source:">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" id="submit-button" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>

    <script type="text/javascript">
        var app = new App();
        app.initHandlers();
    </script>
@stop