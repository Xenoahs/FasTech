<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="http://localhost/Fastech/index.php" class="navbar-brand"><b>Fas</b>Tech</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">HOME</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">

                            <?php

                            $conn = $ftdb->open();
                            try{
                                $stmt = $conn->prepare("SELECT * FROM category");
                                $stmt->execute();
                                foreach($stmt as $row){
                                    echo "
                      <li><a href='category.php?category=".$row['category_disp']."'>".$row['category_name']."</a></li>
                    ";
                                }
                            }
                            catch(PDOException $e){
                                echo "There is some problem in connection: " . $e->getMessage();
                            }

                            $ftdb->close();

                            ?>

                        </ul>
                    </li>
                </ul>

                <form method="POST" class="navbar-form navbar-left" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="" required>
                        <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
                    </div>
                </form>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="label label-success cart_count"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
                            <li>
                                <ul class="menu" id="cart_menu">
                                </ul>
                            </li>
                            <li class="footer"><a href="">Go to Cart</a></li>
                        </ul>
                    </li>
                    <?php
                    echo "
                    <li><a href='login.php'>LOGIN</a></li>
                    <li><a href='signup.php'>SIGNUP</a></li>
                    "; ?>
                </ul>
            </div>

