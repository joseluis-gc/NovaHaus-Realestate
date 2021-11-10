<?php

class User
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();


    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUserFromAdmin();
        }
        if (isset($_POST["edit_user"])) {
            $this->editUserFromAdmin();
        }
    }

    
    private function registerNewUserFromAdmin()
    {
        if (empty($_POST['user_name'])) 
        {
            $this->errors[] = "Empty Username";
        }
        elseif (empty($_POST['password']) || empty($_POST['password_repeat'])) 
        {
            $this->errors[] = "Empty Password";
        } 
        elseif ($_POST['password'] !== $_POST['password_repeat'])
        {
            $this->errors[] = "Password and password repeat are not the same";
        } 
        elseif (strlen($_POST['password']) < 6) 
        {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } 
        elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) 
        {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } 
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) 
        {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } 
        elseif (empty($_POST['user_email'])) 
        {
            $this->errors[] = "Email cannot be empty";
        } 
        elseif (strlen($_POST['user_email']) > 64) 
        {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } 
        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) 
        {
            $this->errors[] = "Your email address is not in a valid email format";
        }
        elseif (empty($_POST['first_name'])) 
        {
            $this->errors[] = "First Name Cannot Be empty.";
        }
        elseif (empty($_POST['last_name'])) 
        {
            $this->errors[] = "Last Name Cannot Be empty.";
        } 
        elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['password'])
            && !empty($_POST['password_repeat'])
            && !empty($_POST['first_name'])
            && !empty($_POST['last_name'])
            && ($_POST['password'] === $_POST['password_repeat'])
        ) {
            
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $first_name = $this->db_connection->real_escape_string(strip_tags($_POST['first_name'], ENT_QUOTES));
                $last_name = $this->db_connection->real_escape_string(strip_tags($_POST['last_name'], ENT_QUOTES));
                $user_phone = $this->db_connection->real_escape_string(strip_tags($_POST['user_phone'], ENT_QUOTES));

                //user type
                $user_type = $this->db_connection->real_escape_string(strip_tags($_POST['user_type'], ENT_QUOTES));
                
                
                //user_level
                $user_level = 0;
                if(isset($_POST['admin'])){
                    $admin = $this->db_connection->real_escape_string(strip_tags($_POST['admin'], ENT_QUOTES));
                }
                if(isset($_POST['super'])){
                    $super = $this->db_connection->real_escape_string(strip_tags($_POST['super'], ENT_QUOTES));
                }
                if($admin == 'on'){
                    $user_level ++;
                }
                if($super == 'on'){
                    $user_level ++;
                }

                

                //password encryption
                $user_password = $_POST['password'];
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);


                //see if username or email is already taken
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } 
                else 
                {


                    //image upload

                    $target_dir = "uploads/users/";
                    $target_file = $target_dir .rand().basename($_FILES["user_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    
                    if(empty($_FILES["user_image"]["tmp_name"]))
                    {
                        $uploadOk = 1;
                        $target_file = "uploads/default/noimage.png";
                    }
                    else
                    {
                        $check = getimagesize($_FILES["user_image"]["tmp_name"]);
                        if($check !== false) 
                        {
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            $this->errors[] = "Only images are allowed.";
                            $uploadOk = 0;
                        }

                        
                        // Check if file already exists
                        if (file_exists($target_file)) 
                        {
                            $this->errors[] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["user_image"]["size"] > 5000000) {
                            $this->errors[] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "JPG" 
                        && $imageFileType != "PNG" && $imageFileType != "png" 
                        && $imageFileType != "jpeg" && $imageFileType != "JPEG" 
                        && $imageFileType != "gif" && $imageFileType != "GIF" 
                        ) 
                        {
                            $this->errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) 
                        {
                            $this->errors[] = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } 
                        else
                        {
                            if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file))
                            {
                                //echo "The file ". htmlspecialchars( basename( $_FILES["user_image"]["name"])). " has been uploaded.";
                                $uploadOk = 1;
                            } 
                            else 
                            {
                                $this->errors[] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }

                    //image upload end



                    
                    
                    //insert user
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email, user_firstname, user_lastname, user_number, user_phone, user_level, user_type, user_image)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "', '" . $first_name . "', '" . $last_name . "', '1',  '" . $user_phone . "',  '" . $user_level . "', '" . $user_type . "', '" . $target_file . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    
                    if ($query_new_user_insert) 
                    {

                        //user_id 
                        $user_id = $this->db_connection->insert_id;

                        

                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    }
                    else
                    {
                        echo $sql;
                        //error message
                        //$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }


    private function editUserFromAdmin()
    {
        if (empty($_POST['user_name'])) 
        {
            $this->errors[] = "Empty Username";
        }
        elseif (empty($_POST['password']) || empty($_POST['password_repeat'])) 
        {
            $this->errors[] = "Empty Password";
        } 
        elseif ($_POST['password'] !== $_POST['password_repeat'])
        {
            $this->errors[] = "Password and password repeat are not the same";
        } 
        elseif (strlen($_POST['password']) < 6) 
        {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } 
        elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) 
        {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } 
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) 
        {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } 
        elseif (empty($_POST['user_email'])) 
        {
            $this->errors[] = "Email cannot be empty";
        } 
        elseif (strlen($_POST['user_email']) > 64) 
        {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } 
        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) 
        {
            $this->errors[] = "Your email address is not in a valid email format";
        }
        elseif (empty($_POST['first_name'])) 
        {
            $this->errors[] = "First Name Cannot Be empty.";
        }
        elseif (empty($_POST['last_name'])) 
        {
            $this->errors[] = "Last Name Cannot Be empty.";
        } 
        elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['password'])
            && !empty($_POST['password_repeat'])
            && !empty($_POST['first_name'])
            && !empty($_POST['last_name'])
            && ($_POST['password'] === $_POST['password_repeat'])
        ) {
            
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $user_id = $this->db_connection->real_escape_string(strip_tags($_GET['id'], ENT_QUOTES));
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $first_name = $this->db_connection->real_escape_string(strip_tags($_POST['first_name'], ENT_QUOTES));
                $last_name = $this->db_connection->real_escape_string(strip_tags($_POST['last_name'], ENT_QUOTES));
                $user_phone = $this->db_connection->real_escape_string(strip_tags($_POST['user_phone'], ENT_QUOTES));

                //user type
                $user_type = $this->db_connection->real_escape_string(strip_tags($_POST['user_type'], ENT_QUOTES));
                
                
                //user_level
                $user_level = 0;
                if(isset($_POST['admin'])){
                    $admin = $this->db_connection->real_escape_string(strip_tags($_POST['admin'], ENT_QUOTES));
                }
                if(isset($_POST['super'])){
                    $super = $this->db_connection->real_escape_string(strip_tags($_POST['super'], ENT_QUOTES));
                }
                if($admin == 'on'){
                    $user_level ++;
                }
                if($super == 'on'){
                    $user_level ++;
                }

                

                //password encryption
                $user_password = $_POST['password'];
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);


                //see if username or email is already taken
                $sql = "SELECT * FROM users WHERE (user_name = '" . $user_name . "' OR user_email = '" . $user_email . "') AND user_id != $user_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } 
                else 
                {



                    //image upload

                    $new = 1;

                    $target_dir = "uploads/users/";
                    $target_file = $target_dir .rand().basename($_FILES["user_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    
                    if(empty($_FILES["user_image"]["tmp_name"]))
                    {
                        $uploadOk = 1;
                        $new = 0;
                        //$target_file = "uploads/default/noimage.png";
                    }
                    else
                    {
                        $check = getimagesize($_FILES["user_image"]["tmp_name"]);
                        if($check !== false) 
                        {
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            $this->errors[] = "Only images are allowed.";
                            $uploadOk = 0;
                        }

                        
                        // Check if file already exists
                        if (file_exists($target_file)) 
                        {
                            $this->errors[] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["user_image"]["size"] > 5000000) {
                            $this->errors[] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "JPG" 
                        && $imageFileType != "PNG" && $imageFileType != "png" 
                        && $imageFileType != "jpeg" && $imageFileType != "JPEG" 
                        && $imageFileType != "gif" && $imageFileType != "GIF" 
                        ) 
                        {
                            $this->errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) 
                        {
                            $this->errors[] = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } 
                        else
                        {
                            if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file))
                            {
                                //echo "The file ". htmlspecialchars( basename( $_FILES["user_image"]["name"])). " has been uploaded.";
                                $uploadOk = 1;
                            } 
                            else 
                            {
                                $this->errors[] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }

                    //image upload end



                    
                    
                    //insert user

                    if($new == 1)
                    {

                        $sql = "UPDATE users SET user_name = '" . $user_name . "', user_password_hash ='" . $user_password_hash . "', user_email='" . $user_email . "',
                        user_firstname = '" . $first_name . "', user_lastname = '" . $last_name . "', user_number = 1, user_phone ='" . $user_phone . "', 
                        user_level ='" . $user_level . "', user_type ='" . $user_type . "', user_image =  '" . $target_file . "' WHERE user_id = $user_id;";
                    }
                    else
                    {

                        $sql = "UPDATE users SET user_name = '" . $user_name . "', user_password_hash ='" . $user_password_hash . "', user_email='" . $user_email . "',
                        user_firstname = '" . $first_name . "', user_lastname = '" . $last_name . "', user_number = 1, user_phone ='" . $user_phone . "', 
                        user_level ='" . $user_level . "', user_type ='" . $user_type . "'  WHERE user_id = $user_id;";
                    }

                    $query_new_user_insert = $this->db_connection->query($sql);

                    
                    if ($query_new_user_insert) 
                    {

                        //user_id 
                        $user_id = $this->db_connection->insert_id;

                        

                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    }
                    else
                    {
                        echo $sql;
                        //error message
                        //$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }
}
