<p>Hi, {{ $blog->user->name }}</p>
<p>Đây là mail thông báo thông báo xoá bài đăng mà bạn đã đăng tải lên hệ thống Ask-me</p>
<p>Bài đăng: {{ $blog->title }}</p>
<p>Thời gian tạo: {{ $blog->created_at }}</p>
<p>Loại: {{\App\Models\Blog::$type[$blog->type]}}</p>
<p>Nội dung: {{ $blog->description }}</p>
@if ($blog->approve_status == 1)
    <p>Trạng thái kiểm duyệt : <span style="color: blue">{{ \App\Models\Question::$approveStatus[$blog->approve_status] }}</span></p>
@elseif ($blog->approve_status == 2)
    <p>Trạng thái kiểm duyệt : <span style="color: red">{{ \App\Models\Question::$approveStatus[$blog->approve_status] }}</span></p>
@else
    <p>Trạng thái kiểm duyệt : <span style="color: greenyellow">{{ \App\Models\Question::$approveStatus[$blog->approve_status] }}</span></p>
@endif
<h3>Bài đăng của bạn tạm thời bị xoá khỏi hệ thống Ask-me</h3>
<p>Thời gian xoá: {{$blog->deleted_at}}</p>
<p>Lí do: {{ $blog->delete_reason }}</p>
<p>Thông tin và thắc mắc, xin liên hệ lại với chúng tôi.</p>
<p>Hệ thống Ask-me cảm ơn quý khách đã sử dụng. Chúc quý khách có những trải nghiệm tốt nhất!</p>
