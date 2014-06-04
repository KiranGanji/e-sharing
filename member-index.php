<?php
require_once('auth.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="style.css" />
<title>Ebook Page</title>
</head>

<body>

<div id="wrap">
  <div id="wrapdata">
    
    
    <div id="header">
      <div id="headerdata">      
        
        <div class="chipboxw1 chipstyle1">
          <div class="chipboxw1data">          
            <h2 class="margin0">ISTE Ebook Forum welcomes you</h2>&nbsp;&nbsp; <a href="logout.php">Logout</a>
          </div>
        </div>
        
            
      </div>
    </div>
    
    <div id="content">
      <div id="contentdata">
        
        <div class="chipboxw1 chipstyle1">
          <div class="chipboxw1data">          
              <h3 class="margin0">Files for download</h3>
              <ul>
                <?php
				readfile('reference.txt');
				?>
              </ul>
              
          </div>
        </div>
        
      </div>
    </div>
    
     <div id="footer">
      <div id="footerdata">
        
        <div class="chipboxw1 chipstyle1">
          <div class="chipboxw1data">          
            &copy; <a href="http://www.istenitc.org/">ISTE NITC</a>
          </div>
        </div>
        
      </div>
    </div>
    
  </div>
</div>

</body>
</html>