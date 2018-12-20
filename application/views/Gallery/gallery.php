        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-2">
                    <div class="ibox float-e-margins">
                        <div class="file-manager">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">
                                Upload Images
                            </button>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width:45%;">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <img src="<?=base_url()?>assets/img/gallery_icon.png">
                                            <h4 class="modal-title">Upload Images</h4>
                                            <small class="font-bold">Please select the images to upload.</small>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addGallery" action="<?=site_url('Gallery/upload_gallery_images')?>">
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Album</label>
                                                    <div class="col-lg-4">
                                                        <input list="album_name" name="gallery_name" class="form-control">
                                                        <datalist id="album_name">
                                                            <?php foreach ($Album_name as $key ) {?>
                                                                <option value="<?=$key['gallery_album_name']?>">
                                                            <?php } ?>
                                                        </datalist>
                                                    </div>
                                                    <label class="col-lg-2 control-label">Photos</label>
                                                    <div class="col-lg-4">
                                                        <input name="userfile[]" class="form-control" accept="image/png,image/jpeg,image/gif" id="upload_file" type="file" multiple="" onchange="preview_image();" style="background-color: #f8fafb;border: none;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-4">
                                                        <input class="btn btn-primary btn-block" type="submit" value="Upload"/>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row" id="image_preview">
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php for ($j=0; $j < count($image); $j++) { ?>
                                <ul class="folder-list" style="padding: 0">
                                    <a href="<?=site_url('gallery/img_link/'.$image[$j]['gallery_album_name'])?>">
                                        <li><i class="fa fa-folder"></i> <?=$image[$j]['gallery_album_name']; ?></li>
                                    </a>
                                </ul>
                                <?php } ?>
                                <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                <?php 
                                for ($i=0; $i < count($image); $i++) { 
                                    ?>
                                    <div class="file-box">
                                        <div class="file xyz" data-href="<?=site_url('gallery/img_link/'.$image[$i]['gallery_album_name'])?>">
                                            <a href="<?=site_url('gallery/img_link/'.$image[$i]['gallery_album_name'])?>">
                                                <span class="corner" style="background-color:red;"></span>

                                                <div class="image">
                                                    <img alt="image" class="img-responsive" src="<?=$image[$i]['gallery_big'];?>">
                                                </div>
                                                <div class="file-name">
                                                    <?=$image[$i]['gallery_album_name']; ?>
                                                    <br/>
                                                    <small>Total: <?=$image[$i]['total']; ?> </small><br>
                                                    <small>Created on : <?=$image[$i]['gallery_datetime']; ?> </small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>