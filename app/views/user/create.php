	<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah User
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?= BASEURL; ?>/user/register" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="username">User ID / Username</label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>    
                                    </div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<label for="typeuser">Type User</label>
                                        <select class="form-control show-tick" name="typeuser" id="typeuser">
                                            <option value="SysAdmin">Super User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Customer">Customer</option>
                                        </select>
                                    </div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                                            </div>
                                        </div>
                                    </div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                                <label for="telp">Department</label>
                                                <select name="department" class="form-control" id="department">
                                                    <option value="0">Pilih Department</option>
                                                    <?php foreach($data['department'] as $dept) : ?>
                                                        <option value="<?= $dept['id']; ?>"><?= $dept['department']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                                <label for="telp">Jabatan</label>
                                                <select name="jabatan" class="form-control" id="jabatan">
                                                <option value="0">Pilih Jabatan</option>
                                                    <?php foreach($data['jabatan'] as $jbtn) : ?>
                                                        <option value="<?= $jbtn['id']; ?>"><?= $jbtn['jabatan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="reffid">REFFID</label>
                                                <input type="text" name="reffid" id="REFFID" class="form-control" placeholder="reffid">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 divCustomer">
                                        <div class="form-group">
                                            <label for="customer">Customer</label>
                                            <select name="customer" class="form-control" id="customer">
                                                <option value="0">Pilih Customer</option>
                                                <?php foreach($data['cust'] as $cust) : ?>
                                                    <option value="<?= $cust['cust_id']; ?>"><?= $cust['cust_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
                                            <button type="submit" id="btn-save" class="btn btn-primary">Simpan</button>
											<a href="<?= BASEURL; ?>/user" class="btn btn-success">Kembali</a>
										</div>
									</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        $(function(){

            $('.divCustomer').hide();

            $('#typeuser').on('change', function(){
                if(this.value === "Customer"){
                    $('.divCustomer').show();
                }else{
                    $('.divCustomer').hide();
                }
            })
        })
    </script>