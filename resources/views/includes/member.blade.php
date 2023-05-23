<div class="card {{$shadow ?? ''}} @if(isset($collapsed) && $collapsed) collapsed-card @else expanded-card @endif">
    <div class="card-header {{$bg ?? ''}}">
        <h4 class="card-title">@lang('Member Details')</h4>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                @if(isset($collapsed) && $collapsed)
                    <i class="fas fa-minus"></i>
                @else 
                    <i class="fas fa-plus"></i>
                @endif
                
            </button>
        </div>
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
                <tr>
                    <th>@lang('Savings Amount')</th>
                    <td>{{number_format(($member->saving_amount - $member->saving_withdraw_amount), 2)}}</td>
                </tr>
                <tr>
                    <th>@lang('Loan Amount')</th>
                    <td>{{number_format($member->loan_amount ?? 0, 2)}}</td>
                </tr>
                <tr>
                    <th>@lang('DPS Amount')</th>
                    <td>{{number_format(($member->dps_deposit - $member->dps_withdraw) ?? 0, 2)}}</td>
                </tr>
                <tr>
                    <th>@lang('FDR Amount')</th>
                    <td>{{number_format(($member->fdr_amount - $member->fdr_amount_withdraw) ?? 0, 2)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>