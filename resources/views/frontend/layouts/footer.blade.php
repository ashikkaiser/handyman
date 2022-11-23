<style>
    #appendlist input[type="radio"] {
        display: none;
    }

    .find-content {
        display: flex;
        align-items: center;
        border: 1px solid #204746;
        border-radius: 5px;
    }

    .find-content .input-group input {

        border-radius: 0 5px 5px 0 !important;
    }

    .find-content .input-group input,
    .find-content .input-group span {
        border: none;
        padding: 10px 15px;
    }

    .find-content .input-group input:focus {
        box-shadow: none !important;
        outline: none !important;
        border: none !important;
    }

    .find-content .input-group input::placeholder {
        font-size: 14px;
        font-weight: 300;
    }

    .modal .find-content button {
        padding: 6px 25px;
        border: 1px solid #fff;
        outline: none;
        background-color: #204746;
        color: #fff;
        margin-left: 15px;
        border-radius: 5px;
    }

    .input-box span {
        font-size: 12px;

    }

    .input-box {
        position: relative;
    }

    .input-icon {
        position: absolute;
        right: 5%;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
    }

    .pac-container {
        z-index: 9999;
    }

    .modal .list-group-item {
        cursor: pointer !important;
    }

    .list-group-item label {
        cursor: pointer !important;
    }

    .list-group-item:hover {

        color: gray;
    }

    .icon-box img {
        width: 83px;
        height: 83px;

    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        #select_category {
            width: 100px;
        }
    }
</style>


<footer>
    <div class="modal fade" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="text-black"> What do you need this service to help with?</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('search') }}" id="searchForm" method="POST">
                        @csrf
                        <ul class="list-group list-group-flush" id="appendlist">

                        </ul>
                        <input type="hidden" name="c">

                        <div class="text-center catloading">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="find-content">
                            <div class="input-group input-box">
                                <span class="input-group-text">Find</span>
                                <input type="text" class="form-control postal-code" id="postalcode" required
                                    placeholder="Enter Postal Code" name="postal_code">
                                <input type="hidden" name="lat">
                                <input type="hidden" name="lng">
                                <div class="input-icon">
                                    <img src="/assets/images/elc/icon.gif" alt="" style="margin-bottom: 10px;">
                                </div>
                            </div>
                            <button type="submit">Search</button>
                        </div>

                    </form>



                </div>

            </div>
        </div>
    </div>



    </select>

    <div class="container">
        <div class="top-footer">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="single-footer-item">
                        <h3 class="footer-heading">Address</h3>
                        <ul> {!! nl2br(site()->address) !!} </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single-footer-item">
                        <h3 class="footer-heading">Main menu</h3>
                        <ul>
                            @foreach (json_decode(site()->footer_links)->main as $item)
                                <li>
                                    <a href="{{ $item->link }}" class="text-white">{{ $item->label }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single-footer-item">
                        <h3 class="footer-heading">Help</h3>
                        <ul>
                            @foreach (json_decode(site()->footer_links)->quick as $item)
                                <li>
                                    <a href="{{ $item->link }}" class="text-white">{{ $item->label }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="single-footer-item">
                        <h3 class="footer-heading">Services</h3>
                        <ul>
                            @foreach (allCats() as $item)
                                <li onclick="inputClick({{ $item->id }})" style="cursor:pointer">{{ $item->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom pt-5 justify-content-center">

            <div class="text-center">
                <p>{{ site()->copy_right_text }}</p>
            </div>
        </div>
    </div>
</footer>
<!-- Jquery Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>


<!-- Boostrap Jquery -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>

<!-- Owl carousel Js  -->
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/swl.js"></script>

<!-- Main JS  -->
<script src="/assets/js/swiper-bundle.min.js"></script>

<script src="/assets/js/main.js"></script>

<script>
    $('.catloading').hide();
    const myModal = new bootstrap.Modal('#searchModal', {
        keyboard: false
    })

    function showSearchModal(category) {
        $('#appendlist').html(null)
        $('.find-content').hide()
        $('input[name="c"]').val(category)
        $('.catloading').show();
        $.post("{{ route('tasker.register.getSubCategory') }}", {
            _token: "{{ csrf_token() }}",
            id: category
        }, function(data) {

            $('.catloading').hide();
            if (category === 'all' || category === null) {
                data.forEach(element => {
                    const exdata = JSON.stringify(element)
                    $('#appendlist').append(
                        `<li class="list-group-item" onclick="showSearchModal('${element.slug}')">${element.text}</li>`
                    )
                });
            } else {
                data.forEach(element => {
                    $('#appendlist').append(
                        `<li class="list-group-item" onclick="selectSubCategory(${element.id})">
                              <input type="radio" name="s" value="${element.id}" id="r${element.id}" required>
                             <label for="r${element.id}"> ${element.text} </label>
                          </li>`
                    )
                });
            }

            $('#searchModal').modal('show');

        });

        myModal.show()
    }

    function selectSubCategory(id) {
        // check this value
        $("#r" + id).prop("checked", true);
        var subcategory = $('input[name="s"]:checked')
        if (subcategory.val()) {
            subcategory.parent().addClass('active')
            subcategory.parent().siblings().removeClass('active')
            $('#appendlist').attr('style', 'display:none')
            $('.find-content').show()
        }

    }

    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var data = $(this).serializeArray()
        var lat = data.find(d => d.name == 'lat').value
        if (lat == '') {
            alert('Please enter valid postal code')
            return false
        }
        this.submit()
    })
</script>

<script>
    function initMap() {
        $('.postal-code').each(function(item) {
            input = $('.postal-code')[item]
            const options = {
                componentRestrictions: {
                    country: "uk"
                },
                fields: ["address_components", "geometry", "icon", "name"],
                strictBounds: false,
                types: ["postal_code"],
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);
            google.maps.event.addListener(autocomplete, 'place_changed', function(e) {
                var place = autocomplete.getPlace();
                var code = place.address_components.find(function(item) {
                    return item.types.includes('postal_code');
                });
                var town = place.address_components.find(function(item) {
                    return item.types.includes('postal_town');
                });
                // $(this).val(code.long_name)

                console.log(input)
                $(`input[name="${input.name}"]`).val(code.long_name);
                $(`#postalcodeJob`).val(code.long_name);
                $(`#pernalpostcode`).val(code.long_name);
                $(`#postcode`).val(code.long_name);

                $('input[name="lat"]').val(place.geometry.location.lng());
                $('input[name="lng"]').val(place.geometry.location.lat());

            });
        })


    }
</script>
<script>
    const myModalEl = document.getElementById('searchModal')
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $('#appendlist').attr('style', 'display:block')
        $('.find-content').hide()
        $('#appendlist').html(null)
    })


    function inputClick(value = null) {
        if (value) {
            const category = value
            showSearchModal(value)
        } else {
            var catinput = $('#select_category')
            const category = catinput.find(':selected').data('slug')
            showSearchModal(catinput.val())
        }



    }
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNLzN1W7LEWXFF8ssJPU7OZyh3e9-mUrM&libraries=places&callback=initMap">
</script>
