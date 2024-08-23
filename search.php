<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// مسار ملف Excel
$file = 'data.xlsx'; // تأكد من صحة المسار والاسم

if (!file_exists($file)) {
    die('الملف غير موجود.');
}

$spreadsheet = IOFactory::load($file);

// التحقق من وجود البيانات المطلوبة
$student_name = $_GET['student_name'] ?? '';
$grade = $_GET['grade'] ?? '';

if (empty($student_name) || empty($grade)) {
    die('الرجاء تقديم اسم الطالب وصف البحث.');
}

// التحقق من وجود ورقة العمل
$sheet = $spreadsheet->getSheetByName($grade);

if (!$sheet) {
    die('اسم ورقة العمل غير صحيح: ' . htmlspecialchars($grade));
}

$results = [];
$rows = $sheet->toArray();
foreach ($rows as $row) {
    if ($row[0] === $student_name) {
        $results = $row;
        break;
    }
}

if (!$results) {
    $status = 'لم يتم العثور على نتائج للطالب.';
} else {
    // حساب الحالة
    $failures = 0;
    $total_subjects = count($results) - 2; // استبعاد اسم الطالب والمجموع
    $pass_threshold = 50;
    $status = 'ناجح'; // افتراضي

    for ($i = 1; $i <= $total_subjects; $i++) {
        if ($results[$i] < $pass_threshold) {
            $failures++;
        }
    }

    if ($failures >= 4) {
        $status = 'راسب';
    } elseif ($failures >= 1) {
        $status = 'مكمل';
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتائج امتحانات نصف السنة</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
            height: auto;
        }
        .header h1 {
            color: #f4c542; /* لون أصفر حديث */
            font-size: 28px;
            margin: 10px 0;
        }
        .student-info {
            margin-bottom: 20px;
        }
        .student-info p {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            direction: rtl; /* الترتيب من اليمين إلى اليسار */
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: right; /* النص موجه لليمين */
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
        td.red {
            background-color: #f8d7da; /* أحمر فاتح */
            color: #721c24;
        }
        td.total {
            background-color: #cce5ff; /* لون الأزرق الفاتح للمجموع */
            font-weight: bold;
        }
        td.average {
            background-color: #d4edda; /* لون الأخضر الفاتح للمعدل */
            font-weight: bold;
        }
        .footer {
            text-align: left;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #007bff; /* لون أزرق جميل */
        }
        .note {
            font-size: 14px;
            color: #dc3545; /* لون أحمر للنص */
            margin-top: 20px;
        }
        .status {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        .status.success {
            color: #28a745; /* أخضر */
        }
        .status.warning {
            color: #ffc107; /* أخضر فاتح */
        }
        .status.fail {
            color: #dc3545; /* أحمر */
        }
        @media (max-width: 600px) {
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://b.top4top.io/p_3157xsxjq1.png" alt="شعار المدرسة">
            <h1>ثانوية تل الذهب المختلطة</h1>
        </div>

        <div class="student-info">
            <h2>نتائج امتحانات نصف السنة للعام الدراسي 2024-2025</h2>
            <p><?php echo htmlspecialchars($student_name); ?></p>
        </div>

        <?php if ($results): ?>
            <table>
                <thead>
                    <tr>
                        <th>المادة</th>
                        <th>الدرجة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // مواد حسب الصف
                    $subjects = [
                        'الأول متوسط' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الرياضيات', 'الفيزياء', 'الأحياء', 'الكيمياء', 'الاجتماعيات', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'الثاني متوسط' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الرياضيات', 'الفيزياء', 'الأحياء', 'الكيمياء', 'الاجتماعيات', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'الثالث متوسط' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الرياضيات', 'الفيزياء', 'الأحياء', 'الكيمياء', 'الاجتماعيات', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'الرابع العلمي' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الكردية', 'الرياضيات', 'الأحياء', 'الكيمياء', 'الفيزياء', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'الرابع الأدبي' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الكردية', 'الرياضيات', 'التاريخ', 'الجغرافية', 'الاجتماع', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'الخامس العلمي' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الكردية', 'الرياضيات', 'الفيزياء', 'الأحياء', 'الكيمياء', 'علم الارض', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'الخامس الأدبي' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الكردية', 'التاريخ', 'الجغرافية', 'الرياضيات', 'الفلسفة', 'الاقتصاد', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'السادس العلمي' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'الرياضيات', 'الفيزياء', 'الأحياء', 'الكيمياء', 'الرياضة', 'الفنية', 'المجموع', 'المعدل'],
                        'السادس الأدبي' => ['الاسلامية', 'اللغة العربية', 'اللغة الانكليزية', 'التاريخ', 'الجغرافية', 'الرياضيات', 'الاقتصاد', 'الرياضة', 'الفنية', 'المجموع', 'المعدل']
                    ];

                    foreach ($subjects[$grade] as $index => $subject) {
                        $score = $results[$index + 1] ?? '';
                        $class = '';

                        // تخصيص لون النتائج الأقل من 50
                        if ($subject != 'المجموع' && $subject != 'المعدل' && $score < 50) {
                            $class = 'red';
                        } elseif ($subject == 'المجموع') {
                            $class = 'total';
                        } elseif ($subject == 'المعدل') {
                            $class = 'average';
                        }

                        echo "<tr><td>$subject</td><td class='$class'>$score</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="status <?php echo ($status == 'ناجح') ? 'success' : ($status == 'مكمل' ? 'warning' : 'fail'); ?>">
                حالة الطالب: <?php echo htmlspecialchars($status); ?>
            </div>

        <?php endif; ?>

        <div class="note">
            (هذه النتيجة لا تعتبر وثيقة رسمية ولا يمكن الأخذ بها في الدوائر الحكومية)
        </div>

          <div class="footer">
                مدير المدرسة: ذياب علي خلف
            </div>
    </div>
</body>
</html>
