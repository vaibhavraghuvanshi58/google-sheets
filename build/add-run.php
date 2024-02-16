<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cricket Database</title>
    <link href= "style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php include_once "header-menu.php" ?>

    <div>
        <table align="center">
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> Add Run </td>
            </tr>
            <tr>
                <td>Player Name</td>
                <td>
                    <?php
                    include_once "db.php";
                    $conn =  getConnection();
                    $stmt = $conn->query('SELECT * FROM PLAYERS');
                    $rows = $stmt->fetchAll();
                     ?>
                      <select id="playername">
                        <?php
                         foreach($rows as $row) {
                         ?>
                            <option value="<?php echo $row['PLAYERID'] ?>"><?php echo $row['PLAYERNAME'] ?> - <?php echo $row['PLAYERCOUNTRY'] ?></option>
                            <?php } ?>
                        </select>
                  </td>
            </tr>
            <tr>
                <td>Against Country</td>
                <td>
                    <select id="country">
                        <option value="IND">India</option>
                        <option value="PAK">Pakistan</option>
                        <option value="AUS">Australia</option>
                        <option value="SFA">South Africa</option>
                        <option value="ENG">England</option>
                        <option value="NZA">NewZealand</option>
                        <option value="SRI">SriLanka</option>
                        <option value="BAN">Bangladesh</option>
                        <option value="SCO">Scotland</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Run</td>
                <td><input type="number" id="playerrun" placeholder="Player Runs"></td>
            </tr>
            <tr>
                <td>Balls</td>
                <td><input type="number" id="playerballs" placeholder="Player Balls"></td>
            </tr>
            <tr>
                <td>Fours</td>
                <td><input type="number" id="playerfours" placeholder="Player Fours"></td>
            </tr>
            <tr>
                <td>Sixes</td>
                <td><input type="number" id="playersixes" placeholder="Player Sixes"></td>
            </tr>
            <tr>
                <td>Inning Date</td>
                <td><input type="date" id="playerYear" placeholder="Date"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;">
                    <button onclick="addRun();">Add Run</button>
                 </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align:left;font-weight:800;font-size:20px;color:red;">
                    <div id="errormsg"></div>
                 </td>
            </tr>

        </table>
    </div>

    <?php include_once "footer.php" ?>
    <script>
           function addRun(){
            var playerName = document.getElementById('playername').value;
            var playerCountry = document.getElementById('country').value;
            var playerRun = document.getElementById('playerrun').value;
            var playerBalls = document.getElementById('playerballs').value;
            var playerFours = document.getElementById('playerfours').value;
            var playerSixes = document.getElementById('playersixes').value;
            var innDate = document.getElementById('playerYear').value;

            params = "p1="+playerName+"&p2="+playerCountry+"&p3="+playerRun+"&p4="+playerBalls+"&p5="+playerFours+"&p6="+playerSixes+"&p7="+innDate;
            var http = new XMLHttpRequest();
            http.onreadystatechange = function() {
                if(http.readyState == 4 && http.status == 200) {
                    var x = http.responseText;
                    document.getElementById('errormsg').innerHTML = x;
                }
            }

            http.open('POST', "new-run-db.php", true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send(params);

           }
    </script>
</body>
</html>