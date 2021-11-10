<?php

class Trigger
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
        if (isset($_POST["trigger_alert"])) {
            $this->Trigger();
        }
    }

    
    private function Trigger()
    {
        if (empty($_POST['plant'])) 
        {
            $this->errors[] = "Empty Plant location";
        }
        elseif (empty($_POST['site']) || empty($_POST['machine']) || empty($_POST['reportby'])) 
        {
            $this->errors[] = "Empty Site, Machine or Report responsible, please try again";
        } 
        
        elseif (!empty($_POST['plant'])
            && !empty($_POST['site'])
            && !empty($_POST['machine'])
            && !empty($_POST['reportby'])
        ) {
        
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $alert_id   = $this->db_connection->real_escape_string(strip_tags($_POST['alert_id'], ENT_QUOTES));
                $plant      = $this->db_connection->real_escape_string(strip_tags($_POST['plant'], ENT_QUOTES));
                $site       = $this->db_connection->real_escape_string(strip_tags($_POST['site'], ENT_QUOTES));
                $machine    = $this->db_connection->real_escape_string(strip_tags($_POST['machine'], ENT_QUOTES));
                $reportby   = $this->db_connection->real_escape_string(strip_tags($_POST['reportby'], ENT_QUOTES));
                $orderno    = $this->db_connection->real_escape_string(strip_tags($_POST['orderno'], ENT_QUOTES));
                $partno     = $this->db_connection->real_escape_string(strip_tags($_POST['partno'], ENT_QUOTES));
                //$qty        = $this->db_connection->real_escape_string(strip_tags($_POST['qty'], ENT_QUOTES));
                
                (isset($_POST['qty']) && $_POST['qty'] != '') ? ($qty = $this->db_connection->real_escape_string(strip_tags($_POST['qty'], ENT_QUOTES))) : ($qty = 0);


                $start = date("Y-m-d H:i:s");

                if(isset($_POST['child']))
                {
                    $child = $this->db_connection->real_escape_string(strip_tags($_POST['child'], ENT_QUOTES));
                }
                else
                {
                    //$child = $_POST['alert_id'];
                    $child = 0;
                }

                //insert andon alert
                $sql = "INSERT INTO andon (andon_site_id, andon_asset_id, andon_alert_main, andon_alert_child, andon_trigger_user, andon_start, andon_partno, andon_orderno, andon_qty) 
                VALUES('" . $site . "', '" . $machine . "', '" . $alert_id . "', '" . $child . "', '" . $reportby . "', '" . $start . "', '" . $partno . "', '" . $orderno . "', '" . $qty . "');";
                
                $query_new_user_insert = $this->db_connection->query($sql);

         
                if ($query_new_user_insert){

                    if($_POST['custom_count'] > 0)
                    {
                        $custom_name = 0;
                        $custom_fields = $_POST['custom_count'];
    
                        foreach($custom_fields as $field)
                        {
                            $custom_name++;
                            $custom_name_value = $_POST[$custom_name];

                            $query_custom = "INSERT INTO andon_custom (custom_field_id, custom_response, andon_id) VALUES ($custom_name, '". $custom_name_value ."' ,$alert_id) ";
                            $run_custom_query = $this->db_connection->query($query_custom);                            
                        }
                    }
                    else
                    {
                        $custom_fields = 0;
                    }

                    sendEmail('jgomez@martechmedical.com', 'TituloAndon', 'El mensaje', array(), array());

                    $this->messages[] = "Alert sent to response teams.";
                } 
                else 
                {
                    echo $sql;
                    //error message
                    //$this->errors[] = "Sorry, your registration failed. Please go back and try again.";
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
