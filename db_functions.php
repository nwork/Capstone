<?php
// Be sure to input YOUR database details below
// Watch the associated videos here: https://www.youtube.com/playlist?list=PLLs69n7Q4dCx5_7ZwnxTymH8X0iRP_2vw

define( 'DB_USER', 'root' );
define( 'DB_PASS', 'toor' );
define( 'DB_NAME', 'childdaycar' );
define( 'DB_HOST', 'localhost' );
define( 'DB_ENCODING', '' );

if ( !class_exists( 'DB' ) ) {
  class DB {
    public function connect() {
      return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    public function query($query) {
      $db = $this->connect();
      $result = $db->query($query);
      
      while ( $row = $result->fetch_object() ) {
        $results[] = $row;
      }
      
      return $results;
    }
    public function insert($table, $data, $format) {
      // Check for $table or $data not set
      if ( empty( $table ) || empty( $data ) ) {
        return false;
      }
      
      // Connect to the database
      $db = $this->connect();
      
      // Cast $data and $format to arrays
      $data = (array) $data;
      $format = (array) $format;
      
      // Build format string
      $format = implode('', $format); 
      $format = str_replace('%', '', $format);
      
      list( $fields, $placeholders, $values ) = $this->prep_query($data);
      
      // Prepend $format onto $values
      array_unshift($values, $format); 

      // Prepary our query for binding
      $stmt = $db->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");

      // Dynamically bind values
      call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($values));
      
      // Execute the query
      $stmt->execute();
      
      // Check for successful insertion
      if ( $stmt->affected_rows ) {
        return true;
      }
      
      return false;
    }
    public function update($table, $data, $format, $where, $where_format) {
      // Check for $table or $data not set
      if ( empty( $table ) || empty( $data ) ) {
        return false;
      }
      
      // Connect to the database
      $db = $this->connect();
      
      // Cast $data and $format to arrays
      $data = (array) $data;
      $format = (array) $format;
      
      // Build format array
      $format = implode('', $format); 
      $format = str_replace('%', '', $format);
      $where_format = implode('', $where_format); 
      $where_format = str_replace('%', '', $where_format);
      $format .= $where_format;
      
      list( $fields, $placeholders, $values ) = $this->prep_query($data, 'update');
      
      //Format where clause
      $where_clause = '';
      $where_values = '';
      $count = 0;
      
      foreach ( $where as $field => $value ) {
        if ( $count > 0 ) {
          $where_clause .= ' AND ';
        }
        
        $where_clause .= $field . '=?';
        $where_values[] = $value;
        
        $count++;
      }

      // Prepend $format onto $values
      array_unshift($values, $format);
      $values = array_merge($values, $where_values);

      // Prepary our query for binding
      $stmt = $db->prepare("UPDATE {$table} SET {$placeholders} WHERE {$where_clause}");
      
      // Dynamically bind values
      call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($values));
      
      // Execute the query
      $stmt->execute();
      
      // Check for successful insertion
      if ( $stmt->affected_rows ) {
        return true;
      }
      
      return false;
    }
    public function get_results($query) {
      return $this->query($query);
    }
    public function get_row($query) {
      $results = $this->query($query);
      
      return $results[0];
    }
    public function delete($table, $id) {
      // Connect to the database
      $db = $this->connect();
      
      // Prepary our query for binding
      $stmt = $db->prepare("DELETE FROM {$table} WHERE ID = ?");
      
      // Dynamically bind values
      $stmt->bind_param('d', $id);
      
      // Execute the query
      $stmt->execute();
      
      // Check for successful insertion
      if ( $stmt->affected_rows ) {
        return true;
      }
    }
    private function prep_query($data, $type='insert') {
      // Instantiate $fields and $placeholders for looping
      $fields = '';
      $placeholders = '';
      $values = array();
      
      // Loop through $data and build $fields, $placeholders, and $values     
      foreach ( $data as $field => $value ) {
        $fields .= "{$field},";
        $values[] = $value;
        
        if ( $type == 'update') {
          $placeholders .= $field . '=?,';
        } else {
          $placeholders .= '?,';
        }
        
      }
      
      // Normalize $fields and $placeholders for inserting
      $fields = substr($fields, 0, -1);
      $placeholders = substr($placeholders, 0, -1);
      
      return array( $fields, $placeholders, $values );
    }
    private function ref_values($array) {
      $refs = array();

      foreach ($array as $key => $value) {
        $refs[$key] = &$array[$key]; 
      }

      return $refs; 
    }
  }
}

$db = new DB;

//print_r($db->insert('objects', array('post_title'=>'Abstraction Test', 'post_content' => 'Abstraction test content'), array('%s', '%s')));
//print_r($db->update('objects', array('post_title'=>'Abstraction Test Update', 'post_content' => 'Abstraction test update content'), array('%s', '%s'), array('ID'=>28), array('%d')));
//print_r($db->get_results("SELECT * FROM objects"));
//print_r($db->get_row("SELECT * FROM objects"));
//print_r($db->delete('objects', 9));
