<!DOCTYPE html>
<html lang="en">
            
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">

                <!-- DATA TABLE -->

                <div class="table-data__tool">
                    <h3 class="title-5 m-b-35">User Data</h3>
                    <div class="table-data__tool-left">
                        <button style="float: right;" data-toggle="modal" data-target="#tambah-data" class="au-btn au-btn-icon au-btn--green au-btn--small" ><i class="zmdi zmdi-plus"></i>add item</button>
                    </div>
                                    
                </div>
                                
            <div class="table-data__tool-right">
                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <div class="form-actions form-group">
                        <a href="<?php echo base_url('index.php/export');?>"><button type="" class="btn btn-secondary btn-sm ">Export Excel</button></a>
                    </div>
                </div>

                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <div class="form-actions form-group">
                        <a href="<?php echo base_url('index.php/import/form');?>"><button type="" class=" btn btn-secondary btn-sm">Import Excel</button></a>
                    </div>
                </div>

                <form style="float: right;" class="form-header" action="<?php echo base_url('index.php/c_home/search');?>" method="POST">
                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search by name or roles" />
                    <button class="au-btn--submit" type="submit"><i class="zmdi zmdi-search"></i></button>
                </form>  

            </div>
            </div>
                    
<div class="row m-t-30">
     <div class="col-md-12">
    <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach($user->result() as $x) {?>
                <tr>
                   <td><?php echo $no; ?></td>
                    <td><?php echo $x->name;?></td>
                    <td><?php echo $x->email;?></td>
                    <td><?php echo $x->role_name;?></td>
                    <td>
                    <div class="table-data-feature">
                        <a href="javascript:void(0);"
                        data-ide="<?php echo $x->id;?>"
                        data-name="<?php echo $x->name;?>"
                        data-email="<?php echo $x->email; ?>"
                        data-password="<?php echo $x->password; ?>"
                        data-role="<?php echo $x->role_id; ?>"
                        data-toggle="modal" data-target="#edit-data">

                        <button class="item" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></button></a>

                        <a href="javascript:void(0);"
                        data-idh="<?php echo $x->id;?>"
                        data-toggle="modal" data-target="#hapus-data">
                         <button class="item" data-toggle="modal" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></button></a>
                                                    
                    </div>
                    </td>
                </tr>

<?php $no++; } ?>
                                           
    </tbody>
    </table>
 </div>
 <!-- END DATA TABLE-->
</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

     <!-- Modal Tambah -->
     <div class="col-lg-6">
 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">

     <div class="modal-dialog">

         <div class="modal-content">
             <div class="modal-header">
                 <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                 
             </div>
             
            <div class="card">
                <div class="card-header">
                   <strong>User Add</strong> Form
                </div>
                <div class="card-body card-block">
                    <form action="<?php echo base_url('index.php/c_home/createUser');?>" method="post" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                 <label for="email" class=" form-control-label">Name</label>
                            </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="Enter Name..." class="form-control">
                        </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                    <label for="hf-email" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="hf-email" name="email" placeholder="Enter Email..." class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-password" class=" form-control-label">Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="password" name="password" placeholder="Enter Password..." class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Select Role</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="role" id="role" class="form-control">
                                    <option value="0">Please select</option>

                                    <?php foreach($role->result() as $x) {?>
                                    <option value="<?php echo $x->role_id;?>"><?php echo $x->role_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                                            <div class="card-footer">
                                        <button style="float: right;" type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        
                                    </div>
                                        </form>
                                    </div>
                                    
                                </div>
             </div>
         </div>
     </div>
 </div>
 <!-- END Modal Tambah -->

<!-- Modal Update -->
 <div class="col-lg-6">
 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">

     <div class="modal-dialog">

         <div class="modal-content">
             <div class="modal-header">
                 <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                 
             </div>
             
            <div class="card">
                <div class="card-header">
                   <strong>User Update</strong> Form
                </div>
                <div class="card-body card-block">
                    <form action="<?php echo base_url('index.php/c_home/updateUser');?>" method="post" class="form-horizontal" role="form">

                         <div class="modal-body">

                        <input type="hidden" id="edit_id" name="edit_id">
                         
                        <div class="row form-group">
                            <div class="col col-md-3">
                                 <label for="xname" class=" form-control-label">Name</label>
                            </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="xname" name="xname" placeholder="Enter Name..." class="form-control">
                        </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                    <label for="xemail" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="xemail" name="xemail" placeholder="Enter Email..." class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="xpassword" class=" form-control-label">Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="xpassword" name="xpassword" placeholder="Enter Password..." class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class="form-control-label">Select Role</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="xrole" id="xrole" class="form-control">
                                    <option value="0">Please select</option>

                                    <?php foreach($role->result() as $x) {?>
                                    <option value="<?php echo $x->role_id;?>"><?php echo $x->role_name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer" >
                        <button style="float: right;" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                        
                    </div>
                </form>
                </div>
                                    
                </div>
             </div>
         </div>
     </div>
 </div>
 
 <!-- END Modal Update -->

 <!-- Modal Hapus -->
 <div class="col-lg-6">
 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="hapus-data" class="modal fade">

     <div class="modal-dialog">

         <div class="modal-content">
             <div class="modal-header">
                 <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                 
             </div>
             
            <div class="card">
                <div class="card-header">
                   <strong>User Delete</strong> Form 
                </div>
                <div class="card-body card-block">
                    <form action="<?php echo base_url('index.php/c_home/deleteUser');?>" method="post" class="form-horizontal">
                        <div class="row form-group">
                            <label style="margin-left: 5%;" class=" form-control-label">Apakah yakin menghapus data?</label>
                            
                            <input type="hidden" id="hapus_id" name="hapus_id" class="form-control">
                        
                        </div>

                    <div class="card-footer">
                        

                         <button style="float: right; margin-left: 5%;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> <i class="fa fa-ban"></i>Tidak </button>

                          <button style="float: right;" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Iya</button>
                                        
                    </div>

                </form>
                </div>
                                    
               </div>
             </div>
         </div>
     </div>
 </div>





    <!-- Jquery JS-->
    <script src="<?php echo base_url();?>assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url();?>assets/vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/wow/wow.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>


<script>

    $(document).ready(function() {
        // Untuk sunting
        

        $('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#edit_id').attr("value",div.data('ide'));
            modal.find('#xname').attr("value",div.data('name'));
            modal.find('#xemail').attr("value",div.data('email'));
            modal.find('#xpassword').attr("value",div.data('password'));
            // modal.find('#xrole').attr("selected",div.data('role'));
            var slc = div.data('role');
            modal.find('#xrole option[value='+slc+']').attr('selected','selected');

        });

         $('#hapus-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#hapus_id').attr("value",div.data('idh'));
        });

    });

</script>
   

</body>

</html>
<!-- end document-->
