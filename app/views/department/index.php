<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="msg-alert">
                        <?php
                            Flasher::msgInfo();
                        ?>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>
                                Master Department
                            </h2>
							
                            <ul class="header-dropdown m-r--5">                                
							<a href="<?= BASEURL; ?>/department/create" class="btn btn-success waves-effect pull-right">Create Department</a>
							</ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        <?php foreach($data['department'] as $barang) : ?>
                                            <?php $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $barang['department']; ?></td>
                                                <td>
                                                    <a href="<?= BASEURL; ?>/department/edit/<?= $barang['id']; ?>" type="button" class="btn btn-success">Edit</a>
                                                    <a href="<?= BASEURL; ?>/department/delete/<?= $barang['id']; ?>" type="button" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>