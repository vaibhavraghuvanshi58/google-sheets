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
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;"> Add new Player </td>
            </tr>
            <tr>
                <td>Player Name</td>
                <td><input type="text" id="playername" placeholder="Enter Your Player Name"></td>
            </tr>
            <tr>
                <td>Player Country</td>
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
                <td>Player Gender</td>
                <td style="font-size:20px;text-align:left;">
                     <input type="radio" name="gender" value="Male"> Male
                     <input type="radio" name="gender" value="Female"> FeMale
                </td>
            </tr>
            <tr>
                <td>Player Year</td>
                <td><input type="number" id="playerYear" placeholder="Player Year"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;font-weight:800;font-size:30px;text-transform:uppercase;">
                    <button onclick="addPlayer();">Add Player</button>
                 </td>
            </tr>

        </table>
    </div>
<?php include_once "footer.php" ?>
    <script>
           function addPlayer(){
            var playerName = document.getElementById('playername').value;
            var playerCountry = document.getElementById('country').value;
            var playerYear = document.getElementById('playerYear').value;
            var genders = document.getElementsByName('gender');
            var gender= "Male";
            for(var i = 0 ; i < genders.length ; i++){
                if(genders[i].checked){
                    gender = genders[i].value;
                }
            }
            params = "param1="+playerName+"&param2="+playerCountry+"&param3="+playerYear+"&param4="+gender;
            var http = new XMLHttpRequest();
            http.onreadystatechange = function() {
                if(http.readyState == 4 && http.status == 200) {
                    var x = http.responseText;
                    alert(x);
                }
            }

            http.open('POST', "new-player-db.php", true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send(params);

           }
    </script>
</body>
</html>