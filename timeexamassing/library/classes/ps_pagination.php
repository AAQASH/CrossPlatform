<?php
/**
 * PHPSense Pagination Class
 *
 * PHP tutorials and scripts
 *
 * @package		PHPSense
 * @author		Jatinder Singh Thind
 * @copyright	Copyright (c) 2006, Jatinder Singh Thind
 * @link		http://www.phpsense.com
 */

// ------------------------------------------------------------------------


class PS_Pagination {
	var $php_self;
	var $rows_per_page = 10; //Number of records to display per page
	var $total_rows = 0; //Total number of rows returned by the query
	var $links_per_page = 5; //Number of links to display per page
	var $append = ""; //Paremeters to append to pagination links
	var $sql = "";
	var $debug = false;
	var $conn = false;
	var $page = 1;
	var $max_pages = 0;
	var $offset = 0;
	var $grid = "";
	var $db;
	var $ajax_function_name;
	var $isAjax = true;
	
	/**
	 * Constructor
	 *
	 * @param resource $connection Mysql connection link
	 * @param string $sql SQL query to paginate. Example : SELECT * FROM users
	 * @param integer $rows_per_page Number of records to display per page. Defaults to 10
	 * @param integer $links_per_page Number of links to display per page. Defaults to 5
	 * @param string $append Parameters to be appended to pagination links 
	 */
	
	function Call_PS_Pagination($gridObj) {
		//echo '<pre>'; print_r($gridObj);exit;
		if ($gridObj instanceof Grid) {
			$this->grid = $gridObj;
			$this->rows_per_page = (APPLICATION_MODULE == 'FRONT' ? ROW_PER_PAGE_FRONT : ROW_PER_PAGE_ADMIN);
			if (intval(LINK_PER_PAGE) > 0) {
				$this->links_per_page = LINK_PER_PAGE;
			} else {
				$this->links_per_page = 5;
			}
			if(strlen(trim($php_self)) < 1){
				$this->php_self = htmlspecialchars($_SERVER['PHP_SELF'] );
			}
			
			if (isset($_REQUEST['page'] )) {
				$this->page = intval($_REQUEST['page'] );
			}
		}
	}
	
	/**
	 * Executes the SQL query and initializes internal variables
	 *
	 * @access public
	 * @return resource
	 */
	function paginate() {
		global $grid;
		$this->grid = $grid;
		$this->total_rows = $this->grid->pagination_row_count;
		
		//Return FALSE if no rows found
		if ($this->total_rows == 0) {
			if ($this->debug)
				echo "Query returned zero rows.";
			return FALSE;
		}
		
		//Max number of pages
		//echo $this->total_rows / $this->rows_per_page;
		if((int)ROW_PER_PAGE_ADMIN > 0){
			$this->rows_per_page = ROW_PER_PAGE_ADMIN;
		}
		$this->max_pages = ceil($this->total_rows / $this->rows_per_page );
		if ($this->links_per_page > $this->max_pages) {
			$this->links_per_page = $this->max_pages;
		}
		
		//Check the page value just in case someone is trying to input an aribitrary value
		if ($this->page > $this->max_pages || $this->page <= 0) {
			$this->page = 1;
		}
		
		//Calculate Offset
		$this->offset = $this->rows_per_page * ($this->page - 1);
		
		return $this;
	}
	
	/**
	 * Display the link to the first page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'First'
	 * @return string
	 */
	function renderFirst($tag = 'First') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page == 1) {
			return "$tag ";
		} else {
			if($this->isAjax == true){
				return '<a class="pagination" href="javascript:void(0);">' . $tag . '</a> ';
			}else{
				return '<a href="' . $this->php_self . '?page=1&' . $this->append . '">' . $tag . '</a> ';
			}
		}
	}
	
	/**
	 * Display the link to the last page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'Last'
	 * @return string
	 */
	function renderLast($tag = 'Last') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page == $this->max_pages) {
			return $tag;
		} else {
			if($this->isAjax == true){
				return ' <a class="pagination" href="javascript:void(0);">' . $tag . '</a>&nbsp;&nbsp;&nbsp;of<input type="text" name="total_pages" id="total_pages" value="'.$this->max_pages.'" style="border:0px; text-align:center" size="2"/>Pages';
			}else{
				return ' <a href="' . $this->php_self . '?page=' . $this->max_pages . '&' . $this->append . '">' . $tag . '</a>';
			}
		}
	}
	
	/**
	 * Display the next link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '>>'
	 * @return string
	 */
	function renderNext($tag = '&gt;&gt;') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page < $this->max_pages) {
			if($this->isAjax == true){
				return '<a class="pagination" href="javascript:void(0);">' . $tag . '</a>';
			}else{
				return '<a href="' . $this->php_self . '?page=' . ($this->page + 1) . '&' . $this->append . '">' . $tag . '</a>';
			}
		} else {
			return $tag;
		}
	}
	
	/**
	 * Display the previous link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '<<'
	 * @return string
	 */
	function renderPrev($tag = '&lt;&lt;') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page > 1) {
			if($this->isAjax == true){
				return ' <a class="pagination" href="javascript:void(0);">' . $tag . '</a>';
			}else{
				return ' <a href="' . $this->php_self . '?page=' . ($this->page - 1) . '&' . $this->append . '">' . $tag . '</a>';
			}
		} else {
			return " $tag";
		}
	}
	
	/**
	 * Display the page links
	 *
	 * @access public
	 * @return string
	 */
	function renderNav($prefix = '<span class="page_link">', $suffix = '</span>') {
		if ($this->total_rows == 0)
			return FALSE;
		
		$batch = ceil($this->page / $this->links_per_page );
		$end = $batch * $this->links_per_page;
		if ($end == $this->page) {
			//$end = $end + $this->links_per_page - 1;
		//$end = $end + ceil($this->links_per_page/2);
		}
		if ($end > $this->max_pages) {
			$end = $this->max_pages;
		}
		$start = $end - $this->links_per_page + 1;
		//echo $this->page; exit;
		$links = '';
		if($this->isAjax == true){
			$links .= ' ' . $prefix . '<input type="text" style="text-align:center" size="1" name="page" id="page" value="'.$this->page.'" />' . $suffix . ' ';
		}else{
			for($i = $start; $i <= $end; $i ++) {
				if ($i == $this->page) {
					$links .= $prefix . " $i " . $suffix;
				} else {
					//$links .= ' ' . $prefix . '<a href="' . $this->php_self . '?page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
					$links .= ' ' . $prefix . '<a onclick="'.$this->ajax_function_name.'('.$i.');" href="javascript:void(0);">' . $i . '</a>' . $suffix . ' ';
				}
			}
		}
		return $links;
	}
	
	/**
	 * Display full pagination navigation
	 *
	 * @access public
	 * @return string
	 */
	function renderFullNav($function_name) {
		global $grid;
		$this->Call_PS_Pagination($grid);
		$this->ajax_function_name = $function_name;
		return $this->renderFirst() . '&nbsp;' . 
		$this->renderPrev() . '&nbsp;' . 
		$this->renderNav() . '&nbsp;' . 
		$this->renderNext() . '&nbsp;' . 
		$this->renderLast();
	}
	
	/**
	 * Set debug mode
	 *
	 * @access public
	 * @param bool $debug Set to TRUE to enable debug messages
	 * @return void
	 */
	function setDebug($debug) {
		$this->debug = $debug;
	}
}
?>
