<?php
    $whitelist = array('name', 'email', 'message'); 
    $email_address = "theforgottenbadge@gmail.com";
    $subject="Test subject";  
    
    $errors = array(); 
    $fields = array(); 

    //check form submission 
    if(!empty($_POST)){
        //print_r($_POST); 
     
    //validate math 
    if(!is_numeric($_POST['test']) && intval($_POST['test'])!=7)
    $errors[] = 'You are not a human'; 
    
    //browser automatically checks for email valid 
  
    //Perform field whitelisting 
    foreach($whitelist as $key){
        $fields[$key] = $_POST[$key]; 
    }

    //validate field data
    foreach($fields as $field => $data){
        if(empty($data))
        $errors[] = 'Please enter your ' . $field; 
    }

    //check and process 
    if(empty($errors)){
      
        $sent = mail( $email_address, $subject, $fields['message'] );
        //sent mail will be blocked by google. not authenticated 
    }
   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
    h1{
        text-align : center; 
        background: #f2e7c7;
        color: #403006;  
        padding: 5px; 
        border-radius: 10px; 
    }
    textarea{
        min-height: 200px; 
        min-width: 400px;
        margin: 20px;  
    }
    label, input{
        margin: 10px; 
        width: 80%; 
    }
    .container{
        display: block; 
        padding: 20px;
        max-width: 500px;  
        margin: auto; 
        text-align: center; 
        
    }
    .error, .success{
        border-radius: 4px;
        display: block; 
        padding: 10px; 
        text-align: center; 
        font-weight: bold; 
    }
    .error {
        background: #edd1d1; 
        color: #f51b1b; 
    }
    .success{
        background: #cfe3bf; 
        color: #407515; 
    }
    </style>
</head>
<body>
    <h1>Enter your message below</h1>
    <div class="container">


    <?php   
    if(!empty($errors)) : 
    ?>
    <p>
   <?php 
        foreach($errors as $key=>$value){
            echo '</p><p class="error">'.$value.'</p><p class="">'; 
        }
   ?>
   </p>
   <?php elseif($sent) : ?>
   <p class="success">Your mail has been sent! </p>
   <?php endif; ?>


    <form method="post" action="mail.php">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="Name" 
    value="<?php
    if(!empty($errors))
    echo isset($fields['name'])? $fields['name'] : ''; 
    else 
    echo ''; 
    ?>">

    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Email" 
    value="<?php
    if(!empty($errors))
    echo isset($fields['email'])? $fields['email'] : ''; 
    else 
    echo ''; 
    ?>">
    <label for="message">Message</label>
    <textarea name="message" placeholder="Type your mail here"  value="<?php
    if(!empty($errors))
    echo isset($fields['message'])? $fields['message'] : ''; 
    else 
    echo ''; 
    ?>"></textarea>
    <label for="test"> 5+2=?</label>
    <input type="text" name="test" placeholder="value"></input>
    <input type="submit" value="Send" >
    </div>
    
</body>
</html>
