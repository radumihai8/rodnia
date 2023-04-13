let navbar = 0;

function toggle_offcanvas() {


    if (navbar === 1) {
        console.log('navbar e 1')

        document.getElementById('mainNav').classList.remove('show');
        document.body.classList.remove('offcanvas-active');
        navbar = 0;
        document.getElementById("showbtn").innerHTML = "<i class=\"bi bi-list\"></i>";
    } else {
        console.log('navbar e 0')

        document.getElementById('mainNav').classList.add('show');
        document.body.classList.add('offcanvas-active');
        navbar = 1;
        document.getElementById("showbtn").innerHTML = "<i class=\"bi bi-x\"></i>";
    }
}

$(document).click(function (e) {
    //check if click is in a child of navbar
    if (!$(e.target).closest('#mainNav').length && !$(e.target).is('#mainNav') && !$(e.target).is('#showbtn') && navbar === 1) {
        toggle_offcanvas();
    }
});

//when page is loaded
$(document).ready(function () {
    // on the input with name social_id don't let user input anything but numbers on input, keyup and keydown, and paste
    $("input[name=social_id]").on("input keyup keydown paste", function () {
        //if the value is not a number remove all non numbers
        if (isNaN($(this).val())) {
            $(this).val($(this).val().replace(/\D/g, ''));
        }
    });
});
