<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran X</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .product-card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        .container {
            flex: 1;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            color: white;
            font-weight: 200;
            background-color: #000000;
            text-align: center;
            padding: 20px 0;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Menu Restoran</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
                </li>
              
            </ul>
         
        </div>
    </nav>


    <div class="container mx-auto py-8">
        <h1 class="text-3xl mb-6">Daftar Menu</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="border rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $product->image ? $product->image->getUrl() : 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                        <p class="mb-2">Description: {{ $product->description }}</p>
                        <p class="mb-2">Price: {{ $product->price }}</p>
                        <p class="mb-2">Stock: {{ $product->stock }}</p>
                        <p class="mb-2">Rating: {{ $product->rating }}</p>
                        <p class="mb-4">Category: {{ App\Models\Product::CATEGORY_SELECT[$product->category] ?? '' }}</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ratingModal{{ $product->id }}">
                            Add Rating & Review
                        </button>
                    </div>
                </div>
                
                <div class="modal fade" id="ratingModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ratingModalLabel{{ $product->id }}">Add Rating & Review for {{ $product->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form untuk menambahkan rating dan ulasan (dapat dilihat dalam halaman admin)-->
                                <form id="rating-review-form" action="{{ route('add.rating.review', $product->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="rating">Rating:</label>
                                            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review:</label>
                                            <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        
                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span class="text-light">&copy;Restoran X</span>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
