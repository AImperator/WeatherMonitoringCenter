<?php
require "head.php"
?>
    <form action="year.php" method="post">
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
        require "func_int.php";
        $day_display = form_days_to_display();
        $month_display = form_months_to_display();
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "1") {
                $year = load_year();
                echo display($year);
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["FORM_ID"] == "2") {
                $year = create_year();
                save_year($year);
                echo display($year);
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
                    $temp = doubleval($_POST["degrees"]);
                } else {
                    throw new ErrorException($message = "No temperature given");
                }
                if (gettype($temp) == "float") {
                    $year = load_year();
                    $year = change_temp_year($year, $month, $day, $hour, $temp);
                    save_year($year);
                } else {
                    throw new ErrorException($message = "Only numbers at change request allowed");
                }
                echo display($year);
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
                    $temp = floatval($_POST["degrees"]);
                } else {
                    throw new ErrorException($message = "No temperature given");
                }
                if (gettype($temp) == "float") {
                    $year = load_year();
                    $year = same_day($year, $day, $hour, $temp);
                    save_year($year);
                } else {
                    throw new ErrorException($message = "Only numbers at change request allowed");
                }
                echo display($year);
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
                echo display($year);
            } else {
                echo "<p class='show'>click 'Show Data' to show the data</p>";
            }
        } catch (ErrorException $ee) {
            echo "<p class='show'>" . $ee . "</p>";
        }

        $average = average_year();

        /**
         * Function to display
         * @param array $year
         * @return string $display
         **/
        function display(array $year): string
        {
            $month_display = form_months_to_display();
            $display = "";
            for ($c = 0; $c < 12; $c++) {
                $display .= "<details class='show'><summary>" . $month_display[$c] . "</summary>";
                for ($i = 0; $i < count($year[$c]); $i++) {
                    $display .= "<ul class='show'>" . ($i + 1) . ". " . $month_display[$c] . ": ";
                    for ($n = 0; $n < 24; $n++) {
                        $display .= "<li>Time: " . $n . ":00, Temperature: " . $year[$c][$i][$n] . "°C</li>";
                    }
                    $display .= "</ul>";
                }
                $display .= "</details>";
            }
            return $display;
        }

        ?>
    </div>
    <br>
    <h3>Average temperature of the year<br>
        <?php
        echo $average . " °C";
        ?>
    </h3>
    <br>
    <form action="year.php" method="post">
        <input name="FORM_ID" type="hidden" value="2">
        <button type="submit">New Temperatures</button>
    </form>
    <br>
    <div class="display">
        <p>Select the kind of changes you want to make</p>
        <details class="show">
            <summary>Single Value</summary>
            <form action="year.php" method="post">
                <input name="FORM_ID" type="hidden" value="3">
                <label for="months">On which month you want to change?</label>
                <select name="months">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">Mai</option>
                    <option value="5">June</option>
                    <option value="6">Juli</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
                <br>
                <label for="days">On which day you want to change?</label>
                <input name="days" type="number" max="31">
                <br>
                <label for="hour">At which hour you want to change?</label>
                <input name="hour" type="number" max="23">
                <br>
                <label for="degrees">How much degrees was it really?</label>
                <input name="degrees" type="text">
                <br>
                <button type="submit">Change Value</button>
            </form>
        </details>
        <details class="show">
            <summary>Same day on every month</summary>
            <form action="year.php" method="post">
                <input name="FORM_ID" type="hidden" value="4">
                <label for="days">Which date you want to change on every month?</label>
                <input name="days" type="number" max="31">
                <br>
                <label for="hour">At which hour you want to change?</label>
                <input name="hour" type="number" max="23">
                <br>
                <label for="degrees">By how much degrees you want to change the temperature?</label>
                <input name="degrees" type="number">
                <br>
                <button type="submit">Change Value</button>
            </form>
        </details>
        <details class="show">
            <summary>Timespan with factor</summary>
            <form action="year.php" method="post">
                <input name="FORM_ID" type="hidden" value="5">
                <label for="months">Starting point | Month</label>
                <select name="months">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">Mai</option>
                    <option value="5">June</option>
                    <option value="6">Juli</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
                <br>
                <label for="days">Starting point | Day</label>
                <input name="days" type="number" max="30">
                <br>
                <label for="monthe">End point | Month</label>
                <select name="monthe">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">Mai</option>
                    <option value="5">June</option>
                    <option value="6">Juli</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
                <br>
                <label for="daye">End point | Day</label>
                <input name="daye" type="number" max="30">
                <br>
                <label for="factor">Factor for temperature change</label>
                <input name="factor" type="number" step="0.1">
                <br>
                <button type="submit">Change Value</button>
            </form>
        </details>
    </div>
    <p>This version works with integer arrays. <a href="year_ass.php">Click here to visit the association arrays
            version</a></p>
<?php
require "foot.php"
?>