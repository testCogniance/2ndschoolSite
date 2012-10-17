<?php
$name = $_POST['name']; // 
$email = $_POST['email'];
$mes = $_POST['mes'];
$text .= "Name: $name \n"; 
$text .= "email: $email \n"; 
$text .= "Question: $mes \n";
  if (!empty($name) && !empty($email) && !empty($mes)) //if not empty 
    {
    $file = fopen ("faq.txt", "a+"); //rewrite faq.txt 
    fwrite ($file,$text); // 
    fclose ($file); // 
    }
?>
<pre><? include ("faq.txt")?></pre>	
