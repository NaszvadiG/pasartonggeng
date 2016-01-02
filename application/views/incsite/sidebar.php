<div class="left-sidebar">
	<div class="brands_products"><!--brands_products-->
		<h2>Kategori</h2>
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				<?php foreach($kategoriq as $row) { ?>
				<li><a href="<?php echo base_url()."site/kategori/".$row['id_kat']; ?>"> <span class="pull-right">(<?php echo $total_kat[0]['totalkategori']; ?>)</span><?php echo $row['kategori']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div><!--/brands_products-->

	<div class="brands_products"><!--brands_products-->
		<h2>Merk</h2>
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				<?php foreach($merk as $row) { ?>
				<li><a href="<?php echo base_url()."site/merk/".$row['id_merk']; ?>"> <span class="pull-right">(13)</span><?php echo $row['merk']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div><!--/brands_products-->

	<div class="shipping text-center"><!--shipping-->
		<img src="<?php echo base_url(); ?>assets/site/images/home/shipping.jpg" alt="" />
	</div><!--/shipping-->

</div>