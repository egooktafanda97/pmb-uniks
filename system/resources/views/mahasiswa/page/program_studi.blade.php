<div class="row id-hide"
     id="card-prodi">
    <div class="col col-lg-9 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                PILIH PROGRA STUDI <span class="in-require">*</span>
            </div>
            <div class="card-body">
                <select aria-label="program studi"
                        class="form-select single-select"
                        id="inputGroupSelect03">
                    <option selected>Pilih Program Studi </option>
                    @foreach ($prodi as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                    @endforeach
                </select>
                <div class="mt-4"
                     id="info-prodi">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                PROGRAM STUDI ...
                            </strong>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-primary"
                                role="tablist">
                                <li class="nav-item"
                                    role="presentation">
                                    <a aria-selected="true"
                                       class="nav-link active"
                                       data-bs-toggle="tab"
                                       href="#primaryhome"
                                       role="tab">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">SYARAT</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item"
                                    role="presentation">
                                    <a aria-selected="false"
                                       class="nav-link"
                                       data-bs-toggle="tab"
                                       href="#primaryprofile"
                                       role="tab"
                                       tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">BIAYA</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item"
                                    role="presentation">
                                    <a aria-selected="false"
                                       class="nav-link"
                                       data-bs-toggle="tab"
                                       href="#primarycontact"
                                       role="tab"
                                       tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">TENTANG</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-3">
                                <div class="tab-pane fade active show"
                                     id="primaryhome"
                                     role="tabpanel">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit eos
                                    ipsa, dignissimos vel odio voluptatem aliquam distinctio impedit? Molestiae,
                                    exercitationem enim? Sit, tempora cupiditate consequuntur quam repellat dolore
                                    sequi?
                                </div>
                                <div class="tab-pane fade"
                                     id="primaryprofile"
                                     role="tabpanel">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit eos
                                    ipsa, dignissimos vel odio voluptatem aliquam distinctio impedit? Molestiae,
                                    exercitationem enim? Sit, tempora cupiditate consequuntur quam repellat dolore
                                    sequi?
                                </div>
                                <div class="tab-pane fade"
                                     id="primarycontact"
                                     role="tabpanel">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit eos
                                    ipsa, dignissimos vel odio voluptatem aliquam distinctio impedit? Molestiae,
                                    exercitationem enim? Sit, tempora cupiditate consequuntur quam repellat dolore
                                    sequi?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 l-right">
                    <button class="btn btn-primary px-5 rounded-0 btn-sm next-card"
                            data-cardId="card-prodi"
                            data-nextId="card-mhs">Next <i class="fa fa-long-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
