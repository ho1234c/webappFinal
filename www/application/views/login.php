
<div class="wrapper">
  <div class="header">Web App programming</div>

  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">
          Log in
        </h4>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="/index.php/auth/authentication" method="post">
          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="email">Email</label>
            <div class="col-sm-10">

              <input type="text" class="form-control" id="email" name="email" placeholder="email">

            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"
            for="password" >Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password"  placeholder="Password">

            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">         


            </div>
          </div>


          <!-- Modal Footer -->
          <div class="modal-footer">
            <input type="button" class="btn btn-primary pull-left" value="회원가입" onclick="location.href='/index.php/auth/register'"/> 

            <input type="submit" class="btn btn-primary pull-right" value="로그인"/>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>

