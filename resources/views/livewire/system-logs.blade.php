<div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="page-title-box"> 
                <h4 class="page-title">System Logs</h4> 
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Date Time</th>
                        <th scope="col">Error Code</th>
                        <th scope="col">Details</th>
                        <th scope="col">From</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\system_logs::orderBy('id', 'desc')->limit(20)->get() as $key => $lists)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$lists->created_at->diffForHumans()}}</td>
                        <td>{{$lists->error_code}}</td>
                        <td>{{$lists->error_details}}</td>
                        <td>{{$lists->error_from}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
