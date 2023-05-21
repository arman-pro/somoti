<form action="{{route('share-sale.update', ['share_sale' => $shareSale->id])}}" id="update-share-sale" method="post">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="date">@lang('Date')*</label>
                    <div class="input-group date" id="updateJoinDatePicker" data-target-input="nearest">
                        <input type="text" name="date" value="{{printDateFormat($shareSale->date)}}" placeholder="@lang('Date')" data-toggle="updateJoinDatePicker" id="date"  class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input" data-target="#updateJoinDatePicker" required/>
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
                                <option value="{{$member->id}}" @if($member->id == $shareSale->member_id) selected @endif >{{$member->name}}</option>
                            @empty
                            @endforelse
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="vouchar_no">@lang('Vouchar No')</label>
                    <input type="text" name="vouchar_no" readonly value="{{$shareSale->vouchar_no}}" id="vouchar_no" placeholder="@lang('vouchar_no')" class="form-control form-control-sm" />
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="amount">@lang('Amount')*</label>
                    <input type="number" name="amount" value="{{$shareSale->amount}}" id="amount" min="0" step="any" placeholder="@lang('Amount')" class="form-control form-control-sm" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 col-sm-12">
                    <label for="comment">@lang('Comment')</label>
                    <textarea name="comment" id="comment" class="form-control form-control-sm " cols="30" rows="2" placeholder="@lang('Comment')">{{$shareSale->comment}}</textarea>
                </div>
            </div> 
            <div class="form-group">
                <button class="btn btn-sm btn-success" type="submit">@lang('Save')</button>
            </div>
        </div>
    </div>
</form>