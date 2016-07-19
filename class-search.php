<?php
/**
 * Performs a search
 *
 * This class is used to perform search functions in a MySQL database
 *
 * @version 1.0
 * @author John Morris <support@johnmorrisonline.com>
 */
class search {
    /**
     * MySQLi connection
     * @access private
     * @var object
     */
    private $mysqli;

    /**
     * Constructor
     *
     * This sets up the class
     */
    public function __construct() {
        // Connect to our database and store in $mysqli property
        $this->connect();
    }
    /**
     * Database connection
     *
     * This connects to our database
     */
    private function connect() {
        $this->mysqli = new mysqli( 'localhost', 'root', 'toor', 'childdaycare' );
    }

    /**
     * Search routine
     *
     * Performs a search
     *
     * @param string $search_term The search term
     *
     * @return array/boolean $search_results Array of search results or false
     */
    public function search($search_term) {
        // Sanitize the search term to prevent injection attacks
        $sanitized = $this->mysqli->real_escape_string($search_term);

        // Run the query
        $query = $this->mysqli->query("
          SELECT `child_idx`, `ch_fname`, `ch_mname`, `ch_lname`, `age`, `ch_gender`, `visit_date`, `kalagy`, `parent_idx`
          FROM `childinfo`
          WHERE `ch_fname` LIKE '%{$sanitized}%'
          OR `ch_lname` LIKE '%{$sanitized}%'");

        // Check results
        if ( ! $query->num_rows ) {
            return false;
        }

        // Loop and fetch objects
        while( $row = mysqli_fetch_object($query) ) {
            $rows[] = $row;
        }

        // Build our return result
        if (!empty($rows)) {
            $search_results = array(
                'count' => $query->num_rows,
                'results' => $rows,
            );
        }

        return $search_results;
    }
}