<form action="{{ route('admin.input.store') }}" method="post">
    @csrf
    <div class="modal fade text-left" id="ModalCreate1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Новое Поле Ввода</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h3><strong>Подпись:</strong></h3>
                            <input type="text" class="form-control form-control-lg" name="label" id="1">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h3><strong>Имя поля</strong>(написано на англ, должно быть уникальным)</h3>
                            <input type="text" class="form-control form-control-lg" name="label" id="1">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Цвет:</strong>
                            <br>
                            <select name="type"style="width: 100%; padding:15px; font-size: 25px; border: rgba(0, 0, 0,  0.3) solid 1px" class="form-select form-select-lg mb-3">
                                <option selected value="select">Селект</option>
                                <option value="text">Строка</option>
                                <option value="textarea">Текст</option>
                                <option value="number"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

