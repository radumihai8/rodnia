<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 item-large ">
            <div class="row">
                <div class="col-4 item-icon text-center" id="item-icon">

                </div>
                <div class="col text-center item-desc">
                    <div class="desc-highlight">
                        <a class="modal-item-title" id="title"></a>
                        <br>
                        <br>
                        <div class="modal-item-bonuses" id="bonuses">

                        </div>
                        <p class="modal-item-desc" id="desc"></p>
                    </div>
                    <form method="POST" action="" id="buy-form">
                        @csrf
                        <div class="row justify-content-end">
                            <div class="col-6">
                                <div class="row ">
                                    <div class="col-5" id="quantityInput">
                                        <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="pcsHelp" value="1" min="1">
                                        <div id="pcsHelp" class="form-text">
                                            {{__('Quantity')}}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" onclick="return confirmOnclick(event)" id="buy-button" class="btn buy-button"><img class="coin-image" id="coin-image" src="{{asset('images/coins.png')}}"><span id="price"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    let confirmText = "";
    let piece_price = 0;
    let total_price = 0;
    let title = "";
    let coin = "";
    $(document).ready(function() {
        $('#itemModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);
            modal.find('#title').text(button.data('title'));
            title = button.data('title');
            modal.find('#coin-image').attr('src', button.data('coin-image'));
            modal.find('#desc').text(button.data('description'));
            modal.find('#price').text(button.data('price'));
            piece_price = button.data('price');
            total_price = button.data('price');
            modal.find('#bonuses').html(button.data('bonuses'));
            modal.find('#quantity').val(1);
            //if data.coin is JD add class btn-silver to #buy-button else add btn-primary
            console.log(button.data('coin'));
            coin = button.data('coin');
            if(button.data('coin') === 'JD') {
                modal.find('#buy-button').removeClass('btn-secondary').addClass('btn-silver');
            }
            else
                modal.find('#buy-button').removeClass('btn-silver').addClass('btn-secondary');

            //set value of input with id quantity to 1
            //if button data of max-quantity is greater than 1, then set max attribute of input with id quantity to max-quantity
            //else set the display of quantityInput to none
            if (button.data('max-quantity') > 1) {
                modal.find('#quantity').val(1).attr('max', button.data('max-quantity'));
            } else {
                modal.find('#quantityInput').css('display', 'none');
            }

            //if data-tradeable is 0 append a p with text to description
            console.log(button.data('tradeable'));
            if(button.data('tradeable') === false) {
                console.log('not tradeable');
                modal.find('#desc').append('<p class="text-danger">{{__("This item is not tradeable")}}</p>');
            }


            //If the value of input is greater than max-quantity, then set the value of input to max-quantity on keydown or up
            modal.find('#quantity').on('keydown keyup change', function() {
                if ($(this).val() > button.data('max-quantity')) {
                    $(this).val(button.data('max-quantity'));
                }

                total_price = piece_price * $(this).val();
                console.log(total_price);

                modal.find('#price').text(total_price);
            });

            const image = document.createElement('img');
            image.setAttribute('src', button.data('img'));
            //update the image in item-icon div to the current image
            modal.find('#item-icon').html(image);
            //update the buy form action to the current item id
            modal.find('#buy-form').attr('action', '/shop/item/' + button.data('id'));

        });


    });
    // function confirmOnclick(event) {
    //     // Display a confirmation prompt
    //     //wait for user to confirm using confirm_modal function and promise
    //     confirm_modal(confirmText).then(function (result) {
    //         if (result) {
    //             // If the values are different, log a message to the console
    //             console.log("Form submitted");
    //             // Submit the form
    //             return true;
    //         } else {
    //             // If the values are different, log a message to the console
    //             console.log("Form not submitted");
    //             return false;
    //         }
    //     });
    // }

    //confirm function that shows a bootstrap modal and continues when clicking yes, and aborts when clicking no
    function confirmOnclick(event){
        //stop the form from submitting
        var form = event.target;
        event.preventDefault();

        confirmText = "{{__('Are you sure you want to buy')}} " + title + " {{__('for')}} " + total_price + " " + coin + "?";
        //Make the confirm text on one line
        confirmText = confirmText.replace(/(\r\n|\n|\r)/gm, "");
        //Remove multiple spaces
        confirmText = confirmText.replace(/\s+/g, ' ');

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
                        <div>`+confirmText+`</div>
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

        modal._element.querySelector('.btn-primary').addEventListener('click', function() {
            //submit the form wit h #buy-form
            document.querySelector('#buy-form').submit();
            return true;
        });
        modal._element.querySelector('.btn-secondary').addEventListener('click', function() {
            event.preventDefault();
            return false;
        });

    }
</script>
