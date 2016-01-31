<?php require_once("./common/config.php"); ?>
<?php include("./front/header.php"); ?>

<!-- Page Content -->
<div class="container">
		<!-- Side Navigation -->
    <?php include("./front/side_nav.php"); ?>

    <?php
        $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
        confirm($query);
        while($row = fetch_array($query)):
    ?>

	<div class="col-md-9">
		<!-- Row for Image and Short Description-->
		<div class="row">
			<div class="col-md-7">
					<img class="img-responsive" src="<?php echo display_image($row['product_image']); ?>" alt="">
			</div>
			<div class="col-md-5">
				<div class="thumbnail"> 
					<div class="caption-full">
						<br>
				        <h3>
					        <?php echo $row['product_title']; ?>
				        </h3>
				        <hr>
				        <h4 class="">&nbsp;
				        	<?php echo "価格: &yen;".number_format($row['product_price']); ?>
				        </h4>
				    	<div class="ratings">     
					        <p>
					            <span class="glyphicon glyphicon-star"></span>
					            <span class="glyphicon glyphicon-star"></span>
					            <span class="glyphicon glyphicon-star"></span>
					            <span class="glyphicon glyphicon-star"></span>
					            <span class="glyphicon glyphicon-star-empty"></span>
					        </p>
					    </div>          
						<p><?php echo $row['short_desc']; ?></p>   
					    <form action="">
					        <div class="form-group">
					        	<a href="./common/cart.php?add=<?php echo $row['product_id']; ?>" class="btn btn-primary">カートに入れる</a>
					        </div>
					    </form>
					</div>
				</div>
			</div>
		</div><!--.row -->
		<hr>

		<!--Row for Tab Panel-->
		<div class="row">
			<div role="tabpanel">
			<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">ディスクリプション</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">レビュー</a></li>
				</ul>

					<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<br>
						<p>							 
							<?php 
								echo "商品番号: " . $row['product_id'] . "&nbsp;&nbsp;&nbsp;&nbsp;" . "商品名: " . $row['product_title']; 
							?>
						</p>           
					    <p><?php echo $row['product_description']; ?></p>
					</div>

					<?php
						$reviews = query("SELECT * FROM reviews ORDER BY review_date DESC");
						confirm($reviews);
					?>	
					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="col-md-6">
					    	<h4>最も参考になったカスタマーレビュー</h4>
					        <hr>
					        <div class="row" id="reviews">
					        	<ul>
					        		<?php while($row = mysqli_fetch_assoc($reviews)): ?>
										<li>
											<div class="col-md-12">
								                <span class="glyphicon glyphicon-star"></span>
								                <span class="glyphicon glyphicon-star"></span>
								                <span class="glyphicon glyphicon-star"></span>
								                <span class="glyphicon glyphicon-star"></span>
								                <span class="glyphicon glyphicon-star-empty"></span>
								                <?php echo $row['rename']; ?>
								                <span class="pull-right"><?php echo $row['review_date']." ".$row['review_time']; ?></span>
								                <p><?php echo $row['review']; ?></p>
								            </div>
								        </li>
						            <?php endwhile; ?>
						        </ul>
					        </div>
					        <hr>

					   
					    </div>

						<div class="col-md-6">
    						<h3><i class="fa fa-fw fa-edit"></i>レビュー</h3>
							<form action="#" class="form-inline" method="post">
								<div class="form-group addreview bottom-space">
						            <label for="review-name">名&nbsp;前&nbsp;:</label>
						            <input type="text" class="form-control" name="review-name" placeholder="お名前" id="review-name" required data-validation-required-message="お名前を入力してください。">
						        </div>
						        <div class="form-group addreview bottom-space">
						            <label for="review-email">メール:</label>
						            <input type="email" class="form-control" name="review-email" placeholder="メールアドレス" id="review-email" required data-validation-required-message="メールアドレスを入力してください。">
						        </div>
						        <div>
						            <h3>評価</h3>
						            <span class="glyphicon glyphicon-star"></span>
						            <span class="glyphicon glyphicon-star"></span>
						            <span class="glyphicon glyphicon-star"></span>
						            <span class="glyphicon glyphicon-star"></span>
						        </div>
    							<br>            
					            <div class="form-group">
					            	<textarea name="review" id="review" cols="60" rows="10" class="form-control"  placeholder="メッセージ" required data-validation-required-message="メッセージを入力してください。"></textarea>
					            </div>
    							<br><br>
					            <div class="form-group">
					                <input type="submit" name="subrev" id="subrev" class="btn btn-primary" value="送 信">
					            </div>
							</form>
						</div>
					</div><!-- .tab-pane -->
				</div><!-- .tab-content -->
			</div><!-- tabpanel -->
		</div><!--Row for Tab Panel-->
	</div><!-- .col-md-9 -->

	<?php endwhile; ?>

</div><!-- .container -->

<?php include("./front/footer.php"); ?>