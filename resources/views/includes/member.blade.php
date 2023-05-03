<div class="card">
    <div class="card-header">
        <h4 class="card-title">@lang('Member Details')</h4>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    <th>@lang("Name")</th>
                    <td>{{$member->name}}</td>
                </tr>
                <tr>
                    <th>@lang('Branch')</th>
                    <td>{{$member->group->area->branch->name}}</td>
                </tr>
                <tr>
                    <th>@lang('Area')</th>
                    <td>{{$member->group->area->name}}</td>
                </tr>
                <tr>
                    <th>@lang('Group')</th>
                    <td>{{$member->group->name}}</td>
                </tr>
                <tr>
                    <th>@lang('Member ID')</th>
                    <td>{{$member->member_no}}</td>
                </tr>
                <tr>
                    <th>@lang('Account')</th>
                    <td>{{$member->account}}</td>
                </tr>
                <tr>
                    <th>@lang('Mobile')</th>
                    <td>{{$member->mobile ?? "N/A"}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>