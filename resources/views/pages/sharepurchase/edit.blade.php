<form action="{{route('share-purchase.update', ['share_purchase' => $sharePurchase->id])}}" id="update-share-purchase" method="post">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="date">@lang('Date')*</label>
                    <div class="input-group date" id="updateJoinDatePicker" data-target-input="nearest">
                        <input type="text" name="date" value="{{printDateFormat($sharePurchase->date)}}" placeholder="@lang('Date')" data-toggle="updateJoinDatePicker" id="date"  class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input" data-target="#updateJoinDatePicker" required/>
                        <div class="input-group-append" data-target="#updateJoinDatePicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="update_member">@lang('Member')*</label>
                        <select name="member_id" id="update_member" class="form-control form-control-sm @error('member_id') is-invalid @enderror" required/>
                            <option value="" hidden>@lang('Select a Member')</option>
                            @forelse ($members as $member)
                                <option value="{{$member->id}}" @if($member->id == $sharePurchase->member_id) selected @endif >{{$member->name}}</option>
                            @empty
                            @endforelse
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="vouchar_no">@lang('Vouchar No')</label>
                    <input type="text" name="vouchar_no" readonly value="{{$sharePurchase->vouchar_no}}" id="vouchar_no" placeholder="@lang('vouchar_no')" class="form-control form-control-sm" />
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="amount">@lang('Amount')*</label>
                    <input type="number" name="amount" value="{{$sharePurchase->amount}}" id="amount" min="0" step="any" placeholder="@lang('Amount')" class="form-control form-control-sm" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 col-sm-12">
                    <label for="comment">@lang('Comment')</label>
                    <textarea name="comment" id="comment" class="form-control form-control-sm " cols="30" rows="2" placeholder="@lang('Comment')">{{$sharePurchase->comment}}</textarea>
                </div>
            </div> 
            <div class="form-group">
                <button class="btn btn-sm btn-success" type="submit">@lang('Save')</button>
            </div>
        </div>
    </div>
</form>

{{-- date picker --}}
{{-- <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" crossorigin="anonymous" /> --}}
{{-- date picker --}}
{{-- <script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script> --}}