<?php
require "head_ass.php"
?>
    <form action="week_ass.php" method="post">
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
        require "func_ass.php";
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "1") {
                $week = load_week();
                echo "<pre class='show'>" . print_r($week) . "</pre>";
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "2") {
                $week = create_week();
                save_week($week);
                echo "<pre class='show'>" . print_r($week) . "</pre>";
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
                    $temp = $_POST["degrees"];
                } else {
                    throw new ErrorException($message = "No temperature given");
                }
                $week = load_week();
                $week = change_temp_week($week, $days, $hour, $temp);
                save_week($week);
                echo "<pre class='show'>" . print_r($week) . "</pre>";
            }
        } catch (ErrorException $ee) {
            echo "<p class='show'>" . $ee . "</p>";
        }
        ?>
    </div>
    <br>
    <form action="week_ass.php" method="post">
        <input name="FORM_ID" type="hidden" value="2">
        <button type="submit">New Temperatures</button>
    </form>
    <br>
    <form action="week_ass.php" method="post">
        <input name="FORM_ID" type="hidden" value="3">
        <label for="days">On which day you want to change?</label>
        <select name="days">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select>
        <br>
        <label for="hour">At which hour you want to change?</label>
        <select name="hour">
            <option value="01 AM">01 AM</option>
            <option value="02 AM">02 AM</option>
            <option value="03 AM">03 AM</option>
            <option value="04 AM">04 AM</option>
            <option value="05 AM">05 AM</option>
            <option value="06 AM">06 AM</option>
            <option value="07 AM">07 AM</option>
            <option value="08 AM">08 AM</option>
            <option value="09 AM">09 AM</option>
            <option value="10 AM">10 AM</option>
            <option value="11 AM">11 AM</option>
            <option value="12 AM">12 AM</option>
            <option value="01 PM">01 PM</option>
            <option value="02 PM">02 PM</option>
            <option value="03 PM">03 PM</option>
            <option value="04 PM">04 PM</option>
            <option value="05 PM">05 PM</option>
            <option value="06 PM">06 PM</option>
            <option value="07 PM">07 PM</option>
            <option value="08 PM">08 PM</option>
            <option value="09 PM">09 PM</option>
            <option value="10 PM">10 PM</option>
            <option value="11 PM">11 PM</option>
            <option value="12 PM">12 PM</option>
        </select>
        <br>
        <label for="degrees">How much degrees was it really?</label>
        <input name="degrees" type="number" step="0.01">
        <br>
        <button type="submit">Change Value</button>
    </form>
    <p style="text-align: center;">This version works with association arrays. <a href="week.php">Click here to visit
            the integer arrays version</a></p>
<?php
require "foot.php"
?>