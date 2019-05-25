<div class="modal" id="modal-confirm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="modal-label">確認</h4>
            </div>
            <div class="modal-body">選択した情報を削除します。よろしいですか？</div>
            <div class="modal-footer">
                <form class="form-confirm" method="post">
                    <input type="hidden" name="_method" value="delete" />
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary remove-record">削除実行</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('inline_scripts')
    <script>
        $('#modal-confirm').on('shown.bs.modal', function(e){

        });
    </script>
@endsection
