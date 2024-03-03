<?php
session_start();
include("header.php");
include("config.php");
//session_destroy();
?>


<!DOCTYPE html>
<html>

<head>
	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>

	<div id="main">
		<div id="products">
			<?php


			foreach ($product as $item) {
				$des = "<form action='addToCart.php' method='POST'>
				<div id=" . $item['id'] . " class = 'product'>
				<img src='images/" . $item['image'] . "'>
				<h3 class ='title'><a href='#'>Product " . $item['id'] . "</a></h3>
				<span>Price: $" . $item['price'] . "</span>
				<button class='add-to-cart' type='submit' name='AddToCart' value=". $item['id'] ." >Add To Cart</button><br>
				<button class='add-to-cart' type='submit' name='buyNow' value = ".$item['id']." >Buy Now</button>
				<button class='add-to-cart' type='submit' name='wishlist' value = ".$item['id']." >ADD TO Wish List</button>
				</div>
				</form>";
				echo $des;
			}


			?>

		</div>
	</div>
	<div>

	</div>
	<div>
	<div class ='cartDiv' >
		<?php
		if (isset($_SESSION['cart'])) {
			$html = "<h2>Cart</h2>
							<table>
							<tr><th>Name</th><th>Product</th><th>Price</th><th>Quantity</th></tr>";
			echo ($html);
		}
		foreach ($_SESSION['cart'] as $key => $value) {

			$html1 = "<form method='POST' action='addToCart.php'> <tr><td>" . $value['name'] . "</td><td><img  src='images/" . $value['image'] . "' width='60px' height='60px' >
			</td><td>$" . $value['price'] . "</td><td><input class='edinp' name='quantity' type='number' onchange='form.submit()' value ='" . $value['quantity'] . "'>
			<input type='hidden' name='id' value=".$value['id'].">
			<button value=".$value['id']." name='remove' type='Submit'>Remove</button></td><td><button value=".$value['id']." name='carttowish' type='Submit'>Add To WishList</button></td></tr>
			<tr><td></td><td><button type='submit' name='bbuyNow' value=".$value['id'].">Buy Now</button></td><td>$".($value['quantity']*$value['price'])."</td> </tr>";
			echo $html1;
		}

		echo "<tr><td></td><td>
		</td><td></td><td></td>
		<td><button name='addtobuy'>Buy All</button></td><td><button name='clearcart'>Clear Cart</button></td>
		</tr></form></table>";

		?>
	</div>
	<div class='buydiv'>
    <?php
 
	$html = "<h2>Buy</h2>
					<table>
					<tr><th>Name</th><th>Product</th><th>Price</th><th>Quantity</th></tr>";
	echo ($html);


	foreach($_SESSION['buynow'] as $key => $val ){
	 
		$html3 = "<form method='POST' action='addToCart.php'> <tr><td>" . $val['name'] . "</td><td><img  src='images/" . $val['image'] . "' width='60px' height='60px' >
   
		</td><td>$" . $val['price'] . "</td><td><input class='edinp' name='quantity' type='number' onchange='form.submit()' value ='" . $val['quantity'] . "'>
 	
		<input type='hidden' name='id' value=".$val['id'].">
    
		</td></tr>
    
		<tr><td></td><td><button type='submit' name= 'addTocart' value=".$val['id'].">Add to Cart</button></td><td>$".($val['quantity']*$val['price'])."</td><td><button value=".$value['id']." name='buytowish' type= 'submit' >Add To WishList</button></td> </tr>";

 	echo $html3;

 }

 
	
   echo "<tr><td></td><td>
		</td><td></td><td></td>
		<td><button type='submit' name ='clearBuy'> Remove </button></td></form>
		</tr></table>";
 
		 ?>


	</div>
	<div>
	<?php
		
			$htmlw = "<h1>Wishlist</h1>
							<table>
							<tr><th>Name</th><th>Product</th><th>Price</th</tr>";
			echo ($htmlw);
		
		foreach($_SESSION['wishlist'] as $key => $value) {

         
	         
	         
         


			$htmlw1 = "<form method='POST' action='addToCart.php'> <tr><td>" . $value['name'] . "</td><td><img  src='images/" . $value['image'] . "' width='60px' height='60px' >
			</td><td>$" . $value['price'] . "</td><td>
			
			<button value=".$value['id']." name='removewish' type='Submit'>Remove</button></td><td><button value=".$value['id']." name='wishtocart' type='Submit'>Add To Cart</button></td><td><button value=".$value['id']." name='wishtobuy' type='Submit'>Buy Now</button></td></tr>
			<tr><td></td><td></td> </tr>";
			echo $htmlw1;
		}

		echo "<tr><td></td><td>
		</td><td></td><td></td>
		<td><td><button name='clearwish'>Clear Wishlist</button></td>
		</tr></form></table>";

		?>
	</div>
	</div>
	<?php include 'footer.php' ?>