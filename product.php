<?php include 'include/session.php'; ?>
<?php
$conn = $ftdb->open();

$slug = $_GET['product'];

try{

    $stmt = $conn->prepare("SELECT *, products.product_name AS prodname, category.category_name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.category_id=products.category_id WHERE product_disp = :slug");
    $stmt->execute(['slug' => $slug]);
    $product = $stmt->fetch();

}
catch(PDOException $e){
    echo "There is some problem in connection: " . $e->getMessage();
}

//page view
$now = date('Y-m-d');
if($product['product_view'] == $now){
    $stmt = $conn->prepare("UPDATE products SET product_count=product_count+1 WHERE id=:id");
    $stmt->execute(['id'=>$product['prodid']]);
}
else{
    $stmt = $conn->prepare("UPDATE products SET product_count=1, product_view=:now WHERE id=:id");
    $stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
}

?>
<?php include 'include/header.php'; ?>
<body class="hold-transition skin-yellow layout-top-nav">
<div class="wrapper">

    <?php include 'include/navbar.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="callout" id="callout" style="display:none">
                            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                            <span class="message"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/no_image.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $product['photo']; ?>">
                                <br><br>
                                <form class="form-inline" id="productForm">
                                    <div class="form-group">
                                        <div class="input-group col-sm-5">

			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
			            				</span>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
                                            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
							                </button>
							            </span>
                                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="page-header"><?php echo $product['prodname']; ?></h1>
                                <h3><b>&#8369; <?php echo number_format($product['product_price'], 2); ?></b></h3>
                                <p><b>Category:</b> <a href="category.php?category=<?php echo $product['category_disp']; ?>"><?php echo $product['catname']; ?></a></p>
                                <p><b>Description:</b></p>
                                <p><?php echo $product['product_desc']; ?></p>
                            </div>
                        </div>
                        <br>
                </div>
            </section>

        </div>
    </div>
    <?php $ftdb->close(); ?>
    <?php include 'include/footer.php'; ?>
</div>

<?php include 'include/scripts.php'; ?>
<script>
    $(function(){
        $('#add').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            quantity++;
            $('#quantity').val(quantity);
        });
        $('#minus').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            if(quantity > 1){
                quantity--;
            }
            $('#quantity').val(quantity);
        });

    });
</script>
</body>
</html>