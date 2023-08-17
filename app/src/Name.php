<?php


namespace Cohortology;
class Name
{



    //declare private variables

    private $fullname;
    private $title;
    private $title_id;
    private $firstname;
    private $middles;
    private $lastname;
    private $screen;


// construct function
	function __contruct(){}

// add setters

    public function setFirstname($firstname)
    {
    $this->firstname = $firstname;
    }
	public function setFullname($fullname)
	{
		$this->fullname = $fullname;
	}
	public function setTitle($title)
	{
		$this->title = $title;
	}
	public function setTitleID($title_id)
	{
		$this->title_id = $title_id;
	}
	public function setMiddles($middles)
	{
		$this->middles = $middles;
	}
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}
	public function setScreen($screen)
	{
		$this->screen = $screen;
	}





  // Add getters


    public function getFullname(){
        return $this->fullname;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getTitleID(){
        return $this->title_id;
    }
    public function getFirstname(){
        return $this->firstname;
    }
    public function getMiddles(){
        return $this->middles;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function getScreen(){
        return $this->screen;
    }
// End of getters

// Function to take a name entered by a user and extract title, firstname, middle names and lastname
// and deal with capitalisation issues and hyphens!
   public function splitName($fullname)
   {

	   $fullname = preg_replace("/[^a-zA-Z- ]/", "", $fullname);

	   $fullname = trim($fullname);



// create array of parts
	   $explosion = explode(" ", $fullname, 99);
//	   print_r($explosion);
		$result=array();
		$no = 0;
	   foreach($explosion as $text){
					if(trim($text)!==""){
						array_push($result,$text);

					}
		$no++;
	   }
	   $count = count($result);

 // print_r($result); //(for debug and in vitro testing)

	   $no = 0;
// deal with capitalisation by converting to title case and remove invalid characters
	   while ($count > $no) {
	   	$result[$no] = trim($result[$no]);
		   $result[$no] = ucfirst(strtolower($result[$no]));
		   $result[$no] = filter_var($result[$no], FILTER_SANITIZE_STRING);
		   $pos = strpos($result[$no], "-");
		   if ($pos > 0) {
			   $result[$no] = substr_replace($result[$no], substr(strtoupper($result[$no]), $pos + 1, 1), $pos + 1, 1);
		   }
		   $no++;
	   }


	   if ($result[0] !== "") {
		   $first = trim($result[0]);

		   $array = array();
		   $ids = array();

		   require_once('Connection.php');

		   $Conn = new Connection();

		   $pdo = $Conn->newConnection();

		   $sql = "SELECT title_id, title_name FROM Titles";

		   $stmt = $pdo->prepare($sql);

//Execute.
		   $stmt->execute();

//Fetch the row.
		   $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

//split into two arrays

		   foreach ($result2 as $row) {
			   $array[] = $row['title_name'];
			   $ids[] = $row['title_id'];

		   }

		   $sql = null;
		   $start = 1;
		   $id = null;

		   $pdo = null;


		   if (array_search(ucfirst($first), $array) > 0) {
			   $title = trim($first);
			   $start = 2;
			   $title_id = $ids[array_search(ucfirst($first), $array)];
			   $first = trim($result[1]);
		   } else {
			   $title = "";
			   $title_id = null;
		   }

	   }

	   $last = $result[$count - 1];

        $middle = "";

        if ($count > $start + 1) {

            switch ($count) {
                case $start + 2 :
                    $middle = $result[$start];
                    break;
                case $start + 3 :
                    $middle = $result[$start] . " " . $result[$start + 1];
                    break;
                case $start + 4 :
                    $middle = $result[$start] . " " . $result[$start + 1] . " " . $result[$start + 2];
                    break;
                case $start + 5 :
                    $middle = $result[$start] . " " . $result[$start + 1] . " " . $result[$start + 2] . " " . $result[$start + 3];
                    break;
                case $start + 6 :
                    $middle = $result[$start] . " " . $result[$start + 1] . " " . $result[$start + 2] . " " . $result[$start + 3] . " " . $result[$start + 4];
                    break;
            }
        }

            $fullname= "";
        if ($title!==""){
            $fullname = $title." ";
        }
	   if ($first!==""){
		   $fullname = $fullname.$first." ";
	   }
	   if ($middle!==""){
		   $fullname = $fullname.$middle." ";
	   }
	   if ($last!==""){
		   $fullname = $fullname.$last." ";
	   }




        $this->fullname = $fullname;
        $this->title = $title;
        $this->title_id = $title_id;
        $this->firstname = $first;
        $this->middles = $middle;
        $this->lastname = $last;
        return;
    } //end of function splitName() ------------------------------------------------------------------------------------

    public function createScreen($fullname){

        $this->splitName($fullname);

        $screen = $this->firstname.ucfirst(substr($this->lastname,0,1));
        // e.g. $screen = "GordonC";


        $sql = "SELECT `ind_screen` FROM `Individuals` WHERE `ind_screen` LIKE :screen";

        require_once('Connection.php');

        $Conn = new Connection();

	    $pdo = $Conn->newConnection();

	    $stmt = $pdo->prepare($sql);

//Bind the provided screen name to test to our prepared statement.

	    $stmt->bindValue(':screen', $screen."%");

//Execute.
	    $stmt->execute();

//Fetch the row.
	    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);



	    if (count($res) > 0)
	    {

            /* Check the number of rows that match the SELECT statement */
            $count = 1;

            $continue = true;
                  while ($continue) {
		            $no = str_pad($count, 3, "0", STR_PAD_LEFT);

		            $found=false;
		            foreach ($res as $row) {
			            if ($screen.$no === $row['ind_screen']) {
				           $found = true;
			            }

		            }
	                  if ($found==false){
		                 $continue = false;
	                  }
		            $count++;
	            }
	            $screen=$screen.$no;
            }
	        else{
	        	$screen=$screen."001";

	        }

        $pdo = null;
        $this->screen = $screen;
        $fullname = $this->getFullname();
        return array ($screen, $fullname);

    } // end of function createScreen ---------------------------------------------------------------------------------

}// end of class definition