<!DOCTYPE html>

<html>
    <head>
        <title>index</title>
        <meta content="charset=utf-8">
    </head>

    <body>
        <h1>Index</h1>
        <h2>학생 테이블</h2>
        <form action="./student.php" method="post">
            <input name = "id" type="text" placeholder = "학번">
            <input name = "name" type="text" placeholder = "이름">
            <input name = "grade" type="text" placeholder = "학년">
            <input name = "department" type="text" placeholder = "학과">
            <button>등록</button>
        </form>
        
        <h2>과목 테이블</h2>
        <form action="./subject.php" method="post">
            <input name = "course_number" type="text" placeholder = "학수번호">
            <input name = "subject" type="text" placeholder = "과목명">
            <input name = "credit" type="text" placeholder = "학점">
            <input name = "department2" type="text" placeholder = "학과">
            <input name = "professor" type="text" placeholder = "담당교수">
            <button>등록</button>
        </form>
        
        <h2>등록 테이블</h2>
        <form action="./registration.php" method="post">
            <input name = "id2" type="text" placeholder = "학번">
            <input name = "course_number2" type="text" placeholder = "학수번호">
            <input name = "score" type="text" placeholder = "성적">
            <input name = "midterm_exam" type="text" placeholder = "중간시험">
            <input name = "final_exam" type="text" placeholder = "기말시험">
            <button>등록</button>
        </form>

        <h2>쿼리</h2>
        <form action="./result.php" method="POST">
            <textarea name="query" type="text" rows="4" cols="50" placeholder="쿼리"></textarea>
            <button>등록</button>
        </form>
    </body>
</html>