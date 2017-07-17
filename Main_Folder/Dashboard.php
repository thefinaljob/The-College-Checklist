<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href='bootstrap-3.3.7-dist/css/bootstrap.css' rel='stylesheet' type='text/css'>
	<link href='bootstrap-3.3.7-dist/css/General.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<title>The College Checklist</title>
</head>
<body>
		<?php
			
			//Credentials for login 
            $servername = "rds-checklist.cvwbcvovrori.us-west-2.rds.amazonaws.com:3306";
            $username = "root";
            $password = "Globe1234";
            
            
            //connects to mySQL server using authentication information
            $db = mysqli_init();
            $db->ssl_set(NULL,NULL, "nika1copy.pem",NULL,NULL);
            $db->real_connect($servername, $username, $password);
            
            // Create connection
            $conn = mysqli_connect($servername, $username, $password);
            
            // Check connection
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
                
            //PLEASE NOTE, ONLY USER 201 IS SUPPORTED IN THIS PROTOTYPE FOR mySQL QUERIES!!!
            }
        ?>

	<header class='jumbotron' id="spiffy_header">
		<div class="col-md-12 text-center">
			<h1>Your Dashboard</h1>
		</div>
		<div class='row'>
			<div class='pull-right'>
				<ul class='nav nav-pills nav-justified'>
					<li>
						<a href="Landingpage.html">Home</a>
					</li>
					<li>
						<a href="Why.html">Why?</a>
					</li>
					<li class= "active">
						<a href="Dashboard.php">Your Dashboard</a>
					</li>
			</div>
		</div>
	</header>
	<div class="container-fluid" id="colleges_body">
		<div class="col-sm-3">
			<div class="row" id="colleges_row">
				<div class="col-sm-12">
						<h2>Your Colleges</h2>
						<h4>Currently selected colleges</h4>
						<ul>
						<!-- Fetches currently selected colleges for user 201 -->
							<?php
								$sql = mysqli_query($conn, "SELECT Colleges_Checklist.Name_College 
								FROM innodb.Colleges_Checklist, innodb.Matchup, innodb.User_List 
								WHERE User_List.ID_User = 201 and Matchup.ID_User = 201 and Colleges_Checklist.id = ID_College");
								if($sql->num_rows > 0) {
									while($row=mysqli_fetch_row($sql)) {
										echo "<li>" . $row[0]."</li>";
									}
								}
							?>
						</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row" id="colleges_row">
				<div class="col-sm-12">
						<h2>Approaching Deadlines</h2>
						<h4>Send Transcript</h4>
						<ul>
							<!-- Transcript submission deadlines fetched from mySQL server, concatenates item with appropriate info for user 201 -->
							<?php
								$sql = mysqli_query($conn, "SELECT CONCAT(Colleges_Checklist.Name_College,': ',Colleges_Checklist.Send_Transcript)
FROM innodb.Colleges_Checklist, innodb.Matchup, innodb.User_List 
WHERE User_List.ID_User = 201 and Matchup.ID_User = 201 and Colleges_Checklist.id = ID_College");
								if($sql->num_rows > 0) {
									while($row=mysqli_fetch_row($sql)) {
										echo "<li>" . $row[0]."</li>";
									}
								}
							?>
							</ul>
							<h4>Send SAT Scores</h4>
							<ul>
								<!-- SAT deadlines fetched from mySQL server, concatenates item with appropriate info -->
							<?php
								$sql = mysqli_query($conn, "SELECT CONCAT(Colleges_Checklist.Name_College,' : ',Colleges_Checklist.SAT_Date)
FROM innodb.Colleges_Checklist, innodb.Matchup, innodb.User_List 
WHERE User_List.ID_User = 201 and Matchup.ID_User = 201 and Colleges_Checklist.id = ID_College");
								if($sql->num_rows > 0) {
									while($row=mysqli_fetch_row($sql)) {
										echo "<li>" . $row[0]."</li>";
									}
								}
							?>
							</ul>
							<h4>Finish FAFSA</h4>
							<ul>
								<!-- FAFSA deadlines fetched from mySQL server, concatenates item with appropriate info for user 201 -->
							<?php
								$sql = mysqli_query($conn, "SELECT CONCAT(Colleges_Checklist.Name_College,': ',Colleges_Checklist.FASFA_Date)
FROM innodb.Colleges_Checklist, innodb.Matchup, innodb.User_List 
WHERE User_List.ID_User = 201 and Matchup.ID_User = 201 and Colleges_Checklist.id = ID_College");
								if($sql->num_rows > 0) {
									while($row=mysqli_fetch_row($sql)) {
										echo "<li>" . $row[0]."</li>";
									}
								}
							?>
						</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="row" id="colleges_row_edge">
				<div class="col-sm-12">
						<h2>Final Deadlines</h2>
						<h4>Make sure to note Final Deadlines</h4>
						<ul>
							<!-- Final deadlines fetched from mySQL server, concatenates item with appropriate info -->
						<?php
								$sql = mysqli_query($conn, "SELECT CONCAT(Colleges_Checklist.Name_College,': ',Colleges_Checklist.Full_App_Date)
FROM innodb.Colleges_Checklist, innodb.Matchup, innodb.User_List 
WHERE User_List.ID_User = 201 and Matchup.ID_User = 201 and Colleges_Checklist.id = ID_College");
								if($sql->num_rows > 0) {
									while($row=mysqli_fetch_row($sql)) {
										echo "<li>" . $row[0]."</li>";
									}
								}
							?>	
						</ul>
				</div>
			</div>
		</div>
	</div>
</body>
	<footer>
		<!-- Default footer for all pages -->
		<div class="jumbotron" id="spiffy_header">
			<div class="container">
				<div class="col-sm-1">
					<div class="thumbnail"><a href="mailto:collegechecklist@gmail.com"><img alt="Image Link Bad" class="img-responsive" src="images/gmail.png"></a></div>
				</div>
				<div class="col-sm-3 pull-right">
					<p>The College Checklist</p>
				</div>
			</div>
		</div>
	</footer>
</html>