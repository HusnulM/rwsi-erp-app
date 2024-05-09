<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AWSI - ERP System</title>
  <link href="<?= BASEURL; ?>/ace/Login/css.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/login/materialdesignicons.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/login/bootstrap.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/login/login.css">
</head>

<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-8 login-section-wrapper">
          <div class="brand">
            <img src="<?= BASEURL; ?>/images/aws-logo.png" width="300px" height="250px" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <div id="msg-alert" style="background-color:red;color:white;">
              <?php
              Flasher::msgInfo();
              ?>
            </div>
            <!-- <h1 class="login-title" align="center">Task Management</h1> -->
            <form action="<?= BASEURL; ?>/home/members" id="sign_in" method="POST">
              <div class="form-group">
                <label for="email">User ID / Email</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="email@example.com">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="enter your passsword">
              </div>
              <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="Login">
              <input name="loginreffid" id="loginreffid" class="btn btn-block login-btn" type="button" value="Login With ID Card / QR">
            </form>
            <a href="#!" class="forgot-password-link"></a>
            <p class="login-wrapper-footer-text"><a href="#!" class="text-reset"></a></p>
          </div>
        </div>
        <div class="col-sm-4 px-0 d-none d-sm-block">
          <img src="<?= BASEURL; ?>/images/city2.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>

  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 style="margin-left: 15%;">SCAN YOUR ID CARD</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <form action="<?= BASEURL; ?>/home/loginwithreffid" method="POST">
              <div class="form-group">
                <input type="text" name="reffid" id="reffid" class="form-control" autofocus="autofocus">
              </div>
              <div id="reader" width="600px" height="600px"></div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= BASEURL; ?>/assets/login/jquery-3.js"></script>
  <script src="<?= BASEURL; ?>/assets/login/popper.js"></script>
  <script src="<?= BASEURL; ?>/assets/login/bootstrap.js"></script>
  <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="<?= BASEURL; ?>/assets/js/html5-qrcode.min.js" type="text/javascript"></script>

  <script>
    // $(document).ready(function() {
    //   // let html5QrcodeScanner = new Html5QrcodeScanner(
    //   //   "reader", {
    //   //     fps: 10,
    //   //     qrbox: 250
    //   //   });

    //   // function onScanSuccess(qrCodeMessage) {
    //   //   $("#reffid").val(qrCodeMessage);
    //   // }
    //   // html5QrcodeScanner.render(onScanSuccess);
    // });

    async function onInitCamera() {
      var devices = await Html5Qrcode.getCameras();
      const html5QrCode = new Html5Qrcode("reader");
      const qrCodeSuccessCallback = message => {
        html5QrCode.stop().then(ignore => {
          $.ajax({
            url: "<?= BASEURL; ?>/home/loginrfidws/",
            method: "POST",
            dataType: "JSON",
            data: {
              reffid: message
            },
            success: function(res) {
              if (res.error) {
                alert('reffid not registered.')
                onInitCamera();
              } else {
                window.location.replace("<?= BASEURL; ?>");
              }
            },
            error: function(err) {
              alert(err)
              onInitCamera();
            }
          });
        }).catch(err => {});
      }
      const qrErrorCallback = error => {}
      const config = {
        fps: 10,
        qrbox: 200
      };

      html5QrCode.start({
        deviceId: {
          exact: (devices.length > 1) ? devices[devices.length - 1].id : devices[0].id
        }
      }, config, qrCodeSuccessCallback, qrErrorCallback);
    }

    function onLoginEvent(refid) {
      $.ajax({
        url: "<?= BASEURL; ?>/home/loginrfidws/",
        method: "POST",
        dataType: "JSON",
        data: {
          reffid: qrCodeMessage
        },
        success: function(res) {
          console.log(res)
          window.location.replace("<?= BASEURL; ?>");
        },
        error: function(err) {
          //window.location.replace("<?= BASEURL; ?>");
        }
      });
    } 
    
    $(function() {
      document.getElementById("username").focus();
      var base_url = window.location.origin + '/aws-erp';
      localStorage.removeItem("reffidmesin");

      $('#loginreffid').on('click', function() {
        onInitCamera();
        $('#errorModal').modal('show');

        setTimeout(function() {
          $('#reffid').focus();
        }, 1000);
        //   $('#reffid').focus();
        //   document.getElementById("reffid").focus();
      });
    })
    
    function showErrorMessage(message) {
      swal("", message, "warning");
    }
  </script>
  <script>
    
  </script>
</body>

</html>