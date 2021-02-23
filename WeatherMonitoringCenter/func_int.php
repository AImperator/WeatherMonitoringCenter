<?php
/**
 *This file include all functions with integer arrays.
 **/


/**
 *Here for days
 **/

/**
 *This function creates the temperatures for one day.
 * @return array $day
 */
function create_day(): array
{
    for ($i = 0; $i < 24; $i++) {
        $day[$i] = (double)rand(150, 400) / 10;
    }
    return $day;
}

/**
 *This function saves a array in a .json file.
 * @param array $day
 */
function save_day(array $day)
{
    $day_json = json_encode($day);
    file_put_contents("./data/day.json", $day_json);
}

/**
 *This function loads a array from a .json file.
 * @return array
 */
function load_day(): array
{
    $day_json = file_get_contents("./data/day.json");
    return json_decode($day_json);
}

/**
 *This function changes the value of a array at a specific index.
 * @param array $day
 * @param int $hour
 * @param int $temp
 * @return array $day
 */
function change_temp_day(array $day, int $hour, int $temp): array
{
    $day[$hour] = $temp;
    return $day;
}


/**
 *Here for weeks
 */

/**
 *This function creates the temperatures for one week.
 * @return array
 */
function create_week(): array
{
    for ($i = 0; $i < 7; $i++) {
        $week[$i] = create_day();
    }
    return $week;
}

/**
 *This function saves a array in a .json file.
 * @param array $week
 **/
function save_week(array $week)
{
    $week_json = json_encode($week);
    file_put_contents("./data/week.json", $week_json);
}

/**
 *This function loads a array from a .json file.
 * @return array
 **/
function load_week(): array
{
    $week_json = file_get_contents("./data/week.json");
    return json_decode($week_json);
}

/**
 *This function changes the value of a array at a specific index.
 * @param array $week
 * @param int $day
 * @param int $hour
 * @param int $temp
 * @return array $week
 **/
function change_temp_week(array $week, int $day, int $hour, int $temp): array
{
    $week[$day][$hour] = $temp;
    return $week;
}


/**
 *Here for a year
 **/

/**
 *This function creates the temperatures for one month.
 * @param int $n
 * @return array
 */
function create_month(int $n): array
{
    for ($i = 0; $i < $n; $i++) {
        $month[$i] = create_day();
    }
    return $month;
}

/**
 *This function creates the temperatures for one year.
 * @return array $year
 */
function create_year(): array
{
    for ($i = 0; $i < 12; $i++) {
        if ($i % 2 == 0) {
            $year[] = create_month(31);
        } else {
            $year[] = create_month(30);
        }
    }
    $year[1] = create_month(28);
    return $year;
}

/**
 *This function saves a array in a .json file.
 * @param array $year
 **/
function save_year(array $year)
{
    $year_json = json_encode($year);
    file_put_contents("./data/year.json", $year_json);
}

/**
 *This function loads a array from a .json file.
 * @return array
 **/
function load_year(): array
{
    $year_json = file_get_contents("./data/year.json");
    return json_decode($year_json);
}

/**
 *This function changes the value of a array at a specific index.
 * @param array $year
 * @param int $month
 * @param int $day
 * @param int $hour
 * @param int $temp
 * @return array $year
 **/
function change_temp_year(array $year, int $month, int $day, int $hour, int $temp): array
{
    $year[$month][$day][$hour] = $temp;
    return $year;
}

/**
 *This function changes the temperature for one given day in every month by a value.
 * @param array $year
 * @param int $day
 * @param int $hour
 * @param int $temp
 * @return array $year
 **/
function same_day(array $year, int $day, int $hour, int $temp): array
{
    for ($i = 0; $i < 12; $i++) {
        $year[$i][$day][$hour] = $temp;
    }
    return $year;
}

/**
 * This function changes the temperature of a timespan by a given factor.
 * @param array $year
 * @param int $months
 * @param int $days
 * @param int $monthe
 * @param int $daye
 * @param float $fac
 * @return array
 */
function span_factor(array $year, int $months, int $days, int $monthe, int $daye, float $fac): array
{
    for ($i = $months; $i < $monthe; $i++) {
        if ($i == $months) {
            for ($c = $days; $c < count($year[$i]); $c++) {
                for ($n = 0; $n < 24; $n++) {
                    $year[$i][$c][$n] = ($year[$i][$c][$n] * $fac);
                }
            }
        } elseif ($i == $monthe) {
            for ($c = 0; $c < $daye; $c++) {
                for ($n = 0; $n < 24; $n++) {
                    $year[$i][$c][$n] = ($year[$i][$c][$n] * $fac);
                }
            }
        } else {
            for ($c = 0; $c < count($year[$i]); $c++) {
                for ($n = 0; $n < 24; $n++) {
                    $year[$i][$c][$n] = ($year[$i][$c][$n] * $fac);
                }
            }
        }
    }
    return $year;
}

/**
 *This function computes the average temperature for the year.
 * @return float
 **/
function average_year(): float
{
    $year = load_year();
    $sum_val = 0;
    $sum_temp = 0;
    for ($i = 0; $i < 12; $i++) {
        for ($c = 0; $c < count($year[$i]); $c++) {
            for ($n = 0; $n < 24; $n++) {
                $sum_temp = $sum_temp + $year[$i][$c][$n];
                $sum_val++;
            }
        }
    }
    return $sum_temp / $sum_val;
}


/**
 *Because the task is to work only with integer arrays, here are days and months to display. In associative arrays or classes this is not needed.
 **/

/**
 *Forms a array to display days
 * @return array $day_display
 **/
function form_days_to_display(): array
{
    $day_display[] = "Monday";
    $day_display[] = "Tuesday";
    $day_display[] = "Wednesday";
    $day_display[] = "Thursday";
    $day_display[] = "Friday";
    $day_display[] = "Saturday";
    $day_display[] = "Sunday";
    return $day_display;
}

/**
 *Forms a array to display months
 * @return array $month_display
 **/
function form_months_to_display(): array
{
    $month_display[] = "January";
    $month_display[] = "February";
    $month_display[] = "March";
    $month_display[] = "April";
    $month_display[] = "Mai";
    $month_display[] = "June";
    $month_display[] = "Juli";
    $month_display[] = "August";
    $month_display[] = "September";
    $month_display[] = "October";
    $month_display[] = "November";
    $month_display[] = "December";
    return $month_display;
}