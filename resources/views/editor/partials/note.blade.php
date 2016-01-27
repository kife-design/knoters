<div class="note">
    <button type="button" class="close note_delete" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="note_date">{{ $note->created_at->diffForHumans() }}</p>
    <p class="note_body">{{ $note->message }}</p>
    <p class="note_author">{{ $note->poster->email }}</p>
    <div class="note_actions clearfix btn-group">
        <button class="btn btn-sm btn-upload btn-default"><i class="fa fa-upload"></i></button>
        <!-- Single button -->
        <div class="btn-group pull-right">
            <div class="btn-group">
                <button class="btn btn-sm btn-type btn-transparent pull-left dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bullseye"></i></button>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="fa fa-bullseye"></i> Info</a></li>
                    <li><a href="#"><i class="fa fa-bullseye"></i> Success</a></li>
                    <li><a href="#"><i class="fa fa-bullseye"></i> Error</a></li>
                </ul>
            </div>
            <button class="btn btn-sm btn-reply btn-success"><i class="fa fa-reply"></i></button>
        </div>
        </div>
</div>