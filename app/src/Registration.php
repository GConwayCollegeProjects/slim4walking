<?php


namespace Cohortology;

use Cohortology\Name;
class Registration
{


    function __construct()
    {
    }


    public function completeRegistration($fullname, $screen, $email, $pass)
    {
    	// include file containing class Name
    	// require_once("Name.php");
    	// create an instance of Name
		$Name = new Name();
		// split the name entered into its constituent parts
		$Name->splitName($fullname);

		$title_id = $Name->getTitleID();
		$first = $Name->getFirstname();
		$middle = $Name->getMiddles();
		$last = $Name->getLastname();

		// retrieve the IP address from the system

        $ip = $_SERVER['REMOTE_ADDR'];

        // hash the password and IP address for security reasons


        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
        $ipHash = password_hash($ip, PASSWORD_BCRYPT, array("cost" => 12));





	    $date = date('Y-m-d H:i:s');


	    require_once('Connection.php');

	    $Conn = new Connection();

	    $pdo = $Conn->newConnection();


		// create record and get id

	    $sql = "INSERT INTO individuals (ind_title_id, ind_firstname, ind_middles, ind_lastname) VALUES (:title, :firstname, :middle, :lastname)";

	    $stmt = $pdo->prepare($sql);

	    //Bind our variables.
	    $stmt->bindValue(':title', $title_id);
	    $stmt->bindValue(':firstname', $first);
	    $stmt->bindValue(':middle', $middle);
	    $stmt->bindValue(':lastname', $last);
	    //Execute the statement and insert the new account.
		  $stmt->execute();

		    $id = $pdo->lastInsertId();

	    //Prepare our next INSERT statement.

        $sql = "UPDATE individuals SET ind_screen = :screen, ind_email = :email, ind_pword = :password, ind_ip = :ip, ind_added = :added, ind_amended = :amended, ind_changed_by = :changed_by WHERE ind_id = $id";

        $stmt = $pdo->prepare($sql);

 //Bind remaining variables.

        $stmt->bindValue(':screen', $screen);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':ip', $ipHash);
	    $stmt->bindValue(':added', $date);
	    $stmt->bindValue(':amended', $date);
	    $stmt->bindValue(':changed_by',$id );

//Execute the statement and insert the new account.

           $stmt->execute();


           $_SESSION['userid'] = $id;
            $_SESSION['username'] = $screen;
	        $_SESSION['loggedin'] = time();

    }

}

