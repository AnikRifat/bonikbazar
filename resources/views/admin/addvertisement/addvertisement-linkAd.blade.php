<input type="hidden" value="{{ $data->id }}" name="id">
<div style="margin:0 10px;" class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row">
            <div class="col-12">
                <label class="mb-2" for="">Type your banner link</label>
                <input type="text" required name="redirect_url" value="{{ $data->redirect_url }}" placeholder="link"
                    class="mb-2 w-100 borders p-2 gb shadow-b rounded-3">
            </div>
            <div class="col-6">
                <label for="">Start date</label>
                <input type="date" required value="{{ Carbon\Carbon::parse($data->start_date)->format('Y-m-d') }}"
                    name="start_date" id="start_date" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
            </div>
            <div class="col-6">

                <label for="">End date</label>
                <input type="date" required min="{{ Carbon\Carbon::parse(now())->format('Y-m-d') }}"
                    value="{{ Carbon\Carbon::parse($data->end_date)->format('Y-m-d') }}" name="end_date" id="end_date"
                    class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Select Your Banner For Desktop</label>
                <select name="desktopAd_position" required="required" id="position"
                    class="form-control borders p-2 gb shadow-b rounded-3">
                    <option value="" selected disabled>Select an option</option>
                    <option value="top" @if ($data->position == 'top') selected @endif>Banner for desktop (Top
                        view)</option>
                    <option value="bottom" @if ($data->position == 'bottom') selected @endif>Banner for desktop (Bottom
                        view)</option>
                </select>



            </div>
        </div>

        <div class="col-6">
            <button onclick="preview('{{ asset('upload/marketing/' . $data->image) }}',960,250)" id="previewButton"
                type="button" class="btn btn-primary float-right mt-4">
                preview
            </button>
        </div>


    </div>

    <div class="col-12">

        <div class="form-group">

            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*"
                data-max-file-size="15M" data-default-file="{{ asset('upload/marketing/' . $data->image) }}"
                class="dropify shadow-b" name="desktop_image">
            <span>Size: 960 * 250 px</span>


        </div>
    </div>

    <div class="col-12 col-md-6">
        <label class="my-2 w-100" for="">Select Your Banner For Desktop (SideView)</label>
        <select name="sideAd_position" class="form-control gb shadow-b borders" id="desktop_sideAds">
            <option value="" selected disabled>Select an option</option>
            <option data-width="240" data-height="600" value="leftSide"
                @if ($data->sideAd_position == 'leftSide') selected @endif>Left Sidebar</option>
            <option data-width="160" data-height="600" value="rightSide"
                @if ($data->sideAd_position == 'rightSide') selected @endif>Right Sidebar</option>
        </select>
        <button onclick="preview('{{ asset('upload/marketing/' . $data->sideAd_image) }}',240,600)" id="previewButton"
            type="button" class="btn btn-primary my-2">
            preview
        </button>
        <div class="h-500">
            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*"
                data-max-file-size="15M" data-default-file="{{ asset('upload/marketing/' . $data->sideAd_image) }}"
                class=" dropify mt-2 shadow-b" name="sideAd_image">
            <span id="sideAdSize">Size: 240*600 px</span>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label class="mb-2 w-100" for="">Select Your Banner For Mobile</label>
        <button onclick="preview('{{ asset('upload/marketing/' . $data->mobile_image) }}',300,300)" id="previewButton"
            type="button" class="btn btn-primary float-left my-2">
            preview
        </button>
        <div>
            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*"
                data-max-file-size="5M" data-default-file="{{ asset('upload/marketing/' . $data->mobile_image) }}"
                class=" dropify mt-2 shadow-b" name="mobile_image">
            <span>Size: 300*300 px</span>
        </div>


    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $("#previewButton").click(function(event) {
            event.preventDefault(); // Prevent form submission
        });
    });


    function preview(imageUrl, w, h) {
        // Show SweetAlert modal
        Swal.fire({
            imageUrl: imageUrl,
            imageAlt: "Custom image",
            customClass: {
                image: 'zoomable-image' // Add a custom class for styling
            },
            didRender: () => {
                const image = document.querySelector('.swal2-image');
                const imageContainer = image.parentElement; // Get the image container

                // Load the image to get its natural dimensions
                const imagePromise = new Promise((resolve, reject) => {
                    const img = new Image();
                    img.onload = () => resolve({
                        width: w,
                        height: h
                    });
                    img.onerror = reject;
                    img.src = imageUrl;
                });

                imagePromise.then(({
                    width,
                    height
                }) => {
                    // Calculate scaling factor to increase both dimensions proportionally
                    // const scaleFactor = Math.min(1.5, Math.max(imageContainer.clientWidth / width, imageContainer.clientHeight / height)); // Increase scale by a factor of 1.5 (adjust as needed)

                    // // Update image scaling and position
                    // image.style.transform = `scale(${scaleFactor})`;
                    // image.style.top = `calc(50% - ${(height * scaleFactor) / 2}px)`; // Center the image vertically (adjust as needed)

                    // Define zoom behavior on mouse wheel (optional)
                    image.addEventListener('wheel', (event) => {
                        const zoomIncrement = event.deltaY > 0 ? -0.1 : 0.1;

                        // Update image zoom level within reasonable limits
                        const currentZoom = parseFloat(image.style.transform.slice(6, -
                            1)) ||
                            1; // Extract current scale factor from transform property
                        const newZoom = Math.max(0.5, Math.min(2, currentZoom +
                            zoomIncrement));
                        image.style.transform = `scale(${newZoom})`;
                    });
                });
            }
        });

        // Set z-index to ensure the SweetAlert modal appears on top
        $(".swal2-container").css("z-index", "100000000000"); // Adjust z-index as needed
    }
</script>
