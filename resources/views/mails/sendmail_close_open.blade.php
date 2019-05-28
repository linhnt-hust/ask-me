<p>Hi, {{ $followUser->name }}</p>
<p>Đây là mail thông báo cập nhật câu hỏi mà bạn đã follow gần đây trên hệ thống Ask-me</p>
<p>Câu hỏi: {{ $question->title }}</p>
<p>Thời gian tạo: {{ $question->created_at }}</p>
<p>Nội dung: {{$question->details}}</p>
@if ($question->is_solved == 1)
    <p>Câu hỏi này đã được <span style="color: red">ĐÓNG</span> bởi chủ câu hỏi.</p>
@else
    <p>Câu hỏi này đã được <span style="color: blue">MỞ LẠI</span> bởi chủ câu hỏi.</p>
@endif
<p>Xem thông tin chi tiết câu hỏi: <a href="{{ route('question.show', $question->id) }}">Tại đây.</a></p>
<p>Thông tin và thắc mắc, xin liên hệ lại với chúng tôi.</p>
<p>Hệ thống Ask-me cảm ơn quý khách đã sử dụng. Chúc quý khách có những trải nghiệm tốt nhất!</p>
