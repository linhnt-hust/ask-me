<p>Hi, {{ $question->user->name }}</p>
<p>Đây là mail thông báo thông báo xoá câu hỏi mà bạn đã đăng tải lên hệ thống Ask-me</p>
<p>Câu hỏi: {{ $question->title }}</p>
<p>Thời gian tạo: {{ $question->created_at }}</p>
<p>Nội dung: {{$question->details}}</p>
@if ($question->approve_status == 1)
    <p>Trạng thái kiểm duyệt : <span style="color: blue">{{ \App\Models\Question::$approveStatus[$question->approve_status] }}</span></p>
@elseif ($question->approve_status == 2)
    <p>Trạng thái kiểm duyệt : <span style="color: red">{{ \App\Models\Question::$approveStatus[$question->approve_status] }}</span></p>
@else
    <p>Trạng thái kiểm duyệt : <span style="color: yellow">{{ \App\Models\Question::$approveStatus[$question->approve_status] }}</span></p>
@endif
<h3>Câu hỏi của bạn tạm thời bị xoá khỏi hệ thống Ask-me</h3>
<p>Thời gian xoá: {{$question->deleted_at}}</p>
<p>Lí do: {{ $question->delete_reason }}</p>
<p>Thông tin và thắc mắc, xin liên hệ lại với chúng tôi.</p>
<p>Hệ thống Ask-me cảm ơn quý khách đã sử dụng. Chúc quý khách có những trải nghiệm tốt nhất!</p>
