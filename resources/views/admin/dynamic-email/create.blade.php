@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        Create Dynamic Email
    </div>

    <div class="card-body">
        <form action="{{ route('admin.dynamic-email.store') }}" method="POST" id="emailForm">
            @csrf
        
            <div class="row mb-3">
                <div class="col-12">
                    <h4>Dynamic Email</h4>
                </div>
            </div>
        
            <div id="dynamicEmailFormsContainer">
                <div class="dynamicEmailForm">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>To*</h5>
                            <div id="toEmailContainer">
                                <div class="input-group mb-2">
                                    <input type="email" name="toEmails[0][]" class="form-control" placeholder="Enter To" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm addToEmail">Add More</button>
                        </div>
        
                        <div class="col-md-4">
                            <h5>CC</h5>
                            <div id="ccEmailContainer">
                                <div class="input-group mb-2">
                                    <input type="email" name="ccEmails[0][]" class="form-control" placeholder="Enter CC">
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm addCcEmail">Add More</button>
                        </div>
        
                        <div class="col-md-4">
                            <h5>BCC</h5>
                            <div id="bccEmailContainer">
                                <div class="input-group mb-2">
                                    <input type="email" name="bccEmails[0][]" class="form-control" placeholder="Enter BCC">
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm addBccEmail">Add More</button>
                        </div>
                    </div>
        
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5>Email Type*</h5>
                            <div id="emailTypeContainer">
                                <div class="input-group mb-2">
                                    <input type="text" name="emailTypes[0][]" class="form-control" placeholder="Enter Email Type" required>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <h5>Form Type</h5>
                            <select name="form_type_name[]" class="form-control" multiple>
                                @foreach($formTypes as $formType)
                                    <option value="{{ $formType->id }}">{{ $formType->form_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row mt-3">
                <div class="col-md-6">
                    <button type="button" id="addDynamicEmail" class="btn btn-secondary btn-sm">Add One More Dynamic Email</button>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary">Save Dynamic Email</button>
                </div>
            </div>
        </form>
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let formIndex = 1;

        function addMoreEmail(containerId, inputName, isText = false) {
            const container = document.getElementById(containerId);
            const newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');

            if (isText) {
                newInput.innerHTML = `
                    <input type="text" name="${inputName}[${formIndex}][]" class="form-control" placeholder="Enter Email Type" required>
                    <button type="button" class="btn btn-danger remove-input">Remove</button>
                `;
            } else {
                newInput.innerHTML = `
                    <input type="email" name="${inputName}[${formIndex}][]" class="form-control" placeholder="Enter Email" required>
                    <button type="button" class="btn btn-danger remove-input">Remove</button>
                `;
            }

            container.appendChild(newInput);
        }

        document.getElementById('addDynamicEmail').addEventListener('click', function () {
            const newForm = document.querySelector('.dynamicEmailForm').cloneNode(true);
            newForm.querySelectorAll('input').forEach(input => input.value = ''); // Reset the inputs
            formIndex++;
            document.getElementById('dynamicEmailFormsContainer').appendChild(newForm);
        });

        document.querySelectorAll('.addToEmail').forEach(button => {
            button.addEventListener('click', function () {
                addMoreEmail('toEmailContainer', 'toEmails');
            });
        });
        
        document.querySelectorAll('.addCcEmail').forEach(button => {
            button.addEventListener('click', function () {
                addMoreEmail('ccEmailContainer', 'ccEmails');
            });
        });
        
        document.querySelectorAll('.addBccEmail').forEach(button => {
            button.addEventListener('click', function () {
                addMoreEmail('bccEmailContainer', 'bccEmails');
            });
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-input')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>

@endsection
