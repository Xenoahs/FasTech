<?php include 'include/session.php'; ?>
<?php
$disp = $_GET['category'];

$conn = $ftdb->open();

try{
    $stmt = $conn->prepare("SELECT * FROM category WHERE category_disp = :disp");
    $stmt->execute(['disp' => $disp]);
    $cat = $stmt->fetch();
    $catid = $cat['id'];
}
catch(PDOException $e){
    echo "There is some problem in connection: " . $e->getMessage();
}

$ftdb->close();

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
                        <h1 class="page-header"><?php echo $cat['category_name']; ?></h1>
                        <?php

                        $conn = $ftdb->open();

                        try{
                            $inc = 3;
                            $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
                            $stmt->execute(['catid' => $catid]);
                            foreach ($stmt as $row) {
                                $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                $inc = ($inc == 3) ? 1 : $inc + 1;
                                if($inc == 1) echo "<div class='row'>";
                                echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
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