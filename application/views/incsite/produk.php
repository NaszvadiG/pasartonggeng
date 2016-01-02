<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">ITEM</h2>
						<?php foreach($data_produk as $row) { ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img style="width:268px; height:269px" src="<?php echo base_url(); ?>assets/upload/<?php echo $row['foto']; ?>" alt="" />
											<h2><?php echo currency_format($row['harga']); ?></h2>
											<p style="text-transform:capitalize;"><?php echo $row['judul']; ?></p>
											<a href="<?php echo base_url(); ?>detail-<?php echo strtolower(str_replace(' ','-',preg_replace("/[^a-zA-Z0-9\s]/", "", $row['judul']))).'-'.$row['id_produk']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Lihat Detail</a>
										</div>
								</div>
								
							</div>
						</div>
						<?php } ?>
						
						<div class="pagination-area">
							<ul class="pagination">
								<?php echo $pages; ?>
							</ul>
						</div>
					</div><!--features_items-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Produk Rekomended</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
								<?php foreach($rekomen as $row) { ?>	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:150px; height:200px" src="<?php echo base_url(); ?>assets/upload/<?php echo $row['foto']; ?>" alt="" />
													<h2><?php echo currency_format($row['harga']); ?></h2>
													<p><?php echo $row['judul']; ?></p>
													<a href="<?php echo base_url(); ?>site/detail/<?php echo $row['id_produk']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Lihat Detail</a>
												</div>
												
											</div>
										</div>
									</div>
								<?php } ?>
									
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>