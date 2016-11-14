<?php
class Grid{
	
	var $search_condition = "";
	var $SQL = "";
	var $allow_row_count = false;
	var $_sql = "";
	var $row_count_sql = "";
	var $rs = "";
	var $pagination_row_count = 0;
	var $row_per_page = 0;
	
	function __construct(){
		$this->input = new input();
		$this->row_per_page = (APPLICATION_MODULE == 'FRONT' ? ROW_PER_PAGE_FRONT : ROW_PER_PAGE_ADMIN);
	}//end function
	
	function select($select = "*"){
		$this->SQL = "SELECT ".$select."". $this->row_count_sql;
		if($this->allow_row_count == true){
			$this->SQL .= " [[rowcount]] ";
			$this->row_count_sql .= "SELECT count(1) as total ";
		}//if
		return $this;
	}//end function
	
	function from($table_name){
		if(strlen($table_name) > 0){
			$this->SQL .= " FROM ".$table_name." ";
			if($this->allow_row_count == true){
				$this->row_count_sql .= " FROM ".$table_name." ";
			}//if
		} else {
			exit("table name not selected");
		}//if
		return $this;
	}//end function

	function join($table_name){
		if(strlen($table_name) > 0){
			$this->SQL .= " INNER JOIN ".$table_name." ";
			if($this->allow_row_count == true){
				$this->row_count_sql .= " INNER JOIN ".$table_name." ";
			}//if
		} else {
			exit("table name not selected");
		}//if
		return $this;
	}//end function
	
	function leftjoin($table_name){
		if(strlen($table_name) > 0){
			$this->SQL .= " LEFT JOIN ".$table_name." ";
			if($this->allow_row_count == true){
				$this->row_count_sql .= " LEFT JOIN ".$table_name." ";
			}//if
		} else {
			exit("table name not selected");
		}//if
		return $this;
	}//end function
	
	function righttjoin($table_name){
		if(strlen($table_name) > 0){
			$this->SQL .= " RIGHT JOIN ".$table_name." ";
			if($this->allow_row_count == true){
				$this->row_count_sql .= " RIGHT JOIN ".$table_name." ";
			}//if
		} else {
			exit("table name not selected");
		}//if
		return $this;
	}//end function
	
	function on($condition){
		if(strlen($condition) > 0){
			$this->SQL .= " ON (".$condition.") ";
			if($this->allow_row_count == true){
				$this->row_count_sql .= " ON (".$condition.") ";
			}//if
		}//if
		return $this;
	}//end function

	
	function where($where = "1"){
		$this->SQL .= " WHERE ".$where ." ". $this->search_condition;
		if($this->allow_row_count == true){
			$this->row_count_sql .= " WHERE ".$where ." ". $this->search_condition;
		}//if
		return $this;
	}//end function
	
	function groupby($groupby){
		if(strlen($groupby) > 0){
			$this->SQL .= " GROUP BY ". $groupby;
			if($this->allow_row_count == true){
				$this->row_count_sql .= " GROUP BY ". $groupby;
			}//if
		}
		return $this;
	}//end function
	
	function having($having){
		if(strlen($having) > 0){
			$this->SQL .= " HAVING ". $having;
			if($this->allow_row_count == true){
				$this->row_count_sql .= " HAVING ". $having;
			}//if
		}//if
		return $this;
	}//end function

	function orderby($orderby){
		if(strlen($orderby) > 0){
			$this->SQL .= " ORDER BY ". $orderby;
		}
		return $this;
	}//end function
	
	function limit($limit=""){
		if(strlen($limit) > 0){
			$this->SQL .= " LIMIT ". $limit;
		}else{
			if($this->row_per_page > 0){
				$page = ((int)$_REQUEST["page"] > 0 ? (int)$_REQUEST["page"] : 1) ;
				$offset = $this->row_per_page * ($page - 1);
				$this->SQL .= " LIMIT ".$offset.", ". $this->row_per_page;
			}
		}
		return $this;
	}//end function
	
	function query(){
		global $db;
		if(strlen($this->row_count_sql) > 0){
			$this->row_count_sql = ", (".$this->row_count_sql.") as total_rows ";
			$this->SQL = str_replace("[[rowcount]]", $this->row_count_sql, $this->SQL);
		} else {
			$this->SQL = str_replace("[[rowcount]]", "", $this->SQL);
		}
		
		//$this->rs = $dbObj->customqry($this->SQL);
		$row = $db->fetchAll($this->SQL);
		
		if(strpos($this->SQL,"SQL_CALC_FOUND_ROWS") > 0){
			$pagination_sql = "SELECT FOUND_ROWS() as total_rows;";
			$pagination_row = $db->fetchRow($pagination_sql);
			if(sizeof($pagination_row) > 0){
				$this->pagination_row_count = $pagination_row['total_rows'];
			}//end if
		}
		return $row;
	}//end function

	
	function andCondition($cdn){
		$this->search_condition .= ' and ('.$cdn.')';
		if($this->allow_row_count == true){
			$this->row_count_sql .= ' and ('.$cdn.')';
		}//if
		return $this;
	}//end function
	
	function orCondition($cdn){
		$this->search_condition .= ' or ('.$cdn.')';
		if($this->allow_row_count == true){
			$this->row_count_sql .= ' or ('.$cdn.')';
		}//if
	}//end function
}//end class
?>
