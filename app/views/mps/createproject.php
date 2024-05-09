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
                                <?= $data['menu']; ?>
                            </h2>
                            <ul class="header-dropdown m-r--5">                                
							    <a href="<?= BASEURL; ?>/mps/project" class="btn btn-danger waves-effect pull-right">Cancel</a>
							</ul>
                        </div>
                        <div class="body">
                            <form action="<?= BASEURL; ?>/mps/savempsproject" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="namampsproject">Nama MPS Project</label>
                                        <input type="text" name="namampsproject" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>ID Activity</th>
                                                        <th>Activity</th>
                                                        <th>Planning Date</th>
                                                        <th>Actual Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0; ?>
                                                    <?php foreach ($data['activity'] as $row) : ?>
                                                        <?php $no++; ?>
                                                        <tr>
                                                            <td><?= $no; ?></td>
                                                            <td>
                                                                <input type="text" name="idactivity[]" class="form-control" value="<?= $row['activity_id']; ?>" readonly style="width:50px;">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="activity[]" class="form-control" value="<?= $row['activity_name']; ?>" readonly style="width:450px;">
                                                            </td>
                                                            <td>
                                                                <input type="date" name="plandate[]" class="form-control" style="width:155px;">
                                                            </td>
                                                            <td>
                                                                <input type="date" name="actdate[]" class="form-control" style="width:155px;">
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn bg-blue pull-right">
                                            <i class="material-icons">save</i> <span>SAVE</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>