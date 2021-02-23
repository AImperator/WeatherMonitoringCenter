<?php
/**
 *This file include all functions with associative arrays.
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
    $hours = [
        "01 AM", "02 AM", "03 AM", "04 AM", "05 AM", "06 AM", "07 AM", "08 AM", "09 AM", "10 AM", "11 AM", "12 AM", "01 PM", "02 PM", "03 PM", "04 PM", "05 PM", "06 PM", "07 PM", "08 PM", "09 PM", "10 PM", "11 PM", "12 PM"
    ];
    $day = [];
    foreach ($hours as $index => $hourAtDay) {
        $day[$hourAtDay] = (double)rand(150, 400) / 10;
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
    file_put_contents("./data/day_ass.json", $day_json);
}

/**
 *This function loads a array from a .json file.
 * @return array
 */
function load_day(): array
{
    $day_json = file_get_contents("./data/day_ass.json");
    return json_decode($day_json, true);
}

/**
 *This function changes the value of a array at a specific index.
 * @param array $day
 * @param string $hour
 * @param float $temp
 * @return array $day
 */
function change_temp_day(array $day, string $hour, float $temp): array
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
    $weekDays = [
        "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
    ];
    $week = [];
    foreach ($weekDays as $index => $weekDayName) {
        $week[$weekDayName] = create_day();
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
    file_put_contents("./data/week_ass.json", $week_json);
}

/**
 *This function loads a array from a .json file.
 * @return array
 **/
function load_week(): array
{
    $week_json = file_get_contents("./data/week_ass.json");
    return json_decode($week_json, true);
}

/**
 *This function changes the value of a array at a specific index.
 * @param array $week
 * @param string $day
 * @param string $hour
 * @param float $temp
 * @return array $week
 **/
function change_temp_week(array $week, string $day, string $hour, float $temp): array
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
    $dayOfMonth_big = [
        "1st.", "2nd.", "3rd.", "4th.", "5th.", "6th.", "7th.", "8th.", "9th.", "10th.", "11th.", "12th.", "13th.", "14th.", "15th.", "16th.", "17th.", "18th.", "19th.", "20th.", "21th.", "22th.", "23rd.", "24th.", "25th.", "26th.", "27th.", "28th.", "29th.", "30th.", "31th."
    ];
    $dayOfMonth_small = [
        "1st.", "2nd.", "3rd.", "4th.", "5th.", "6th.", "7th.", "8th.", "9th.", "10th.", "11th.", "12th.", "13th.", "14th.", "15th.", "16th.", "17th.", "18th.", "19th.", "20th.", "21th.", "22th.", "23rd.", "24th.", "25th.", "26th.", "27th.", "28th.", "29th.", "30th."
    ];
    $dayOfMonth_feb = [
        "1st.", "2nd.", "3rd.", "4th.", "5th.", "6th.", "7th.", "8th.", "9th.", "10th.", "11th.", "12th.", "13th.", "14th.", "15th.", "16th.", "17th.", "18th.", "19th.", "20th.", "21th.", "22th.", "23rd.", "24th.", "25th.", "26th.", "27th.", "28th."
    ];

    $month = [];
    if ($n == 31) {
        foreach ($dayOfMonth_big as $index => $value) {
            $month[$value] = create_day();
        }
    } elseif ($n == 30) {
        foreach ($dayOfMonth_small as $index => $value) {
            $month[$value] = create_day();
        }
    } elseif ($n == 28) {
        foreach ($dayOfMonth_feb as $index => $value) {
            $month[$value] = create_day();
        }
    }
    return $month;
}

/**
 *This function creates the temperatures for one year.
 * @return array $year
 */
function create_year(): array
{
    $months = [
        "January", "February", "March", "April", "Mai", "June", "Juli", "August", "September", "October", "November", "December"
    ];
    $year = [];
    foreach ($months as $index => $value) {
        if ($index % 2 == 0) {
            $year[$value] = create_month(31);
        } else {
            $year[$value] = create_month(30);
        }
    }
    $year["February"] = create_month(28);
    return $year;
}

/**
 *This function saves a array in a .json file.
 * @param array $year
 **/
function save_year(array $year)
{
    $year_json = json_encode($year);
    file_put_contents("./data/year_ass.json", $year_json);
}

/**
 *This function loads a array from a .json file.
 * @return array
 **/
function load_year(): array
{
    $year_json = file_get_contents("./data/year_ass.json");
    return json_decode($year_json, true);
}

/**
 *This function changes the value of a array at a specific index.
 * @param array $year
 * @param string $month
 * @param string $day
 * @param string $hour
 * @param float $temp
 * @return array $year
 **/
function change_temp_year(array $year, string $month, string $day, string $hour, float $temp): array
{
    $year[$month][$day][$hour] = $temp;
    return $year;
}

/**
 *This function changes the temperature for one given day in every month by a value.
 * @param array $year
 * @param string $day
 * @param string $hour
 * @param float $temp
 * @return array $year
 **/
/*function same_day(array $year, string $day, string $hour, float $temp) :array
{
    for ($i=0;$i<12;$i++)
    {
        $year[$i][$day][$hour] = ($year[$i][$day][$hour] + $temp);
    }
    return $year;
}*/

/**
 * This function changes the temperature of a timespan by a given factor.
 * @param array $year
 * @param string $months
 * @param string $days
 * @param string $monthe
 * @param string $daye
 * @param float $fac
 * @return array
 */
/*function span_factor(array $year, string $months, string $days, string $monthe, string $daye, float $fac) :array
{
    for ($i=array_search($months, $year); $i<array_search($monthe, $year); $i++)
    {
        if ($i == $months)
        {
            for ($c = $days; $c < count($year[$i]); $c++) {
                for ($n = 0; $n < 24; $n++) {
                    $year[$i][$c][$n] = ($year[$i][$c][$n] * $fac);
                }
            }
        }
        elseif ($i == $monthe)
        {
            for ($c = 0; $c < $daye; $c++) {
                for ($n = 0; $n < 24; $n++) {
                    $year[$i][$c][$n] = ($year[$i][$c][$n] * $fac);
                }
            }
        }
        else {
            for ($c = 0; $c < count($year[$i]); $c++) {
                for ($n = 0; $n < 24; $n++) {
                    $year[$i][$c][$n] = ($year[$i][$c][$n] * $fac);
                }
            }
        }
    }
    return $year;
}*/

/**
 *This function computes the average temperature for the year.
 * @return float
 **/
function average_year(): float
{
    $year = load_year();
    $sum_val = 0;
    $sum_temp = 0;
    foreach ($year as $month) {
        foreach ($year as $day) {
            foreach ($year as $hour) {
                $sum_temp = $sum_temp + $year[$month][$day][$hour];
                $sum_val++;
            }
        }
    }
    return round($sum_temp / $sum_val, 0.01);
}