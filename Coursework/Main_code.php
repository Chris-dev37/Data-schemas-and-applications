<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="layout.css" type="text/css">
  </head>

<body>

  <table id="vancouver_table" class="inline_table">
    <tr>
      <th>Vancouver</th>
    </tr> 

    <td><iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="vancouverMap.php" allowfullscreen>
    </iframe></td>

    <td>
        <h3 class="weatherTitle">Vancouver Weather</h3>
        <iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="vancouverWeather.php">
    </iframe>
    </td>
  </table>

  <table id="edinburgh_table" class="inline_table"> 
      <tr>
        <th>Edinburgh</th>
      </tr>
    <td><iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="edinburghMap.php" allowfullscreen>
    </iframe></td>

    <td>
        <h3 class="weatherTitle">Edinburgh Weather</h3>
        <iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="edinburghWeather.php">
    </iframe>
    </td>
  </table>

  <div id="googleMap" style="width:100%;height:400px;"></div>


</body>
</html>