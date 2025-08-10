                <form action="/dosen/{{$dosen->nidn}}/update" method="POST" id="form-dosen" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="input-icon mb-3" bis_skin_checked="1">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                            </span>
                            <input type="number" readonly value="{{$dosen->nidn}}" id="nidn" class="form-control" placeholder="NIDN" name="nidn">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-icon mb-3" bis_skin_checked="1">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                              </svg>
                            </span>
                            <input type="text" value="{{$dosen->nama}}" id="nama" class="form-control" placeholder="Nama Lengkap Dosen" name="nama">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-icon mb-3" bis_skin_checked="1">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                            </span>
                            <input type="number" value="{{$dosen->nohp}}" id="nohp" class="form-control" placeholder="Telepon/No HP" name="nohp">
                        </div>
                    </div>
                    
                    <div class="mb-3" bis_skin_checked="1">
                        <div class="form-label" bis_skin_checked="1"></div>
                        <input type="file" class="form-control" name="foto" >
                        <input type="text" name="old_foto" value="{{$dosen->foto}}" hidden>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  
                                    viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                    stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                                </svg>simpan</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>