<div class="wrapper">
  <div class="header">Web App programming</div>

  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">
          register
        </h4>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="/index.php/auth/register" method="post">
          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="email">Email</label>
            <div class="col-sm-10">

              <input type="text" id="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="email">

            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"
            for="nickname" >Nickname</label>
            <div class="col-sm-10">
              <input type="text" id="nickname" class="form-control" name="nickname" value="<?php echo set_value('nickname'); ?>" placeholder="nickname">

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"
            for="password" >Password</label>
            <div class="col-sm-10">
              <input type="password" id="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" placeholder="password">

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"
            for="re_password" >Retype Password</label>
            <div class="col-sm-10">
              <input type="password" id="re_password" class="form-control" name="re_password" value="<?php echo set_value('re_password'); ?>"   placeholder="retype password">

            </div>
          </div>

        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">

          <div class="register-info">
            <?php echo validation_errors(); ?>
          </div>
          <input type="button" class="btn btn-default pull-left" value="돌아가기" onclick="location.href='/index.php/auth/login'"/> 

          <input type="submit" class="btn btn-primary pull-right" value="회원가입" />
        </form>

      </div>
    </div>
  </div>
</div>