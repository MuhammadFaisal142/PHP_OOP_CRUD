<?php
    class Database{
        private $db_host="localhost";
        private $db_userName="root";
        private $db_password="";
        private $db_databaseName="students";
        private $mysqli="";
        private $result=array();
        private $conn=false;
        public  function __construct(){
            if(!$this->conn){
                $this->mysqli =  new mysqli($this->db_host,$this->db_userName,$this->db_password,$this->db_databaseName);
                $this->conn=true;
            }
            if($this->mysqli->connect_error){
                array_push($this->result , $this->mysqli->connect_error );
                return false;
            }
            else{
                return true;
            }
        }
        public function insert($table,$params=array()){
            if($this->tableExists($table)){
                print_r($params);
                $table_columns=implode(',',array_keys($params));
                $table_values=implode("','",$params);
                $sql="INSERT INTO $table ($table_columns) VALUES ('$table_values')";
                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->insert_id);
                    return true;
                }
                else{
                    array_push($this->result,$this->mysqli->error);
                    return false;
                }
            }else{
                return false;
            }
        }
        public function update($table,$params=array(),$where=null){
                if($this->tableExists($table)){
                $args=array();
                foreach($params as $key => $value ){
                    $args[]="$key=  '$value'";
                }
                 $sql="UPDATE $table SET ".implode(', ', $args );
                if($where != null){
                    $sql .= "Where $where ";
                }
                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->affected_rows);
                    return true;
                }else{
                    array_push($this->result,$this->mysqli->error);
                    return false;
                }
            }
            else{
                return false;
            }
        }
        public function delete($table,$where=null){
            if($this->tableExists($table)){
                $sql="DELETE FROM $table";
                if($where != null){
                    $sql .= " WHERE $where"; 
                }
                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->affected_rows);
                    return true;
                }else{
                    array_push($this->result,$this->mysqli->error);
                    return false;
                }
            
            }
            else{
                return false;
            }   
        }
        public function select(){


        }
        public function sql($sql){
            $query=  $this->mysqli->query($sql);
            if($query){
            $this->result = $query->fetch_all(MYSQL_ASSOC);
            return true;
            }
            else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }


        }
        public function __destruct(){
            if($this->conn){
                if($this->mysqli->close()){
                    $this->conn = false;
                    return true;
                }
            }
            else{
                return false;
            }
        }
        private function tableExists($table){
            $sql= "SHOW TABLES FROM $this->db_databaseName LIKE '$table'";
            $tableInDb=$this->mysqli->query($sql);
            if($tableInDb){
                if($tableInDb->num_rows == 1){
                    return true;
                }else{
                    array_push($this->result, $table ." does not exist in this database.");
                    return false;
                }
            }
        }
        public function get_result(){
            $var=$this->result ;
            $this->result=array();
            return $var;
        }
    }

?>