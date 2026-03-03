@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')

<div class="card">
    <div class="card-header">
        Edit Dynamic Email
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.dynamic-email.update', $dynamicEmail->id) }}">
            @csrf
            @method('PUT') 

            <!-- To Emails Section -->
            <div class="form-group">
                <label for="toEmails">To*</label>
                <div id="toEmailContainer">
                    @php
                        $toEmails = explode(',', $dynamicEmail->to_emails);
                    @endphp
                    @foreach($toEmails as $index => $toEmail)
                        <div class="input-group mb-2">
                            <input type="email" name="toEmails[]" class="form-control" placeholder="Enter To" value="{{ old('toEmails.' . $index, $toEmail) }}" required>
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-input">Remove</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm addToEmail">Add More</button>
            </div>

            <!-- CC Emails Section -->
            <div class="form-group">
                <label for="ccEmails">CC</label>
                <div id="ccEmailContainer">
                    @php
                        $ccEmails = explode(',', $dynamicEmail->cc_emails);
                    @endphp
                    @foreach($ccEmails as $index => $ccEmail)
                        <div class="input-group mb-2">
                            <input type="email" name="ccEmails[]" class="form-control" placeholder="Enter CC" value="{{ old('ccEmails.' . $index, $ccEmail) }}">
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-input">Remove</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm addCcEmail">Add More</button>
            </div>

            <!-- BCC Emails Section -->
            <div class="form-group">
                <label for="bccEmails">BCC</label>
                <div id="bccEmailContainer">
                    @php
                        $bccEmails = explode(',', $dynamicEmail->bcc_emails);
                    @endphp
                    @foreach($bccEmails as $index => $bccEmail)
                        <div class="input-group mb-2">
                            <input type="email" name="bccEmails[]" class="form-control" placeholder="Enter BCC" value="{{ old('bccEmails.' . $index, $bccEmail) }}">
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-input">Remove</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm addBccEmail">Add More</button>
            </div>

            <!-- Email Types Section -->
            <div class="form-group">
                <label for="emailTypes">Email Types*</label>
                <div id="emailTypeContainer">
                    @php
                        $emailTypes = explode(',', $dynamicEmail->email_types);
                    @endphp
                    @foreach($emailTypes as $index => $emailType)
                        <div class="input-group mb-2">
                            <input type="text" name="emailTypes[]" class="form-control" placeholder="Enter Email Type" value="{{ old('emailTypes.' . $index, $emailType) }}" required>
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-input">Remove</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm addEmailType">Add More</button>
            </div>

            <!-- Form Type Section -->
            <div class="form-group">
                <label for="form_type_id">Form Type</label>
                <select name="form_type_id[]" class="form-control" multiple>
                    @foreach($formTypes as $formType)
                        <option value="{{ $formType->id }}" 
                            @if(in_array($formType->id, explode(',', $dynamicEmail->form_type_id))) 
                                selected 
                            @endif>
                            {{ $formType->form_type_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function addEmailField(containerId, inputName, type = 'email') {
            const container = document.getElementById(containerId);
            const newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');

            newInput.innerHTML = `  
                <input type="${type}" name="${inputName}[]" class="form-control" placeholder="Enter ${type === 'email' ? 'Email' : 'Text'}" required>
                <button type="button" class="btn btn-danger remove-input">Remove</button>
            `;

            container.appendChild(newInput);
        }

        document.querySelector('.addToEmail').addEventListener('click', function () {
            addEmailField('toEmailContainer', 'toEmails');
        });

        document.querySelector('.addCcEmail').addEventListener('click', function () {
            addEmailField('ccEmailContainer', 'ccEmails');
        });

        document.querySelector('.addBccEmail').addEventListener('click', function () {
            addEmailField('bccEmailContainer', 'bccEmails');
        });

        document.querySelector('.addEmailType').addEventListener('click', function () {
            addEmailField('emailTypeContainer', 'emailTypes', 'text');
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-input')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>

@endsection
