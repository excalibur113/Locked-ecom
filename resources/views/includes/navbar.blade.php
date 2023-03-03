




<nav class="d-flex flex-column align-items-center gap-4 pt-5 pb-2">
    <div class="bg-dark">
        <div class="card rounded-circle m-auto" style="width: 6rem;">
            <img src="{{ asset('admin/blank_profile.png') }}" class="card-img-top" alt="store_profile">
        </div class="w-100">
        <div>
            <h5 class="text-center py-3 text-white store_name ">Locked n' Loaded </h5>
        </div>
        <div class="d-flex flex-column gap-4 " >
            <a href=" {{ url('add-product') }} " class="btn mx-auto add-button">Add a Product</a>
            <form action="/" method="GET" class="d-flex float-end " role="search">
                @csrf
                <div class="input-group mb-3 search-button-container mx-auto">
                    <input type="text" name="search" class="form-control search-button" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                    <button class="input-group-text" id="basic-addon2" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
            <div class="d-flex flex-column gap-2 category-container mx-auto">
                <h4 class="text-white my-4 text-left">Categories</h4>
                <div class="d-flex flex-column p-0 gap-2 w-100">
                    <a class="category-link" href="{{ url('/') }}">All Products</a>
                    <a class="category-link" href="{{ url('/') }}?category=featured">Featured</a>
                    <a class="category-link" href="{{ url('/') }}?category=pistols">Pistols</a>
                    <a class="category-link" href="{{ url('/') }}?category=shotguns">Shotguns</a>
                    <a class="category-link" href="{{ url('/') }}?category=rifles">Rifles</a>
                    <a class="category-link" href="{{ url('/') }}?category=snipers">Snipers</a>
                    <a class="category-link" href="{{ url('/') }}?category=others">Others</a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer d-flex mt-auto">
        <ul class="p-0 m-0 d-flex text-white gap-2">
            <li class="footer-links">Contact</li>
            <li class="footer-links">Term</li>
            <li class="footer-links">Privacy</li>
            <li class="footer-links"><i class="bi bi-c-circle"></i> Jsnflix</li>
        </ul>
    </div>
</nav>