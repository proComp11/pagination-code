<?php 

	class DbUtil {

		private $server = "192.168.40.30";
		private $user = "data";
		private $password = "1234567890";
		private $database = "only_for_pralay";
		protected $conn;
		

		public function __construct(){
			$this->conn = new mysqli($this->server, $this->user, $this->password, $this->database);
			if($this->conn->connect_error){
				echo "Database Connection Failed"; die();
			}
			return $this->conn;
		}

		public function getData($page, $limit){	
			
			// sql query for count total number of pages
			$sqlCount = "SELECT count(*) FROM `expense_table`";
			$result = $this->conn->query($sqlCount);
			$total_records = $result->fetch_row();
			$total_pages = ceil($total_records[0] / $limit);
			
			$table = "";
			$offset = ($page - 1 ) * $limit;
			$sqlstr = "SELECT * FROM `expense_table` LIMIT $offset , $limit";
			$result = $this->conn->query($sqlstr);
			if($result->num_rows > 0){
				$table .= "<table class='table table-hover'> 
							<thead>
								<tr>
									<th>ID</th>
									<th>SUBJECT</th>
									<th>EXPENSE</th>
									<th>AMOUNT</th>
								</tr>
							</thead>
							<tbody>";
				
				while($row = $result->fetch_assoc()){
					$table .= "<tr><td>".$row['id']."</td><td>".$row['subject']."</td><td>".$row['expense_purpose']."</td><td>".$row['amount']."</td></tr>";
				}			
				$table .= "</table>";
				$table .= '<div id="pagination">';
				$i = 1;
				while($i <= $total_pages ){
					if($page == $i){
						$table .= '<a class="active" id="'.$i.'" href="">'.$i.'</a>';
					}else{
						$table .= '<a id="'.$i.'" href="">'.$i.'</a>';
					}
					
					$i++;
				}
				$table .= '</div>';				
				return $table;			
			}else{
				return 0;
			}
		}
	}

?>