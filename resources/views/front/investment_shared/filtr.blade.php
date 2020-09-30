<form method="get" class="row bg-light pt-3 pb-3" action="" id="filtr">
    <div class="col-3">
        <label for="filtr-rooms" class="w-100">Pokoje</label>
        <select name="rooms" id="filtr-rooms" class="form-control">
            <option value="">Wszystkie</option>
            <option value="1" @if(request()->input('rooms') == 1) selected @endif>1</option>
            <option value="2" @if(request()->input('rooms') == 2) selected @endif>2</option>
            <option value="3" @if(request()->input('rooms') == 3) selected @endif>3</option>
        </select>
    </div>
    <div class="col-3">
        <label for="filtr-status" class="w-100">Status</label>
        <select name="status" id="filtr-status" class="form-control">
            <option value="">Wszystkie</option>
            <option value="1" @if(request()->input('status') == 1) selected @endif>Na sprzedaż</option>
            <option value="2" @if(request()->input('status') == 2) selected @endif>Sprzedane</option>
            <option value="3" @if(request()->input('status') == 3) selected @endif>Rezerwacja</option>
        </select>
    </div>
    <div class="col-3">
        <label for="filtr-area" class="w-100">Powierzchnia</label>
        <select name="area" id="filtr-area" class="form-control">
            <option value="">Wszystkie</option>
            <option value="20:40" @if(request()->input('status') == "20:40") selected @endif>20 - 40m2</option>
            <option value="40:60" @if(request()->input('status') == "40:60") selected @endif>40 - 60m2</option>
            <option value="60:80" @if(request()->input('status') == "60:80") selected @endif>60 - 80m2</option>
        </select>
    </div>
    <div class="col-3">
        <label for="filtr-button" class="w-100">&nbsp;</label>
        <button type="submit" id="filtr-button" class="bttn bttn-center bttn-sm w-100">SZUKAJ</button>
    </div>
</form>
