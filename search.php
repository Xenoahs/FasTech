<?php include 'include/session.php'; ?>
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
                        <?php

                        $conn = $ftdb->open();

                        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE product_name LIKE :keyword");
                        $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
                        $row = $stmt->fetch();
                        if($row['numrows'] < 1){
                            echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
                        }
                        else{
                            echo '<h1 class="page-header">Search results for <i>'.$_POST['keyword'].'</i></h1>';
                            try{
                                $inc = 3;
                                $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE :keyword");
                                $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);

                                foreach ($stmt as $row) {
                                    $highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['product_name']);
                                    $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/no_image.jpg';
                                    $inc = ($inc == 3) ? 1 : $inc + 1;
                                    if($inc == 1) echo "<div class='row'>";
                                    echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['product_disp']."'>".$highlighted."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#8369; ".number_format($row['product_price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
                                    if($inc == 3) echo "</div>";
                                }
                                if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>";
                                if($inc == 2) echo "<div class='col-sm-4'></div></div>";

                            }
                            catch(PDOException $e){
                                echo "There is some problem in connection: " . $e->getMessage();
                            }
                        }

                        $ftdb->close();

                        ?>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <?php include 'include/footer.php'; ?>
</div>

<?php include 'include/scripts.php'; ?>
</body>
</html>