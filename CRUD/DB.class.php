<?php
 /** CLASS DATA */

 namespace core\classes;
 use PDO;
 use Exception;

 /**
  * #namespace core\classes; está considerando que nossa classe Database está dentro de core/classes
  * # Crie uma isntância de ( Database ) para utilizar as funções select,update,insert,delet;
  */

 class Database {
    /**CRUD PHP */
 
      private $conn;

     // abre conexão com o banco de dados
      private function connect(){

        
          
           @$this->conn = new PDO(
            'mysql:'. 
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT=> true)
           );

           //debug PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }
       //encerra a conexão
      private function closeConect(){
           $this->conn = null;
      }

      /**
       * Funções que utilizaremos para o nosso CRUD
       * 
       **/

      public function select($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(!preg_match("/^SELECT/i",$sql)){
             die("Error Processing Request for SELECT");
        }
           $this->connect(); // cria a conexão
            $results = null;

            try {
                    if(!empty($params)) {

                          $exec = $this->conn->prepare($sql);
                          $exec->execute($params);
                          $results = $exec->fetchAll(PDO::FETCH_CLASS);
                    } else {

                        $exec = $this->conn->prepare($sql);
                        $exec->execute();
                        $results = $exec->fetchAll(PDO::FETCH_CLASS);
                    }

            } catch (PDOException $e) {
               return false;        
            }

           $this->closeConect();
           return $results;
      }

      //função de inserção
      public function insert($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(!preg_match("/^INSERT/i",$sql)){
            die("Error Processing Request for INSERT");
         }

          $this->connect(); // abrimos a conexão
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }
      
      //função de update
      public function update($sql, $params = null){
        $sql = trim($sql);
        //apenas para debugs em ambiente de desenvolvimento
        if(!preg_match("/^UPDATE/i",$sql)){
            die("Error Processing Request for UPDATE");
       }

          $this->connect();
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }

      // função delete
      public function delete($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(!preg_match("/^DELETE/i",$sql)){
            die("Error Processing Request for DELETE");
       }

          $this->connect(); //abrimos a conexão
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }
      //STATEMENT
      public function statement($sql, $params = null){
        //apenas para debugs em ambiente de desenvolvimento
        $sql = trim($sql);
        if(preg_match("/^(DELETE|UPDATE|SELECT|INSERT)/i",$sql)){
            die("Error Processing Request STATEMENT");
       }

          $this->connect();
            
           try {
                   if(!empty($params)) {

                         $exec = $this->conn->prepare($sql);
                         $exec->execute($params);
                    
                   } else {

                       $exec = $this->conn->prepare($sql);
                       $exec->execute();
                   }

           } catch (PDOException $e) {
              return false;        
           }
          $this->closeConect();
      }
 }
