<?php
class Product{
    private $name = "T-shirt";
    public $price = 300;

}
$product  = new Product();

$refelction = new ReflectionClass($product);
$proprities = $refelction->getProperties();
foreach($proprities as $propritie){
    echo "name product is {$propritie->getName()} <br/>";
    echo "value {$propritie->getValue($product)}";
}
// var_dump($nameProduct)
?>