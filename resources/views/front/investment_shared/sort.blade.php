<div id="sortList" class="row form-group pt-3 pb-3 border-bottom">
    <label for="filtr-sort" class="col-1 m-0 d-flex align-items-center">Sortuj po</label>
    <select name="sort" id="filtr-sort" class="col-2 form-control form-control-sm">
        <option value="">domyślnie</option>
        <option value="rooms:asc" @if(request()->input('sort') == "rooms:asc") selected @endif>ilości pokoi: rosnąco</option>
        <option value="rooms:desc" @if(request()->input('sort') == "rooms:desc") selected @endif>ilości pokoi: malejąco</option>
        <option value="area:asc" @if(request()->input('sort') == "area:asc") selected @endif>powierzchni: od najmniejszej</option>
        <option value="area:desc" @if(request()->input('sort') == "area:desc") selected @endif>powierzchni: od największej</option>
    </select>

    <div class="col-9 d-flex justify-content-end align-items-center">
        <div class="view">
            <span id="grid"><i class="las la-border-none"></i> Siatka</span>
            <span id="list" class="active"><i class="las la-th-list"></i> Lista</span>
        </div>
    </div>
</div>
