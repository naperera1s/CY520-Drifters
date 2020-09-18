<html>
 <head>
     <style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 50%;
}


.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: black;
  display: none;
  padding: auto;
  height: auto;
  padding-left: 50px;
}



table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: auto;
   padding-left: 50px;
   
}

td, th {
  border: 5px solid #dddddd;
  text-align: center;
  padding: auto;
 
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.column {
  float: left;
  width: 25%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


#SystemInformation {background-color: white;}
#FolderPermission {background-color: white;}
</style>
  <title>Admin Management</title>
 </head>
 <body>
     
<button class="tablink" onclick="openPage('SystemInformation', this, 'black')" id="defaultOpen" >SystemInformation</button>
<button class="tablink" onclick="openPage('FolderPermission', this, 'green')">Folder Permission</button>

<div class="row">
<div id="SystemInformation" class="tabcontent">
  
  <?php  
 $dir = "/var/www/reports";//preconfigured directory for the assignment
 $length = shell_exec('find /var/www/reports -type f -print | wc -l'); //number of files in the folder
 $length2 =shell_exec('cut -d: -f1 /etc/passwd | wc -l');//number of users in the system
 $length3 = shell_exec('getent group | cut -d: -f1 |wc -l');
 ?>
  <div class="column" > 
  <h2>Shared Directory Files</h2>

<table>
  <tr>
    <th>File List</th>
  </tr>
  <tr>
    <td>
        
        <?php
// Sort in descending order
$files = scandir($dir,1);

for($i = 0; $i < $length; $i++) {
    "<td></td>";
    print $files[$i]."<br>";
     "<td></td>";
}
?>
</td>
  </tr>
</table>
 
  <br></br><!-- comment -->

  <h2>All Users Sytem Users</h2>

<table>
  <tr>
    <th>Users</th>
  </tr>
  <tr>
    <td>
  
  <?php  
 


//working to get all the users in the system
exec('cut -d: -f1 /etc/passwd | sort',$users);

for($i = 0; $i < $length2; $i++) {
   "<tr></tr>";
   print $users[$i]."<br>";
   "<tr></tr>";
}

?>
        </td>
  </tr>
</table>
  </div>
 <div class="column" > 
<h2>All System Groups</h2>

<table>
  <tr>
    <th>Group</th>
  </tr>
  <tr>
    <td>
  
  <?php  
 
//working to get all the users in the system
exec('getent group | cut -d: -f1 | sort',$groups);

for($i = 0; $i < $length3; $i++) {
   "<tr></tr>";
   print $groups[$i]."<br>";
   "<tr></tr>";
}
?>
  
        </td>
  </tr>
</table>
  
  <br></br><!-- comment -->
   <br></br><!-- comment -->
 </div>
  
    <div class="column" > 
        
        <h2>Create New File</h2>

   <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname"/>
  <input  type="submit" >
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['fname'];
  if (empty($name)) {
    echo "File name is empty";
  } else {
   echo $name;
   echo " named file created";
  } 
  echo "<meta http-equiv='refresh' content='0'>";
}
?>
        <br></br>      
        <h2>Shared folder file permissions</h2>
 
<?php
$currentstatus = shell_exec('ls -l');
$output = shell_exec("cd /var/www/reports/; ls -l");
echo "<pre>$output</pre>";
?>
        
    </div>
    
    
    
</div>
<div id="FolderPermission" class="tabcontent">
  <h3>File Permission</h3>
  <p>Folder Permission still to make</p> 
</div>


<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
     
     
     
     
 
    
 </body>
</html>
