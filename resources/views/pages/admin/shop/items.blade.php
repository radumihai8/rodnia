@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage ItemShop Items" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <div class="accordion" id="accordionItem">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Add new item
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="POST" action="" onsubmit="trackChanges(event)">
                                @csrf
                                <div class="row g-3 justify-content-center">
                                    <div class="col-auto form-floating mb-3">
                                        <input type="number" name="vnum" placeholder="1" class="form-control">
                                        <label>Vnum</label>
                                    </div>
                                    <div class="col-auto form-floating">
                                        <input type="number" name="quantity" value="1" class="form-control">
                                        <label>Quantity</label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="subcategory_id" class="form-select">
                                            @foreach($subcategories as $subcategory)
                                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 justify-content-center">
                                    <div class="col-auto form-floating mb-3">
                                        <input type="number" name="discount" value="0" class="form-control">
                                        <label>Discont percent</label>
                                    </div>
                                    <div class="col-auto">
                                        <!-- datetime input -->
                                        <input type="datetime-local" name="discount_start" class="form-control">
                                        <label>Discount Start Date</label>
                                    </div>
                                    <div class="col-auto">
                                        <!-- datetime input -->
                                        <input type="datetime-local" name="discount_end" class="form-control">
                                        <label>Discount End Date</label>
                                    </div>
                                </div>
                                <div class="row g-3 justify-content-center">
                                    <div class="col-auto">
                                        <!-- datetime input -->
                                        <input type="datetime-local" name="available_start" class="form-control">
                                        <label>Available Start Date</label>
                                    </div>
                                    <div class="col-auto">
                                        <!-- datetime input -->
                                        <input type="datetime-local" name="available_end" class="form-control">
                                        <label>Available End Date</label>
                                    </div>
                                </div>
                                <div class="row g-3 justify-content-center">
                                    <div class="col-auto form-floating mb-3">
                                        <input type="number" name="max_pcs" value="1" class="form-control">
                                        <label>Max. Quantity ( quantity one can buy at the same time )</label>
                                    </div>
                                    <div class="col-auto form-floating mb-3">
                                        <input type="number" name="max_pcs_account" class="form-control">
                                        <label>Max. Quantity / Acc.</label>
                                    </div>
                                    <div class="col-auto form-floating mb-3">
                                        <input type="number" name="max_pcs_global" class="form-control">
                                        <label>Max. Quantity Global (item stock)</label>
                                    </div>
                                </div>
                                <div class="row justify-content-center mb-3">
                                    <div class="col-auto form-floating">
                                        <input type="text" name="description" placeholder="Item description" class="form-control">
                                        <label>Description</label>
                                    </div>
                                    <div class="col-auto form-floating">
                                        <input type="number" name="price" placeholder="Item price" class="form-control">
                                        <label>Price</label>
                                    </div>
                                    <div class="col-auto mb-3">
                                        <select name="coin" class="form-control">
                                            <option value="MD" selected>{{__("MD")}}</option>
                                            <option value="JD">{{__("JD")}}</option>
                                        </select>
                                        <label>Coin</label>
                                    </div>
                                    @for($i=0; $i<=6; $i++)
                                        <div class="row justify-content-center mb-2">
                                            <div class="col-auto">
                                                <select name="attrtype{{$i}}" class="form-control">
                                                    <option value="0" selected>None</option>
                                                    @foreach($bonuses as $bonus)
                                                        <option value="{{$bonus['id']}}">{{$bonus['en']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto form-floating">
                                                <input type="number" name="attrvalue{{$i}}" value="0" class="form-control">
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
                </div>
            </div>
            <br>

            <table class="table table-striped table-hover">
                <tr>
                    <th>{{__('Vnum')}}</th>
                    <th>{{__('Category')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Action')}}</th>

                </tr>
               @foreach($items as $item)
                   <tr>
                        <td>{{$item->vnum}}</td>
                        <td>{{$item->subcategory->name}}</td>
                        <td>{{$item->proto->locale_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->price}} {{$item->coin}}</td>
                        <td>
                            <a href="{{route('shop.admin.item.edit', $item->id)}}" class="btn btn-secondary">Edit</a>
                        </td>
                   </tr>
               @endforeach
            </table>

            {{$items->links()}}
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
                //check if value is empty or null
                if(input.value !== '' && input.value !== null && input.value !== '0') {

                    // If the values are different, log a message to the console
                    console.log("" + input.name + "' :'" + input.value + "'");
                    //Add to confirmMessage
                    confirmMessage += "<p>" + input.name + " : " + input.value + "</p>";
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
