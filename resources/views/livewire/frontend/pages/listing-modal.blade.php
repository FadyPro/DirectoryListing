<div>
    <!-- Modal -->
    @if($selectId)
        <div wire:ignore.self class="modal show" id="ProductModal" tabindex="-1" aria-labelledby="ProductModal" aria-hidden="true" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel"></h5>
                        <button type="button" wire:click="closeModal()" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- CART POPUT START -->
                        <div class="col-12 col-xl-12 col-md-12">
                            <div class="map_popup_content">
                                <div class="img">
                                    <td> <img src="{{(!empty($listing->image))? url('/uploads/listing/'.$listing->image) : url('/uploads/no-image.png')}}" alt="{{ $listing->title }}"  class="img-fluid w-100"> </td>
                                </div>
                                <div class="map_popup_text">
                                    @if ($listing->is_featured)
                                        <span><i class="far fa-star"></i> Featured</span>
                                    @endif
                                    @if ($listing->is_verified)
                                        <span class="red"><i class="far fa-check"></i> verified</span>
                                    @endif
                                    <h5>{{ $listing->title }}</h5>
                                    <a class="call" href="callto:{{ $listing->phone }}"><i class="fal fa-phone-alt"></i>
                                        {{ $listing->phone }}</a>
                                    <a class="mail" href="mailto:{{ $listing->email }}"><i class="fal fa-envelope"></i>
                                        {{ $listing->email }}</a>
                                    <p>{{ truncate(strip_tags($listing->description), 140) }}</p>
                                    <a class="read_btn" href="{{ route('listing.show', $listing->slug) }}">read more</a>
                                </div>
                            </div>
                        </div>
                        @if ($listing->google_map_embed_code)
                            <div class="col-12 col-xl-12 col-md-12">
                                <div class="map_popup_content_map">
                                    {!! $listing->google_map_embed_code !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
    <!-- CART POPUT END -->
    <style>
        .modal-dialog {
            max-width: 600px;
        }
    </style>
</div>
