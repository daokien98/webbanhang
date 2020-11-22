@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách video
    </div>
    <div class="row w3-res-tb">
    <div class="col-sm-12">
      <div class="position-center">
                                <form>
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Tên video</label>
                                    <input type="text" class="form-control video_title"  onkeyup="ChangeToSlug();" name="video_title"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Slug</label>
                                    <input type="text" name="video_slug" class="form-control video_slug" id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Link video</label>
                                    <input type="text" name="video_link" class="form-control video_link" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả video</label>
                                    <textarea style="resize: none" row="8" class="form-control video_desc" name="video_desc" id="ckeditor2" placeholder="Mô tả danh mục">
                                    </textarea>
                                </div>
                                <button type="submit" name="add_video" class="btn btn-info btn-add-video">Thêm video</button>
                            </form>
                            <div id="notify"></div>
                            </div>
    </div>
  </div>
    <div class="table-responsive">
                    <?php
                      $message = Session::get('message');
                      if($message){
                        echo $message;
                        Session::put('message',NULL);
                      }
                    ?>
      <div id="video_load"></div>
    </div>
    <!-- Modal -->
      <div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tên video</h5>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <div class="modal-body">
              Video
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection