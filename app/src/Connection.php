<?php

namespace Cohortology;
use PDO;

class Connection
{

    /**
     * This class connects to MySQL using the PDO object.
     * This can be included in web pages where a database connection is needed.
     * Customize these to match your MySQL database connection details.
     * This info should be available from within your hosting panel.
     */

    function _construct(){ }

    public const USER = "u260357075_gconwayuk";
    public const PASSWORD = "#LovethePeaks48";
    public const HOST = "sql582.main-hosting.eu";
    public const DB = "u260357075_cohortology";



    /**
     * PDO options / configuration details.
     * I'm going to set the error mode to "Exceptions".
     * I'm also going to turn off emulated prepared statements.
     */

    public const OPTIONS = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false ) ;



    public function newConnection(): PDO
    {
        /**
         * Connect to MySQL and instantiate the PDO object.
         */

        $pdo = new PDO(
            "mysql:host=" . self::HOST . ";dbname=" . self::DB, //DSN
            self::USER, //Username
            self::PASSWORD, //Password
            self::OPTIONS //Options
        );

        return($pdo);
    }




}