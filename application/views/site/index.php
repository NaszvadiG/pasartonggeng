<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('incsite/head'); ?>
</head><!--/head-->

<body>
	<?php $this->load->view('incsite/head2'); ?>
	
	<?php $this->load->view('incsite/slider'); ?>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php $this->load->view('incsite/sidebar'); ?>
				</div>
				
				<?php $this->load->view('incsite/produk'); ?>
			</div>
		</div>
	</section>
	<?php $this->load->view('incsite/footer'); ?>
  	<?php $this->load->view('incsite/footer2'); ?>
    
</body>
</html>