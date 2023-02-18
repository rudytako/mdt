<?php
    session_start();

    // cad controller
    class Controller
    {
        // Database Connection Properties
        protected $host = 'localhost';
        protected $user = 'root';
        protected $password = '';
        protected $database = "cad";

        // connection property
        public $con = null;

        // call constructor
        public function __construct()
        {
            $this->con = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($this->con->connect_error){
                echo "Fail " . $this->con->connect_error;
            }
        }

        public function __destruct()
        {
            $this->closeConnection();
        }

        // for mysqli closing connection
        protected function closeConnection(){
            if ($this->con != null ){
                $this->con->close();
                $this->con = null;
            }
        }
    }

    // cad data
    class Data
    {
        public $db = null;

        public function __construct(Controller $db)
        {
            if (!isset($db->con)) return null;
            $this->db = $db;
        }

        public function getDataArray($query){
            $result = $this->db->con->query($query);

            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }

        public function getData($query) {
            $returned = $this->db->con->query($query);
            $result = $returned->fetch_assoc();
            return $result;
        }

        public function doQuery($query) {
            $result = $this->db->con->query($query) or trigger_error("Query Failed! SQL:".mysqli_error($this->db->con), E_USER_ERROR);
            return $result;
        }
    }

    // Fivem Controller
    class FivemController
    {
        // Database Connection Properties
        protected $host = 'localhost';
        protected $user = 'root';
        protected $password = '';
        protected $database = "fivem";

        // connection property
        public $conF = null;

        // call constructor
        public function __construct()
        {
            $this->conF = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($this->conF->connect_error){
                echo "Fail " . $this->conF->connect_error;
            }
        }

        public function __destruct()
        {
            $this->closeConnection();
        }

        // for mysqli closing connection
        protected function closeConnection(){
            if ($this->conF != null ){
                $this->conF->close();
                $this->conF = null;
            }
        }
    }

    class FivemData
    {
        public $dbF = null;

        public function __construct(FivemController $dbF)
        {
            if (!isset($dbF->conF)) return null;
            $this->dbF = $dbF;
        }

        public function getDataArray($query){
            $result = $this->dbF->conF->query($query);

            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }

        public function getData($query) {
            $returned = $this->dbF->conF->query($query);
            $result = $returned->fetch_assoc();
            return $result;
        }

        public function doQuery($query) {
            $result = $this->dbF->conF->query($query); // or trigger_error("Query Failed! SQL:".mysqli_error($this->dbF->conF), E_USER_ERROR);
            return $result;
        }
    }

    $db = new Controller();
    $data = new Data($db);

    $dbF = new FivemController();
    $fivemData = new FivemData($dbF);
?>