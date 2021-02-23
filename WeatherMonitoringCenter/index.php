<?php
require "head.php"
?>
<form action="index.php" method="post">
    <input name="FORM_ID" type="hidden" value="1">
    <button type="submit">Show Data</button>
</form>
<br>
<p style="text-align: center;">
    <span class="sign">&darr;</span>
    Here are the temperatures of the last day
    <span class="sign">&darr;</span>
</p>
<br>
<div class="display">
    <?php
    require "func_int.php";
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "1") {
            $day = load_day();
            echo display($day);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "2") {
            $day = create_day();
            save_day($day);
            echo display($day);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "3") {

            if (isset($_POST["hour"]) == true) {
                $hour = $_POST["hour"];
            } else {
                throw new ErrorException($message = "No hour given");
            }
            if (isset($_POST["degrees"]) == true) {
                $temp = floatval($_POST["degrees"]);
            } else {
                throw new ErrorException($message = "No temperature given");
            }
            if (gettype($temp) == "double") {
                $day = load_day();
                $day = change_temp_day($day, $hour, $temp);
                save_day($day);
            } else {
                throw new ErrorException($message = "Only numbers at change request allowed");
            }
            echo display($day);
        }
    } catch (ErrorException $ee) {
        echo "<p class='show'>" . $ee . "</p>";
    }


    /**
     * Function to display
     * @param array $day
     * @return string $display
     **/
    function display(array $day): string
    {
        for ($i = 0; $i < 7; $i++) {
            $display = "";
            for ($i = 0; $i < 24; $i++) {
                $display .= "<p class='show'>Time: " . $i . ":00, Temperature: " . $day[$i] . "°C</p>";
            }
        }
        return $display;
    }

    ?>
</div>
<br>
<form action="index.php" method="post">
    <input name="FORM_ID" type="hidden" value="2">
    <button type="submit">New Temperatures</button>
</form>
<br>
<form action="index.php" method="post">
    <input name="FORM_ID" type="hidden" value="3">
    <label for="hour">At which hour you want to change?</label>
    <input name="hour" type="number" max="23" min="0">
    <br>
    <label for="degrees">How much degrees was it really?</label>
    <input name="degrees" type="text">
    <br>
    <button type="submit">Change Value</button>
</form>
<p style="text-align: center;">This version works with integer arrays. <a href="index_ass.php">Click here to visit the
        association arrays version</a></p>
<?php
require "foot.php"
?>
