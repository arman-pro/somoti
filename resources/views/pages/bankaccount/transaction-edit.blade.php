<form action="{{ route('bank-account.transaction.store') }}" method="post" id="add-new-transaction">
    @csrf @method('UPDATE')
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Edit Transaction')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="joinDate">@lang('Date')*</label>
                            <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                <input type="text" name="date" placeholder="@lang('Date')"
                                    data-toggle="joinDatePicker" id="joinDate"
                                    class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input"
                                    data-target="#joinDatePickerOne" required />
                                <div class="input-group-append" data-target="#joinDatePickerOne"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('date')
                                <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="bankAccount">@lang('Bank Account')*</label>
                            <select name="bank_account" id="bankAccount"
                                class="form-control form-control-sm @error('bank_account') is-invalid @enderror"
                                required />
                            <option value="" hidden>@lang('Select a Bank Account')</option>
                            @forelse ($bankAccounts as $bankAccount)
                                <option value="{{ $bankAccount->id }}">{{ $bankAccount->name }}
                                </option>
                            @empty
                            @endforelse
                            </select>
                            @error('bank_account')
                                <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                            @enderror
                            <p class="m-0 p-0 text-danger"><span id="show-bank-balance"></span></p>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="amount">@lang('Amount')*</label>
                            <input type="number" name="amount" placeholder="@lang('Amount')"
                                value="{{ old('amount') }}" id="amount"
                                class="form-control form-control-sm @error('amount') is-invalid @enderror "
                                required />
                            @error('amount')
                                <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                            @enderror

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">@lang('Transaction Type')</label> <br />
                            <div class="form-check-inline icheck-primary icheck-inline">
                                <input type="radio" name="transaction_type" id="deposit" value="deposit" />
                                <label for="deposit">@lang('Deposit')</label>
                            </div>
                            <div class="form-check-inline icheck-primary icheck-inline">
                                <input type="radio" name="transaction_type" value="withdraw" id="withdraw" />
                                <label for="withdraw">@lang('Withdraw')</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">@lang('Note')</label>
                        <textarea name="note" id="note" class="form-control form-control-sm @error('note') is-invalid @enderror "
                            cols="30" rows="2" placeholder="@lang('Note')">{{ old('note') }}</textarea>
                        @error('Note')
                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</form>