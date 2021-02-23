<?php
require "head.php"
?>
    <form action="week.php" method="post">
        <input name="FORM_ID" type="hidden" value="1">
        <button type="submit">Show Data</button>
    </form>
    <br>
    <p style="text-align: center;">
        <span class="sign">&darr;</span>
        Here are the temperatures of the last week
        <span class="sign">&darr;</span>
    </p>
    <br>
    <div class="display">
        <?php
        require "func_int.php";
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "1") {
                $week = load_week();
                echo display($week);
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "2") {
                $week = create_week();
                save_week($week);
                echo display($week);
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "3") {

                if (isset($_POST["days"]) == true) {
                    $days = $_POST["days"];
                } else {
                    throw new ErrorException($message = "No days given");
                }
                if (isset($_POST["hour"]) == true) {
                    $hour = $_POST["hour"];
                } else {
                    throw new ErrorException($message = "No hour given");
                }
                if (isset($_POST["degrees"]) == true) {
                    $temp = doubleval($_POST["degrees"]);
                } else {
                    throw new ErrorException($message = "No temperature given");
                }
                if (gettype($temp) == "float") {
                    $week = load_week();
                    $week = change_temp_week($week, $days, $hour, $temp);
                    save_week($week);
                } else {
                    throw new ErrorException($message = "Only numbers at change request allowed");
                }
                echo display($week);
            }
        } catch (ErrorException $ee) {
            echo "<p class='show'>" . $ee . "</p>";
        }

        /**
         * Function to display
         * @param array $week
         * @return string $display
         **/
        function display(array $week): string
        {
            $day_display = form_days_to_display();
            $display = "";
            for ($i = 0; $i < 7; $i++) {
                $display .= "<ul class='show'>" . $day_display[$i] . ": ";
                for ($n = 0; $n < 24; $n++) {
                    $display .= "<li>Time: " . $n . ":00, Temperature: " . $week[$i][$n] . "°C</li>";
                }
                $display .= "</ul>";
            }
            return $display;
        }

        ?>
    </div>
    <br>
    <form action="week.php" method="post">
        <input name="FORM_ID" type="hidden" value="2">
        <button type="submit">New Temperatures</button>
    </form>
    <br>
    <form action="week.php" method="post">
        <input name="FORM_ID" type="hidden" value="3">
        <label for="days">On which day you want to change?</label>
        <select name="days">
            <option value="0">Monday</option>
            <option value="1">Tuesday</option>
            <option value="2">Wednesday</option>
            <option value="3">Thursday</option>
            <option value="4">Friday</option>
            <option value="5">Saturday</option>
            <option value="6">Sunday</option>
        </select>
        <br>
        <label for="hour">At which hour you want to change?</label>
        <input name="hour" type="number" max="23" min="0">
        <br>
        <label for="degrees">How much degrees was it really?</label>
        <input name="degrees" type="text">
        <br>
        <button type="submit">Change Value</button>
    </form>
    <p style="text-align: center;">This version works with integer arrays. <a href="week_ass.php">Click here to visit
            the association arrays version</a></p>
<?php
require "foot.php"
?>