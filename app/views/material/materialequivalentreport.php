<style>
   .custom-input{
        float: right;
        padding: 6px;
        margin-top: 8px;
        margin-right: 16px;
        border: none;
        font-size: 17px;
    }
</style>

    <div class="content" style="margin-top:100px;">
        <div class="container-fluid">   
            <div id="msg-alert">
                <?php
                    Flasher::msgInfo();
                ?>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h3>
                                PART Equivalent List
                            </h3>
                            <ul class="header-dropdown m-r--3">        
                                <div class="col-lg-12">
                                    <a href="<?= BASEURL; ?>/materialequivalent" class="btn bg-blue waves-effect">
                                        <i class="material-icons">keyboard_arrow_left</i> <span>BACK</span>
                                    </a>
                                    <!-- <input type="text" name="" id="" class="form-class" placeholder="Cari Part" style="width:300px;height:35px;"> -->
                                    <!-- <button id="btn-excel" type="button" class="btn btn-primary bg-blue">
                                        <i class="material-icons">file_download</i> Export to Excel
                                    </button> -->
                                </div>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:150%;">
                                    <thead>
                                        <th>No.</th>
                                        <th>AWSI PN</th>
                                        <th>Drawing PN</th>
                                        <th>MAKER / ORIGIN PN</th>
                                        <th>EQ PN 1</th>
                                        <th>EQ PN 2</th>
                                        <th>EQ PN 3</th>
                                        <th>EQ PN 4</th>
                                        <th>EQ PN 5</th>
                                        <th>EQ PN 6</th>
                                        <th>EQ PN 7</th>
                                        <th>EQ PN 8</th>
                                        <th>EQ PN 9</th>
                                        <th>EQ PN 10</th>
                                        <th>EQ PN 11</th>
                                        <th>EQ PN 12</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        <?php foreach($data['material'] as $mat) : ?>
                                            <?php $count += 1; ?>
                                            <tr>
                                                <td><?= $count; ?></td>
                                                <td><?= $mat['material']; ?></td>
                                                <td><?= $mat['drawingpn']; ?></td>
                                                <td><?= $mat['orignpn']; ?></td>
                                                <td><?= $mat['eq01']; ?></td>
                                                <td><?= $mat['eq02']; ?></td>
                                                <td><?= $mat['eq03']; ?></td>
                                                <td><?= $mat['eq04']; ?></td>
                                                <td><?= $mat['eq05']; ?></td>
                                                <td><?= $mat['eq06']; ?></td>
                                                <td><?= $mat['eq07']; ?></td>
                                                <td><?= $mat['eq08']; ?></td>
                                                <td><?= $mat['eq09']; ?></td>
                                                <td><?= $mat['eq10']; ?></td>
                                                <td><?= $mat['eq11']; ?></td>
                                                <td><?= $mat['eq12']; ?></td>
                                                <td>
                                                    <a href="<?= BASEURL; ?>/materialequivalent/edit/data?material=<?= $mat['material']; ?>" class="btn btn-primary">EDIT</a>
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
    </div>

    <script src="<?= BASEURL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('.sidebar').hide();
            // document.getElementById("reffid").focus();

            
        })
    </script>