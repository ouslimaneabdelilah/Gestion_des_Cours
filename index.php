<?php 

class User{
    public $name;
    public function __construct($name)
    {
         $this->name = $name;
    }
    public function testHello(){
        echo "Hello my name" . $this->name . "2025";
    }

}
$user = new User("abdelilah");
echo $user->testHello();
echo "<pre>";
print_r($user);
echo "</pre>";
?>