<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('Savings Details')</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th>@lang('Date')</th>
                            <td>{{printDateFormat($saving->date)}}</td>
                            <th>@lang("Voucher No")</th>
                            <td>{{$saving->voucher_no}}</td>
                        </tr>
                        <tr>
                            <th>@lang('Amount')</th>
                            <td>{{$saving->amount}}</td>
                            <th>@lang("Comment")</th>
                            <td>{{$saving->comment}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        @include('includes.member', ['member' => $saving->member])
    </div>
</div>