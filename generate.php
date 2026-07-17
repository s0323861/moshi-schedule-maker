<?php

$schedules = require 'moshi_data.php';

$data = [];

foreach ($schedules as $group) {
    foreach ($group['events'] as $key => $event) {
        $data[$key] = $event;
    }
}

function escapeIcsText(string $text): string
{
    $text = str_replace('\\', '\\\\', $text);
    $text = str_replace(';', '\;', $text);
    $text = str_replace(',', '\,', $text);
    $text = str_replace(["\r\n", "\r", "\n"], '\n', $text);

    return $text;
}

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="moshi_schedule.ics"');

echo "BEGIN:VCALENDAR\r\n";
echo "VERSION:2.0\r\n";
echo "PRODID:-//Akira Mukai//Moshi Schedule Maker//JA\r\n";
echo "CALSCALE:GREGORIAN\r\n";

$tests = $_POST['tests'] ?? [];
$types = $_POST['types'] ?? [];

foreach ($tests as $test) {

    foreach ($types as $type) {

        if (!isset($data[$test][$type])) {
            continue;
        }

        $date = $data[$test][$type][0];
        $title = $data[$test][$type][1];

        // 日付未設定の場合はスキップ
        if (empty($date)) {
            continue;
        }

        $end_date = date(
            'Ymd',
            strtotime(
                substr($date,0,4) . '-' .
                substr($date,4,2) . '-' .
                substr($date,6,2) . ' +1 day'
            )
        );

        $uid = md5($test . $type);

        echo "BEGIN:VEVENT\r\n";
        echo "UID:$uid@tsukuba42195.sakura.ne.jp\r\n";
        echo "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
        echo "DTSTART;VALUE=DATE:$date\r\n";
        echo "DTEND;VALUE=DATE:$end_date\r\n";
        echo "SUMMARY:" . escapeIcsText($title) . "\r\n";
        echo "END:VEVENT\r\n";
    }
}

echo "END:VCALENDAR\r\n";