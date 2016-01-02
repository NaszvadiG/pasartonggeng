<!DOCTYPE html>
<html>
<head>
  <link href="<?php echo base_url(); ?>assets/dist/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <?php $this->load->view('inc/head'); ?>
  
</head>
<body class="skin-blue">
  <!-- wrapper di bawah footer -->
  <div class="wrapper">

    <?php $this->load->view('inc/head2'); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <?php $this->load->view('inc/sidebar'); ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <b>EDIT DATA PRODUK</b>
        </h1>
          <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol> -->
        </section>

        <!-- Main content -->
        <section class="content">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Chat box -->
            <div class="box">
              <div class="box-header">
                <i class="fa fa-plus"></i>
                <h3 class="box-title">FORM EDIT PRODUK</h3>
              </div>
              <div class="box-body chat" id="chat-box">
                <!-- chat item -->
                <div class="item">
                  <form role="form" action="<?php echo base_url(); ?>produk/updateproduk" method="POST" enctype="multipart/form-data">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Judul</label>
                        <input type="hidden" class="form-control" value="<?php echo $id_produk; ?>" id="" name="id_produk" placeholder="Isikan Judul Produk" required>
                        <input type="hidden" class="form-control" value="<?php echo $tgl_input_pro; ?>" id="" name="tgl_input_pro" placeholder="Isikan Judul Produk" required>
                        <input type="text" class="form-control" value="<?php echo $judul; ?>" id="" name="judul" placeholder="Isikan Judul Produk" required>
                    </div>

                    <div class="form-group">
                      <label for="">Harga</label>
                        <input type="text" class="form-control" value="<?php echo $harga; ?>" id="" name="harga" placeholder="Haraga Produk" required>                        
                    </div>
                    <div class="form-group">
                      <label for="">Jumlah</label>
                        <input type="text" class="form-control" value="<?php echo $jumlah; ?>" id="" name="jumlah" placeholder="Jumlah Produk" required>                        
                    </div>
                    <div class="form-group">
                      <label for="">Kondisi</label>
                        <input type="text" class="form-control" value="<?php echo $judul; ?>" id="" name="kondisi" placeholder="Kondisi Produk" required>                        
                    </div>
                    
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Merk</label>
                        <select name="id_merk" class="form-control" required>
                          <?php foreach($merk as $kat){
                            if(!in_array($kat['id_merk'],$merk_post)){
                              ?>
                              <option value="<?php echo $kat['id_merk'] ?>"><?php echo $kat['merk'] ?></option>
                              <?php } else { ?>
                              <option selected="selected" value="<?php echo $kat['id_merk'] ?>"><?php echo $kat['merk'] ?></option>
                              <?php } } ?>
                        </select>                        
                    </div>

                    <div class="form-group">
                      <label for="">Kategori</label>
                        <select name="id_kat" class="form-control" required>
                          <?php foreach($kategori as $kat){
                            if(!in_array($kat['id_kat'],$label_post)){
                              ?>
                              <option value="<?php echo $kat['id_kat'] ?>"><?php echo $kat['kategori'] ?></option>
                              <?php } else { ?>
                              <option selected="selected" value="<?php echo $kat['id_kat'] ?>"><?php echo $kat['kategori'] ?></option>
                              <?php } } ?>
                        </select> 
                    </div>
                    <div class="form-group">
                      <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option value="publish">Publish</option>
                          <option value="draft">Draft</option>
                        </select> 
                    </div>
                    <div class="form-group">
                      <label for="">Keterangan Produk</label>
                        <textarea style="height:100px"  class="form-control" name="ket" placeholder="Keterangan Produk"><?php echo $ket; ?></textarea>                
                    </div>
                    <div class="form-group">
                      <label for="">Foto</label>
                      <input type="hidden" name="foto" value="<?php echo $foto; ?>">
                        <input type="file" class="form-control" value="" id="" name="file_upload" placeholder="">
                        <img style="width:80px;height:80px" src="<?php echo base_url(); ?>assets/upload/<?php echo $foto; ?>" class="img-circl" alt="User Image" />                        
                    </div>
                    
                  </div>
                  </div><!-- /.item -->
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                  <a href="<?php echo base_url(); ?>produk" class="btn btn-warning btn-block btn-flat">Kembali</a>
                </div><!-- /.col -->
               </form>
               
              </div><!-- /.chat -->
            </div><!-- /.box (chat box) -->
          </section><!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

          </section><!-- right col -->
        </div><!-- /.row (main row) -->

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <!-- <b>Version</b> 2.0 -->
      </div>
      <strong>Copyright &copy; 2015 <a href="#"></a></strong>
    </footer>
  </div><!-- ./wrapper -->
  <!-- page script -->
  

    
    <?php $this->load->view('inc/footer'); ?>
</body>
</html>