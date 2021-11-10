<?php

class AndonResponse
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
        if (isset($_POST["respond"])) {
            $this->Respond();
        }

        if (isset($_POST["solution"])) {
            $this->Solution();
        }
    }

    
    private function Respond()
    {
        if (!is_numeric($_GET['andon_id'])) 
        {
            $this->errors[] = "Invalid Parameter.";
        }
        elseif (!isset($_POST['user_error']) && $_POST['user_error']!='') 
        {
            $this->errors[] = "Please mark if this was a user error or not.";
        } 
        elseif (!empty($_POST['user_error']) && $_POST['user_error'] == 0 && empty($_POST['notes'])) 
        {
            $this->errors[] = "If this was a user error please make a note Responsible, error cause, etc.";
        } 
        
        elseif (is_numeric($_GET['andon_id'])
            && isset($_POST['user_error'])
        ) {
        
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $andon_id        = $this->db_connection->real_escape_string(strip_tags($_GET['andon_id'], ENT_QUOTES));
                $user_error      = $this->db_connection->real_escape_string(strip_tags($_POST['user_error'], ENT_QUOTES));
                $notes           = $this->db_connection->real_escape_string(strip_tags($_POST['notes'], ENT_QUOTES));
                $andon_response  = date("Y-m-d H:i:s");

                if($user_error == 1)
                {
                    //user triggerd andon by mistake.    
                    $sql = "UPDATE andon SET andon_response = '".$andon_response."', andon_end = '".$andon_response."', andon_response_user = {$_SESSION['user_id']}, andon_end_user = {$_SESSION['user_id']}, andon_response_comment = '".$notes."', andon_attention = 1, andon_solution = 1 
                    WHERE andon_id = $andon_id";       
                }
                else
                {
                    $sql = "UPDATE andon  SET andon_response = '".$andon_response."', andon_response_user = {$_SESSION['user_id']},  andon_response_comment = '".$notes."', andon_attention = 1  
                    WHERE andon_id = $andon_id";
                }
            
                $query_update_andon = $this->db_connection->query($sql);

         
                if ($query_update_andon)
                {
                    if($user_error == 1)
                    {
                        $this->messages[] = "Your Response has been recorded and this issue has been solved.";
                    }
                    else
                    {
                        $this->messages[] = "Your Response has been recorded. You will need to register a solution.";
                    }
                    
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
            $this->errors[] = "A validation error occurred.";
        }
    }



    private function Solution()
    {
        if (!is_numeric($_GET['andon_id'])) 
        {
            $this->errors[] = "Invalid Parameter.";
        }
        elseif (empty($_POST['report'])) 
        {
            $this->errors[] = "You need to fill a report.";
        } 
        elseif (is_numeric($_GET['andon_id']) && !empty($_POST['report'])) 
        {
        
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $andon_id        = $this->db_connection->real_escape_string(strip_tags($_GET['andon_id'], ENT_QUOTES));
                $report          = $this->db_connection->real_escape_string(strip_tags($_POST['report'], ENT_QUOTES));
                $andon_end       = date("Y-m-d H:i:s");

                //get andon data
                $query = "SELECT * FROM andon  
                LEFT JOIN alerts ON andon.andon_alert_main = alerts.alert_id 
                LEFT JOIN alert_child ON andon.andon_alert_child = alert_child.child_id  
                LEFT JOIN site ON andon.andon_site_id = site.site_id 
                LEFT JOIN plant ON plant.plant_id = site.plant_id 
                LEFT JOIN assets ON andon.andon_asset_id = assets.asset_id  
                WHERE andon_id = $andon_id";

                $run = $this->db_connection->query($query);
                $row = $run->fetch_object();

                $passwd   = $row->plant_password;
                $use_pass = $row->use_pass;

                if($use_pass == 1)
                {
                    $plant_password = $this->db_connection->real_escape_string(strip_tags($_POST['plant_password'], ENT_QUOTES));

                    if($passwd == $plant_password)
                    {
                        $sql = "UPDATE andon SET andon_end = '".$andon_end."', andon_end_user = {$_SESSION['user_id']},  andon_end_comment = '".$report."', andon_solution = 1  
                        WHERE andon_id = $andon_id";                    
                        $query_update_andon = $this->db_connection->query($sql);        
                    }
                    else
                    {
                        //echo "pass";
                        $query_update_andon = 0;
                    }
                }
                else
                {
                    $sql = "UPDATE andon SET andon_end = '".$andon_end."', andon_end_user = {$_SESSION['user_id']},  andon_end_comment = '".$report."', andon_solution = 1  
                    WHERE andon_id = $andon_id";   
                    $query_update_andon = $this->db_connection->query($sql);                
                }

                
         
                if ($query_update_andon)
                {    
                    $this->messages[] = "Your Response has been recorded and this issue has been solved.";   
                } 
                else 
                {
                    if($passwd != $plant_password)
                    {
                        $this->errors[] = "Incorrect plant password, please try again.";
                    }
                    else
                    {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                    //echo $sql;
                    //error message
                }        
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "A validation error occurred.";
        }
    }





}
