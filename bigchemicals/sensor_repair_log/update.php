<?php 
	include '../config.php'; 
	$sql = "SELECT * FROM sensorslist;";
	$result = $conn->query($sql);
	
	$uid = $_GET['uid'];
	$msg = "";
	
	if(isset($uid) && !empty($uid)){
		$sid = "";
		$technician = "";
		$repair = "";
		$repairDate = "";
		$cause = "";
		$downDate = "";
		
		$srl_sql = "SELECT * FROM sensor_repair_log where uid = ".$uid.";";
		$srl_result = $conn->query($srl_sql);
		if ($srl_result->num_rows > 0) {
			while($srl_row = $srl_result->fetch_assoc()) {
				$sid = $srl_row['sid'];
				$technician = $srl_row['technician'];
				$repair = $srl_row['repair'];
				$repairDate = $srl_row['repairDate'];
				$cause = $srl_row['cause'];
				$downDate = $srl_row['downDate'];
			}
		}
	}
	
	if(isset($_POST) && !empty($_POST)){
		$uuid = $_POST['uid'];
		$sid = $_POST['sid'];
		$technician = $_POST['technician'];
		$repair = $_POST['repair'];
		$repairDate = $_POST['repairDate'];
		$cause = $_POST['cause'];
		$downDate = $_POST['downDate'];
		
		$srl_update_sql = "UPDATE sensor_repair_log SET `sid` = ".$sid.", `technician` = '".$technician."', `repair` = '".$repair."', `repairDate` = '".$repairDate."', `cause` = '".$cause."', `downDate` = '".$downDate."' WHERE `uid` = ".$uuid;
		
		if ($conn->query($srl_update_sql) === TRUE) {
		  $msg = "Sensor repair log record updated successfully";
		} else {
		  $msg = "Error: " . $emp_update_sql . "<br>" . $conn->error;
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Sensor Repair log</title>
    <script type="text/javascript">
      function showMessage() {
          alert("Log Recorded.");
      }
    </script>
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, label, p { 
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: black;
      line-height: 22px;
      background-color: #c4f2bf;
      }
      h1 {
      position: absolute;
      font-size: 40px;
      color:#126f08;
      z-index: 2;
      line-height: 83px;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 10px;
      border-radius: 1px;
      background:#c4f2bf;
      box-shadow: 0 0 8px  #669999; 
      }
      .banner {
      position: relative;
      height: 100px;
      background-color: #5dcc61 ;  
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.2); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      input[type="date"] {
      padding: 4px 5px;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color:  #669999;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 3px 0  #669999;
      color: #669999;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      .item span {
      color: red;
      }
      .week {
      display:flex;
      justfiy-content:space-between;
      }
      .colums {
      display:flex;
      justify-content:space-between;
      flex-direction:row;
      flex-wrap:wrap;
      }
      .colums div {
      width:48%;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      right: 0;
      color:  #c4f2bf;
      }
      .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
      }
     
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background:  #669999;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background:  #a3c2c2;
      }
	  .addnewright{
		  display: inline-block;
		  float: right;
	  }
	  .addnew{display:inline-block;}
	  select{width:100%;padding:5px;}
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .name-item div {
      width: calc(50% - 20px);
      }
      .name-item div input {
      width:97%;}
      .name-item div label {
      display:block;
      padding-bottom:5px;
      }
      }
    </style>
  </head>
  <body>
    <div class="testbox">
      <form action="" method="post" id="app">
        <div class="banner">
          <h1>Update Sensor Repair Log</h1>
        </div>
        
        <div class="main-subtitle">	
         <div class="addnew">
         	<a href="<?php echo SITE_URL; ?>">Home</a>
            
          </div>
          <div class="addnewright">
            <a href="<?php echo SITE_URL; ?>sensor_repair_log/list.php" >Update Sensor Repair Log Details</a>
          </div>
        </div>
        
        <div class="colums">
        	<input type="hidden" name="uid" value="<?php echo $uid; ?>">
          <div class="item">
            <label for="sid">Sensor ID<span>*</span></label>
            <select id="sid" name="sid" required>
            	<?php 
				  if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$selected = "";
						if($row['sid'] == $sid){
							$selected = "selected";
						}
				  ?>
				  <option value='<?php echo $row['sid']; ?>' <?php echo $selected; ?>><?php echo $row['sname']; ?></option>
				  <?php } } ?>
            </select>
          </div>
          <div class="item">
            <label for="technician">Technician name<span>*</span></label>
            <input id="technician" type="text" value="<?php echo $technician; ?>" name="technician" required/>
          </div>
          <div class="item">
            <label for="downDate">Date Down<span>*</span></label>
            <input id="downDate" type="date" value="<?php echo $downDate; ?>" name="downDate" required/>
          </div>
          <div class="item">
            <label for="repairDate">Restored Date<span>*</span></label>
            <input id="repairDate" type="date" value="<?php echo $repairDate; ?>" name="repairDate" required/>
          </div>
          <div class="item">
            <label for="cause">Cause<span>*</span></label>
            <input id="cause" type="text" value="<?php echo $cause; ?>" name="cause" required/>
          </div>
          <div class="item">
            <label for="repair">Repair done<span>*</span></label>
            <input id="repair" type="text" value="<?php echo $repair; ?>" name="repair" required/>
          </div>
          
        </div>
        <div class="btn-block">
          <button type="submit" name="submit">Submit</button>
        </div>
        <div class="btn-block">
        	<?php echo $msg; ?>
        </div>
      </form>
    </div>
    
  </body>
</html>