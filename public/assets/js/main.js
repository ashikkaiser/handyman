
// Carousel Jquery
$(document).ready(function () {
    $('#banner-carousel').owlCarousel({
        dots: false,
        loop: false,
        infinity: false,

        autoplay: true,
        autoplayTimeout: 3000,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    $('#experts-carousel').owlCarousel({
        loop: true,
        dots: true,
        margin: 10,
        responsiveClass: true,
        nav: false,
        responsive: {
            0: {

                items: 1,
                nav: true
            },
            567: {
                items: 2,
                nav: true,
            },
            768: {
                items: 3,
                nav: true,
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            },
            1200: {
                items: 5,
                nav: true,
                loop: false
            }
        }
    })
});




function handleRateChange(e, num, isAdding) {
    let value = document.getElementById(num + "-number").innerHTML;
    let valueCount = parseInt(value);

    let initialNumber = 7;

    let message = {
        0: 'Unacceptable',
        1: 'Terrible',
        2: 'Very Poor',
        3: 'Poor',
        4: 'Below Expectations',
        5: 'Disappointing',
        6: 'Acceptable',
        7: 'OK',
        8: 'Good',
        9: 'Very Good',
        10: 'Excellent!'

    }
    if (isAdding && valueCount < 10) {
        initialNumber = valueCount + 1;
    }
    else if (!isAdding && valueCount > 1) {
        initialNumber = valueCount - 1;
    } else {
        initialNumber = valueCount;
    }
    e.parent().find(".count-number span").text(initialNumber)
    console.log(e.parent().find(".count-number input").val(initialNumber))

    document.getElementById(num + "-number").innerHTML = initialNumber;
    e.parent().parent().find('.count-number-after-x').text(message[initialNumber])

}


// Swiper Js
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 3,
    autoplay: true,
    loop: true,
    fade: 'true',
    centerSlide: 'true',
    grabCursor: 'true',
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,

    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        767: {
            slidesPerView: 2
        },
        992: {
            slidesPerView: 3
        },
    }
});



// select box Js

// const inputResult = document.querySelector('.inputBox');
// const result = document.querySelector('.result');

// inputResult.addEventListener('keyup', () => {
//     result.classList.add('show')
//     if (inputResult.value.length == 0) {
//         result.classList.remove('show')
//     }

// });



// function isValidUKPostcode(postcode) {
//     try {
//         postcode = postcode.replace(/\s/g, "");
//         const fromat = postcode
//             .toUpperCase()
//             .match(/^([A-Z]{1,2}\d{1,2}[A-Z]?)\s*(\d[A-Z]{2})$/);
//         const finalValue = `${fromat[1]} ${fromat[2]}`;
//         const regex = /^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([AZa-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))[0-9][A-Za-z]{2})$/i;
//         return {
//             isValid: regex.test(postcode),
//             formatedPostCode: finalValue,
//             error: false,
//             message: 'It is a valid postcode'
//         };
//     } catch (error) {
//         return { error: true, message: 'Invalid postcode' };
//     }
// };

$('#post_code').on('keyup', function () {
    var post_code = $(this).val();
    console.log(post_code)
    const isValidate = isValidUKPostcode(post_code);
    if (isValidate.error) {
        $('#post_code').addClass('is-invalid');
        $('#post_code').removeClass('is-valid');
    } else {
        $('#post_code').addClass('is-valid');
        $('#post_code').removeClass('is-invalid');
        $('#post_code').val(isValidate.formatedPostCode);
    }


});