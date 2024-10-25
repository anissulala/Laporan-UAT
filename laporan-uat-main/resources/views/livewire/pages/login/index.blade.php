<div>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-10 col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body position-relative">
                        <div class="position-absolute top-0 start-0 p-3">
                            <img src="{{ asset('assets/img/logo-3.png') }}" alt="Logo" class="img-fluid illustration-image" style="max-height: 35px;">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-5 d-none d-lg-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/img/ilustrasi.png') }}" alt="login image" class="img-fluid illustration-image">
                            </div>
                            <div class="col-lg-5 d-flex flex-column justify-content-center p-5">
                                <h4 class="mb-4 fs-2">Halo,<br>Selamat Datang</h4>
                                
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
    
                                <form>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email / Username</label>
                                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary w-100 mb-3" wire:click.prevent="login">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>