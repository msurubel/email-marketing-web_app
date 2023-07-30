<div class="row">
    {{request()->userAgent()}}
    <form action="{{route('submit_test_form')}}" method="POST">
    @csrf
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="example-fileinput" class="form-label">Choos a .csv file</label>
                <input type="file" name="file" id="example-fileinput" class="form-control">
            </div>
            <div class="mb-3">
                <select id="inputState" class="form-select" name="importinggroup" required>
                    <option value="">Select Subscriber Group</option>
                    @foreach(\App\Models\subscribe_groups::wherestatus("active")->get() as $lists)
                    <option value="{{$lists->id}}">{{$lists->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-12">
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Submit</button>
        </div>
    </form>
</div>