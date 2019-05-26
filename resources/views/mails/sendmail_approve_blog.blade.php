<p>Hi, {{ $blog->user->name }}</p>
<p>Đây là mail thông báo kết quả kiểm duyệt bài đăng mà bạn đã đăng tải lên hệ thống Ask-me</p>
<p>Tiêu đề bài đăng: {{ $blog->title }}</p>
<p>Loại : {{ \App\Models\Blog::$type[$blog->type] }}</p>
<p>Thời gian tạo: {{ $blog->created_at }}</p>
<p>Nội dung: {{$blog->description}}</p>
@if ($blog->approve_status == 1)
    <p>Câu hỏi của bạn đã được : <span style="color: blue">{{ \App\Models\Question::$approveStatus[$blog->approve_status] }}</span></p>
@else
    <p>Câu hỏi của bạn đã bị : <span style="color: red">{{ \App\Models\Question::$approveStatus[$blog->approve_status] }}</span></p>
@endif
<p>Người kiểm duyệt: {{ $blog->verifyAuthor->name }}</p>
<p>Thời gian kiểm duyệt: {{ $blog->verified_at }}</p>
<p>Lời nhắn từ admin: {{$blog->note}}</p>
<p>Thông tin và thắc mắc, xin liên hệ lại với chúng tôi.</p>
<p>Hệ thống Ask-me cảm ơn quý khách đã sử dụng. Chúc quý khách có những trải nghiệm tốt nhất!</p>
