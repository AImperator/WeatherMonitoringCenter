<?php
require "head_ass.php"
?>
    <form action="year_ass.php" method="post">
        <input name="FORM_ID" type="hidden" value="1">
        <button type="submit">Show Data</button>
    </form>
    <br>
    <p style="text-align: center;">
        <span class="sign">&darr;</span>
        Here are the temperatures of the last year
        <span class="sign">&darr;</span>
    </p>
    <br>
    <div class="display">
        <?php
        require "func_ass.php";
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "1") {
                $year = load_year();
                echo "<pre class='show'>" . print_r($year) . "</pre>";
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "2") {
                $year = create_year();
                save_year($year);
                echo "<pre class='show'>" . print_r($year) . "</pre>";
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "3") {
                if (isset($_POST["months"]) == true) {
                    $month = $_POST["months"];
                } else {
                    throw new ErrorException($message = "No days given");
                }
                if (isset($_POST["days"]) == true) {
                    $day = $_POST["days"];
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
                $year = load_year();
                $year = change_temp_year($year, $month, $day, $hour, $temp);
                save_year($year);
                echo "<pre class='show'>" . print_r($year) . "</pre>";
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "4") {
                if (isset($_POST["days"]) == true) {
                    $day = $_POST["days"];
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
                $year = load_year();
                $year = same_day($year, $day, $hour, $temp);
                save_year($year);
                echo "<pre class='show'>" . print_r($year) . "</pre>";
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "5") {
                if (isset($_POST["months"]) == true) {
                    $months = $_POST["months"];
                } else {
                    throw new ErrorException($message = "No starting month given");
                }
                if (isset($_POST["days"]) == true) {
                    $days = $_POST["days"];
                } else {
                    throw new ErrorException($message = "No starting day given");
                }
                if (isset($_POST["monthe"]) == true) {
                    $monthe = $_POST["monthe"];
                } else {
                    throw new ErrorException($message = "No end month given");
                }
                if (isset($_POST["daye"]) == true) {
                    $daye = $_POST["daye"];
                } else {
                    throw new ErrorException($message = "No end day given");
                }
                if (isset($_POST["factor"]) == true) {
                    $fac = $_POST["factor"];
                } else {
                    throw new ErrorException($message = "No temperature given");
                }
                $year = load_year();
                $year = span_factor($year, $months, $days, $monthe, $daye, $fac);
                save_year($year);
                echo "<pre class='show'>" . print_r($year) . "</pre>";
            } else {
                echo "<p class='show'>click 'Show Data' to show the data</p>";
            }
        } catch (ErrorException $ee) {
            echo "<p class='show'>" . $ee . "</p>";
        }
        /*$average = average_year();*/
        ?>
    </div>
    <br>
    <h3>Average temperature of the year<br>
        <?php
        echo /*$average*/
            "<span style='text-decoration-style: wavy; color: red'>Not finished</span>" . " °C";
        ?>
    </h3>
    <br>
    <form action="year_ass.php" method="post">
        <input name="FORM_ID" type="hidden" value="2">
        <button type="submit">New Temperatures</button>
    </form>
    <br>
    <div class="display">
        <p>Select the kind of changes you want to make <span style='text-decoration-style: wavy; color: red'>Not finished</span>
        </p>
        <details class="show">
            <summary>Single Value</summary>
            <form action="year_ass.php" method="post">
                <input name="FORM_ID" type="hidden" value="3">
                <label for="months">On which month you want to change?</label>
                <select name="months">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="Mai">Mai</option>
                    <option value="June">June</option>
                    <option value="Juli">Juli</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <br>
                <label for="days">On which day you want to change?</label>
                <select name="days">
                    "Monday">Monday</option>
                    <option value="1st.">1st</option>
                    <option value="2nd.">2nd</option>
                    <option value="3rd.">3rd</option>
                    <option value="4th.">4th</option>
                    <option value="5th.">5th</option>
                    <option value="6th.">6th</option>
                    <option value="7th.">7th</option>
                    <option value="8th.">8th</option>
                    <option value="9th.">9th</option>
                    <option value="10th.">10th</option>
                    <option value="11th.">11th</option>
                    <option value="12th.">12th</option>
                    <option value="13th.">13th</option>
                    <option value="14th.">14th</option>
                    <option value="15th.">15th</option>
                    <option value="16th.">16th</option>
                    <option value="17th.">17th</option>
                    <option value="18th.">18th</option>
                    <option value="19th.">19th</option>
                    <option value="20th.">20th</option>
                    <option value="21th.">21th</option>
                    <option value="22th.">22th</option>
                    <option value="23rd.">23rd</option>
                    <option value="24th.">24th</option>
                    <option value="25th.">25th</option>
                    <option value="26th.">26th</option>
                    <option value="27th.">27th</option>
                    <option value="28th.">28th</option>
                    <option value="29th.">29th</option>
                    <option value="30th.">30th</option>
                    <option value="31th.">31th</option>
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
        </details>
        <details class="show">
            <summary>Same day on every month</summary>
            <form action="year_ass.php" method="post">
                <input name="FORM_ID" type="hidden" value="4">
                <label for="days">Which date you want to change on every month?</label>
                <select name="days">
                    "Monday">Monday</option>
                    <option value="1st.">1st</option>
                    <option value="2nd.">2nd</option>
                    <option value="3rd.">3rd</option>
                    <option value="4th.">4th</option>
                    <option value="5th.">5th</option>
                    <option value="6th.">6th</option>
                    <option value="7th.">7th</option>
                    <option value="8th.">8th</option>
                    <option value="9th.">9th</option>
                    <option value="10th.">10th</option>
                    <option value="11th.">11th</option>
                    <option value="12th.">12th</option>
                    <option value="13th.">13th</option>
                    <option value="14th.">14th</option>
                    <option value="15th.">15th</option>
                    <option value="16th.">16th</option>
                    <option value="17th.">17th</option>
                    <option value="18th.">18th</option>
                    <option value="19th.">19th</option>
                    <option value="20th.">20th</option>
                    <option value="21th.">21th</option>
                    <option value="22th.">22th</option>
                    <option value="23rd.">23rd</option>
                    <option value="24th.">24th</option>
                    <option value="25th.">25th</option>
                    <option value="26th.">26th</option>
                    <option value="27th.">27th</option>
                    <option value="28th.">28th</option>
                    <option value="29th.">29th</option>
                    <option value="30th.">30th</option>
                    <option value="31th.">31th</option>
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
                <label for="degrees">By how much degrees you want to change the temperature?</label>
                <input name="degrees" type="number" step="0.01">
                <br>
                <button type="submit">Change Value</button>
            </form>
        </details>
        <details class="show">
            <summary>Timespan with factor</summary>
            <form action="year_ass.php" method="post">
                <input name="FORM_ID" type="hidden" value="5">
                <label for="months">Starting point | Month</label>
                <select name="months">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="Mai">Mai</option>
                    <option value="June">June</option>
                    <option value="Juli">Juli</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <br>
                <label for="days">Starting point | Day</label>
                <select name="days">
                    "Monday">Monday</option>
                    <option value="1st.">1st</option>
                    <option value="2nd.">2nd</option>
                    <option value="3rd.">3rd</option>
                    <option value="4th.">4th</option>
                    <option value="5th.">5th</option>
                    <option value="6th.">6th</option>
                    <option value="7th.">7th</option>
                    <option value="8th.">8th</option>
                    <option value="9th.">9th</option>
                    <option value="10th.">10th</option>
                    <option value="11th.">11th</option>
                    <option value="12th.">12th</option>
                    <option value="13th.">13th</option>
                    <option value="14th.">14th</option>
                    <option value="15th.">15th</option>
                    <option value="16th.">16th</option>
                    <option value="17th.">17th</option>
                    <option value="18th.">18th</option>
                    <option value="19th.">19th</option>
                    <option value="20th.">20th</option>
                    <option value="21th.">21th</option>
                    <option value="22th.">22th</option>
                    <option value="23rd.">23rd</option>
                    <option value="24th.">24th</option>
                    <option value="25th.">25th</option>
                    <option value="26th.">26th</option>
                    <option value="27th.">27th</option>
                    <option value="28th.">28th</option>
                    <option value="29th.">29th</option>
                    <option value="30th.">30th</option>
                    <option value="31th.">31th</option>
                </select>
                <br>
                <label for="monthe">End point | Month</label>
                <select name="monthe">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="Mai">Mai</option>
                    <option value="June">June</option>
                    <option value="Juli">Juli</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <br>
                <label for="daye">End point | Day</label>
                <select name="daye">
                    "Monday">Monday</option>
                    <option value="1st.">1st</option>
                    <option value="2nd.">2nd</option>
                    <option value="3rd.">3rd</option>
                    <option value="4th.">4th</option>
                    <option value="5th.">5th</option>
                    <option value="6th.">6th</option>
                    <option value="7th.">7th</option>
                    <option value="8th.">8th</option>
                    <option value="9th.">9th</option>
                    <option value="10th.">10th</option>
                    <option value="11th.">11th</option>
                    <option value="12th.">12th</option>
                    <option value="13th.">13th</option>
                    <option value="14th.">14th</option>
                    <option value="15th.">15th</option>
                    <option value="16th.">16th</option>
                    <option value="17th.">17th</option>
                    <option value="18th.">18th</option>
                    <option value="19th.">19th</option>
                    <option value="20th.">20th</option>
                    <option value="21th.">21th</option>
                    <option value="22th.">22th</option>
                    <option value="23rd.">23rd</option>
                    <option value="24th.">24th</option>
                    <option value="25th.">25th</option>
                    <option value="26th.">26th</option>
                    <option value="27th.">27th</option>
                    <option value="28th.">28th</option>
                    <option value="29th.">29th</option>
                    <option value="30th.">30th</option>
                    <option value="31th.">31th</option>
                </select>
                <br>
                <label for="factor">Factor for temperature change</label>
                <input name="factor" type="number" step="0.1">
                <br>
                <button type="submit">Change Value</button>
            </form>
        </details>
    </div>
    <p style="text-align: center;">This version works with association arrays. <a href="year.php">Click here to visit
            the integer arrays version</a></p>
<?php
require "foot.php"
?>