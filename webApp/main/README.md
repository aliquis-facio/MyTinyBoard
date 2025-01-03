# 웹페이지 만들기
1. mypage.php 만들기
1. SQL 연결하는 부분 prepare statement 적용하기
1. 입력할 수 있는 곳 html entity로 치환하기

## outer
### new_home.php
#### 소개
홈페이지이자 게시판 페이지
#### 할 일
1. 게시글 페이지네이션 적용하기
1. 게시글 정렬 기능 적용하기
1. index.php로 파일명 바꾸기

### mypage.php
#### 소개
내 정보를 확인 및 변경

### sign_in.php
#### 소개
로그인 페이지

### sign_up.php
#### 소개
회원가입 페이지

### find_id.php
#### 소개
아이디 찾기 페이지

### find_pw.php
#### 소개
비밀번호 찾기 페이지

### write.php
#### 소개
게시글 작성 페이지
#### 할 일
1. post_write.php로 파일명 바꾸기

### view.php
#### 소개
게시글 보는 페이지
#### 할 일
1. write.php에서 textarea로 받아서 저장된 post의 내용이 div에서는 줄바꿈이 안 됨
1. post_view.php로 파일명 바꾸기
1. 내가 쓴 댓글 수정, 삭제할 수 있게 하기

### post_modify.php
#### 소개
내가 작성한 게시글 수정 페이지

### sb_post_list.php
#### 소개
특정 유저의 작성글들을 볼 수 있는 페이지

### score_board.php
#### 소개

## inner
### error_report.php
#### 소개
php code error 발생 시 error 띄움

### sql_connect.php
#### 소개

### create_select_sql.php
#### 소개

### user_session.php
#### 소개
user의 session을 생성함

### login_proc.php
#### 소개

### regist_proc.php
#### 소개

### logout.php
#### 소개
현재 user session 삭제함

### find_id_proc.php
#### 소개

### get_id.php
#### 소개

### find_pw_proc.php
#### 소개

### post_write_proc.php
#### 소개

### num_of_post.php
#### 소개
조건에 따른 게시글의 개수를 반환함

### modify_post_proc.php
#### 소개
사용자가 수정한 게시글을 DB에서 수정함

### delete_post.php
#### 소개
게시글을 DB에서 삭제함

### sb_num_of_list.php
#### 소개

### coment_write.php
#### 소개
작성한 댓글을 DB와 연결, 저장함

# 참고
1. <https://developer.mozilla.org/ko/docs/Web/CSS/Class_selectors>
2. <https://www.tcpschool.com/html-tags/b>
3. <https://inpa.tistory.com/entry/CSS-%F0%9F%92%8D-%EB%A1%9C%EA%B7%B8%EC%9D%B8-%ED%9A%8C%EC%9B%90%EA%B0%80%EC%9E%85-%ED%8E%98%EC%9D%B4%EC%A7%80-%EC%8A%A4%ED%83%80%EC%9D%BC-%F0%9F%96%8C%EF%B8%8F-%EB%AA%A8%EC%9D%8C#thankYou>
4. <https://www.opentutorials.org/course/1688/9351>
5. <https://hianna.tistory.com/474>
6. <https://www.freecodecamp.org/korean/news/css-font-color-how-to-style-text-in-html/>
7. <https://velog.io/@nalsae/%EB%82%B4%EB%B3%B4%EC%A0%95CSS-%EB%AA%A8%EB%A5%B4%EB%A9%B4-%EA%B3%A4%EB%9E%80%ED%95%9C-box-sizing>