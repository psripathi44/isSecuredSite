
<?php

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=file.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('Column 1', 'Column 2', 'Column 3', 'Column 4'));

$list = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
);

foreach ($list as $fields) {
    fputcsv($output, $fields);
}

fclose($output);
?>
