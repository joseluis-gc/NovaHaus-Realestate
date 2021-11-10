<?php

class Property
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
    /**
     * @var array $property return values
     */
    public $property_return = array();


    public function __construct()
    {
        if (isset($_POST["create_property"])) {
            $this->createProperty();
        }
    }

    
    private function createProperty()
    {
        if (empty($_POST['name'])) 
        {
            $this->errors[] = "La publicación debe tener un titulo";
        }
        if (empty($_POST['tipo'])) 
        {
            $this->errors[] = "La propiedad debe tener una categoria";
        }
        elseif (empty($_POST['vor'])) 
        {
            $this->errors[] = "Seleccione venta, renta o traspaso";
        }
        elseif (empty($_POST['street']) || empty($_POST['number']) || empty($_POST['section'])) 
        {
            $this->errors[] = "Llene todos los campos de derección";
        }
        elseif (empty($_POST['country_id']) || empty($_POST['state_id']) || empty($_POST['city_id'])) 
        {
            $this->errors[] = "Llene todos los campos de locación";
        }
        elseif (empty($_POST['precio']) || empty($_POST['precio_interno']) || empty($_POST['moneda'])) 
        {
            $this->errors[] = "Llene todos los campos de precio.";
        } 
         
        elseif (
        !empty($_POST['name']) && 
        !empty($_POST['vor']) && 
        !empty($_POST['tipo']) && 
        !empty($_POST['street']) &&
        !empty($_POST['number']) && 
        !empty($_POST['section']) &&
        !empty($_POST['country_id']) &&
        !empty($_POST['state_id']) &&
        !empty($_POST['city_id']) &&
        !empty($_POST['precio']) &&
        !empty($_POST['precio_interno']) &&
        !empty($_POST['moneda'])
        ) 
        {
            
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {


                $name           = $this->db_connection->real_escape_string(strip_tags($_POST['name'], ENT_QUOTES));
                $tipo           = $this->db_connection->real_escape_string(strip_tags($_POST['tipo'], ENT_QUOTES));
                $vor            = $this->db_connection->real_escape_string(strip_tags($_POST['vor'], ENT_QUOTES));
                $street         = $this->db_connection->real_escape_string(strip_tags($_POST['street'], ENT_QUOTES));
                $number         = $this->db_connection->real_escape_string(strip_tags($_POST['number'], ENT_QUOTES));
                $section        = $this->db_connection->real_escape_string(strip_tags($_POST['section'], ENT_QUOTES));
                $country_id     = $this->db_connection->real_escape_string(strip_tags($_POST['country_id'], ENT_QUOTES));
                $state_id       = $this->db_connection->real_escape_string(strip_tags($_POST['state_id'], ENT_QUOTES));
                $city_id        = $this->db_connection->real_escape_string(strip_tags($_POST['city_id'], ENT_QUOTES));
                $precio         = $this->db_connection->real_escape_string(strip_tags($_POST['precio'], ENT_QUOTES));
                $precio_interno = $this->db_connection->real_escape_string(strip_tags($_POST['precio_interno'], ENT_QUOTES));
                $moneda         = $this->db_connection->real_escape_string(strip_tags($_POST['moneda'], ENT_QUOTES));
                $bathrooms      = $this->db_connection->real_escape_string(strip_tags($_POST['bathrooms'], ENT_QUOTES));
                $recamaras      = $this->db_connection->real_escape_string(strip_tags($_POST['recamaras'], ENT_QUOTES));
                $terreno        = $this->db_connection->real_escape_string(strip_tags($_POST['terreno'], ENT_QUOTES));
                $construccion   = $this->db_connection->real_escape_string(strip_tags($_POST['construccion'], ENT_QUOTES));
                $cocina         = $this->db_connection->real_escape_string(strip_tags($_POST['cocina'], ENT_QUOTES));
                $cochera        = $this->db_connection->real_escape_string(strip_tags($_POST['cochera'], ENT_QUOTES));
                $patio         = $this->db_connection->real_escape_string(strip_tags($_POST['patio'], ENT_QUOTES));
                $alberca       = $this->db_connection->real_escape_string(strip_tags($_POST['alberca'], ENT_QUOTES));
                $description   = "";
                $agente        = $this->db_connection->real_escape_string(strip_tags($_POST['agente'], ENT_QUOTES));
                $date_created = date("Y-m-d H:i:s"); 

                //see if address is already taken
                $sql = "SELECT * FROM property WHERE street = '" . $street . "' AND number = '" . $number . "' AND section = '" . $section . "' AND city_id = '" . $city_id . "' ;";
                $query_address = $this->db_connection->query($sql);

                if ($query_address->num_rows == 1) 
                {
                    $this->errors[] = "Una propiedad con esa dirección ya esta registrada.";
                } 
                else 
                {

                    //image upload

                    $target_dir = "uploads/property/";
                    $target_file = $target_dir .rand().basename($_FILES["property_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    
                    if(empty($_FILES["property_image"]["tmp_name"]))
                    {
                        $uploadOk = 1;
                        $target_file = "uploads/default/noimage.png";
                    }
                    else
                    {
                        $check = getimagesize($_FILES["property_image"]["tmp_name"]);
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
                        if ($_FILES["property_image"]["size"] > 5000000) {
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
                            if (move_uploaded_file($_FILES["property_image"]["tmp_name"], $target_file))
                            {
                                //echo "The file ". htmlspecialchars( basename( $_FILES["property_image"]["name"])). " has been uploaded.";
                                $uploadOk = 1;
                            } 
                            else 
                            {
                                $this->errors[] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }

                    //image upload end


                    if($uploadOk == 1)
                    {

                        //insert property
                        $sql = "INSERT INTO property (name, tipo, vor, street, number, section, country_id, state_id, city_id, description, 
                        recamaras, bathrooms, terreno, construccion, cocina, cochera, patio, alberca, precio, precio_interno, moneda, imagen_principal, date_created)
                                VALUES('" . $name . "', '" . $tipo . "', '" . $vor . "', '" . $street . "', '" . $number . "', '".$section."',  
                                '" . $country_id . "',  '" . $state_id . "', '" . $city_id . "', '" . $description . "', '" . $recamaras . "' 
                                , '" . $bathrooms . "', '" . $terreno . "', '" . $construccion . "', '" . $cocina . "', '" . $cochera . "', '" . $patio . "'
                                , '" . $alberca . "', '" . $precio . "', '" . $precio_interno . "', '" . $moneda . "', '" . $target_file . "', '".$date_created."');";
                        $query_new_property_insert = $this->db_connection->query($sql);

                        
                        if ($query_new_property_insert) 
                        {
                            //property_id
                            $property_id = $this->db_connection->insert_id;

                            $assign_agent = "INSERT INTO agent_property (user_id, property_id) VALUES ($agente, $property_id)";
                            $run_assign = $this->db_connection->query($assign_agent);
                            


                            $this->property_return[] = $property_id;

                            $this->messages[] = "La propiedad ha sido guardada, ahora agregue una galeria.";
                        }
                        else 
                        {
                            echo $sql;
                            //$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                        }

                    }
                    else
                    {
                        $this->errors[] = "Hubo un error al subir la imagen.";

                    }
                }
            } 
            else
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "An unknown error occurred.";
        }
    }
}
