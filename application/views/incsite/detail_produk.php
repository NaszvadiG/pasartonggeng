<div class="col-sm-9 padding-right">
					<?php foreach($data_produk as $row){ ?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img style="width:266px; height=281px" src="<?php echo base_url(); ?>assets/upload/<?php echo $row['foto']; ?>" alt="" />
							</div>
							<!-- <div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="<?php echo base_url(); ?>assets/site/images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="<?php echo base_url(); ?>assets/site/images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="<?php echo base_url(); ?>assets/site/images/product-details/similar3.jpg" alt=""></a>
										</div>										
									</div>

								  
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div> -->

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="<?php echo base_url(); ?>assets/site/images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $row['judul']; ?></h2>
								<!-- <img src="<?php echo base_url(); ?>assets/site/images/product-details/rating.png" alt="" /> -->
								<span>
									<span><?php echo currency_format($row['harga']); ?></span>
									<!-- <input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button> -->
								</span>
								<!-- <p><b>Tersedia:</b> <?php echo $row['judul']; ?></p> -->
								<p><b>Di Update Tanggal:</b> <?php echo date('d M Y H:i:s',strtotime($row['tgl_input_pro'])); ?></p>
								<p><b>Jumlah:</b> <?php echo $row['jumlah']; ?></p>
								<p><b>Kondisi:</b> <?php echo $row['kondisi']; ?></p>
								<p><b>Merk:</b> <?php echo $row['merk']; ?></p>
								<p><b>Keterangan:</b> <?php echo $row['ket']; ?></p>
								<!-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<?php } ?>
					
					
					<!-- <div class="recommended_items">
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div> -->
					
				</div>