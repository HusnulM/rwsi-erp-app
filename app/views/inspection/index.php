    <section class="content">
        <div class="container-fluid">   
            <div id="msg-alert">
                <?php
                    Flasher::msgInfo();
                ?>
            </div>
            <form action="<?= BASEURL ?>/inspection/save" method="POST">         
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <?= $data['menu']; ?>
                                </h2>

                                <ul class="header-dropdown m-r--5">          
                                    <button type="submit" class="btn bg-green waves-effect">
                                        <i class="material-icons">save</i> <span>SAVE</span>
                                    </button>
                                    <a href="<?= BASEURL; ?>/inspection/report" class="btn bg-green waves-effect">
                                        <i class="material-icons">view_headline</i> <span>Data Inspection</span>
                                    </a>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="idate">Tanggal</label>
                                        <input type="date" name="idate" id="idate" class="form-control"  required/>
                                        <input type="hidden" name="bomid" id="bomid">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="cusotmer">Customer</label>
                                        <input type="text" name="cusotmer" id="cusotmer" class="form-control"  required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="process">Process</label>
                                        <select name="process" id="process" class="form-control">
                                            <?php foreach($data['activity'] as $act): ?>
                                                <option value="<?= $act['id']; ?>"><?= $act['activity']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="assyno">Assy No</label>
                                        <input type="text" name="assyno" id="assyno" class="form-control"  required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inspector">Nama Inspector</label>
                                        <select name="inspector" id="inspector" class="form-control">
                                            <?php foreach($data['userlist'] as $usr): ?>
                                                <option value="<?= $usr['username']; ?>"><?= $usr['username']; ?> - <?= $usr['nama']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="cctno">CCT No</label>
                                        <input type="text" name="cctno" id="cctno" class="form-control"  required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="operator">Nama Operator</label>
                                        <input type="text" name="operator" id="operator" class="form-control"  required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="jmlcheck">Jumlah Check</label>
                                        <input type="text" name="jmlcheck" id="jmlcheck" class="form-control"  required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nomeja">No Meja / Mesin</label>
                                        <select name="nomeja" id="nomeja" class="form-control">
                                            <?php foreach($data['meja'] as $meja): ?>
                                                <option value="<?= $meja['nomeja']; ?>"><?= $meja['deskripsi']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="jdefect">Jenis Defect</label>
                                        <select name="jdefect" id="jdefect" class="form-control">
                                            <?php foreach($data['defect'] as $defect): ?>
                                                <option value="<?= $defect['id']; ?>"><?= $defect['defect']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="jmlng">Jumlah NG</label>
                                        <input type="text" name="jmlng" id="jmlng" class="form-control"  required/>
                                    </div>
                                    <div class="col-lg-6">
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="lotng">LOT NG</label>
                                        <input type="text" name="lotng" id="lotng" class="form-control"  required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

            <div class="modal fade" id="partModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-xs" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="vendorModalLabel">Pilih Partnumber</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-responsive" id="list-part" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Part Number</th>
                                            <th>Part Name</th>
                                            <th>Customer</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

        
    </section>