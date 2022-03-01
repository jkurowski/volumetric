<div class="container">
    <div id="sortList" class="row form-group pt-3 pb-3 border-bottom">
        <div class="col-3">
            <div class="row">
                <div class="col-8">
                    <select name="sort" id="filtr-sort">
                        <option value="">Domyślne sortowanie</option>
                        <option value="rooms:asc" @if(request()->input('sort') == "rooms:asc") selected @endif>ilości pokoi: rosnąco</option>
                        <option value="rooms:desc" @if(request()->input('sort') == "rooms:desc") selected @endif>ilości pokoi: malejąco</option>
                        <option value="area:asc" @if(request()->input('sort') == "area:asc") selected @endif>powierzchni: od najmniejszej</option>
                        <option value="area:desc" @if(request()->input('sort') == "area:desc") selected @endif>powierzchni: od największej</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-9 d-flex justify-content-end align-items-center">
            <div class="view">
                <span id="grid"><i class="las la-th-large"></i> Siatka</span>
                <span id="list" class="active"><i class="las la-list"></i> Lista</span>
            </div>
        </div>
    </div>

</div>
