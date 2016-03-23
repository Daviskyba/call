<?php require "options.php";
define('PROC_1_YEARS', 9);
define('PROC_2_YEARS', 11);
define('PROC_3_YEARS', 13);
define('PROC_4_YEARS', 15);
define('PROC_5_YEARS', 17);
define('PROC_6_YEARS', 19);
define('PROC_7_YEARS', 21);
define('MIN_PROCENT', 0);
define('MAX_PROCENT', 100);
define('MIN_YEARS', 1);
define('MAX_YEARS', 7);
define('MIN_SUM', 1000);
$amount = "";
$years = "";
$procentTerm = "";
if (!empty($_POST)) {
    $amount = $_POST['amount'];
    $years = $_POST['rat'];
    $procentTerm = $_POST['term'];
    if (($amount == "" or $years == "" or $procentTerm == "")) {
        echo "<br> Пожалуйста, заполните все поля!";
    }
}
$errors = [];
if (!empty($_POST)) {
    if ($years < MIN_YEARS or $years > MAX_YEARS) {
        $errors[] = "Срок кредитования от 1 до 7 лет.";
    }
    if ($procentTerm < MIN_PROCENT or $procentTerm > MAX_PROCENT) {
        $errors[] = "Процент первоначального взноса от 0% до 100%";
    }
    if ($amount < MIN_SUM) {
        $errors[] = "Минимальная сумма 1000 грн.";
    }
    foreach ($errors as $item) {
        echo "<br> $item";
    }
    $month = 1;
    $procentYear = 1;
    switch ($years) {
        case 1:
            $procentYear = $amount * PROC_1_YEARS / 100 * $years;
            $month = 12;
            break;
        case 2:
            $procentYear = $amount * PROC_2_YEARS / 100 * $years;
            $month = 24;
            break;
        case 3:
            $procentYear = $amount * PROC_3_YEARS / 100 * $years;
            $month = 36;
            break;
        case 4:
            $procentYear = $amount * PROC_4_YEARS / 100 * $years;
            $month = 48;
            break;
        case 5:
            $procentYear = $amount * PROC_5_YEARS / 100 * $years;
            $month = 72;
            break;
        case 6:
            $procentYear = $amount * PROC_6_YEARS / 100 * $years;
            $month = 84;
            break;
        case 7:
            $procentYear = $amount * PROC_7_YEARS / 100 * $years;
            $month = 96;
            break;
    }
    $payoffAll = $amount + $procentYear - $procentTerm;
    $payoffMonth = $payoffAll / $month;
    Echo "<br>Ваша оплата: $payoffAll <br>";
    if ($month >= 12) {
        for ($i = 1; $i <= $month; $i++) {
            $balance = $payoffAll - $payoffMonth;
            echo "Месяц $i , ваша оплата составляет: " . $payoffMonth . " гривен. <br> Осталось оплатить:   $balance";
            echo "<br>";
        }
    }
}

?>
