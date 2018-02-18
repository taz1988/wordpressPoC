# Introduction
I had an event registration project, where the site has support user registration and login. I never do that before, so I decided to do a little PoC to examine how this can be done in wordpress.

# The implementation
The implementation is minimal, I don't care about nice code:
```
<?php

function generateRandomString($length = 10) {
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}
return $randomString;
}

    if (isset($_POST["email"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["phone"]) && !is_numeric(email_exists(esc_sql($_POST["email"]))))
    {
        $password = generateRandomString();

        $role = get_role("custom2");

        if ($role == null)
        {
            add_role( "custom2", "custom2", array('read'         => true) );
        }

        $userdata = array(
            'user_login'  =>  esc_sql($_POST["email"]),
            'user_email'  =>  esc_sql($_POST["email"]),
            'user_nicename' => esc_sql($_POST["firstName"])." ".esc_sql($_POST["lastName"]),
            'first_name' =>  esc_sql($_POST["firstName"]),
            'last_name' =>  esc_sql($_POST["lastName"]),
            'role' => 'custom2',
            'locale' => 'de_DE',
            'user_pass'   =>  $password
        );

        $user_id = wp_insert_user( $userdata ) ;

        add_user_meta( $user_id, "phone_number", esc_sql($_POST["phone"]));

        echo $user_id;
        echo $password;
    }

 ?>

 <div>
     <h1>Login form</h1>
     <?php wp_login_form(); ?>
 </div>

<div class="registration-form">
    <h1>Registration form POC</h1>
    <form method="POST">
    <label>E-mail cím:<input type="text" name="email" /></label>
    <label>Vezetéknév:<input type="text" name="firstName" /></label>
    <label>Keresztnév:<input type="text" name="lastName" /></label>
    <label>Phone:<input type="text" name="phone" /></label>
    <input type="submit" />
    </form>
</div>

```

# Useful links
* http://www.wpbeginner.com/beginners-guide/how-to-allow-user-registration-on-your-wordpress-site/
* http://www.wpbeginner.com/beginners-guide/wordpress-user-roles-and-permissions/
* https://codex.wordpress.org/Installing_WordPress_in_Your_Language
* https://codex.wordpress.org/Function_Reference#User_and_Author_Functions
* https://codex.wordpress.org/Roles_and_Capabilities
