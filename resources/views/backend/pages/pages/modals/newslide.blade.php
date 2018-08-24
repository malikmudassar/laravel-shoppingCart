<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fal fa-images modal-icon"></i>
                <h4 class="modal-title">Go with next slide</h4>
                <small class="font-bold">All fields are required.</small>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="field">
                    <h4>Image</h4>

                    <div class="form-group">
                        <label>Select a new Favicon for this page</label><br>
                        <select class="cloudinary form-control" name="slide-image" style="width: 100%;"></select>
                    </div>


                    <h4>Slide title</h4>
                    <input class="form-control" type="text" name="title">

                    <h4>Slide caption</h4>
                    <input class="form-control" type="text" name="caption">

                    <h4>Slide link</h4>
                    <input class="form-control" type="text" name="link">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save slide</button>
            </div>
        </div>
    </div>
</div>