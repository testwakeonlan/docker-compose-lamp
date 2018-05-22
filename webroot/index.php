<!DOCTYPE html>
<html>

  <?php include 'wol.php'; ?>
  <head>
    <meta id="viewport" name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="iphone.css" />
    <title>PHP Wake On Lan</title>
  </head>
  <body>
    <div class="title"><? echo $sitename; ?></div>
    <div class="undertitle">Wake on Lan</div>
    <div class="logo"><img src="remote.png" alt="PHP Wake on Lan" /></div>
    <?php  
      $result = null;

      $wakemachine = $_GET["wake_machine"];

      if($wakemachine != "" && $wakemachine != "-1") 
        $result = WakeOnLan($networkbroadcast, $wakemachine, $port);

      if($result != null) 
        echo "<div class=\"messageOK\">WOL for ".$wakemachine." was successful!</div>\n<hr />\n"; 
    ?>
    <form name="WakeOnLan" method="get" action="index.php">
      <div class="normal">
        <label for="WakeOnLan" class="label">Select a machine to wake-up:<br /></label>
      </div>
      <div class="normal">
        <select name="wake_machine" id="WakeOnLan">
          <option value="-1">Machine</option><?php PopulateMACList($maclist); ?>
        </select> 
        <input type="submit" value="Wake-up" />
      </div>
    </form>
  </body>
</html>
