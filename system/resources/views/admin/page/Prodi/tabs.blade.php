<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a aria-selected="true" class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">Info Prodi</div>
                    </div>
                </a>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <a aria-selected="false" class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                    tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">Gallery</div>
                    </div>
                </a>
            </li> --}}
        </ul>
        <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                <ul class="list-group list-group-flush">
                    @foreach ($items as $k => $v)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- <div class="tab-pane fade" id="primaryprofile" role="tabpanel">

            </div> --}}
        </div>
    </div>
</div>
