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
                            <?php for ($j=0; $j < count($image_cat); $j++) {  ?>
                                <div class="file-box" style="padding-left: 6%; padding-right: 6%; width:227px;">
                                    <div class="file" style="margin-right: 0px;">
                                        <a href="<?=site_url('gallery/img_link/'.$image_cat[$j]['gallery_album_name'])?>">
                                            <span class="corner" style="background-color:red;"></span>

                                            <div class="image">
                                                <img alt="image" class="img-responsive" src="<?=$image_cat[$j]['gallery_big']?>">
                                            </div>
                                            <div class="file-name">
                                                <?=$image_cat[$j]['gallery_album_name']; ?>
                                                <br/>
                                                <small>Created on : <?=$image_cat[$j]['gallery_datetime']; ?> </small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                               <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="ibox-title" style="border:none;border-bottom: 3px solid #e7eaec;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b> <?php echo $image_cate_name; ?>  Images's</b></h3>
                                        </div>
                                        <div class="col-sm-6" style="text-align: right;">
                                            <a href="<?=site_url('Gallery') ?>"><span class="btn btn-info"><i class="fa fa-backward"></i> BACK</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="lightBoxGallery">
                                    <?php for ($i=0; $i < count($image); $i++) { ?>
                                        <a href="<?=$image[$i]['gallery_big']?>" title="Image from Unsplash" data-gallery="">
                                            <img src="<?=$image[$i]['gallery_big']?>" style="height:100px;width: 100px;">
                                        </a>
                                        <?php } ?>
                                        <div id="blueimp-gallery" class="blueimp-gallery">
                                            <div class="slides"></div>
                                            <h3 class="title"></h3>
                                            <a class="prev">‹</a>
                                            <a class="next">›</a>
                                            <a class="close">×</a>
                                            <a class="play-pause"></a>
                                            <ol class="indicator"></ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>