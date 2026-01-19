<?php
class db{
    private $dbh;
    private $error;
	
	private $stmt;
 
    public function __construct(){
		
        // set DSN
        $dsn = 'mysql:host=127.0.0.1;dbname=vitrum';
		
        // set opciones del PDO
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        // crear una nueva instancia PDO
        try{
            //$this->dbh = new PDO($dsn, 'vitrum_user', 'rAtUV6QzaLzRnZPw', $options);
        }
        // Catch algun error
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
	// query prepare
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
		}
	
	// bind parametros
	public function bind($param, $value, $type = null){
    if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        	}
    	}
    $this->stmt->bindValue($param, $value, $type);
	}

	// ejecutar query
	public function execute(){
    	return $this->stmt->execute();
		}
	
	
	// resultados set
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	
	// regresa un solo resultado
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
	
	// regresar el numero de registros afectados
	public function rowCount(){
    	return $this->stmt->rowCount();
		}
		
	// el ultimo id modificadfo
	public function lastInsertId(){
    	return $this->dbh->lastInsertId();
		}
	
	//inciiar transaccion
	public function beginTransaction(){
    	return $this->dbh->beginTransaction();
		}
	
	// terminar la trasaccion
	public function endTransaction(){
    	return $this->dbh->commit();
		}
	
	// cancelar la transaccion
	public function cancelTransaction(){
    	return $this->dbh->rollBack();
		}
	
	// debug parametros
	public function debugDumpParams(){
    	return $this->stmt->debugDumpParams();
		}
}
?>