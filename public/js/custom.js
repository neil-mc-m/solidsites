$(document).ready(function () {
    $('#contactForm').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var formSerialize = $(this).serializeArray();
            $('#sendButton').hide();
            $('.loader').show();
            $.ajax({
                type: $(this).attr('method'),
                url: url,
                data: formSerialize,

                success: function (response) {
                    $('.loader').hide();
                    $('#sendButton').show();
                    $('#alert').show();
                    // $('#myModal').modal('show');
                    console.log(response);
                    $('.message').html(response);
                    $('#contactForm')[0].reset();
                },
                error: function (response) {
                    // $('#preLoader').hide();
                    // $('#contactSubmit').show();
                    console.log(response);
                    $('.message').html(response);
                }
            })
        }
    );
// Select all links with hashes
    $('a[href*="#section"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function (event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function () {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        }

                    });
                }
            }
        });
});

