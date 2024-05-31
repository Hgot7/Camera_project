<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colorful Words</title>
    <style>
        .word1 { color: red; }
        .word2 { color: green; }
        .word3 { color: blue; }
    </style>
</head>
<body>
    <?php
    // ตัวอย่าง array ที่มีคำ 3 คำ
    $words = ["คำแรก", "คำที่สอง", "คำที่สาม"];

    // การแสดงคำใน tag <p> โดยใช้สีที่แตกต่างกัน
    echo '<p>';
    echo '<span class="word1">' . $words[0] . '</span> ';
    echo '<span class="word2">' . $words[1] . '</span> ';
    echo '<span class="word3">' . $words[2] . '</span>';
    echo '</p>';
    ?>
</body>
</html>
