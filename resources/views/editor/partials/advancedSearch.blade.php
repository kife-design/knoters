<div class="modal fade" id="advancedSearchModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div id="search-container">
                    <form class="clearfix">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" name="message">
                        </div>
                        <div class="form-group">
                            <select name="author" class="form-control input-sm">
                                <option value="">Any</option>
                                @foreach($project->users as $user)
                                    <option value="{{ $user->email }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="btn-group btn-block">
                                <button class="btn btn-sm btn-type btn-block dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"><span class="text-left">Any<i
                                                class="fa fa-bullseye text-right"></i></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" v-on="click: setType('any')"><i class="pull-right"></i>Any</a></li>
                                    <li><a href="#" v-on="click: setType('info')"><i
                                                    class="pull-right fa fa-bullseye type-info"></i>Info</a></li>
                                    <li><a href="#" v-on="click: setType('success')"><i
                                                    class="pull-right fa fa-bullseye type-success"></i> Success</a></li>
                                    <li><a href="#" v-on="click: setType('error')"><i
                                                    class="pull-right fa fa-bullseye type-error"></i> Error</a></li>
                                </ul>
                                <input type="hidden" name="type" value="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default btn-sm pull-right">Submit</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
