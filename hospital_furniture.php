<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing Furniture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            background:rgb(216, 230, 235);
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-bottom:50px ;
            margin-top: 30px;
            font-weight: 700;
        }

        .heading1 {
            font-size:30px;
            text-align: center;
            font-weight: 800;
        }

        .product-card {
            margin:14px;
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Updated image styling to fit the product card */
        .product-img {
            width: 100%;
            height: 300px; /* Fixed height for consistency */
            object-fit: contain; /* Ensures the whole image is displayed without cropping */
            transition: transform 0.3s;
            background: #fff; /* Adds a background to fill any empty space */
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .discount {
            color: #ff3f6c;
            font-weight: bold;
        }

        .btn-shop {
            background-color: #ff3f6c;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-shop:hover {
            background-color: #e62e5c;
        }

        .back-to-shop {
            text-decoration: none;
            color: #151112;
        }
    </style>
</head>

<body>

<div class="container">
    <h2 class="heading1">Explore Our Latest Collection</h2>

    <div class="row" id="productContainer">
        <!-- Products will be injected here -->
    </div>

     <!-- <div class="text-center mt-5">
        <a href="shop.html" class="back-to-shop">⬅ Back to Shop</a>
    </div>
</div>-->

<script>
    const tshirts = [
        { name: "<B>Beside Table</B>", price: 1799, discount: 20, img: "images/beside_table.jpg" },
        { name: "<b>Examination Table</b>", price: 1999, discount: 15, img: "images/examination_table.jpeg"},
        { name: "<b>Medicine Table</b>", price: 2149, discount: 10, img: "images/medicine_table.avif"},
        { name: "<b>Stretcher 1</b>", price: 2599, discount: 25, img: "images/stretcher2.jpg"},
        { name: "<b>Stryker</b>", price: 1199, discount: 30, img: "images/stryker.jpg" },
        { name: "<b>Room4</b>", price: 1899, discount: 18, img: "images/room4.webp"},
        { name: "<b>Room5</b>", price: 55599, discount: 22, img: "images/room5.jpeg" },
        { name: "<b>Room6</b>", price: 99999, discount: 12, img: "images/room6.jpeg" },
        { name: "<b>Room7</b>", price: 25599, discount: 18, img: "images/room7.webp" },
        { name: "<b>Examination Couch</b>", price: 59999, discount: 20, img: "images/examination_couch.jpeg" },
        { name: "<b>Single Bed</b>", price: 37899, discount: 16, img: "images/medicine_tray.webp" },
        { name: "<b>Stretcher2</b>", price: 159999, discount: 25, img: "images/stretcher.webp" }
    ];

    function displayProducts() {
        const container = document.getElementById('productContainer');
        container.innerHTML = '';

        tshirts.forEach(tshirt => {
            const discountedPrice = tshirt.price - (tshirt.price * tshirt.discount / 100);

            container.innerHTML += `
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card product-card">
                        <img src="${tshirt.img}" class="product-img card-img-top" alt="${tshirt.name}">
                        <div class="card-body text-center">
                            <h5 class="card-title">${tshirt.name}</h5>
                            <p class="card-text">₹${discountedPrice.toFixed(2)} <span class="discount">(${tshirt.discount}% OFF)</span></p>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    displayProducts();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
