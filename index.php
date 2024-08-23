<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثانوية تل الذهب - البحث عن النتائج</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e9ecef; /* خلفية بلون رمادي فاتح */
            text-align: center; /* توسيط النصوص */
            direction: rtl; /* الكتابة من اليمين لليسار */
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff; /* خلفية بيضاء للنافذة */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6; /* إطار رفيع */
        }
        .header {
            margin-bottom: 30px;
        }
        .header img {
            width: 120px; /* تصغير حجم الشعار */
            height: auto;
            margin-bottom: 15px;
        }
        .header h1 {
            color: #ffca28; /* لون أصفر عصري */
            font-size: 36px;
            font-weight: 700; /* خط عريض */
            margin: 10px 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* تأثير ظل خفيف للنص */
        }
        .search-form {
            background-color: #f8f9fa; /* خلفية خفيفة للفورم */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .search-form h2 {
            font-size: 28px;
            color: #343a40; /* لون نص داكن */
            margin-bottom: 20px;
        }
        .search-form label {
            display: block;
            font-size: 18px;
            margin: 10px 0;
            text-align: center; /* توسيط النصوص */
            color: #495057; /* لون رمادي داكن للنصوص */
        }
        .search-form input[type="text"],
        .search-form select {
            font-size: 16px;
            padding: 12px;
            border: 2px solid #007bff; /* لون أزرق زاهي */
            border-radius: 6px;
            width: 100%;
            max-width: 400px;
            margin: 10px auto;
            display: block;
            box-sizing: border-box;
            transition: border-color 0.3s; /* تأثير تغيير لون الحدود */
        }
        .search-form input[type="text"]:focus,
        .search-form select:focus {
            border-color: #0056b3; /* لون أزرق داكن عند التركيز */
            outline: none;
        }
        .search-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s; /* تأثير تغيير لون الخلفية */
        }
        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            .header h1 {
                font-size: 28px;
            }
            .search-form h2 {
                font-size: 22px;
            }
            .search-form label,
            .search-form input[type="text"],
            .search-form select,
            .search-form input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://b.top4top.io/p_3157xsxjq1.png" alt="شعار المدرسة">
            <h1>ثانوية تل الذهب</h1>
        </div>

        <div class="search-form">
            <h2>البحث عن نتائج الطالب</h2>
            <form action="search.php" method="get">
                <label for="student_name">اسم الطالب الثلاثي:</label>
                <input type="text" id="student_name" name="student_name" required>
                
                <label for="grade">الصف:</label>
                <select id="grade" name="grade" required>
                    <option value="الأول متوسط">الأول متوسط</option>
                    <option value="الثاني متوسط">الثاني متوسط</option>
                    <option value="الثالث متوسط">الثالث متوسط</option>
                    <option value="الرابع العلمي">الرابع العلمي</option>
                    <option value="الرابع الأدبي">الرابع الأدبي</option>
                    <option value="الخامس العلمي">الخامس العلمي</option>
                    <option value="الخامس الأدبي">الخامس الأدبي</option>
                    <option value="السادس العلمي">السادس العلمي</option>
                    <option value="السادس الأدبي">السادس الأدبي</option>
                </select>
                
                <input type="submit" value="بحث">
            </form>
        </div>
    </div>
</body>
</html>
