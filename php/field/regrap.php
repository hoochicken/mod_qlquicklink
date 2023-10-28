<?php

$src = __DIR__ . '/fa-raw-glyph.txt';
$dest = __DIR__ . '/fa-glyph.txt';
$raw = file_get_contents($src);
$raw = strip_tags($raw, ['i', 'span']);
$fas = explode("\r\n\r\n", $raw);
array_walk($fas, function(&$item) { $item = trim(str_replace('  ', ' ', $item)); });
// $fas = array_filter($fas, function($item) { return str_contains($item, 'content:') && !str_contains($item, '/* Font Awesome uses the Unicode Private'); });
$fas = array_filter($fas, function($item) { return str_contains($item, 'i class="fa') || str_contains($item, 'muted'); });
array_walk($fas, function(&$item) {
    if (str_contains($item, 'i class')) {
        $item = trim(substr($item, strrpos($item, ' ')));
    }
    if (str_contains($item, 'text-muted')) {
        $item = trim(substr($item, strpos($item, '#') + 1));
        $item = trim(substr($item, 0, strrpos($item, ';')));
    }
});
$fasNew = [];
$checked = [];
$fas = array_values($fas);
$keyPrev = 0;
$typePrev = 'class';
foreach ($fas as $key => $value) {
    $type = str_contains($value, 'fa') ? 'class' : 'glyph';
    if ('class' === $type) {
        $fasNew[$key] = $value;
        $keyPrev = $key;
        continue;
    }
    if (isset($checked[$keyPrev]) && $checked[$keyPrev]) {
        continue;
    }
    $fasNew[$keyPrev] .= ' ' . str_replace('\\', '', $value);
    $checked[$keyPrev] = true;
}
$fas = array_filter($fasNew, function($item) { return str_starts_with($item, 'fa'); });
$resultGlyph = [];
foreach ($fas as $value) {
    $info = array_values(array_filter(explode(' ', $value)));
    if (!isset($info[1])) {
        continue;
    }
    $resultGlyph[$info[0]] = $info[1];
}

file_put_contents($dest, implode("\n", $fas));

$src = __DIR__ . '/fa-raw-joomla.txt';
$dest = __DIR__ . '/fa-joomla.txt';
$raw = file_get_contents($src);
$fas = explode("\r\n\r\n", $raw);
$fas = array_filter($fas, function($item) { return str_contains($item, 'content:') && !str_contains($item, '/* Font Awesome uses the Unicode Private'); });
array_walk($fas, function(&$item) { $item = trim(str_replace(['.', ':before', '{', '}', 'content:', ';', '"', "\r", "\n", '\\', ], '', $item)); });
array_walk($fas, function(&$item) { $item = trim(str_replace('  ', ' ', $item)); });
$resultJoomla = [];
foreach ($fas as $value) {
    $info = array_values(array_filter(explode(' ', $value)));
    $resultJoomla[$info[0]] = $info[1];
}

$dest = __DIR__ . '/fa.txt';
file_put_contents($dest, implode("\n", $fas));
array_walk($resultJoomla, function (&$item, $faName) use ($resultGlyph) {
    $item = !isset($resultGlyph[$faName])
        ? $faName
        : $faName . ' ' . $resultGlyph[$faName];
    $item = $item;
});
file_put_contents($dest, implode("\n", $resultJoomla));
echo 'fa-file was regrapped';
