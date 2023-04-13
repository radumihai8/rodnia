@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="{{$item->proto->locale_name}}" subtitle="Edit item"></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <form method="POST" action="" onsubmit="trackChanges(event)">
                @csrf
                <div class="row g-3 justify-content-center">
                    <div class="col-auto form-floating mb-3">
                        <input type="number" name="vnum" value="{{$item->vnum}}" class="form-control">
                        <label>Vnum</label>
                    </div>
                    <div class="col-auto form-floating">
                        <input type="number" name="quantity" value="{{$item->quantity}}" class="form-control">
                        <label>Quantity</label>
                    </div>
                    <div class="col-auto">
                        <select name="subcategory_id" class="form-select">
                            @foreach($subcategories as $subcategory)

                                <option value="{{$subcategory->id}}"
                                        @if($subcategory->id == $item->subcategory_id)
                                            selected
                                        @endif
                               >{{$subcategory->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-auto form-floating mb-3">
                        <input type="number" name="discount" value="{{$item->discount}}" class="form-control">
                        <label>Discont percent</label>
                    </div>
                    <div class="col-auto">
                        <!-- datetime input -->
                        <input type="datetime-local" name="discount_start" value="{{\Carbon\Carbon::parse($item->discount_start)->toDateTimeLocalString()}}" class="form-control">
                        <label>Discount Start Date</label>
                    </div>
                    <div class="col-auto">
                        <!-- datetime input -->
                        <input type="datetime-local" name="discount_end" value="{{\Carbon\Carbon::parse($item->discount_end)->toDateTimeLocalString()}}" class="form-control">
                        <label>Discount End Date</label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-auto form-floating">
                        <input type="text" name="description" value="{{$item->description}}" class="form-control">
                        <label>Description</label>
                    </div>
                    <div class="col-auto form-floating">
                        <input type="number" name="price" value="{{$item->price}}" class="form-control">
                        <label>Price</label>
                    </div>
                    <div class="col-auto">
                        <select name="coin" class="form-control">
                            @if($item->coin == 'MD')
                                <option value="MD" selected>MD</option>
                                <option value="JD">JD</option>
                            @else
                                <option value="MD">MD</option>
                                <option value="JD" selected>JD</option>

                            @endif
                        </select>
                        <label>Coin</label>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto form-floating mb-3">
                            <input type="number" name="max_pcs" value="{{$item->max_pcs}}" class="form-control">
                            <label>Max. Quantity ( quantity one can buy at the same time )</label>
                        </div>
                        <div class="col-auto form-floating mb-3">
                            <input type="number" name="max_pcs_account" value="{{$item->max_pcs_account}}" class="form-control">
                            <label>Max. Quantity / Acc.</label>
                        </div>
                        <div class="col-auto form-floating mb-3">
                            <input type="number" name="max_pcs_global" value="{{$item->max_pcs_global}}"class="form-control">
                            <label>Max. Quantity Global (item stock)</label>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <!-- datetime input -->
                            <input type="datetime-local" name="available_start" value="{{$item->available_start}}" class="form-control">
                            <label>Available Start Date</label>
                        </div>
                        <div class="col-auto">
                            <!-- datetime input -->
                            <input type="datetime-local" name="available_end" value="{{$item->available_end}}" class="form-control">
                            <label>Available End Date</label>
                        </div>
                    </div>
                    @for($i=0; $i<=6; $i++)
                        <div class="row justify-content-center mb-2">
                            <div class="col-auto">
                                <select name="attrtype{{$i}}" class="form-control">

                                    <option value="0" @if($item->{"attrtype$i"} == 0) selected @endif>None</option>
                                    @foreach($bonuses as $bonus)
                                        <option value="{{$bonus['id']}}" @if($item->{"attrtype$i"} == $bonus['id']) selected @endif>{{$bonus['en']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto form-floating">
                                <input type="number" name="attrvalue{{$i}}" value='{!! $item->{"attrvalue$i"} !!}' class="form-control">
                                <label>attrvalue{{$i}}</label>
                            </div>
                        </div>
                    @endfor

                    <div class="col-auto justify-content-center">
                        <button type="submit" class="btn btn-primary mb-3">Send</button>
                    </div>

                </div>


            </form>


        </div>
    </div>
@endsection

<script>
    // First, define the function that will be called when the form is submitted
    function trackChanges(event) {
        // Get the form element from the event
        var form = event.target;
        // encode $item variable to js
        var item = {!! json_encode($item) !!};

        var confirmMessage = "";

        // Loop through all of the form inputs
        for (var i = 0; i < form.elements.length; i++) {
            // Get the current input element
            var input = form.elements[i];

            //if input.name is _token, continue
            if(input.name === '_token') continue;

            // Check if the input has a name attribute
            if (input.name) {
                var oldValue = item[input.name];
                var newValue = input.value;

                if(input.name === 'discount_start' || input.name === 'discount_end' || input.name === 'available_start' || input.name === 'available_end') {
                    //remove .000000Z from the end of the string
                    if(oldValue !== null)
                        oldValue = oldValue.slice(0, -8);
                }
                if(input.name === 'available_start' || input.name === 'available_end') {
                    //if the date has seconds and newValue doesn't, remove the seconds
                    if(oldValue !== null && oldValue.length > 16 && newValue.length === 16 ) {
                        oldValue = oldValue.slice(0, -3);
                    }
                }
                //if oldValue is null change it to empty
                if(oldValue === null) {
                    oldValue = '';
                }


                if (oldValue != newValue) {
                    // If the values are different, log a message to the console
                    //Add to confirmMessage
                    confirmMessage += "</p>The " + input.name + " field has changed from " + oldValue + " to " + newValue + "</p>";
                }
            }
        }

        //wait for user to confirm using confirm_modal function and promise
        confirm_modal(confirmMessage).then(function (result) {
            if (result) {
                // If the values are different, log a message to the console
                console.log("Form submitted");
                // Submit the form
                form.submit();
            } else {
                // If the values are different, log a message to the console
                console.log("Form not submitted");
            }
        });
    }


    //confirm function that shows a bootstrap modal and continues when clicking yes, and aborts when clicking no
    function confirm_modal(confirmMessage){
        //stop the form from submitting
        event.preventDefault();

        //create a bootstrap modal
        var modal = document.createElement('div');
        modal.classList.add('modal');
        modal.classList.add('fade');
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-labelledby', 'confirmModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        modal.innerHTML = `
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>`+confirmMessage+`</div>
                        <p>Are you sure you want to submit the form?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                    </div>
                </div>
            </div>
        `;
        //append the modal to the body
        document.body.appendChild(modal);
        //create a bootstrap modal
        var modal = new bootstrap.Modal(modal);
        //show the modal
        modal.show();

        //return true if the user clicks yes, and false if the user clicks no
        return new Promise((resolve, reject) => {
            modal._element.querySelector('.btn-primary').addEventListener('click', function() {
                resolve(true);
            });
            modal._element.querySelector('.btn-secondary').addEventListener('click', function() {
                resolve(false);
            });
        });

    }

</script>
