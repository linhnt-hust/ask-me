<p>Hi, {{ $question->user->name }}</p>
<p>Đây là mail thông báo kết quả kiểm duyệt câu hỏi mà bạn đã đăng tải lên hệ thống Ask-me</p>
<p>Câu hỏi: {{ $question->title }}</p>
<p>Thời gian tạo: {{ $question->created_at }}</p>
<p>Nội dung: {{$question->details}}</p>
@if ($question->approve_status == 1)
    <p>Câu hỏi của bạn đã được : <span style="color: blue">{{ \App\Models\Question::$approveStatus[$question->approve_status] }}</span></p>
@else
    <p>Câu hỏi của bạn đã bị : <span style="color: red">{{ \App\Models\Question::$approveStatus[$question->approve_status] }}</span></p>
@endif
<p>Người kiểm duyệt: {{ $question->verifyAuthor->name }}</p>
<p>Thời gian kiểm duyệt: {{ $question->verified_at }}</p>
<p>Lời nhắn từ admin: {{$question->note}}</p>
<p>Thông tin và thắc mắc, xin liên hệ lại với chúng tôi.</p>
<p>Hệ thống Ask-me cảm ơn quý khách đã sử dụng. Chúc quý khách có những trải nghiệm tốt nhất!</p>
