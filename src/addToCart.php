<?php
session_start();
include("config.php"); 
header("location:products.php");


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['buynow']))
{
    $_SESSION['buynow'] =array();
}

if (!isset($_SESSION['wishlist']))
    {
        $_SESSION['wishlist'] =array();
    }



  $action="";
  

foreach ($_POST as $k => $v)
{
    $action = $k;
    break;
}
switch ($action)
{  
    case "AddToCart":
        addToCart();
        break;

    case "quantity":
        changeQuantity();
        break;

      case "buyNow":
        buynow(); 

    case "wishlist":
        wishlist();

    
}


function addToCart()
{
    foreach($_SESSION['product'] as $key=> $value)
    {
        if (isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $key =>$val){
                if($val['id']==$_POST['AddToCart']){
                    $_SESSION['cart'][$key]['quantity'] +=1;

                    return;
                }
            }
        }        
    }

    foreach ($_SESSION['product'] as $value){ 
        if ($value['id'] == $_POST['AddToCart'])
        {
            $id = $value['id'];
            $name = $value['name'];
            $image =$value['image'];
            $price =$value ['price'];
            $data = array("id" => $id ,"name"=> $name , "image"=> $image ,"price" => $price, "quantity" => "1");
            array_push($_SESSION['cart'], $data);
           
        }
    }
   }
   
function wishlist(){
   
    
    foreach($_SESSION['product'] as $key=> $value)
    {

     if(isset($_SESSION['wishlist']))
      {
        foreach($_SESSION['cart'] as $key =>$val){
                if($val['id']==$_POST['wishlist']){
                    echo "this is already in your wishlist";
                    break;
                }
          }

        }
      }
    foreach ($_SESSION['product'] as $vlw){ 
        if ($vlw['id'] == $_POST['wishlist'])
        {
            $wid = $vlw['id'];
            $wname = $vlw['name'];
            $wimage =$vlw['image'];
            $wprice =$vlw ['price'];
            $wdata = array("id" => $wid ,"name"=> $wname , "image"=> $wimage ,"price" => $wprice, "quantity" => "1");
            array_push($_SESSION['wishlist'], $wdata);
            
        }
       
    }
    

}
if(isset($_POST['removewish'])){
    foreach($_SESSION['wishlist'] as $key => $val){
               if($val['id'] == $_POST['removewish']){
                   array_splice($_SESSION['wishlist'] , $key ,1);
                     
                }
     }
 }








   function changeQuantity()
   {
       foreach($_SESSION['cart'] as $key =>$val){
        if($val['id']== $_POST['id']){
         $_SESSION['cart'][$key]['quantity'] = $_POST['quantity'];
         echo  $_SESSION['cart'][$key]['quantity'];
         $_POST['quantity'];
            return;
        }
    }
   }
  
   
   
 if(isset($_POST['remove'])){
     foreach($_SESSION['cart'] as $key => $val){
                if($val['id'] == $_POST['remove']){
                    array_splice($_SESSION['cart'] , $key ,1);
                     
 }
     }
 }




function buynow(){
   
    if (!isset($_SESSION['buynow']))
    {
        $_SESSION['buynow'] =array();
    }
   
   foreach($_SESSION['product']  as $key=> $val)
    {
        if($_POST['buyNow'] == $val['id'])
        {
            $bid = $val['id'];
            $bname = $val['name'];
            $bimage =$val['image'];
            $bprice =$val ['price'];
            $bdata = array(array("id" => $bid ,"name"=> $bname , "image"=> $bimage ,"price" => $bprice, "quantity" => "1"));
           $_SESSION['buynow'] = $bdata;
           break;
        } 
       
    }
    print_r($_SESSION['buynow']);   
}
 
if(isset($_POST['addTocart'])){
    foreach($_SESSION['buynow'] as $key=> $value)
    {
        if (isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $key =>$val){
                if($val['id']==$_POST['addTocart']){
                 $_SESSION['cart'][$key]['quantity'] +=1;
                  array_splice($_SESSION['buynow'],$key,1);
                    return;
                }
            }
        }        
    }
    foreach ($_SESSION['buynow'] as $key => $value){ 
        if ($value['id'] == $_POST['addTocart'])
        {
            $id = $value['id'];
             $name = $value['name'];
             $image =$value['image'];
            $price =$value ['price'];
             $data = array("id" => $id ,"name"=> $name , "image"=> $image ,"price" => $price, "quantity" => "1");
            array_push($_SESSION['cart'], $data);
            array_splice($_SESSION['buynow'],$key,1);
        }
    }

}



if(isset($_POST['bbuyNow'])){
    foreach ($_SESSION['cart'] as $key => $vll){ 
        if ($vll['id'] == $_POST['bbuyNow'])
        {
             $aid = $vll['id'];
             $aname = $vll['name'];
             $aimage =$vll['image'];
            $aprice =$vll ['price'];
            $aquantity =$vll['quantity'];
             $adata = array("id" => $aid ,"name"=> $aname , "image"=> $aimage ,"price" => $aprice, "quantity" => $aquantity);
            array_push($_SESSION['buynow'], $adata);
            array_splice($_SESSION['cart'],$key,1);
        }
    }
   

}

if(isset($_POST['addtobuy'])){

    
    foreach($_SESSION['cart'] as $key => $ve){
        $aid = $ve['id'];
             $baname = $ve['name'];
             $baimage =$ve['image'];
            $baprice =$ve ['price'];
            $baquantity =$ve['quantity'];
            $badata = array("id" => $baid ,"name"=> $baname , "image"=> $baimage ,"price" => $baprice, "quantity" => $baquantity);
            array_push($_SESSION['buynow'], $badata);
          
            array_splice($_SESSION['cart'],$key,1);
    }
}

if(isset($_POST['clearcart'])){
    unset($_SESSION['cart']);

}
if(isset($_POST['clearBuy'])){
    unset($_SESSION['buynow']);

}
if(isset($_POST['clearwish'])){
    unset($_SESSION['wishlist']);

}

if(isset($_POST['carttowish'])){
    foreach ($_SESSION['cart'] as $key=> $vll){ 
        if ($vll['id'] == $_POST['carttowish'])
        {
             $aid = $vll['id'];
             $aname = $vll['name'];
             $aimage =$vll['image'];
            $aprice =$vll ['price'];
            $aquantity =$vll['quantity'];
             $adata = array("id" => $aid ,"name"=> $aname , "image"=> $aimage ,"price" => $aprice, "quantity" => $aquantity);
            array_push($_SESSION['wishlist'], $adata);
            array_splice($_SESSION['cart'],$key,1);
        }
    }
}




if(isset($_POST['wishtocart'])){
   

    foreach ($_SESSION['wishlist'] as $key=> $vll){ 
       
        if ($vll['id'] == $_POST['wishtocart'])
        {
            echo 'hello';
             $aid = $vll['id'];
             $aname = $vll['name'];
             $aimage =$vll['image'];
            $aprice =$vll ['price'];
            $aquantity =$vll['quantity'];
             $adata = array("id" => $aid ,"name"=> $aname , "image"=> $aimage ,"price" => $aprice, "quantity" => $aquantity);
            array_push($_SESSION['cart'], $adata);
            array_splice($_SESSION['cart'],$key,1);
        }
    }
}


if(isset($_POST['wishtobuy'])){
   
   echo $_POST['wishtobuy'];
    foreach ($_SESSION['wishlist'] as $vll){ 
       echo $vll['id'];
        if ($vll['id'] == $_POST['wishtobuy'])
        {
            echo 'hello';
             $aid = $vll['id'];
             $aname = $vll['name'];
             $aimage =$vll['image'];
            $aprice =$vll ['price'];
            $aquantity =$vll['quantity'];
             $adata = array("id" => $aid ,"name"=> $aname , "image"=> $aimage ,"price" => $aprice, "quantity" => $aquantity);
            array_push($_SESSION['buynow'], $adata);
            array_splice($_SESSION['wishlist'],$key,1);
        }
    }
}

if(isset($_POST['buytowish'])){
   
    echo $_POST['buytowish'];
    foreach ($_SESSION['buynow'] as $key=>  $vll){ 
       
        if ($vll['id'] == $_POST['buytowish']+1)
        {
            echo 'hello';

             $aid = $vll['id'];
             $aname = $vll['name'];
             $aimage =$vll['image'];
            $aprice =$vll ['price'];
            $aquantity =$vll['quantity'];
             $adata = array("id" => $aid ,"name"=> $aname , "image"=> $aimage ,"price" => $aprice, "quantity" => $aquantity);
            array_push($_SESSION['wishlist'], $adata);
            array_splice($_SESSION['cart'],$key,1);
        }
    }
}

?>